# Laravel Custom UUIDs

This package offers uuids like they are used by Stripe, prefixed by the model.

## Open Tasks

- Add command to add this field to existing models

## Installation

Run the following commands:

```shell
// Install the package
composer require faaren-tech/laravel-custom-uuids

// Publish relevant stubs for model and migration creation
php artisan custom-uuids:publish-stubs
```

## Usage

As this package uses its own stubs, you can simply keep running the `make` commands as you are used to. This package overrides the stubs for `make:model` and `make:migration`.

The changes made to the stubs are:

- added another base model to extend `FaarenTech\LaravelCustomUuids\Models\UuidModel` instead of `Illuminate\Database\Eloquent\Model`. `Illuminate\Database\Eloquent\Model` is still the parent class of `FaarenTech\LaravelCustomUuids\Models\UuidModel`
- added an additional uuid column to the create migration 

## User Model and Authenticatable Models

Those models that are a child of `Illuminate\Foundation\Auth\User`, e.g. the `App\User` model, you have to do some additional work.

- Switch the parent class to `FaarenTech\LaravelCustomUuids\Models\UuidModel`
- Add the following interfaces
  - `Illuminate\Contracts\Auth\Access\Authorizable`
  - `Illuminate\Contracts\Auth\Authenticatable`
  - `Illuminate\Contracts\Auth\CanResetPassword`
- Add the following traits to your model
  - `Illuminate\Auth\Authenticatable`
  - `Illuminate\Foundation\Auth\Access\Authorizable`
  - `Illuminate\Auth\Passwords\CanResetPassword`
  - `Illuminate\Auth\MustVerifyEmail`

A possible implementation could look like this:

```php
<?php

namespace App\Models;

use FaarenTech\LaravelCustomUuids\Models\UuidModel;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends UuidModel implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract,
    HasCustomUuidInterface
{
    use Authenticatable, 
        Authorizable, 
        CanResetPassword, 
        MustVerifyEmail, 
        HasApiTokens, 
        HasFactory, 
        Notifiable;
        
    public function getUuidPrefix(): string
    {
        return "user";
    }
}
```
