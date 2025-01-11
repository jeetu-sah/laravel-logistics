set -e

echo "🚚 Dploying application"

echo "⬇️ Laravel down"

(sudo php artisan down) || true

    echo "⬇️ Updating base code: main branch"
    
    sudo git fetch origin main
    sudo git reset --hard origin/main

    echo "📦 Installing composer dependencies"
    
    sudo composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

    echo "🗃️ Running migrations"

    sudo php artisan migrate --force

    echo "🔄 Restarting queue"
    
    sudo php artisan queue:restart

    echo "🧹 Recreating cache"
    
    sudo php artisan optimize

    echo "📦 Installing Npm dependencies"
    
    sudo npm ci

    echo "🏗️ Compiling assets"
    
    sudo npm run production

    echo "🔐 Applying permissions"
    
    sudo find /var/www/project -type f -exec chmod 644 {} \;
    sudo find /var/www/project -type d -exec chmod 755 {} \;
    sudo chown -R www-data:www-data /var/www/project
    sudo chgrp -R www-data /var/www/project/storage /var/www/project/bootstrap/cache
    sudo chmod -R ug+rwx /var/www/project/storage /var/www/project/bootstrap/cache

    echo "🔄 Restarting Php"
    
    echo "" | sudo -S service php8.1-fpm reload
    
echo "⬆️ Rising Laravel"

sudo php artisan up

echo "🎉 Deployed application"