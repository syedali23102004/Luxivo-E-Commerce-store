# LUXIVO - Modern Laravel E-Commerce Platform

[![Laravel](https://img.shields.io/badge/Laravel-11+-red.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

## 🚀 Overview

**Video Demo**:https://drive.google.com/file/d/1kHLyY9IVBZEJPxRA0UdxpJlWyTTDIw1O/view?usp=sharing




**LUXIVO** is a fully-featured e-commerce platform built with Laravel 11+. It provides a complete shopping experience for customers and a powerful admin panel for store management. Key highlights:

- Responsive frontend with product catalog, cart & checkout
- Admin dashboard with CRUD operations
- User authentication (login/register)
- Contact form & management
- Seeded with sample products/categories

## ✨ Features

### Customer Features
- Browse products by category
- Product details & gallery
- Add to cart & manage cart
- Checkout with customer details (name, email, phone, address)
- Order confirmation & success page
- User registration/login

### Admin Features (/admin)
- Dashboard overview
- Products CRUD (create/edit/delete/list)
- Orders & Order Items management
- Users management
- Contacts management

## 📸 Screenshots

### Homepage
![Homepage](public/images/products/home.jpg)

### Products Catalog
![Products](public/images/products/electronics.jpg)

### Admin Dashboard
Admin features are accessible after seeding the admin user.

## 🛠️ Installation & Setup

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Laragon (recommended for Windows)

### Quick Start
```bash
# Clone the repo
git clone <your-repo-url> luxivo
cd luxivo

# Copy env
cp .env.example .env
php artisan key:generate

# Install PHP dependencies
composer install

# Install JS dependencies
npm install
npm run build

# Setup database
php artisan migrate --seed

# Storage link
php artisan storage:link

# Serve
php artisan serve
```

**Admin Login:** After seeding, use `admin@example.com` / `password` (check `AdminSeeder`)

**Customer Demo:** No login required for browsing/cart/checkout.

Database: Update `.env` with your DB credentials (Laragon defaults work).

## 📁 Project Structure

```
luxivo/
├── app/                 # Controllers, Models, Middleware
├── resources/views/     # Blade templates (customer + admin)
├── public/              # CSS/JS/Assets, product images
├── database/            # Migrations & Seeders
├── routes/              # Web routes
└── ...
```

## 🚀 Running Locally

```bash
php artisan serve
```
Visit `http://localhost:8000`

Admin: `http://localhost:8000/admin`

## 📋 Roadmap / TODO

See [TODO.md](TODO.md) for current tasks.

Recent updates:
- Added customer fields to orders (name, email, phone, address)
- Enhanced order items fields

## 🤝 Contributing

1. Fork the project
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add some AmazingFeature'`)
4. Push (`git push origin feature/AmazingFeature`)
5. Open Pull Request

## 📄 License

MIT License - see [LICENSE](LICENSE) (create if needed).

## 🙏 Acknowledgments

Built with ❤️ using Laravel ecosystem. Product images from free sources.

---

**Ready to launch your online store? Start with LUXIVO today!**
