# West River Academy (Laravel App)

### Prerequisites 
* php v7.4.3, [see](https://laravel.com/docs/installation) Laravel specific requirements
* Apache v2.4.43 with ```mod_rewrite```
* MySql 8.0
* [Composer](https://getcomposer.org) v2.0.2
* [node-js](https://github.com/creationix/nvm) >=12.14.0 and [yarn](https://yarnpkg.com/en/) >=1.22

### Quick setup 
* Clone this repo, checkout to most the active branch
* Write permissions on ```storage``` and ```bootstrap/cache``` folders
* Create a config file (copy from ```.env.example```), and update environment variables
```
cp .env.example .env
```
* Install dependencies
```
composer install
yarn install

php artisan key:generate
```
* Migrate and Seed the database
```
php artisan migrate
php artisan db:seed
```
* Create the symbolic link for local file uploads
```
php artisan storage:link
```
* Point your web server to **public** folder of this project
* Additionally, you can run this command on production server
```
php artisan optimize
```
