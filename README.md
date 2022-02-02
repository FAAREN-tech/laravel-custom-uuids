# Laravel Custom UUIDs

This package offers uuids like they are used by Stripe, prefixed by the model.

## Open Tasks

- [ ] Add command to add this field to existing models

## Installation

Run the following commands:

```shell
// Install the package
composer require faaren-tech/laravel-custom-uuids

// Publish relevant stubs for model and migration creation
php artisan custom-uuids:publish-stubs
```

## Usage

### Normal models

Simply keep using the following commands to create models and migrations:

- `php artisan make:model <MyModel>` to create a new model
- `php artisan make:model <MyModel> -m` to create a new model and a migration 
- `php artisan make:migration <CreateMyModelTable>` to create a new migration class

Thanks to the custom stubs, those generated classes will have included the relevant interfaces and/or methods.

**Important**: You have to implement `public function getUuidPrefix(): string` from `FaarenTech\LaravelCustomUuids\Interfaces\HasCustomUuidInterface` by your own.

### User Model and Authenticatable Models

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

## Customize stubs

Of course, you are free to customize the given stubs. They are stored in `*/stubs`.
