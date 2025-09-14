# 🚀 Руководство по деплою нового дизайна license.kz

## Обзор

Этот проект представляет собой новый дизайн для license.kz, который будет работать параллельно с основным проектом на том же сервере, но на другом порту.

### Архитектура деплоя:
- **Основной проект**: `http://license.kz` (порт 80)
- **Новый дизайн**: `http://license.kz:8001` (порт 8001)
- **База данных**: Общая для обоих проектов
- **Redis**: Отдельный инстанс на порту 6380

## 📋 Предварительные требования

### На сервере должны быть установлены:
- Docker (версия 20.10+)
- Docker Compose (версия 1.25+)
- Git
- PHP 8.1+ (для локальных команд)
- Composer

### Проверка версий:
```bash
docker --version
docker-compose --version
php --version
composer --version
```

## 🛠 Пошаговая инструкция деплоя

### 1. Подготовка на сервере

```bash
# Переходим в директорию с проектами
cd /path/to/your/projects

# Клонируем репозиторий (если еще не клонирован)
git clone https://github.com/your-repo/license.kz.git license-kz-new
cd license-kz-new

# Или обновляем существующий
git pull origin master
```

### 2. Настройка окружения

```bash
# Делаем скрипт деплоя исполняемым
chmod +x deploy.sh

# Запускаем деплой
./deploy.sh
```

### 3. Ручная настройка .env (если нужно)

После первого запуска скрипта отредактируйте `.env` файл:

```bash
nano .env
```

Обязательно настройте:
- `DB_PASSWORD` - пароль от базы данных
- `MAIL_USERNAME` и `MAIL_PASSWORD` - если нужна отправка почты
- `APP_KEY` - будет сгенерирован автоматически

### 4. Проверка работы

```bash
# Проверяем статус контейнеров
docker-compose -f docker-compose.prod.yml ps

# Смотрим логи
docker-compose -f docker-compose.prod.yml logs -f

# Проверяем доступность
curl http://localhost:8001
```

## 🔧 Управление проектом

### Основные команды:

```bash
# Запуск
docker-compose -f docker-compose.prod.yml up -d

# Остановка
docker-compose -f docker-compose.prod.yml down

# Перезапуск
docker-compose -f docker-compose.prod.yml restart

# Пересборка образа
docker-compose -f docker-compose.prod.yml build --no-cache

# Логи
docker-compose -f docker-compose.prod.yml logs -f

# Статус
docker-compose -f docker-compose.prod.yml ps
```

### Обновление проекта:

```bash
# Получаем последние изменения
git pull origin master

# Перезапускаем деплой
./deploy.sh
```

## 🌐 Настройка веб-сервера (Nginx/Apache)

### Для Nginx добавьте в конфигурацию:

```nginx
# Новый дизайн на поддомене или отдельном порту
server {
    listen 80;
    server_name new.license.kz;  # или используйте license.kz:8001
    
    location / {
        proxy_pass http://localhost:8001;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
```

### Для Apache добавьте VirtualHost:

```apache
<VirtualHost *:80>
    ServerName new.license.kz
    ProxyPreserveHost On
    ProxyPass / http://localhost:8001/
    ProxyPassReverse / http://localhost:8001/
</VirtualHost>
```

## 🔍 Мониторинг и отладка

### Проверка логов:
```bash
# Логи приложения
docker-compose -f docker-compose.prod.yml logs app_new

# Логи Redis
docker-compose -f docker-compose.prod.yml logs redis_new

# Логи Laravel (внутри контейнера)
docker-compose -f docker-compose.prod.yml exec app_new tail -f storage/logs/laravel.log
```

### Выполнение команд Laravel:
```bash
# Вход в контейнер
docker-compose -f docker-compose.prod.yml exec app_new bash

# Или выполнение команд напрямую
docker-compose -f docker-compose.prod.yml exec app_new php artisan cache:clear
```

## 🚨 Решение проблем

### Проблема с версией Docker Compose:
```bash
# Если получаете ошибку "Version is unsupported"
# Используйте более старую версию файла
cp docker-compose.prod.yml docker-compose.yml
# И измените version: '3.3' на version: '2.2'
```

### Проблемы с правами доступа:
```bash
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

### Проблемы с базой данных:
```bash
# Проверьте подключение к БД
docker-compose -f docker-compose.prod.yml exec app_new php artisan tinker
# В tinker: DB::connection()->getPdo();
```

## 📊 Мониторинг ресурсов

```bash
# Использование ресурсов контейнерами
docker stats

# Размер образов
docker images

# Очистка неиспользуемых образов
docker system prune -a
```

## 🔄 Откат к предыдущей версии

```bash
# Остановка нового проекта
docker-compose -f docker-compose.prod.yml down

# Возврат к предыдущему коммиту
git log --oneline -10  # смотрим историю
git checkout COMMIT_HASH

# Повторный деплой
./deploy.sh
```

## 📞 Поддержка

При возникновении проблем:
1. Проверьте логи: `docker-compose -f docker-compose.prod.yml logs`
2. Убедитесь что все сервисы запущены: `docker-compose -f docker-compose.prod.yml ps`
3. Проверьте доступность портов: `netstat -tlnp | grep :8001`
4. Проверьте настройки .env файла

