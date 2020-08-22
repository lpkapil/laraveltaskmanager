<p align="center">
        <img src="https://raw.githubusercontent.com/lpkapil/storemanager/dev/public/demo_images/banner.png">
</p>

## About Application

It's Store manager web application based on Software as service model. Multiple online stores can be created for sellers as a service, REST API exposed for creating store mobile application to sell goods & a dedicated admin panel available for sellers to manage store, It's Developed using Laravel v7.15.0. 

###### Completed

- User Login/Registration Module 
- Contacts Management Module
- User Management Module
- Role Management Module
- Role Permision Management Module
- Store Mangement Module
- Category Mangement Module
- Product Management Module

###### In-Progress

- Order Management Module

###### To-do

- Integration token management module for REST API Access
- REST API(s) for all modules for mobile apps
- Frontend ReactJs Store Building
- Alerts Mangement Module
- Payment Gateway Integration

###### Summary of completed modules 

Two differenet roles "Admin" and "User" will automatically added in system and both have differnet dashboard according to assiged permissions in roles. On new user registration a confirmation email will be sent to the registered email address, Account will activate only when user will click on activation link sent in email address.

## Installation Procedure

Pull Latest code: 

`https://github.com/lpkapil/storemanager.git`

- Create Virtual Host & Host Entry in apache configuration and host file and restart apache server

```
<VirtualHost *:80>
        ServerAdmin webmaster@example.com
        ServerName storemanager.com
        ServerAlias storemanager.com
        DocumentRoot /var/www/html/storemanager/public/
        <Directory /var/www/html/storemanager>
                AllowOverride all
                Require all granted
        </Directory>
</VirtualHost>
```

`127.0.0.1 storemanager.com`

`service apache2 restart`

- Run below command after navigating to application root for refreshing application key & installing database

`php artisan key:generate`

`php artisan migrate:refresh --seed`

`cd public`

`rm -rf storage`

`php artisan storage:link`

- Storage:link command needs to be run first time, and it's used when application using media upload feature, it created symlink of internal image folder to public folder, so images can access via url from internal app stoage folder.

- Open application using URL

`http://storemanager.com`

## Login Details

#### Admin #### 

Username: admin@example.com
Password: admin

#### User ####

Username: user@example.com
Password: user

## Demo Screens

![Demo Screens](https://github.com/lpkapil/storemanager/blob/dev/public/demo_images/demo.gif?raw=true)

## Learning Laravel

Laravel has the most extensive and thorough documentation and video tutorial library of any modern web application framework. The [Laravel documentation](https://laravel.com/docs) is thorough, complete, and makes it a breeze to get started learning the framework.

If you're not in the mood to read, [Laracasts](https://laracasts.com) contains over 900 video tutorials on a range of topics including Laravel, modern PHP, unit testing, JavaScript, and more. Boost the skill level of yourself and your entire team by digging into our comprehensive video library.
