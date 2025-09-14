#!/bin/bash

echo "🚀 Установка Laravel приложения напрямую на сервер..."

# Определяем тип системы
if command -v yum >/dev/null 2>&1; then
    PACKAGE_MANAGER="yum"
    WEB_USER="apache"
    WEB_GROUP="apache"
    WEB_SERVICE="httpd"
    PHP_VERSION="php81"
elif command -v apt >/dev/null 2>&1; then
    PACKAGE_MANAGER="apt"
    WEB_USER="www-data"
    WEB_GROUP="www-data"
    WEB_SERVICE="apache2"
    PHP_VERSION="php8.1"
else
    echo "❌ Неподдерживаемая система"
    exit 1
fi

echo "📊 Система: $PACKAGE_MANAGER, веб-сервер: $WEB_SERVICE"

# Функция установки для CentOS/RHEL
install_centos() {
    echo "📦 Устанавливаем зависимости для CentOS/RHEL..."
    
    # Устанавливаем EPEL и Remi
    yum install -y epel-release
    yum install -y http://rpms.remirepo.net/enterprise/remi-release-7.rpm
    yum-config-manager --enable remi-php81
    
    # Устанавливаем Apache и PHP
    yum install -y \
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
        php81-php-tokenizer \
        php81-php-fileinfo \
        php81-php-openssl \
        unzip \
        curl \
        nodejs \
        npm
    
    # Создаем символические ссылки
    ln -sf /usr/bin/php81 /usr/bin/php
    
    # Устанавливаем Composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
}

# Функция установки для Ubuntu/Debian
install_ubuntu() {
    echo "📦 Устанавливаем зависимости для Ubuntu/Debian..."
    
    # Обновляем пакеты
    apt update
    
    # Добавляем репозиторий PHP
    apt install -y software-properties-common
    add-apt-repository ppa:ondrej/php -y
    apt update
    
    # Устанавливаем Apache и PHP
    apt install -y \
        apache2 \
        php8.1 \
        php8.1-mysql \
        php8.1-zip \
        php8.1-gd \
        php8.1-mbstring \
        php8.1-xml \
        php8.1-curl \
        php8.1-bcmath \
        php8.1-tokenizer \
        php8.1-fileinfo \
        php8.1-openssl \
        libapache2-mod-php8.1 \
        unzip \
        curl \
        nodejs \
        npm
    
    # Устанавливаем Composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    
    # Включаем mod_rewrite
    a2enmod rewrite
}

# Устанавливаем зависимости
if [ "$PACKAGE_MANAGER" = "yum" ]; then
    install_centos
else
    install_ubuntu
fi

# Проверяем установку PHP
echo "🔍 Проверяем PHP..."
php --version

# Создаем директорию для проекта
PROJECT_DIR="/var/www/html"
echo "📁 Настраиваем проект в $PROJECT_DIR..."

# Устанавливаем зависимости Composer
echo "📦 Устанавливаем зависимости Composer..."
cd "$PROJECT_DIR"
composer install --no-dev --optimize-autoloader

# Устанавливаем зависимости npm (если есть)
if [ -f "package.json" ]; then
    echo "📦 Устанавливаем зависимости npm..."
    npm install
    npm run production
fi

# Создаем .env файл если его нет
if [ ! -f ".env" ]; then
    echo "📝 Создаем .env файл..."
    cp .env.example .env 2>/dev/null || cat > .env << 'EOF'
APP_NAME=UPPERLICENSE
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=http://license.kz

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=license_kz
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
EOF
fi

# Генерируем ключ приложения
echo "🔑 Генерируем ключ приложения..."
php artisan key:generate --force

# Устанавливаем права доступа
echo "🔐 Устанавливаем права доступа..."
chown -R $WEB_USER:$WEB_GROUP /var/www/html
chmod -R 755 /var/www/html/storage
chmod -R 755 /var/www/html/bootstrap/cache

# Создаем необходимые директории
mkdir -p /var/www/html/storage/logs
mkdir -p /var/www/html/storage/framework/cache
mkdir -p /var/www/html/storage/framework/sessions
mkdir -p /var/www/html/storage/framework/views

# Настраиваем Apache
echo "⚙️ Настраиваем Apache..."

if [ "$PACKAGE_MANAGER" = "yum" ]; then
    # Конфигурация для CentOS
    cat > /etc/httpd/conf.d/laravel.conf << 'EOF'
<VirtualHost *:80>
    ServerName license.kz
    DocumentRoot /var/www/html/public
    
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog /var/log/httpd/laravel_error.log
    CustomLog /var/log/httpd/laravel_access.log combined
</VirtualHost>
EOF
    
    # Включаем и запускаем Apache
    systemctl enable httpd
    systemctl restart httpd
    
else
    # Конфигурация для Ubuntu
    cat > /etc/apache2/sites-available/laravel.conf << 'EOF'
<VirtualHost *:80>
    ServerName license.kz
    DocumentRoot /var/www/html/public
    
    <Directory /var/www/html/public>
        AllowOverride All
        Require all granted
    </Directory>
    
    ErrorLog ${APACHE_LOG_DIR}/laravel_error.log
    CustomLog ${APACHE_LOG_DIR}/laravel_access.log combined
</VirtualHost>
EOF
    
    # Отключаем дефолтный сайт и включаем наш
    a2dissite 000-default
    a2ensite laravel
    
    # Перезапускаем Apache
    systemctl restart apache2
fi

# Очищаем кеши Laravel
echo "🧹 Очищаем кеши..."
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# Создаем символическую ссылку для storage
php artisan storage:link

# Проверяем статус веб-сервера
echo "📊 Проверяем статус веб-сервера..."
systemctl status $WEB_SERVICE --no-pager

# Показываем информацию
echo ""
echo "✅ Установка завершена!"
echo "🌐 Сайт доступен по адресу: http://$(hostname -I | awk '{print $1}')"
echo "📁 Директория проекта: /var/www/html"
echo "📝 Логи Apache: /var/log/httpd/ или /var/log/apache2/"
echo "🔧 Конфигурация: .env файл"
echo ""
echo "📋 Следующие шаги:"
echo "1. Отредактируйте .env файл: nano /var/www/html/.env"
echo "2. Добавьте пароль базы данных в DB_PASSWORD"
echo "3. Проверьте сайт: curl http://localhost"
echo "4. Посмотрите логи: tail -f /var/log/httpd/laravel_error.log"
