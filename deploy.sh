#!/bin/bash

# Скрипт деплоя нового дизайна license.kz на продакшен сервер
# Запускается на том же сервере что и основной проект, но на порту 8001

echo "🚀 Начинаем деплой нового дизайна license.kz..."

# Проверяем что мы в правильной директории
if [ ! -f "artisan" ]; then
    echo "❌ Ошибка: artisan файл не найден. Убедитесь что вы в корне Laravel проекта."
    exit 1
fi

# Останавливаем контейнеры если они запущены
echo "🛑 Останавливаем существующие контейнеры..."
docker-compose -f docker-compose.prod.yml down

# Создаем .env файл для продакшена если его нет
if [ ! -f ".env" ]; then
    echo "📝 Создаем .env файл..."
    cat > .env << EOF
APP_NAME=UPPERLICENSE_NEW
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=http://license.kz:8001

# База данных - та же что и у основного проекта
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=license_kz
DB_USERNAME=root
DB_PASSWORD=

# Кеш и сессии
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Почта
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@license.kz
MAIL_FROM_NAME=UPPERLICENSE

RUN_MIGRATIONS=false
EOF
    
    echo "⚠️  ВАЖНО: Отредактируйте .env файл и добавьте:"
    echo "   - APP_KEY (запустите: php artisan key:generate)"
    echo "   - DB_PASSWORD"
    echo "   - MAIL_USERNAME и MAIL_PASSWORD если нужна почта"
fi

# Генерируем ключ приложения если его нет
if grep -q "APP_KEY=$" .env; then
    echo "🔑 Генерируем ключ приложения..."
    php artisan key:generate --no-interaction
fi

# Устанавливаем зависимости
echo "📦 Устанавливаем зависимости..."
composer install --no-dev --optimize-autoloader

# Очищаем кеши
echo "🧹 Очищаем кеши..."
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Кешируем конфигурацию для продакшена
echo "⚡ Кешируем конфигурацию..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Устанавливаем права на папки
echo "🔐 Устанавливаем права доступа..."
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache 2>/dev/null || true

# Собираем Docker образ
echo "🐳 Собираем Docker образ..."
docker-compose -f docker-compose.prod.yml build --no-cache

# Запускаем контейнеры
echo "🚀 Запускаем контейнеры..."
docker-compose -f docker-compose.prod.yml up -d

# Проверяем статус
echo "📊 Проверяем статус контейнеров..."
docker-compose -f docker-compose.prod.yml ps

echo ""
echo "✅ Деплой завершен!"
echo ""
echo "🌐 Новый дизайн доступен по адресу: http://license.kz:8001"
echo "📊 Основной проект остается доступен по адресу: http://license.kz"
echo ""
echo "📋 Полезные команды:"
echo "   Логи:           docker-compose -f docker-compose.prod.yml logs -f"
echo "   Остановить:     docker-compose -f docker-compose.prod.yml down"
echo "   Перезапустить:  docker-compose -f docker-compose.prod.yml restart"
echo "   Статус:         docker-compose -f docker-compose.prod.yml ps"
echo ""

# Показываем логи последние 20 строк
echo "📝 Последние логи:"
docker-compose -f docker-compose.prod.yml logs --tail=20
