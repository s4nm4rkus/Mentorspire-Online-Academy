#!/usr/bin/env bash

git stash
git fetch
git pull origin main

# install dependencies
composer install -n --ignore-platform-reqs

# run artisan commands
php artisan config:cache && php artisan migrate --force

#run npm commands
npm install -qy && npm run dev
