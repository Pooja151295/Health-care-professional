# HealthCareProfessionals
# Laravel 12 Healthcare Appointment API

A **Laravel 12 RESTful API** for booking and managing appointments with healthcare professionals — built using **clean architecture** principles.  
This project demonstrates best practices including the **Service Pattern**, **policy-based authorization**, and **implicit route model binding**.

## Features

- ✅ Laravel 12 with modern PHP support
- 🧩 Service-oriented clean architecture  
- 🧠 Clean service-oriented architecture
- 🔁 Implicit route model binding
- ⚙️ Dockerized setup for local development  
- 📦 RESTful API conventions
- 🧪 Feature tests included

## Prerequisites

- PHP >= 8.1
- Composer
- MySQL or compatible database
- Docker & Docker Compose (if using Docker)

## Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/Pooja151295/Health-care-professional.git

```

#(refere HC-0001 branch due some circumstances not able to upload on main)

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Environment File

```bash
cp .env.example .env
```

After copying the `.env` file, open it in a text editor and **update your MySQL database configuration**:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations and seeders

```bash
php artisan migrate --seed
```

The application will be available at:  
`http://localhost:3002`

## API Documentation [Swagger Implementation]

After successfully running the project, you can check the interactive API documentation in your browser at `/api/documentation`, which will display the Swagger UI with all your annotated API endpoints.

## Login Credentials for Generating Login Token

You can use the following credentials to log in and generate tokens for the seeded user:

- **Email**: `john@example.com`
- **Password**: `password`

## API Endpoints

> Sample endpoints may include:

| Method | Endpoint                      | Description                                  |
|--------|-------------------------------|----------------------------------------------|
| POST   | /api/login                    | Login with email and password                |
| GET    | /api/get-all-appointments     | Get all healthcare professionals             |
| POST   | /api/book-appointment         | Book an appointment to selected professional |
| POST   | /api/book-appointment         | Book an appointment to selected professional |
| POST   | /api/appointments/status      | update status of booking                     |
> **Note:** Actual endpoints depend on your route setup. Please refer to `routes/api.php`.

## Project Structure

- `app/Services/` – Core business logic
- `routes/api.php` – API route definitions
- `app/Http/Requests/` – Request validation
- `app/Http/Resource/` – Response handling
- `app/Http/Controllers/` – HTTP layer controllers

## Laravel Healthcare API Dockerized Setup

## 📦 Prerequisites

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
