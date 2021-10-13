# West River Academy (Laravel App)

### Prerequisites

-   php v7.4.3, [see](https://laravel.com/docs/installation) Laravel specific requirements
-   Apache v2.4.43 with `mod_rewrite`
-   MySql 8.0
-   [Composer](https://getcomposer.org) v2.0.2
-   [node-js](https://github.com/creationix/nvm) >=14.15.1 and [npm](https://www.npmjs.com/) >=6.14.8

### Quick setup

-   Clone this repo, checkout to most the active branch
-   Write permissions on `storage` and `bootstrap/cache` folders
-   Create a config file (copy from `.env.example`), and update environment variables

```
cp .env.example .env
```

-   Install dependencies

```
composer install
yarn install

php artisan key:generate
```

-   Migrate and Seed the database

```
php artisan migrate
php artisan db:seed
```

-   Create the symbolic link for local file uploads

```
php artisan storage:link
```

-   Point your web server to **public** folder of this project
-   Additionally, you can run this command on production server

```
php artisan optimize
```

### 3rd party services used

-   E-mail service
-   [Sentry](https://docs.sentry.io/platforms/php/laravel/) error reporting service (optional)

-   Sequence to execute db commands

### user, parent and student import CSV import

-   php artisan import:users
-   php artisan import:parents
-   php artisan import:students

### Enrollment import

-   php artisan import:enrollments
-   php artisan import:enrollmentpayment
-   php artisan import:enrollmentpaymentsmethods

### Transcript Import k8

-   php artisan import:transcript9_12

### Transcript Import 9-12 import

-   php artisan import:transcript9_12

### Representative Groups

`First generate new csv for filling empty parent representative names`

-   php artisan import:repname
-   php artisan import:representative
-   php artisan import:parentrep
-   php artisan import:repamount


## For Custom Payments

- php artisan import:custompayment
- php artisan import:updatecustom

## For Custom Letter

- php artisan import:customletter
- php artisan import:updatecustompletterayment

## For Coupon
- php artisan import:coupon

## For Personal Consultation
- php artisan import:personalconsultation
- php artisan import:updatepaymentconsultation

## For Graduation
- php artisan import:graduation
- php artisan import:graduationpayment

## For Apostile/Notarization
- php artisan import:apostilenotarization
- php artisan import:notarizationpayment