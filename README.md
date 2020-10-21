# cms-backend-auth
#Create Admin Authentication and Roles

## Installation
1- Define package to your composer.json add this lines to composer.json :
` "repositories": [
    {
      "type": "git",
      "url":  "https://ahmed-elsadany@bitbucket.org/ahmed-elsadany/cms-backend-auth.git"
    }],`
2- Run Command 
```bash
composer require ahmed-elsadany/cms-backend-auth 
```
```php
// config/app.php
'providers' => [
    ...
    MediaSci\CmsBackendAuth\CmsBackendAuthServiceProvider::class,
    ...
];
```
```bash
php artisan vendor:publish
```
The following config File will be published in `config/cms-backend-auth`
```php
return [
/*
the name of project you are working on
*/
      'projectName'=>'',
/*
the home link that you want to redirect to on login
*/
    'dashboardLink'=>'',
/*
the prefix of your project
*/
    'prefix'=>'',
/*
the title of the message of forget password
*/
    'forgetPasswordTitle'=>'Forgetten password request',
/*
the from mail that will be displayed in forget password message
*/ 
   'fromEmail'=>'test@test.com',//example info@admin.com
/*
the layout path
*/
    'extends'=>'backend.layout',//example -> 'backend.layout'
/*
the content area Name
*/
    'contentArea'=>'content',//example ->content
];
```
run migration the get your tables
```bash
php artisan migrate
```
###This are the routes of Authentication
login route
```bash
your prefix /login
```
logout route
```bash
your prefix /logout
```
pages route
```bash
your prefix /pages
```
roles route
```bash
your prefix /roles
```
users route
```bash
your prefix /users
```
update profile route
```bash
your prefix /update-profile
```
update password route
```bash
your prefix /update-password
```
-this is the object of the session of user 
`\Session::get('backendUser')`


# cms-backend-auth
