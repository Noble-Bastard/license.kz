#!/bin/bash

echo "🔧 Исправляем проблемы с Docker на сервере..."

# 1. Очищаем старые контейнеры
echo "🧹 Очищаем старые контейнеры..."
docker-compose down --remove-orphans 2>/dev/null || true
docker system prune -f

# 2. Создаем упрощенный docker-compose без внешних зависимостей
echo "📝 Создаем упрощенный docker-compose.yml..."
cat > docker-compose.yml << 'EOF'
version: '2.2'

services:
  # Laravel приложение
  app:
    build: .
    container_name: license_kz_app
    ports:
      - "8001:80"
    volumes:
      - ./storage:/var/www/html/storage
      - ./public/uploads:/var/www/html/public/uploads
    environment:
      - APP_NAME=UPPERLICENSE
      - APP_ENV=production
      - APP_KEY=${APP_KEY:-}
      - APP_DEBUG=false
      - APP_URL=http://license.kz:8001
      - DB_CONNECTION=mysql
      - DB_HOST=localhost
      - DB_PORT=3306
      - DB_DATABASE=license_kz
      - DB_USERNAME=root
      - DB_PASSWORD=${DB_PASSWORD:-}
      - CACHE_DRIVER=file
      - SESSION_DRIVER=file
      - QUEUE_CONNECTION=sync
      - RUN_MIGRATIONS=false
    restart: unless-stopped
    network_mode: "host"
EOF

echo "✅ Создан упрощенный docker-compose.yml"

# 3. Создаем .env файл если его нет
if [ ! -f ".env" ]; then
    echo "📝 Создаем .env файл..."
    cat > .env << 'EOF'
APP_NAME=UPPERLICENSE
APP_ENV=production
APP_KEY=
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
    
    echo "⚠️  Отредактируйте .env файл и добавьте DB_PASSWORD"
fi

# 4. Генерируем ключ приложения
if grep -q "APP_KEY=$" .env 2>/dev/null; then
    echo "🔑 Генерируем ключ приложения..."
    if command -v php >/dev/null 2>&1; then
        php artisan key:generate --no-interaction 2>/dev/null || echo "⚠️  Не удалось сгенерировать ключ. Сделайте это вручную после запуска."
    fi
fi

# 5. Устанавливаем права
echo "🔐 Устанавливаем права доступа..."
chmod -R 775 storage bootstrap/cache 2>/dev/null || true
chown -R apache:apache storage bootstrap/cache 2>/dev/null || chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

# 6. Собираем образ
echo "🐳 Собираем Docker образ..."
docker build -t license-kz-app . --no-cache

if [ $? -ne 0 ]; then
    echo "❌ Ошибка при сборке образа. Проверьте Dockerfile."
    exit 1
fi

# 7. Запускаем контейнер
echo "🚀 Запускаем контейнер..."
docker-compose up -d

# 8. Проверяем статус
echo "📊 Проверяем статус..."
sleep 5
docker-compose ps

# 9. Показываем логи
echo "📝 Логи контейнера:"
docker-compose logs --tail=20

echo ""
echo "✅ Настройка завершена!"
echo "🌐 Проверьте доступность: curl http://localhost:8001"
echo "📊 Статус: docker-compose ps"
echo "📝 Логи: docker-compose logs -f"

