#!/bin/bash

# Скрипт для исправления MySQL view service_ext
echo "Начинаем исправление MySQL view service_ext..."

# Шаг 1: Проверить текущего пользователя
echo "Шаг 1: Проверяем текущего пользователя БД..."
mysql -h localhost -u root -p license_kz -e "SELECT USER();" 2>/dev/null || {
    echo "Ошибка подключения к БД. Проверьте учетные данные в .env файле"
    exit 1
}

# Шаг 2: Попытаться исправить view с помощью ALTER DEFINER
echo "Шаг 2: Исправляем definer для view service_ext..."
mysql -h localhost -u root -p license_kz -e "
SET GLOBAL log_bin_trust_function_creators = 1;
ALTER DEFINER=\`root\`@\`localhost\` SQL SECURITY INVOKER VIEW \`service_ext\` AS
SELECT sj.id,
       sj.service_no,
       sj.create_date,
       sj.modify_date,
       sj.service_status_id,
       ss.name AS service_status_name,
       sj.client_id,
       CONCAT(p.last_name, ' ', p.first_name, ' ', COALESCE(p.middle_name, '')) AS client_name,
       sj.manager_id,
       CONCAT(m.last_name, ' ', m.first_name, ' ', COALESCE(m.middle_name, '')) AS manager_name,
       sj.country_id,
       c.name AS country_name,
       sj.agreement_no,
       sj.agreement_date
FROM service_journal sj
LEFT JOIN service_status ss ON sj.service_status_id = ss.id
LEFT JOIN profile p ON sj.client_id = p.id
LEFT JOIN profile m ON sj.manager_id = m.id
LEFT JOIN country c ON sj.country_id = c.id;
" 2>/dev/null && {
    echo "View service_ext успешно исправлен!"
} || {
    echo "Не удалось исправить view автоматически. Попробуйте выполнить команды вручную:"
    echo "1. Подключитесь к БД: mysql -h localhost -u root -p license_kz"
    echo "2. Выполните: SET GLOBAL log_bin_trust_function_creators = 1;"
    echo "3. Экспортируйте view: mysqldump -u root -p --no-data license_kz service_ext > service_ext_backup.sql"
    echo "4. Отредактируйте файл, заменив DEFINER на правильного пользователя"
    echo "5. Удалите старый view: DROP VIEW service_ext;"
    echo "6. Импортируйте исправленный: mysql -u root -p license_kz < service_ext_backup.sql"
}

echo "Исправление завершено!"
