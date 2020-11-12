
## West River Academy

### Prerequisites 

* php v7.4.3, [see](https://laravel.com/docs/installation) Laravel specific requirements
* Apache v2.4.33
* [Composer](https://getcomposer.org) v1.10.5 || 2.0

### Quick setup 
* Clone this repo, checkout to most active branch
* Create a config file (copy from ```.env.example```), and update environment variables
```
cp .env.example .env
```
* Install dependencies

composer install
php artisan key:generate
```
* Migrate database
```
php artisan migrate
