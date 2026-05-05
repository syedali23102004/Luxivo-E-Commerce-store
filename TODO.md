# 🛍️ LUXIVO


## 📋 Table of Contents

- [About](#-about)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Project Structure](#-project-structure)
- [Database Schema](#-database-schema)
- [Getting Started](#-getting-started)
- [Default Credentials](#-default-credentials)
- [Routes Overview](#-routes-overview)
- [Admin Panel](#-admin-panel)
- [Categories](#-categories)
- [Contributing](#-contributing)
- [License](#-license)

---

## 📌 About

**LUXIVO** is a clean, production-ready e-commerce web application built on **Laravel 12**. It offers a seamless shopping experience for customers alongside a full-featured admin panel for managing products, orders, users, and contacts. Designed with simplicity and extensibility in mind, LUXIVO is an ideal foundation for any online store.

---

## ✨ Features

### 🛒 Customer-Facing
- Browse products by category or view all
- Product detail pages with slug-based URLs
- Session-based shopping cart (add, update, remove, clear)
- Secure checkout with order placement
- Order success confirmation page
- Contact form submission
- User registration and login

### 🔧 Admin Panel
- Dashboard overview
- Full product CRUD (create, read, update, delete) with image upload
- Order listing with real-time status updates
- User management
- Admin account management
- Contact message inbox with mark-as-read functionality
- DataTables-powered dynamic tables (server-side)

### 🔐 Authentication & Authorization
- Separate `auth` and `admin` middleware
- Role-based access (`admin` / `user`)
- Secure password hashing with bcrypt

---

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| **Backend Framework** | Laravel 12 |
| **Language** | PHP 8.2+ |
| **Frontend Styling** | Tailwind CSS v4 (via Vite) |
| **Database** | SQLite (MySQL/PostgreSQL supported) |
| **DataTables** | yajra/laravel-datatables-oracle v12 |
| **Build Tool** | Vite with Laravel plugin |
| **Package Manager** | Composer + npm |
| **Testing** | PHPUnit 11 |

---

## 📁 Project Structure

```
LUXIVO/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/              # Admin panel controllers
│   │   │   │   ├── AdminController.php
│   │   │   │   ├── ContactController.php
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── OrderController.php
│   │   │   │   ├── OrderItemController.php
│   │   │   │   ├── ProductController.php
│   │   │   │   └── UserController.php
│   │   │   ├── Auth/               # Auth controllers
│   │   │   │   ├── LoginController.php
│   │   │   │   └── RegisterController.php
│   │   │   ├── CartController.php
│   │   │   ├── CheckoutController.php
│   │   │   ├── ContactController.php
│   │   │   ├── HomeController.php
│   │   │   └── ProductController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   ├── Models/
│   │   ├── Category.php
│   │   ├── Contact.php
│   │   ├── Order.php
│   │   ├── OrderItem.php
│   │   ├── Product.php
│   │   └── User.php
│   └── Providers/
├── database/
│   ├── migrations/                 # 8 migration files
│   ├── seeders/
│   │   ├── AdminSeeder.php
│   │   ├── CategorySeeder.php
│   │   ├── OrderSeeder.php
│   │   └── DatabaseSeeder.php
│   └── database.sqlite
├── resources/
│   ├── css/app.css
│   ├── js/app.js
│   └── views/
├── routes/
│   ├── web.php
│   └── console.php
├── .env.example
├── composer.json
└── vite.config.js
```

---

## 🗄️ Database Schema

LUXIVO uses **8 database tables**:

```
users           - id, name, email, password, role, phone, address, email_verified_at
categories      - id, name, slug, icon, description
products        - id, category_id, name, slug, description, price, discount_price,
                  stock, brand, image, is_featured
orders          - id, user_id, total_amount, status, payment_method, shipping_address
order_items     - id, order_id, product_id, quantity, price
contacts        - id, name, email, subject, message, is_read
cache           - (Laravel cache table)
jobs            - (Laravel queue table)
```

### Relationships

```
User         ──< Order       (one-to-many)
Order        ──< OrderItem   (one-to-many)
Product      ──< OrderItem   (one-to-many)
Category     ──< Product     (one-to-many)
```

---

## 🚀 Getting Started

### Prerequisites

Make sure you have the following installed:

- **PHP** >= 8.2
- **Composer** >= 2.x
- **Node.js** >= 18.x & **npm**
- **SQLite** (default) or MySQL/PostgreSQL

---

### ⚡ Quick Setup (One Command)

```bash
git clone https://github.com/your-username/luxivo.git
cd luxivo
composer run setup
```

This single command will:
1. Install all PHP dependencies (`composer install`)
2. Copy `.env.example` to `.env`
3. Generate the application key
4. Run all database migrations
5. Install npm dependencies
6. Build frontend assets

---

### 🔧 Manual Setup

If you prefer step-by-step installation:

```bash
# 1. Clone the repository
git clone https://github.com/your-username/luxivo.git
cd luxivo

# 2. Install PHP dependencies
composer install

# 3. Set up environment file
cp .env.example .env
php artisan key:generate

# 4. Run database migrations
php artisan migrate

# 5. Seed the database
php artisan db:seed

# 6. Install and build frontend assets
npm install
npm run build

# 7. Start the development server
php artisan serve
```

Visit `http://localhost:8000` in your browser. ✅

---

### 🔥 Development Mode (Hot Reload)

To run all services concurrently with hot module replacement:

```bash
composer run dev
```

This starts:
- PHP development server
- Queue worker
- Laravel Pail (log viewer)
- Vite dev server (with HMR)

---

### 🌐 Environment Configuration

Key settings in your `.env` file:

```env
APP_NAME=LUXIVO
APP_URL=http://localhost

# Database (SQLite by default — no setup needed)
DB_CONNECTION=sqlite

# Switch to MySQL if needed:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=luxivo
# DB_USERNAME=root
# DB_PASSWORD=

# Mail configuration
MAIL_MAILER=smtp
MAIL_HOST=your-mail-host
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=your-password
```

---

## 🔑 Default Credentials

After running seeders, the following admin account is created:

| Field | Value |
|---|---|
| **Email** | `admin@luxivo.com` |
| **Password** | `admin123` |
| **Role** | `admin` |

> ⚠️ **Important:** Change the default admin password immediately after first login in a production environment.

---

## 🗺️ Routes Overview

### Public Routes

| Method | URL | Description |
|---|---|---|
| GET | `/` | Homepage |
| GET | `/products` | All products |
| GET | `/products/{slug}` | Product detail |
| GET | `/category/{slug}` | Products by category |
| GET | `/contact` | Contact page |
| POST | `/contact` | Submit contact form |
| GET | `/login` | Login page |
| POST | `/login` | Authenticate user |
| GET | `/register` | Registration page |
| POST | `/register` | Create account |
| POST | `/logout` | Log out |

### Auth-Protected Routes (requires login)

| Method | URL | Description |
|---|---|---|
| GET | `/cart` | View cart |
| POST | `/cart/add` | Add item to cart |
| POST | `/cart/update` | Update cart item |
| POST | `/cart/remove` | Remove item |
| POST | `/cart/clear` | Clear entire cart |
| GET | `/checkout` | Checkout page |
| POST | `/checkout` | Place order |
| GET | `/order/success` | Order confirmation |

### Admin Routes (requires admin role) — prefix: `/admin`

| Method | URL | Description |
|---|---|---|
| GET | `/admin/dashboard` | Admin dashboard |
| GET/POST | `/admin/products` | List / Create products |
| GET/PUT/DELETE | `/admin/products/{id}` | View / Update / Delete |
| GET | `/admin/orders` | Order listing |
| POST | `/admin/orders/{id}/status` | Update order status |
| GET | `/admin/users` | User management |
| GET | `/admin/admins` | Admin accounts |
| GET | `/admin/contacts` | Contact messages |
| POST | `/admin/contacts/{id}/mark-read` | Mark message as read |

---

## 🖥️ Admin Panel

Access the admin panel at: `http://localhost:8000/admin/dashboard`

The admin panel provides:

- **Dashboard** — overview stats and quick access
- **Products** — full CRUD with image upload, pricing, discount, stock, featured flag
- **Orders** — view all orders, update status (pending → processing → shipped → delivered)
- **Users** — view registered customers
- **Admins** — manage admin accounts
- **Contacts** — read and manage customer inquiries

All data tables are powered by **Yajra DataTables** for server-side pagination, search, and sorting.

---

## 🏷️ Categories

LUXIVO ships with **15 pre-seeded categories**:

| Icon | Category |
|---|---|
| 💻 | Electronics |
| 👕 | Fashion |
| 🏠 | Home & Garden |
| 📚 | Books |
| ⚽ | Sports & Outdoors |
| 💄 | Beauty & Personal Care |
| 🎮 | Toys & Games |
| 🍔 | Food & Beverages |
| 🪑 | Furniture |
| ❤️ | Health & Wellness |
| 🚗 | Automotive |
| 💍 | Jewelry & Watches |
| 🐾 | Pet Supplies |
| 💼 | Office Supplies |
| 🎵 | Music & Instruments |

---

## 🧪 Running Tests

```bash
composer run test
```

Or directly with PHPUnit:

```bash
php artisan test
```

---

## 🤝 Contributing

Contributions are welcome! To get started:

1. Fork the repository
2. Create a feature branch: `git checkout -b feature/your-feature-name`
3. Commit your changes: `git commit -m "feat: add your feature"`
4. Push to your branch: `git push origin feature/your-feature-name`
5. Open a Pull Request

Please follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding standards. You can auto-format with:

```bash
./vendor/bin/pint
```

---

## 📄 License

This project is open-source and available under the [MIT License](LICENSE).

---

<div align="center">

Built with ❤️ using **Laravel 12** · **Tailwind CSS** · **SQLite**

</div>