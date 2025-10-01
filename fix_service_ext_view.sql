-- Скрипт для виправлення definer у view service_ext
-- Проблема: view має definer 'license_usr'@'%', який не існує

-- Крок 1: Перевірити поточного користувача
SELECT USER();

-- Крок 2: Видалити існуючий view (якщо потрібно)
-- DROP VIEW IF EXISTS service_ext;

-- Крок 3: Змінити definer для існуючого view
-- Замініть 'root'@'localhost' на вашого поточного користувача БД
-- Наприклад: 'root'@'localhost' або 'license_kz'@'localhost'

-- Варіант 1: Якщо ви знаєте структуру view, можна пересоздати його:
-- CREATE OR REPLACE DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `service_ext` AS
-- SELECT ... (тут має бути оригінальний SQL запит view)

-- Варіант 2: Експортувати view, змінити definer і імпортувати назад
-- 1. Експортуйте view: mysqldump -u root -p --no-data --routines license_kz service_ext > service_ext_backup.sql
-- 2. Відредагуйте файл, замінивши DEFINER=`license_usr`@`%` на DEFINER=`root`@`localhost`
-- 3. Видаліть старий view: DROP VIEW service_ext;
-- 4. Імпортуйте виправлений: mysql -u root -p license_kz < service_ext_backup.sql

-- Варіант 3: Швидке виправлення (потребує прав SUPER)
-- Цей варіант працює тільки якщо у вас є права SUPER
-- SET GLOBAL log_bin_trust_function_creators = 1;

-- ВАЖЛИВО: Після виправлення перезапустіть сервер додатку
-- php artisan config:clear
-- php artisan cache:clear
