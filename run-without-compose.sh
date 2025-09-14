#!/bin/bash

echo "🚀 Запуск без Docker Compose (альтернативный способ)..."

# Останавливаем существующие контейнеры
echo "🛑 Останавливаем существующие контейнеры..."
docker stop license_kz_app 2>/dev/null || true
docker rm license_kz_app 2>/dev/null || true

# Собираем образ
echo "🐳 Собираем Docker образ..."
docker build -t license-kz-app . --no-cache

if [ $? -ne 0 ]; then
    echo "❌ Ошибка при сборке образа."
    exit 1
fi

# Создаем .env файл если его нет
if [ ! -f ".env" ]; then
    echo "📝 Создаем .env файл..."
    cat > .env << 'EOF'
APP_NAME=UPPERLICENSE
APP_ENV=production
APP_KEY=base64:PLACEHOLDER_KEY_REPLACE_ME
APP_DEBUG=false
APP_URL=http://license.kz:8001

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=license_kz
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
RUN_MIGRATIONS=false
EOF
fi

# Запускаем контейнер напрямую
echo "🚀 Запускаем контейнер..."
docker run -d \
  --name license_kz_app \
  --network host \
  -p 8001:80 \
  -v "$(pwd)/storage:/var/www/html/storage" \
  -v "$(pwd)/public/uploads:/var/www/html/public/uploads" \
  -v "$(pwd)/.env:/var/www/html/.env" \
  --restart unless-stopped \
  license-kz-app

# Проверяем статус
echo "📊 Проверяем статус контейнера..."
sleep 5
docker ps | grep license_kz_app

# Показываем логи
echo "📝 Логи контейнера:"
docker logs license_kz_app --tail=20

echo ""
echo "✅ Контейнер запущен!"
echo "🌐 Проверьте доступность: curl http://localhost:8001"
echo "📊 Статус: docker ps | grep license_kz_app"
echo "📝 Логи: docker logs license_kz_app -f"
echo "🛑 Остановить: docker stop license_kz_app"

