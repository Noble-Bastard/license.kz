# 🐳 UPPERLICENSE Docker Setup

Быстрый запуск проекта UPPERLICENSE в Docker контейнере с подключением к внешней базе данных.

## 🚀 Быстрый запуск (одна команда)

### Windows:
```bash
start.bat
```

### Linux/macOS:
```bash
chmod +x start.sh
./start.sh
```

## 📋 Требования

- Docker Desktop
- Docker Compose
- Внешняя база данных (MySQL/PostgreSQL)

## ⚙️ Настройка

### 1. Настройка базы данных

Отредактируйте файл `.env` (создается автоматически при первом запуске):

```env
# Для MySQL
DB_CONNECTION=mysql
DB_HOST=your-database-host.com
DB_PORT=3306
DB_DATABASE=license_kz
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Для PostgreSQL
DB_CONNECTION=pgsql
DB_HOST=your-postgres-host.com
DB_PORT=5432
DB_DATABASE=license_kz
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 2. Запуск приложения

После настройки базы данных перезапустите контейнер:

```bash
docker-compose -f docker-compose.simple.yml restart
```

## 🌐 Доступ к приложению

После успешного запуска приложение будет доступно по адресу:
- **http://localhost:8000**

## 📋 Полезные команды

### Просмотр логов:
```bash
docker-compose -f docker-compose.simple.yml logs -f
```

### Остановка:
```bash
docker-compose -f docker-compose.simple.yml down
```

### Перезапуск:
```bash
docker-compose -f docker-compose.simple.yml restart
```

### Выполнение команд Laravel внутри контейнера:
```bash
docker-compose -f docker-compose.simple.yml exec app php artisan migrate
docker-compose -f docker-compose.simple.yml exec app php artisan cache:clear
```

## 🔧 Расширенная настройка

Для продвинутых настроек используйте полный `docker-compose.yml`:

```bash
# Запуск с Redis и Nginx
docker-compose up -d

# Только приложение (простая версия)
docker-compose -f docker-compose.simple.yml up -d
```

## 🗂️ Структура файлов Docker

- `Dockerfile` - конфигурация образа приложения
- `docker-compose.yml` - полная конфигурация с Redis и Nginx
- `docker-compose.simple.yml` - упрощенная конфигурация
- `docker-entrypoint.sh` - скрипт инициализации
- `docker.env.example` - пример настроек окружения
- `start.sh` / `start.bat` - скрипты быстрого запуска

## 🔐 Безопасность

### Для продакшена:

1. Измените `APP_KEY`:
```bash
docker-compose exec app php artisan key:generate
```

2. Настройте HTTPS через Nginx
3. Используйте безопасные пароли БД
4. Ограничьте доступ к портам

## 🐛 Устранение проблем

### Проблема с подключением к БД:

1. Проверьте настройки в `.env`
2. Убедитесь, что БД доступна из Docker:
```bash
docker-compose exec app ping your-database-host.com
```

### Проблема с правами доступа:
```bash
docker-compose exec app chown -R www-data:www-data /var/www/html/storage
docker-compose exec app chmod -R 755 /var/www/html/storage
```

### Очистка и пересборка:
```bash
docker-compose down
docker system prune -f
docker-compose build --no-cache
docker-compose up -d
```

## 📞 Поддержка

При возникновении проблем:
1. Проверьте логи: `docker-compose logs`
2. Убедитесь в правильности настроек БД
3. Проверьте доступность внешней БД

## 🎯 Особенности

- ✅ Подключение к внешней БД (MySQL/PostgreSQL)
- ✅ Автоматическая инициализация проекта
- ✅ Кеширование конфигурации для продакшена
- ✅ Поддержка загрузки файлов
- ✅ Оптимизированная сборка образа
- ✅ Простой запуск одной командой
