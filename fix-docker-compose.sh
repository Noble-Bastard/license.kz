#!/bin/bash

# Быстрое исправление проблемы с версией docker-compose на сервере

echo "🔧 Исправляем проблему с версией docker-compose..."

# Проверяем версию docker-compose
COMPOSE_VERSION=$(docker-compose --version | grep -oE '[0-9]+\.[0-9]+\.[0-9]+' | head -1)
echo "Текущая версия docker-compose: $COMPOSE_VERSION"

# Если версия очень старая, используем version 2.2
if [[ "$COMPOSE_VERSION" < "1.25.0" ]]; then
    echo "⚠️  Обнаружена старая версия docker-compose. Используем version 2.2"
    
    # Создаем совместимый файл
    cat > docker-compose.yml << 'EOF'
version: '2.2'

services:
  # Laravel приложение
  app:
    build: .
    container_name: license_kz_app
    ports:
      - "8000:80"
    volumes:
      - ./storage:/var/www/html/storage
      - ./public/uploads:/var/www/html/public/uploads
    environment:
      - APP_NAME=UPPERLICENSE
      - APP_ENV=production
      - APP_KEY=${APP_KEY:-}
      - APP_DEBUG=false
      - APP_URL=http://localhost:8000
      - DB_CONNECTION=${DB_CONNECTION:-mysql}
      - DB_HOST=${DB_HOST:-host.docker.internal}
      - DB_PORT=${DB_PORT:-3306}
      - DB_DATABASE=${DB_DATABASE:-license_kz}
      - DB_USERNAME=${DB_USERNAME:-root}
      - DB_PASSWORD=${DB_PASSWORD:-}
      - CACHE_DRIVER=file
      - SESSION_DRIVER=file
      - QUEUE_CONNECTION=sync
      - MAIL_MAILER=${MAIL_MAILER:-smtp}
      - MAIL_HOST=${MAIL_HOST:-smtp.gmail.com}
      - MAIL_PORT=${MAIL_PORT:-587}
      - MAIL_USERNAME=${MAIL_USERNAME:-}
      - MAIL_PASSWORD=${MAIL_PASSWORD:-}
      - MAIL_ENCRYPTION=${MAIL_ENCRYPTION:-tls}
      - MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS:-noreply@license.kz}
      - MAIL_FROM_NAME=${MAIL_FROM_NAME:-UPPERLICENSE}
      - RUN_MIGRATIONS=${RUN_MIGRATIONS:-false}
    depends_on:
      - redis

  # Redis для кеширования
  redis:
    image: redis:6-alpine
    container_name: license_kz_redis
    ports:
      - "6379:6379"
    volumes:
      - redis_data:/data

volumes:
  redis_data:
    driver: local
EOF

    echo "✅ Создан совместимый docker-compose.yml с version 2.2"
else
    echo "✅ Версия docker-compose подходящая, используем version 3.3"
fi

# Пробуем запустить
echo "🚀 Пробуем запустить контейнеры..."
docker-compose up -d

if [ $? -eq 0 ]; then
    echo "✅ Контейнеры успешно запущены!"
    echo "📊 Статус контейнеров:"
    docker-compose ps
else
    echo "❌ Ошибка при запуске. Проверьте логи:"
    echo "docker-compose logs"
fi

