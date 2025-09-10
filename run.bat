@echo off
chcp 65001 >nul

echo 🚀 UPPERLICENSE - Быстрый запуск
echo.

REM Проверяем Docker
docker --version >nul 2>&1
if errorlevel 1 (
    echo ❌ Установите Docker Desktop
    pause & exit /b 1
)

REM Создаем .env
if not exist .env (
    if exist docker.env.example (
        copy docker.env.example .env >nul
    ) else (
        copy .env.example .env >nul
    )
    echo ✅ Создан .env файл
)

REM Запускаем
echo 🔨 Сборка и запуск...
docker-compose -f docker-compose.simple.yml up -d --build

echo.
echo ✅ ГОТОВО! Откройте: http://localhost:8000
echo.
echo 📝 Настройте БД в .env и перезапустите:
echo    docker-compose -f docker-compose.simple.yml restart
pause
