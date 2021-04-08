<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## API
#### Api Postman Description:
- https://documenter.getpostman.com/view/605698/TzCTZkeB
### POST Register

- http://tek.loc/api/v1/register
- BODY formdata
-     Params : ['uID' => '12345678','appID' => '1234567','lang' => 'en','os' => 'Android']
-     Response : {"data":{"u_id":"12345678","app_id":"1234567","lang":"en","os":"Android","updated_at":"2021-04-08T14:58:34.000000Z","created_at":"2021-04-08T14:58:34.000000Z"},"client_token":Token}

### POST purchase

- http://tek.loc/api/v1/purchase
- AUTHORIZATION Bearer Token
- BODY formdata
-     Params : ['receipt' => '1A2B3']
-     Response : {"data":{"device_id":2,"receipt":"1A2B3","status":"started","expire_date":"2021-05-08 17:04:19","created_at":"2021-04-08T14:58:45.000000Z","updated_at":"2021-04-08T17:04:20.000000Z"}}

### POST Check Subscriptoin

- http://tek.loc/api/v1/check_subscription
- AUTHORIZATION Bearer Token
-     Response : {"data":{"device_id":2,"receipt":"1A2B3","status":"started","expire_date":"2021-05-08 14:58:44"}}

### POST Google Mock Verification

- http://tek.loc/api/mock/google/verification
- BODY formdata
-     Params : ['receipt' => '1A2B3']
-     Response : {"status":true,"expire_date":"2021-05-08 20:02:29"}

### POST Apple Mock Verification

- http://tek.loc/api/mock/apple/verification
- BODY formdata
-     Params : ['receipt' => '1A2B3']
-     Response : {"status":true,"expire_date":"2021-05-08 20:02:29"}

## Worker
Command php artisan:
-     subscription:verify_expired
