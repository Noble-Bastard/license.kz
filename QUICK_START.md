# 🚀 UPPERLICENSE - Быстрый запуск в Docker

## ⚡ Запуск одной командой

### Windows:
```cmd
start.bat
```

### Linux/macOS:
```bash
./start.sh
```

## 📝 Что происходит автоматически:

1. ✅ Проверка Docker и Docker Compose
2. ✅ Создание `.env` файла из примера
3. ✅ Сборка Docker образа
4. ✅ Запуск контейнера
5. ✅ Инициализация Laravel приложения

## 🔧 Единственная настройка - База данных

После запуска отредактируйте `.env` файл:

```env
DB_HOST=your-database-host.com
DB_DATABASE=license_kz
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Затем перезапустите:
```bash
docker-compose -f docker-compose.simple.yml restart
```

## 🌐 Готово!

Приложение будет доступно по адресу: **http://localhost:8000**

---
*Полная документация в DOCKER_README.md*
