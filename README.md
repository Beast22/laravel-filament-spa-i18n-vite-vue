# SPA with i18n @ Laravel, Filament, Vue, Vite, Pinia.

### Laravel backend:
- Full data migrations with seeders and factoriy example (pages, categories, descriptions, objects, users)
- Filament admin panel with customised theme
- Internationalization (i18n) with [Spatie Translatable](https://filamentphp.com/docs/2.x/spatie-laravel-translatable-plugin/installation)
- [Spatie Media](https://filamentphp.com/docs/2.x/spatie-laravel-media-library-plugin/installation)
- [Spatie Settings](https://filamentphp.com/docs/2.x/spatie-laravel-settings-plugin/installation)
- [Spatie Health](https://github.com/shuvroroy/filament-spatie-laravel-health) page
- TinyEditor with custom colors

### Vue frontend:
- TypeScript
- [Vue 3](https://vuejs.org/) with Composition api
- [Vite](https://vitejs.dev/) for assets build
- [Pinia](https://pinia.vuejs.org/) for data store
- [ky](https://github.com/sindresorhus/ky) for fetching data
- SPA with basic routes and filtration with categories
- [Cache/expiration] system for api requests

## SPA screenshots
Main page:
![SPA preview](https://github.com/Beast22/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/p-1.jpg?raw=true)
Filtration page:
![SPA preview](https://github.com/Beast22/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/p-2.jpg?raw=true)
Object page:
![SPA preview](https://github.com/Beast22/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/p-3.jpg?raw=true)
Bottom page:
![SPA preview](https://github.com/Beast22/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/p-4.jpg?raw=true)
Rightside drawer:
![SPA preview](https://github.com/Beast22/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/p-5.jpg?raw=true)

## SPA video
https://github.com/user-attachments/assets/582e1780-ca5e-49a3-80b4-443b2a6c4340


## Filament screenshots

Category list:
![Filament preview](https://github.com/Beast22/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/pf-1.jpg?raw=true)
Objects list:
![Filament preview](https://github.com/Beast22/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/pf-2.jpg?raw=true)
Separate object:
![Filament preview](https://github.com/Beast22/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/pf-3.jpg?raw=true)
Global settings page:
![Filament preview](https://github.com/Beast22/laravel-filament-spa-i18n-vite-vue/blob/main/github_preview/pf-4.jpg?raw=true)

## Prerequisites

Required requisites:

1. [Git](https://git-scm.com/book/en/Getting-Started-Installing-Git)
2. [Node](https://nodejs.org/en/)
3. Any kind of serving app (valet, wamp, xamp, sail, artisan serve)

## Installation

1. Clone the project:
```
git clone https://github.com/volkar/laravel-filament-spa-i18n-vite-vue.git
```
2. Go to the project's folder
```
cd laravel-filament-spa-i18n-vite-vue
```
3. Update and install composer packages
```
composer update
```
4. Copy .env.example to .env
```
cp .env.example .env
```
5. Generate keys
```
php artisan key:generate
```
6. Edit your .env file to setup database connection and site address `APP_URL`
7. Create database schema & seed it
```
php artisan migrate:refresh --seed
```
8. Install all node.js dependencies
```
npm install
```
9. Run Vite dev server
```
npm run dev
```
10. Serve your Laravel app (valet in example, wamp, xamp, sail or whatever)
```
valet link mysite
```
11. Open served address in your browser.
```
http://mysite.test
```

Filament's admin account created by seeding:
- login: **admin@admin.com**
- pass: **admin**

## Contact me

Contact me
- E-mail: blagorad@list.ru
- Telegram: @snakecatcher32
