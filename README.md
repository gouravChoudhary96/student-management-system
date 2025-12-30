<p align="center"> <a href="https://laravel.com" target="_blank"> <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"> </a> </p> <p align="center"> <img src="https://img.shields.io/badge/Laravel-12-red" alt="Laravel 12"> <img src="https://img.shields.io/badge/PHP-8.2-blue" alt="PHP 8.2"> <img src="https://img.shields.io/badge/Database-MySQL-orange" alt="MySQL"> <img src="https://img.shields.io/badge/Frontend-jQuery%20%2B%20Blade-green" alt="jQuery + Blade"> <img src="https://img.shields.io/badge/CSS-Tailwind_CDN-teal" alt="Tailwind CSS"> </p>
🎓 Student Management System

A modern Student Management System built using Laravel 12, Blade, jQuery (AJAX), Tailwind CSS (CDN), and MySQL.

This project demonstrates professional CRUD architecture, AJAX pagination, sorting, search, validation, SweetAlert2 confirmations, and Laravel Feature Tests — without using Node.js or npm.

📸 Screenshots

Upload screenshots inside a screenshots/ folder in the project root.

🧾 Student List

➕ Add Student

✏️ Edit Student

⚠️ Delete Confirmation

✨ Features

AJAX-based Add / Edit / Delete Students

Laravel Resource Controller

Live Search with debounce

Sorting by Name, Age, Mark, Result

AJAX Pagination (state preserved)

jQuery Frontend Validation

Laravel Backend Validation

SweetAlert2 Confirm Dialogs & Toast Messages

Automatic Pass / Fail Result Calculation

MySQL CRUD Operations

Factory & Seeder for dummy records

Feature Tests (CRUD, Validation, Filters)

🛠️ Tech Stack
Layer	Technology
Backend	Laravel 12
Frontend	Blade + jQuery
Styling	Tailwind CSS (CDN)
Database	MySQL
Testing	PHPUnit

✅ No Node.js
✅ No npm
✅ No Vite

📂 Project Structure
app/
 └── Models/
     └── Student.php

database/
 ├── factories/
 │   └── StudentFactory.php
 └── seeders/
     └── StudentSeeder.php

resources/
 └── views/
     └── students/
         ├── index.blade.php
         └── partials/table.blade.php

tests/
 └── Feature/
     └── StudentFeatureTest.php

⚙️ Installation & Setup
1️⃣ Clone Repository
git clone https://github.com/your-username/student-management-system.git
cd student-management-system

2️⃣ Install PHP Dependencies
composer install

3️⃣ Environment Configuration
cp .env.example .env
php artisan key:generate


Update .env:

DB_DATABASE=student_db
DB_USERNAME=root
DB_PASSWORD=

4️⃣ Run Migration & Seeder
php artisan migrate:fresh --seed

5️⃣ Start Server
php artisan serve


Open:

http://127.0.0.1:8000/students

🧪 Run Tests
php artisan test


✔ CRUD Tests
✔ Validation Tests
✔ Sorting & Search Tests
✔ Pagination Tests

📊 Validation Rules
Field	Rule
Name	Required
Age	Integer ≥ 1
Mark	Integer (0–100)
Result	Auto Calculated
🧠 Business Logic

Mark ≥ 40 → Pass

Mark < 40 → Fail

🚀 Future Enhancements

Authentication (Admin)

Soft Delete & Restore

Export to Excel / PDF

REST API Version

Role-based Access Control

👨‍💻 Author

Your Name
Gourav Choudhary

GitHub: https://github.com/gouravChoudhary96

Email: gouravdhariwal1@gmail.com

⭐ Support

If you like this project, please give it a ⭐ on GitHub.

📄 License

This project is open-sourced software licensed under the MIT license.