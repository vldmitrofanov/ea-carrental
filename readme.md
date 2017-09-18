## About Application
- name: tender-larkspur
- [Applicatio URL](tender-larkspur.deis.impressitsolutions.com)

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb combination of simplicity, elegance, and innovation give you tools you need to build any application with which you are tasked.

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

## Installation Guide

Please follow the steps below to configure the Embassy Alliance rental car application built on Laravel 5.4:
### Server Requirement
Your server must meet the following requirements

1. PHP >= 5.6.4
2. OpenSSL PHP Extension
3. PDO PHP Extension
4. Mbstring PHP Extension
5. Tokenizer PHP Extension
6. XML PHP Extension
7. Composer must be installed on server


### Application Configurations
1. Create a clone of the project like $ git clone <<COMMAND CODE GENERATED BY BITBUCKET>>. after running this command it'll create folder with same name as on GIT repository.
2. Goto your directory folder
3. Run the command $ composer install
4. Create a configuration file named ".env". you can rename or make a copy of file ".env.example" and set the configurations
5. Run Command $ php artisan key:generate (this will generate the application key)
6. Run the command $ composer update
7. Run the command $ php artisan migrate:refresh --seed (this will generate the database tables using the Database credentials mentioned in .env file)
8. Then download the countries.sql file (PATH: /path/to/laravel/storage/dump/) and manually import into database
    * countries.sql is dump file for countries with currencies and currency code information downloaded from google

9. Server website folder path must must be set to: /path/to/laravel/public (As in laravel the index.php file exists under public folder)
10. For Google calendar configuration, please check the link :https://murze.be/2016/05/how-to-setup-and-use-the-google-calendar-api/ and 
    place the json file containing the credentials of a Google Service account under "storage/app/laravel-google-calendar/" folder and
    update the 'config/laravel-google-calendar.php' file with json file name

### Google ReCaptcha
Please register site at  and get the site-key and secret key generated by google for the domain and place in .env with the following variables.
RE_CAP_SITE=XXXXXXXXXXXXXXXXXXXXXXXX
RE_CAP_SECRET=XXXXXXXXXXXXXXXXXXXXXXXXXX

### AWS S3 STorage
Please set the following information for AWS S3 server.

AWS_KEY=AKIAJWCJLEQL6UESZWPQ
AWS_SECRET=YVaKyp4chm8lV3eqKLAFS2dQgfZj3RJfSlUEa+Ri
AWS_REGION=ap-southeast-1
AWS_BUCKET=carrental-test

### Storage
According to Laravel 5.2 docs, your publicly accessible files should be put in directory storage/app/public
 
To make them accessible from the web, you should create a symbolic link from public/storage to storage/app/public.
 
ln -s /path/to/laravel/storage/app/public /path/to/laravel/public/storage