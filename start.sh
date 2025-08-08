#!/bin/bash

# SkillGro LMS Docker Startup Script
# This script automatically sets up and starts the application

set -e  # Exit on any error

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

# Stop existing containers
echo "🛑 Stopping existing containers..."
docker-compose -f docker-compose.dev.yml down

# Remove volumes to ensure fresh start (optional - comment out if you want to keep data)
echo "🗑️  Removing volumes for fresh start..."
docker volume rm main_files_mysql_dev_data main_files_redis_dev_data 2>/dev/null || true

# Start containers
echo "🔧 Starting containers..."
docker-compose -f docker-compose.dev.yml --env-file docker.env up -d

# Wait for MySQL to be ready
echo "⏳ Waiting for MySQL to be ready..."
for i in {1..60}; do
    if docker-compose -f docker-compose.dev.yml exec -T mysql mysqladmin ping -h localhost -u root -proot_password --silent; then
        echo "✅ MySQL is ready!"
        break
    fi
    echo "⏳ Waiting for MySQL... ($i/60)"
    sleep 5
done

# Check if MySQL is ready
if ! docker-compose -f docker-compose.dev.yml exec -T mysql mysqladmin ping -h localhost -u root -proot_password --silent; then
    echo "❌ MySQL failed to start properly"
    exit 1
fi

# Wait a bit more for all services to be fully ready
echo "⏳ Waiting for all services to be ready..."
sleep 10

# Test database connection
echo "🔍 Testing database connection..."
if docker-compose -f docker-compose.dev.yml exec -T mysql mysql -u erzhan -p'!Gro@2025' -e "USE lms_system; SELECT 1;" > /dev/null 2>&1; then
    echo "✅ Database connection successful!"
else
    echo "❌ Database connection failed!"
    exit 1
fi

# Run Laravel setup commands (only if needed)
echo "⚙️  Setting up Laravel..."

# Check if app container is ready
if ! docker-compose -f docker-compose.dev.yml exec -T app php --version > /dev/null 2>&1; then
    echo "❌ App container is not ready"
    exit 1
fi

# Run Laravel commands (with error handling)
docker-compose -f docker-compose.dev.yml exec -T app php artisan key:generate --force || echo "⚠️  Key generation failed (may already exist)"
docker-compose -f docker-compose.dev.yml exec -T app php artisan storage:link --force || echo "⚠️  Storage link failed"
docker-compose -f docker-compose.dev.yml exec -T app php artisan config:cache || echo "⚠️  Config cache failed"
docker-compose -f docker-compose.dev.yml exec -T app php artisan route:cache || echo "⚠️  Route cache failed"
docker-compose -f docker-compose.dev.yml exec -T app php artisan view:cache || echo "⚠️  View cache failed"

echo "✅ Setup complete!"
echo ""
echo "🌐 Application: http://localhost:8080"
echo "🗄️  phpMyAdmin: http://localhost:8081"
echo "📧 MailHog: http://localhost:8025"
echo ""
echo "📋 Container status:"
docker-compose -f docker-compose.dev.yml ps
echo ""
echo "🔍 To check logs: docker-compose -f docker-compose.dev.yml logs -f"
echo "🛑 To stop: docker-compose -f docker-compose.dev.yml down"
echo ""
echo "💡 For production deployment:"
echo "   1. Copy docker.env to docker.env.production"
echo "   2. Update variables for production"
echo "   3. Run: docker-compose -f docker-compose.yml --env-file docker.env.production up -d"
