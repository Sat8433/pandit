# Pooja Booking Platform - Setup Guide

## Overview
A complete production-ready web application for booking Hindu poojas online, similar to UrbanClap. Built with Laravel (PHP) and MySQL.

## Features

### User Features
- User registration & login (email + mobile OTP optional)
- Browse poojas list with filtering
- View detailed pooja information
- Select date and time slots
- Select or auto-assign pandits
- Add pooja samagri (full kit or individual items)
- Add delivery address
- Place bookings with payment integration
- View booking history and status
- Rate and review completed poojas

### Pandit Features
- Pandit registration/login
- Profile management (experience, languages, specialization)
- Set availability calendar and time slots
- Accept/reject booking requests
- View earnings and booking history
- Manage profile and verification

### Admin Features
- Dashboard with analytics (total bookings, revenue, users)
- Manage poojas (CRUD operations)
- Manage pandits (approval/rejection)
- Manage samagri items and kits
- Manage bookings and payments
- Commission management
- Reports and analytics

## Tech Stack
- **Backend**: Laravel 12.x
- **Database**: MySQL 8.0+
- **Frontend**: Blade + Tailwind CSS
- **Authentication**: Laravel Breeze
- **Payment**: Razorpay Integration
- **Real-time**: Laravel Echo (optional)

## Prerequisites
- PHP 8.2+
- MySQL 8.0+
- Composer
- Node.js & NPM
- Git

## Installation Steps

### 1. Clone the Repository
```bash
git clone <repository-url>
cd panditbooking
```

### 2. Install Dependencies
```bash
composer install
npm install
npm run build
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Database Setup
Create a MySQL database named `panditbooking`:

```sql
CREATE DATABASE panditbooking CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=panditbooking
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 5. Run Migrations
```bash
php artisan migrate
```

### 6. Seed Data (Optional)
```bash
php artisan db:seed
```

### 7. Create Storage Link
```bash
php artisan storage:link
```

### 8. Start Development Server
```bash
php artisan serve
npm run dev
```

Visit `http://localhost:8000` in your browser.

## Database Schema

The application uses the following main tables:

- **users** - User authentication and profiles
- **pandits** - Pandit-specific information
- **poojas** - Pooja services and details
- **pooja_packages** - Pooja pricing packages
- **samagri_items** - Pooja materials inventory
- **samagri_kits** - Pre-packaged samagri bundles
- **bookings** - Booking records and status
- **payments** - Payment transactions
- **reviews** - User ratings and feedback
- **notifications** - System notifications

## API Endpoints

### Authentication
- `POST /login` - User login
- `POST /register` - User registration
- `POST /logout` - User logout

### Poojas
- `GET /api/poojas` - List all poojas
- `GET /api/poojas/{id}` - Get pooja details
- `GET /api/poojas/{id}/packages` - Get pooja packages

### Bookings
- `GET /api/bookings` - User bookings
- `POST /api/bookings` - Create new booking
- `PUT /api/bookings/{id}` - Update booking
- `DELETE /api/bookings/{id}` - Cancel booking

### Payments
- `POST /api/payments/razorpay/create-order` - Create Razorpay order
- `POST /api/payments/razorpay/verify` - Verify payment

## Configuration

### Razorpay Setup
1. Create a Razorpay account
2. Get your API keys from Razorpay dashboard
3. Add keys to `.env`:

```env
RAZORPAY_KEY_ID=your_key_id
RAZORPAY_KEY_SECRET=your_key_secret
RAZORPAY_WEBHOOK_SECRET=your_webhook_secret
```

### Email Configuration
Update `.env` for email notifications:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
```

## Deployment

### For Production
1. Set `APP_ENV=production` in `.env`
2. Run `php artisan config:cache`
3. Run `php artisan route:cache`
4. Run `php artisan view:cache`
5. Set up SSL certificate
6. Configure web server (Apache/Nginx)

### Sample Nginx Configuration
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/panditbooking/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

## Testing
```bash
# Run tests
php artisan test

# Run specific test
php artisan test --filter BookingTest
```

## Common Issues

### Migration Errors
- Ensure database exists and credentials are correct
- Check MySQL version compatibility
- Verify database permissions

### Permission Issues
```bash
# Fix storage permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Asset Compilation
```bash
# Clear and recompile assets
npm run build
php artisan view:clear
php artisan config:clear
```

## Support

For issues and support:
1. Check the logs: `storage/logs/laravel.log`
2. Enable debug mode in `.env`: `APP_DEBUG=true`
3. Check database connections
4. Verify file permissions

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Run tests
5. Submit a pull request

## License

This project is licensed under the MIT License.

## Security

- Keep your `.env` file secure
- Regularly update dependencies
- Use HTTPS in production
- Implement rate limiting
- Validate all user inputs
- Use prepared statements (Eloquent ORM handles this)

## Performance Optimization

- Enable query caching
- Use Redis for session storage
- Implement CDN for assets
- Use database indexing
- Enable opcode caching
- Monitor with Laravel Telescope

## Future Enhancements

- Mobile app API
- WhatsApp integration
- Multi-city support
- Advanced analytics
- Live chat support
- Video consultation features
