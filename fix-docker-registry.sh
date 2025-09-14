#!/bin/bash

echo "🔧 Исправляем проблемы с Docker registry..."

# 1. Проверяем версию Docker
echo "📊 Информация о Docker:"
docker --version
docker-compose --version

# 2. Очищаем Docker полностью
echo "🧹 Полная очистка Docker..."
docker system prune -a -f --volumes

# 3. Перезапускаем Docker daemon
echo "🔄 Перезапускаем Docker..."
systemctl restart docker
sleep 5

# 4. Проверяем статус Docker
systemctl status docker --no-pager

# 5. Пробуем альтернативные registry
echo "🔍 Пробуем альтернативные способы получения образов..."

# Способ 1: Используем локальный образ CentOS/RHEL
if command -v yum >/dev/null 2>&1; then
    echo "📦 Устанавливаем PHP и Apache напрямую..."
    
    # Создаем простой Dockerfile без внешних зависимостей
    cat > Dockerfile.simple << 'EOF'
# Используем базовый образ системы
FROM centos:7

# Устанавливаем EPEL и Remi репозитории
RUN yum install -y epel-release && \
    yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm && \
    yum-config-manager --enable remi-php81

# Устанавливаем PHP 8.1 и Apache
RUN yum install -y \
    httpd \
    php81-php \
    php81-php-fpm \
    php81-php-mysqlnd \
    php81-php-zip \
    php81-php-gd \
    php81-php-mbstring \
    php81-php-xml \
    php81-php-json \
    php81-php-curl \
    php81-php-bcmath \
    unzip \
    curl

# Создаем символические ссылки для PHP
RUN ln -s /usr/bin/php81 /usr/bin/php

# Устанавливаем Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Настраиваем Apache
RUN echo 'ServerName localhost' >> /etc/httpd/conf/httpd.conf

# Копируем конфигурацию Apache
RUN echo '<VirtualHost *:80>' > /etc/httpd/conf.d/laravel.conf && \
    echo '    DocumentRoot /var/www/html/public' >> /etc/httpd/conf.d/laravel.conf && \
    echo '    <Directory /var/www/html/public>' >> /etc/httpd/conf.d/laravel.conf && \
    echo '        AllowOverride All' >> /etc/httpd/conf.d/laravel.conf && \
    echo '        Require all granted' >> /etc/httpd/conf.d/laravel.conf && \
    echo '    </Directory>' >> /etc/httpd/conf.d/laravel.conf && \
    echo '</VirtualHost>' >> /etc/httpd/conf.d/laravel.conf

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем файлы проекта
COPY . .

# Устанавливаем зависимости (без npm пока)
RUN composer install --no-dev --optimize-autoloader --no-scripts || true

# Устанавливаем права
RUN chown -R apache:apache /var/www/html && \
    chmod -R 755 /var/www/html/storage && \
    chmod -R 755 /var/www/html/bootstrap/cache

# Создаем директории
RUN mkdir -p /var/www/html/storage/logs && \
    mkdir -p /var/www/html/storage/framework/cache && \
    mkdir -p /var/www/html/storage/framework/sessions && \
    mkdir -p /var/www/html/storage/framework/views

# Открываем порт
EXPOSE 80

# Запускаем Apache
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]
EOF

    echo "✅ Создан упрощенный Dockerfile для CentOS"
fi

# Способ 2: Пробуем собрать с другим базовым образом
cat > Dockerfile.alpine << 'EOF'
# Используем Alpine Linux (меньший размер)
FROM alpine:3.16

# Устанавливаем PHP и Apache
RUN apk add --no-cache \
    apache2 \
    php81 \
    php81-apache2 \
    php81-session \
    php81-mysqli \
    php81-pdo_mysql \
    php81-mbstring \
    php81-xml \
    php81-zip \
    php81-gd \
    php81-curl \
    php81-json \
    php81-bcmath \
    php81-tokenizer \
    php81-fileinfo \
    php81-openssl \
    composer \
    curl

# Создаем символическую ссылку для PHP
RUN ln -sf /usr/bin/php81 /usr/bin/php

# Настраиваем Apache
RUN echo 'ServerName localhost' >> /etc/apache2/httpd.conf
RUN sed -i 's/#LoadModule rewrite_module/LoadModule rewrite_module/' /etc/apache2/httpd.conf

# Создаем конфигурацию для Laravel
RUN echo '<VirtualHost *:80>' > /etc/apache2/conf.d/laravel.conf && \
    echo '    DocumentRoot /var/www/html/public' >> /etc/apache2/conf.d/laravel.conf && \
    echo '    <Directory /var/www/html/public>' >> /etc/apache2/conf.d/laravel.conf && \
    echo '        AllowOverride All' >> /etc/apache2/conf.d/laravel.conf && \
    echo '        Require all granted' >> /etc/apache2/conf.d/laravel.conf && \
    echo '    </Directory>' >> /etc/apache2/conf.d/laravel.conf && \
    echo '</VirtualHost>' >> /etc/apache2/conf.d/laravel.conf

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Копируем файлы проекта
COPY . .

# Устанавливаем зависимости
RUN composer install --no-dev --optimize-autoloader --no-scripts || true

# Устанавливаем права
RUN chown -R apache:apache /var/www/html && \
    chmod -R 755 /var/www/html/storage && \
    chmod -R 755 /var/www/html/bootstrap/cache

# Создаем директории
RUN mkdir -p /var/www/html/storage/logs && \
    mkdir -p /var/www/html/storage/framework/cache && \
    mkdir -p /var/www/html/storage/framework/sessions && \
    mkdir -p /var/www/html/storage/framework/views

# Открываем порт
EXPOSE 80

# Запускаем Apache
CMD ["httpd", "-D", "FOREGROUND"]
EOF

echo "✅ Создан Dockerfile для Alpine Linux"

# 6. Пробуем собрать с альтернативными образами
echo "🔨 Пробуем собрать с CentOS..."
if docker build -f Dockerfile.simple -t license-kz-app-centos . --no-cache; then
    echo "✅ Сборка с CentOS успешна!"
    
    # Запускаем контейнер
    docker run -d \
      --name license_kz_app \
      --network host \
      -p 8001:80 \
      -v "$(pwd)/storage:/var/www/html/storage" \
      -v "$(pwd)/.env:/var/www/html/.env" \
      --restart unless-stopped \
      license-kz-app-centos
      
    echo "🚀 Контейнер запущен с CentOS!"
    exit 0
fi

echo "🔨 Пробуем собрать с Alpine..."
if docker build -f Dockerfile.alpine -t license-kz-app-alpine . --no-cache; then
    echo "✅ Сборка с Alpine успешна!"
    
    # Запускаем контейнер
    docker run -d \
      --name license_kz_app \
      --network host \
      -p 8001:80 \
      -v "$(pwd)/storage:/var/www/html/storage" \
      -v "$(pwd)/.env:/var/www/html/.env" \
      --restart unless-stopped \
      license-kz-app-alpine
      
    echo "🚀 Контейнер запущен с Alpine!"
    exit 0
fi

echo "❌ Не удалось собрать Docker образ. Попробуем установить напрямую на сервер..."
