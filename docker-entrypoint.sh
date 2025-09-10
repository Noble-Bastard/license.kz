#!/bin/bash

# Ждем подключения к базе данных
echo "Ожидание подключения к базе данных..."

# Функция для проверки подключения к БД
wait_for_db() {
    if [ -n "$DB_HOST" ] && [ -n "$DB_PORT" ]; then
        echo "Проверяем подключение к $DB_HOST:$DB_PORT"
        
        # Устанавливаем netcat если его нет
        apt-get update && apt-get install -y netcat-openbsd
        
        until nc -z $DB_HOST $DB_PORT; do
            echo "База данных недоступна - ждем..."
            sleep 2
        done
        
        echo "База данных доступна!"
    fi
}

# Ждем БД
wait_for_db

# Создаем .env файл если его нет
if [ ! -f .env ]; then
    echo "Создаем .env файл из .env.example"
    cp .env.example .env
fi

# Генерируем ключ приложения если его нет
if ! grep -q "APP_KEY=base64:" .env; then
    echo "Генерируем ключ приложения..."
    php artisan key:generate --force
fi

# Устанавливаем права доступа
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html/storage
chmod -R 755 /var/www/html/bootstrap/cache

# Очищаем кеши
echo "Очищаем кеши..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Кешируем конфигурацию для продакшена
if [ "$APP_ENV" = "production" ]; then
    echo "Кешируем конфигурацию для продакшена..."
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
fi

# Выполняем миграции если нужно
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Выполняем миграции..."
    php artisan migrate --force
fi

# Создаем символическую ссылку для storage
php artisan storage:link

echo "Инициализация завершена! Запускаем приложение..."

# Передаем управление следующей команде
exec "$@"
