<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Pooja;
use App\Models\Pandit;
use App\Models\PoojaPackage;
use App\Models\SamagriItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['pooja', 'pandit', 'user'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($poojaId)
    {
        $pooja = Pooja::with(['packages', 'samagriItems'])->findOrFail($poojaId);
        $pandits = Pandit::where('is_active', 1)->get();
        
        return view('bookings.create', compact('pooja', 'pandits'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pooja_id' => 'required|exists:poojas,id',
            'pooja_package_id' => 'required|exists:pooja_packages,id',
            'pandit_id' => 'nullable|exists:pandits,id',
            'booking_date' => 'required|date|after:today',
            'booking_time' => 'required|date_format:H:i',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'special_instructions' => 'nullable|string|max:1000',
            'samagri_items' => 'nullable|array',
            'samagri_items.*.id' => 'exists:samagri_items,id',
            'samagri_items.*.quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // Calculate total amount
            $package = PoojaPackage::findOrFail($validated['pooja_package_id']);
            $samagriTotal = 0;
            
            if (!empty($validated['samagri_items'])) {
                foreach ($validated['samagri_items'] as $item) {
                    $samagriItem = SamagriItem::findOrFail($item['id']);
                    $samagriTotal += $samagriItem->price * $item['quantity'];
                }
            }

            $totalAmount = $package->price + $samagriTotal;

            // Calculate booking times
            $startTime = Carbon::parse($validated['booking_time']);
            $endTime = (clone $startTime)->addMinutes($package->duration_minutes);

            // Create booking
            $booking = Booking::create([
                'user_id' => Auth::id(),
                'pooja_id' => $validated['pooja_id'],
                'pooja_package_id' => $validated['pooja_package_id'],
                'pandit_id' => $validated['pandit_id'] ?? null,
                'booking_date' => $validated['booking_date'],
                'start_time' => $startTime->format('H:i:s'),
                'end_time' => $endTime->format('H:i:s'),
                'address' => $validated['address'],
                'city' => $validated['city'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode'],
                'latitude' => $validated['latitude'],
                'longitude' => $validated['longitude'],
                'special_instructions' => $validated['special_instructions'],
                'pooja_price' => $package->price,
                'samagri_price' => $samagriTotal,
                'pandit_charges' => 0.00, // Handle later
                'platform_fee' => 0.00, // Handle later
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            // Attach samagri items
            if (!empty($validated['samagri_items'])) {
                foreach ($validated['samagri_items'] as $item) {
                    $booking->samagriItems()->attach($item['id'], [
                        'quantity' => $item['quantity'],
                        'price' => SamagriItem::findOrFail($item['id'])->price,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('bookings.show', $booking->id)
                ->with('success', 'Booking created successfully! Please proceed with payment.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->with('error', 'Failed to create booking: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        // Check if booking belongs to authenticated user
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this booking.');
        }

        $booking->load(['pooja', 'pandit', 'user', 'samagriItems']);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Display user's bookings.
     */
    public function userBookings()
    {
        $bookings = Booking::with(['pooja', 'pandit'])
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.user', compact('bookings'));
    }

    /**
     * Accept booking (for pandits).
     */
    public function accept(Booking $booking)
    {
        // Check if user is pandit and owns this booking
        if (Auth::user()->user_type !== 'pandit' || $booking->pandit_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->update(['status' => 'confirmed']);

        return redirect()->back()->with('success', 'Booking accepted successfully!');
    }

    /**
     * Reject booking (for pandits).
     */
    public function reject(Booking $booking)
    {
        // Check if user is pandit and owns this booking
        if (Auth::user()->user_type !== 'pandit' || $booking->pandit_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect()->back()->with('success', 'Booking rejected successfully!');
    }
}
