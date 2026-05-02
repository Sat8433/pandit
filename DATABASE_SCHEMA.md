# Pooja Booking Platform - Database Schema Design

## Overview
Complete database schema for Pooja Booking Platform with relationships and constraints.

## Tables Structure

### 1. users
```sql
- id (bigint, primary, auto_increment)
- name (varchar, 255)
- email (varchar, 255, unique)
- email_verified_at (timestamp, nullable)
- mobile (varchar, 20, unique, nullable)
- mobile_verified_at (timestamp, nullable)
- password (varchar, 255)
- user_type (enum: user, pandit, admin)
- profile_image (varchar, 255, nullable)
- address (text, nullable)
- city (varchar, 100, nullable)
- state (varchar, 100, nullable)
- pincode (varchar, 10, nullable)
- latitude (decimal, 10, 8, nullable)
- longitude (decimal, 11, 8, nullable)
- is_active (boolean, default: true)
- remember_token (varchar, 100, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 2. pandits
```sql
- id (bigint, primary, auto_increment)
- user_id (bigint, foreign: users.id)
- experience_years (integer)
- languages_known (json) // ["Hindi", "English", "Sanskrit"]
- specialization (json) // ["Satyanarayan Puja", "Griha Pravesh"]
- verification_status (enum: pending, approved, rejected)
- verification_documents (json, nullable) // document paths
- rating (decimal, 3, 2, default: 0.00)
- total_bookings (integer, default: 0)
- commission_rate (decimal, 5, 2, default: 10.00)
- bio (text, nullable)
- bank_account (varchar, 50, nullable)
- ifsc_code (varchar, 20, nullable)
- is_available (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

### 3. poojas
```sql
- id (bigint, primary, auto_increment)
- name (varchar, 255)
- slug (varchar, 255, unique)
- description (text)
- duration_minutes (integer)
- base_price (decimal, 10, 2)
- category (varchar, 100)
- image (varchar, 255, nullable)
- is_active (boolean, default: true)
- seo_title (varchar, 255, nullable)
- seo_description (text, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 4. pooja_packages
```sql
- id (bigint, primary, auto_increment)
- pooja_id (bigint, foreign: poojas.id)
- name (varchar, 255) // Basic, Standard, Premium
- description (text)
- price (decimal, 10, 2)
- duration_minutes (integer)
- is_active (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

### 5. samagri_items
```sql
- id (bigint, primary, auto_increment)
- name (varchar, 255)
- description (text, nullable)
- unit (varchar, 50) // kg, pieces, liters, etc.
- price_per_unit (decimal, 10, 2)
- stock_quantity (integer, default: 0)
- is_active (boolean, default: true)
- image (varchar, 255, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 6. pooja_samagri
```sql
- id (bigint, primary, auto_increment)
- pooja_id (bigint, foreign: poojas.id)
- samagri_id (bigint, foreign: samagri_items.id)
- quantity (decimal, 10, 2)
- is_required (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

### 7. samagri_kits
```sql
- id (bigint, primary, auto_increment)
- name (varchar, 255)
- description (text)
- price (decimal, 10, 2)
- image (varchar, 255, nullable)
- is_active (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

### 8. kit_items
```sql
- id (bigint, primary, auto_increment)
- kit_id (bigint, foreign: samagri_kits.id)
- samagri_id (bigint, foreign: samagri_items.id)
- quantity (decimal, 10, 2)
- created_at (timestamp)
- updated_at (timestamp)
```

### 9. pandit_availability
```sql
- id (bigint, primary, auto_increment)
- pandit_id (bigint, foreign: pandits.id)
- date (date)
- start_time (time)
- end_time (time)
- is_available (boolean, default: true)
- notes (text, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 10. bookings
```sql
- id (bigint, primary, auto_increment)
- user_id (bigint, foreign: users.id)
- pandit_id (bigint, foreign: pandits.id, nullable)
- pooja_id (bigint, foreign: poojas.id)
- pooja_package_id (bigint, foreign: pooja_packages.id, nullable)
- booking_date (date)
- start_time (time)
- end_time (time)
- status (enum: pending, confirmed, assigned, in_progress, completed, cancelled, refunded)
- pooja_price (decimal, 10, 2)
- samagri_price (decimal, 10, 2)
- pandit_charges (decimal, 10, 2)
- platform_fee (decimal, 10, 2)
- total_amount (decimal, 10, 2)
- address (text)
- landmark (varchar, 255, nullable)
- city (varchar, 100)
- state (varchar, 100)
- pincode (varchar, 10)
- latitude (decimal, 10, 8, nullable)
- longitude (decimal, 11, 8, nullable)
- special_instructions (text, nullable)
- assigned_at (timestamp, nullable)
- started_at (timestamp, nullable)
- completed_at (timestamp, nullable)
- cancelled_at (timestamp, nullable)
- cancellation_reason (text, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 11. booking_samagri
```sql
- id (bigint, primary, auto_increment)
- booking_id (bigint, foreign: bookings.id)
- samagri_id (bigint, foreign: samagri_items.id)
- quantity (decimal, 10, 2)
- unit_price (decimal, 10, 2)
- total_price (decimal, 10, 2)
- is_kit_item (boolean, default: false)
- kit_id (bigint, foreign: samagri_kits.id, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 12. payments
```sql
- id (bigint, primary, auto_increment)
- booking_id (bigint, foreign: bookings.id)
- payment_method (enum: razorpay, cod, upi)
- payment_status (enum: pending, processing, completed, failed, refunded)
- amount (decimal, 10, 2)
- transaction_id (varchar, 255, nullable)
- razorpay_order_id (varchar, 255, nullable)
- razorpay_payment_id (varchar, 255, nullable)
- razorpay_signature (varchar, 255, nullable)
- paid_at (timestamp, nullable)
- refunded_at (timestamp, nullable)
- refund_id (varchar, 255, nullable)
- notes (text, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

### 13. reviews
```sql
- id (bigint, primary, auto_increment)
- booking_id (bigint, foreign: bookings.id)
- user_id (bigint, foreign: users.id)
- pandit_id (bigint, foreign: pandits.id)
- rating (integer, 1-5)
- review_text (text, nullable)
- is_visible (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

### 14. coupons
```sql
- id (bigint, primary, auto_increment)
- code (varchar, 50, unique)
- description (text)
- discount_type (enum: percentage, fixed)
- discount_value (decimal, 10, 2)
- minimum_amount (decimal, 10, 2, nullable)
- maximum_discount (decimal, 10, 2, nullable)
- usage_limit (integer, nullable)
- used_count (integer, default: 0)
- valid_from (date)
- valid_until (date)
- is_active (boolean, default: true)
- created_at (timestamp)
- updated_at (timestamp)
```

### 15. coupon_usage
```sql
- id (bigint, primary, auto_increment)
- coupon_id (bigint, foreign: coupons.id)
- user_id (bigint, foreign: users.id)
- booking_id (bigint, foreign: bookings.id)
- discount_amount (decimal, 10, 2)
- created_at (timestamp)
```

### 16. notifications
```sql
- id (bigint, primary, auto_increment)
- user_id (bigint, foreign: users.id, nullable)
- pandit_id (bigint, foreign: pandits.id, nullable)
- title (varchar, 255)
- message (text)
- type (enum: booking, payment, system, review)
- is_read (boolean, default: false)
- sent_via (json) // ["email", "sms", "whatsapp", "push"]
- created_at (timestamp)
- updated_at (timestamp)
```

### 17. settings
```sql
- id (bigint, primary, auto_increment)
- key (varchar, 255, unique)
- value (text)
- description (text, nullable)
- created_at (timestamp)
- updated_at (timestamp)
```

## Key Relationships

1. **users** 1:1 **pandits** (user_type = 'pandit')
2. **poojas** 1:M **pooja_packages**
3. **poojas** M:M **samagri_items** through **pooja_samagri**
4. **samagri_kits** M:M **samagri_items** through **kit_items**
5. **pandits** 1:M **pandit_availability**
6. **bookings** belongs to **users**, **pandits**, **poojas**
7. **bookings** M:M **samagri_items** through **booking_samagri**
8. **bookings** 1:1 **payments**
9. **bookings** 1:1 **reviews**
10. **coupons** M:M **users** through **coupon_usage**

## Indexes

- users.email, users.mobile
- poojas.slug
- bookings.user_id, bookings.pandit_id, bookings.booking_date, bookings.status
- pandit_availability.pandit_id, pandit_availability.date
- payments.booking_id, payments.transaction_id
- reviews.pandit_id, reviews.rating
