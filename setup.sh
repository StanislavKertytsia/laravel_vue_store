#!/bin/bash

set -a
source .env
set +a

echo "📦 Stopping and removing containers..."
docker compose down -v

echo "🧹 Removing MySQL volume (if exists)..."
docker volume rm laravel_vue_store_mysql_data || true

echo "🚀 Starting containers and rebuilding..."
docker compose up -d --build

echo "⏳ Waiting for MySQL to be ready..."

until docker compose exec back sh -c "mysqladmin ping -h $DB_HOST -P $DB_PORT -u $DB_USER -p$DB_PASS" > /dev/null 2>&1; do
  echo "Waiting for MySQL..."
  sleep 3
done

echo "🧩 Dropping and creating database '${DB_NAME}'..."

docker compose exec back sh -c "mysql -h $DB_HOST -P $DB_PORT -u $DB_USER -p$DB_PASS -e \"DROP DATABASE IF EXISTS \\\`$DB_NAME\\\`; CREATE DATABASE \\\`$DB_NAME\\\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;\""

echo "🧩 Running database migrations and seeders..."
docker compose exec back php artisan migrate:fresh --seed

echo "🔗 Creating symbolic link for storage..."
docker compose exec back php artisan storage:link

echo "✅ Done! Project is up, database is reset and seeded, images are accessible via /storage."
