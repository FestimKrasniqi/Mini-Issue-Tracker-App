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
  DB_DATABASE=issue_tracker
  DB_USERNAME=root
  DB_PASSWORD=
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

## 👥 User Roles

- Project Owner: Can edit/delete only their own projects.
- Project Members: Can view issues and be assigned to them.


## 🔑 Authentication

- This project uses Laravel Breeze for authentication.


## 🧑‍💻 Author

 [Festim Krasniqi](https://github.com/FestimKrasniqi)





