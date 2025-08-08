#!/bin/bash

# SkillGro LMS Docker Startup Script
# This script automatically sets up and starts the application

echo "🚀 Starting SkillGro LMS..."

# Check if .env file exists
if [ ! -f .env ]; then
    echo "📝 Creating .env file from .env.example..."
    cp .env.example .env
fi

# Check if docker.env file exists
if [ ! -f docker.env ]; then
    echo "📝 Creating docker.env file..."
    cat > docker.env << EOF
# Docker Environment Variables
APP_PORT=8080
APP_ENV=local
APP_DEBUG=true
DB_DATABASE=lms_system
DB_USERNAME=erzhan
DB_PASSWORD=!Gro@2025
MYSQL_ROOT_PASSWORD=root_password
MYSQL_PORT=3307
REDIS_PORT=6380
PMA_PORT=8081
MAILHOG_SMTP_PORT=1025
MAILHOG_WEB_PORT=8025
EOF
fi

# Stop and remove existing containers
echo "🛑 Stopping existing containers..."
docker-compose -f docker-compose.dev.yml down

# Remove volumes to ensure fresh start
echo "🗑️  Removing volumes..."
docker volume rm main_files_mysql_dev_data main_files_redis_dev_data 2>/dev/null || true

# Start containers
echo "🔧 Starting containers..."
docker-compose -f docker-compose.dev.yml --env-file docker.env up -d

# Wait for MySQL to be ready
echo "⏳ Waiting for MySQL to be ready..."
sleep 30

# Run Laravel setup commands
echo "⚙️  Setting up Laravel..."
docker-compose -f docker-compose.dev.yml exec -T app php artisan key:generate --force
docker-compose -f docker-compose.dev.yml exec -T app php artisan migrate --force
docker-compose -f docker-compose.dev.yml exec -T app php artisan storage:link --force
docker-compose -f docker-compose.dev.yml exec -T app php artisan config:cache
docker-compose -f docker-compose.dev.yml exec -T app php artisan route:cache
docker-compose -f docker-compose.dev.yml exec -T app php artisan view:cache

echo "✅ Setup complete!"
echo "🌐 Application: http://localhost:8080"
echo "🗄️  phpMyAdmin: http://localhost:8081"
echo "📧 MailHog: http://localhost:8025"
echo ""
echo "📋 Container status:"
docker-compose -f docker-compose.dev.yml ps
