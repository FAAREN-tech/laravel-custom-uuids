# Laravel Custom UUIDs

This package offers uuids like they are used by Stripe, prefixed by the model.

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

