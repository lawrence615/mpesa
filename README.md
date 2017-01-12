# Mpesa API Implementation
This package is created to integrate MPesa Services i.e. C2B, B2C, B2B and Online Checkout in your Laravel app.
It allows you to receive and process soap sent by Safaricom. The package is still under heavy development and thus subject to bugs and changes.

## Requirements
- [PHP >=5.6.0](http://php.net/)
- [Laravel 5.x](https://github.com/laravel/framework)

## Quick Installation
`composer require "lawrence615/mpesa:dev-master"`

#### Service Provider
`Mobidev\Mpesa\MpesaServiceProvider::class`

#### Configuration and Assets
`$ php artisan vendor:publish`

Then run php artisan:migrate to create the tables in you database
