#!/bin/sh

# Trap for graceful shutdown
trap 'kill $(jobs -p)' EXIT

echo "🔁 Waiting for services..."
/usr/bin/wait-for.sh db:3306 -- echo "✅ MySQL DB is ready."
/usr/bin/wait-for.sh mail:1025 -- echo "✅ Mailpit is ready."

echo "📦 Installing backend dependencies..."
if [ ! -f vendor/autoload.php ]; then
  composer install
fi

echo "📦 Installing frontend dependencies..."
if [ ! -d node_modules ]; then
  npm install
fi
npm i dotenv --no-save

echo "⚡ Running Vite dev server..."
npm run dev -- --host &

echo "🧹 Clearing and optimizing Laravel..."
php artisan optimize:clear

echo "🗃️ Running migrations and seeding..."
php artisan migrate --force
php artisan db:seed --force

echo "🚦 Starting PHP-FPM..."
exec php-fpm -R
