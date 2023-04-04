#!/bin/bash
composer dump-autoload --optimize
npm run watch & php artisan serve --host 0.0.0.0
