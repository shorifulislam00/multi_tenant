# Multi Tenant Laravel Project

This is a **multi-tenant application** built with **Laravel**.  
It supports multiple tenants with isolated data management.  

---

## 🚀 Requirements
- **PHP 8.2+**  
- **Composer 2.x**  
- **MySQL**
- **Git**

---

## ⚙️ Installation Guide

1. **Clone the Repository**
   ```bash
   git clone https://github.com/shorifulislam00/multi_tenant.git
   cd multi_tenant
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Environment Setup**
   - Copy `.env.example` to `.env`
     ```bash
     cp .env.example .env
     ```
   - Update your **database credentials** in `.env` file:
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Run Migrations with Seeders**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Serve the Application**
   ```bash
   php artisan serve
   ```
   Your application will be available at:  
   👉 http://127.0.0.1:8000  

---

## 🧪 Testing Login
```
Email: admin@gmail.com
Password: 12345678
```

---

## 🛠️ Common Commands
```bash
php artisan cache:clear        # Clear cache
php artisan route:clear        # Clear routes
php artisan config:clear       # Clear config
php artisan migrate:refresh    # Refresh migrations
```

---

## 📜 License
This project is open-source and available under the [MIT license](LICENSE).  
