#!/bin/bash

echo "🌱 Запуск сидеров для LMS системы"
echo "=================================="

# Проверяем, что мы в Laravel проекте
if [ ! -f "artisan" ]; then
    echo "❌ Ошибка: artisan файл не найден. Убедитесь, что вы находитесь в корне Laravel проекта."
    exit 1
fi

# Проверяем, что composer установлен
if ! command -v composer &> /dev/null; then
    echo "❌ Ошибка: composer не установлен. Установите composer и попробуйте снова."
    exit 1
fi

# Проверяем, что PHP установлен
if ! command -v php &> /dev/null; then
    echo "❌ Ошибка: PHP не установлен. Установите PHP и попробуйте снова."
    exit 1
fi

echo "✅ Проверки пройдены успешно"
echo ""

# Устанавливаем зависимости если нужно
if [ ! -d "vendor" ]; then
    echo "📦 Устанавливаем зависимости Composer..."
    composer install
    echo ""
fi

# Очищаем кэш
echo "🧹 Очищаем кэш..."
php artisan cache:clear
php artisan config:clear
php artisan view:clear
echo ""

# Запускаем полный сброс и перезапуск базы данных
echo "🗄️  Выполняем полный сброс базы данных..."
php artisan migrate:fresh --seed --force
echo ""

# Проверяем результат
echo "🔍 Проверяем результат..."
php artisan seeders:check

echo ""
echo "🎉 Готово! Сидеры успешно запущены."
echo ""
echo "📋 Полезные команды:"
echo "  - Проверить статус: php artisan seeders:check"
echo "  - Перезапустить: php artisan migrate:fresh --seed"
echo "  - Очистить кэш: php artisan cache:clear"
echo ""
echo "👤 Тестовые пользователи:"
echo "  - Админ: admin@gmail.com / 1234"
echo "  - Пользователь: ivan.petrov@example.com / password"
