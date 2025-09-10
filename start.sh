#!/bin/bash

# Скрипт быстрого запуска UPPERLICENSE в Docker
# Использование: ./start.sh

echo "🚀 Запуск UPPERLICENSE в Docker..."

# Цвета для вывода
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Проверяем наличие Docker
if ! command -v docker &> /dev/null; then
    echo -e "${RED}❌ Docker не установлен. Установите Docker и попробуйте снова.${NC}"
    exit 1
fi

# Проверяем наличие docker-compose
if ! command -v docker-compose &> /dev/null; then
    echo -e "${RED}❌ Docker Compose не установлен. Установите Docker Compose и попробуйте снова.${NC}"
    exit 1
fi

# Создаем .env файл если его нет
if [ ! -f .env ]; then
    echo -e "${YELLOW}📄 Создаем .env файл из примера...${NC}"
    if [ -f docker.env.example ]; then
        cp docker.env.example .env
        echo -e "${GREEN}✅ .env файл создан из docker.env.example${NC}"
    elif [ -f .env.example ]; then
        cp .env.example .env
        echo -e "${GREEN}✅ .env файл создан из .env.example${NC}"
    else
        echo -e "${RED}❌ Не найден файл примера для .env${NC}"
        exit 1
    fi
    
    echo -e "${YELLOW}⚠️  Не забудьте настроить подключение к базе данных в .env файле!${NC}"
fi

# Останавливаем существующие контейнеры
echo -e "${YELLOW}🛑 Останавливаем существующие контейнеры...${NC}"
docker-compose -f docker-compose.simple.yml down 2>/dev/null

# Собираем и запускаем контейнеры
echo -e "${YELLOW}🔨 Собираем Docker образ...${NC}"
docker-compose -f docker-compose.simple.yml build

echo -e "${YELLOW}🚀 Запускаем приложение...${NC}"
docker-compose -f docker-compose.simple.yml up -d

# Ждем запуска
echo -e "${YELLOW}⏳ Ждем запуска приложения...${NC}"
sleep 10

# Проверяем статус
if docker-compose -f docker-compose.simple.yml ps | grep -q "Up"; then
    echo -e "${GREEN}✅ Приложение успешно запущено!${NC}"
    echo ""
    echo -e "${GREEN}🌐 Откройте браузер и перейдите по адресу:${NC}"
    echo -e "${GREEN}   http://localhost:8000${NC}"
    echo ""
    echo -e "${YELLOW}📋 Полезные команды:${NC}"
    echo "   Просмотр логов: docker-compose -f docker-compose.simple.yml logs -f"
    echo "   Остановка:      docker-compose -f docker-compose.simple.yml down"
    echo "   Перезапуск:     docker-compose -f docker-compose.simple.yml restart"
    echo ""
    echo -e "${YELLOW}⚙️  Настройка базы данных:${NC}"
    echo "   1. Отредактируйте .env файл"
    echo "   2. Укажите параметры подключения к вашей БД"
    echo "   3. Перезапустите: docker-compose -f docker-compose.simple.yml restart"
else
    echo -e "${RED}❌ Ошибка запуска приложения${NC}"
    echo -e "${YELLOW}📋 Просмотрите логи для диагностики:${NC}"
    echo "   docker-compose -f docker-compose.simple.yml logs"
    exit 1
fi
