# Church Management App

A church management application built with Laravel, containerized with Docker (PHP + MySQL + phpMyAdmin).

## Prerequisites

Before you start, make sure you have installed:

- **Docker Desktop** — [download here](https://www.docker.com/products/docker-desktop/)
  - On Windows, you need **virtualization** enabled in BIOS and **WSL2** enabled (see [Docker's install guide](https://docs.docker.com/desktop/setup/install/windows-install/) if Docker fails to start)
- **Git**

You don't need to install PHP, MySQL, or Composer directly on your machine — everything is packaged inside Docker.

## Installation

### 1. Clone the project

```bash
git clone <YOUR_REPO_URL>
cd church-management-app
```

### 2. Create the environment config file

Copy the example file and rename it:

```bash
cp .env.example .env
```

Open the newly created `.env` file and make sure the database section looks like this (matching `docker-compose.yml`):

```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=church_management
DB_USERNAME=root
DB_PASSWORD=rootpassword
```

### 3. Build and start the containers

```bash
docker compose up -d --build
```

The first run may take a few minutes to pull the MySQL/phpMyAdmin images and build the PHP image.

Check that all 3 containers are running:

```bash
docker compose ps
```

### 4. Install PHP dependencies

```bash
docker compose exec php composer install
```

### 5. Generate the app key (required if not already in `.env`)

```bash
docker compose exec php php artisan key:generate
```

### 6. Set storage permissions

```bash
docker compose exec php chown -R www-data:www-data storage bootstrap/cache
docker compose exec php chmod -R 775 storage bootstrap/cache
```

### 7. Run migrations

```bash
docker compose exec php php artisan migrate
```

### 8. (Optional) Seed sample data

```bash
docker compose exec php php artisan db:seed
```

## Accessing the app

| Service | URL |
|---|---|
| Main application | http://localhost:8080 |
| phpMyAdmin (database management) | http://localhost:8081 |

phpMyAdmin login:
- User: `root`
- Password: `rootpassword`

## Common commands

```bash
# Start containers (if stopped)
docker compose up -d

# Stop containers
docker compose down

# Stop and remove MySQL data as well (careful, this deletes all data)
docker compose down -v

# View real-time logs (useful for debugging)
docker compose logs -f php

# Run any artisan command
docker compose exec php php artisan <command>

# Run composer
docker compose exec php composer <command>

# Clear cache if you hit stale config/view issues
docker compose exec php php artisan config:clear
docker compose exec php php artisan cache:clear
docker compose exec php php artisan view:clear
```

## Updating code

- **Regular PHP/Blade changes**: just save the file and refresh the browser — no rebuild needed.
- **New migration added**: run `docker compose exec php php artisan migrate`
- **New Composer package**: run `docker compose exec php composer require <package>`
- **Dockerfile changed** (PHP version, new system extension, etc.): rebuild with `docker compose up -d --build`

## Docker setup overview

| Container | Image | Role |
|---|---|---|
| `my_php_app` | built from `Dockerfile` (PHP 8.4 + Apache) | Runs the Laravel app |
| `my_mysql` | `mysql:8.0` | Database |
| `my_phpmyadmin` | `phpmyadmin/phpmyadmin` | Web UI for managing the database |

## Troubleshooting

**Database connection error when running migrations:**
Check your `.env` file and make sure `DB_HOST=mysql` (not `127.0.0.1` or `localhost`).

**`tempnam(): file created in the system's temporary directory` or other file write errors:**
```bash
docker compose exec php chown -R www-data:www-data storage bootstrap/cache
docker compose exec php chmod -R 775 storage bootstrap/cache
```

**Port 8080/8081/3306 already in use:**
Change the left-hand port number in `docker-compose.yml`, e.g. `"8090:80"`, then run `docker compose up -d --build` again.