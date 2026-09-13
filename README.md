# Travelia — Tourism Destination Management System

A tourism destination browsing and enquiry portal built with **PHP 8 + MySQL + Bootstrap**.
Visitors can browse destinations and packages, save a wishlist, and send enquiries.
Admins can manage destinations, users, and enquiries from a separate panel.

## Run it (choose one)

### Option A — Docker (one command, works anywhere)

Requires [Docker Desktop](https://www.docker.com/products/docker-desktop/).

```bash
git clone https://github.com/rahulskandagal/core-einstein.git
cd core-einstein
docker compose up
```

Then open:

| What        | URL                        |
|-------------|----------------------------|
| Website     | http://localhost:8080      |
| Admin panel | http://localhost:8080/admin/ |
| phpMyAdmin  | http://localhost:8081      |

The database is created and seeded automatically on first start. Stop with `Ctrl+C`;
run `docker compose down -v` to wipe the database and start fresh.

If port 8080 or 8081 is already in use on your machine, pick different ones:

```bash
WEB_PORT=8090 PMA_PORT=8091 docker compose up
```

### Option B — XAMPP (Windows / macOS / Linux)

1. Install [XAMPP](https://www.apachefriends.org/) and start **Apache** and **MySQL** from the control panel.
2. Clone (or download and unzip) this repo into the `htdocs` folder:
   ```bash
   cd C:\xampp\htdocs
   git clone https://github.com/rahulskandagal/core-einstein.git
   ```
3. Import the database — either:
   - open http://localhost/phpmyadmin → **Import** → choose `database/tourism_db.sql` → **Go**, or
   - from a terminal:
     ```bash
     C:\xampp\mysql\bin\mysql -u root < database\tourism_db.sql
     ```
4. Open http://localhost/core-einstein/

No config changes are needed — `includes/db_connect.php` defaults to XAMPP's `root` user with an empty password.
To use different credentials, set the `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME` environment variables.

## Demo logins

| Role  | Where                      | Username / Email | Password |
|-------|----------------------------|------------------|----------|
| Admin | `/admin/`                  | `rahulsk`        | `1234`   |
| User  | `/register.php`            | create your own  |          |

> These are sample credentials for local testing only — change them before deploying anywhere public.

## Project structure

```
├── index.php                # Home page
├── destinations.php         # Destination listing + destination-details.php
├── packages.php             # Travel packages
├── gallery.php, about.php, contact.php
├── login.php, register.php, profile.php, logout.php
├── wishlist.php, add_to_wishlist.php
├── admin/                   # Admin panel (login, manage destinations/users/enquiries)
├── includes/                # db_connect.php, navbar.php, footer.php
├── database/tourism_db.sql  # Schema + sample data
├── css/, js/, images/
├── Dockerfile, docker-compose.yml
```

## Tech stack

- PHP 8.2 (mysqli, prepared statements, bcrypt password hashing)
- MySQL 8 / MariaDB (XAMPP)
- Bootstrap 5, Font Awesome
