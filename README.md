# 📝 Mini Issue Tracker

A lightweight issue tracking application built with **Laravel** and **Bootstrap 5**.  
It allows creating and managing projects, assigning issues with tags, filtering/searching issues, and assigning multiple members to issues.

---

## 🚀 Features
- ✅ User authentication (Laravel Breeze / basic auth)  
- ✅ Projects management (CRUD) with ownership policies (only owners can edit/delete)  
- ✅ Issues management (CRUD) with status, priority, and tags  
- ✅ Filter issues by status, priority, and tags  
- ✅ Search issues by title and description
- ✅ Many-to-many user assignments (issues can have multiple members)  
- ✅ AJAX search and member assignment  
- ✅ Flash messages with dismissible alerts  
- ✅ Validation error messages for forms
- ✅ Pagination for issues  

---

## 📋 Prerequisites
Before installing, make sure you have the following installed on your system:

- [PHP >= 8.2](https://www.php.net/)  
- [Composer](https://getcomposer.org/)  
- [Node.js & NPM](https://nodejs.org/)  
- [MySQL](https://dev.mysql.com/downloads/) (or provided by **XAMPP**)  
- [XAMPP](https://www.apachefriends.org/index.html) (includes Apache, PHP, MySQL)  
- [Git](https://git-scm.com/)  

---

## 🛠️ Tech Stack
- **Backend:** Laravel 12
- **Frontend:** Blade templates + Bootstrap 5  
- **Database:** MySQL 
- **Authentication:** Laravel Breeze (or basic auth)  

---

## 📦 Installation

### 1. Clone the Repository
```bash
git clone https://github.com/FestimKrasniqi/Mini-Issue-Tracker-App
cd issue-tracker
composer install
npm install
npm run dev
```

2. **Environment setup:**

   - Copy the `.env.example` file to `.env`:

   ```bash
   cp .env.example .env
   ```

  - Update the `.env` file with your database credentials and other settings:

  ```env
  DB_DATABASE=your_db_name
  DB_USERNAME=yor_db_username
  DB_PASSWORD=your_db_password
  ```

  3. **Generate application key:**

```bash
php artisan key:generate
```

4. **Run migrations:**

```bash
php artisan migrate
```

5. **Start the server:**

```bash
php artisan serve
```

Your server should now be running at `http://localhost:8000`.

## 👥 User Roles

- Project Owner: Can edit/delete only their own projects.
- Project Members: Can view issues and be assigned to them.

---

## 🔑 Authentication

- This project uses Laravel Breeze for authentication.

---

## 🧑‍💻 Author

 [Festim Krasniqi](https://github.com/FestimKrasniqi)





