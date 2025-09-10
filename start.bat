@echo off
chcp 65001 >nul
title UPPERLICENSE Docker Launcher

echo 🚀 Запуск UPPERLICENSE в Docker...
echo.

REM Проверяем наличие Docker
docker --version >nul 2>&1
if errorlevel 1 (
    echo ❌ Docker не установлен. Установите Docker Desktop и попробуйте снова.
    pause
    exit /b 1
)

REM Проверяем наличие docker-compose
docker-compose --version >nul 2>&1
if errorlevel 1 (
    echo ❌ Docker Compose не установлен. Установите Docker Compose и попробуйте снова.
    pause
    exit /b 1
)

REM Создаем .env файл если его нет
if not exist .env (
    echo 📄 Создаем .env файл из примера...
    if exist docker.env.example (
        copy docker.env.example .env >nul
        echo ✅ .env файл создан из docker.env.example
    ) else if exist .env.example (
        copy .env.example .env >nul
        echo ✅ .env файл создан из .env.example
    ) else (
        echo ❌ Не найден файл примера для .env
        pause
        exit /b 1
    )
    echo ⚠️  Не забудьте настроить подключение к базе данных в .env файле!
    echo.
)

REM Останавливаем существующие контейнеры
echo 🛑 Останавливаем существующие контейнеры...
docker-compose -f docker-compose.simple.yml down >nul 2>&1

REM Собираем и запускаем контейнеры
echo 🔨 Собираем Docker образ...
docker-compose -f docker-compose.simple.yml build

echo 🚀 Запускаем приложение...
docker-compose -f docker-compose.simple.yml up -d

REM Ждем запуска
echo ⏳ Ждем запуска приложения...
timeout /t 10 /nobreak >nul

REM Проверяем статус
docker-compose -f docker-compose.simple.yml ps | findstr "Up" >nul
if errorlevel 1 (
    echo ❌ Ошибка запуска приложения
    echo 📋 Просмотрите логи для диагностики:
    echo    docker-compose -f docker-compose.simple.yml logs
    pause
    exit /b 1
)

echo ✅ Приложение успешно запущено!
echo.
echo 🌐 Откройте браузер и перейдите по адресу:
echo    http://localhost:8000
echo.
echo 📋 Полезные команды:
echo    Просмотр логов: docker-compose -f docker-compose.simple.yml logs -f
echo    Остановка:      docker-compose -f docker-compose.simple.yml down
echo    Перезапуск:     docker-compose -f docker-compose.simple.yml restart
echo.
echo ⚙️  Настройка базы данных:
echo    1. Отредактируйте .env файл
echo    2. Укажите параметры подключения к вашей БД
echo    3. Перезапустите: docker-compose -f docker-compose.simple.yml restart
echo.

pause
