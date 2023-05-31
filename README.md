# Laravel Typed Arr

[![Latest Version on Packagist](https://img.shields.io/packagist/v/lemaur/laravel-typed-arr.svg?style=flat-square)](https://packagist.org/packages/lemaur/laravel-typed-arr)
[![Total Downloads](https://img.shields.io/packagist/dt/lemaur/laravel-typed-arr.svg?style=flat-square)](https://packagist.org/packages/lemaur/laravel-typed-arr)
[![License](https://img.shields.io/packagist/l/lemaur/laravel-typed-arr.svg?style=flat-square&color=yellow)](https://github.com/leMaur/laravel-typed-arr/blob/main/LICENSE.md)
[![Tests](https://img.shields.io/github/actions/workflow/status/lemaur/laravel-typed-arr/run-tests.yml?label=tests&style=flat-square)](https://github.com/leMaur/laravel-typed-arr/actions/workflows/run-tests.yml)
[![GitHub Sponsors](https://img.shields.io/github/sponsors/lemaur?style=flat-square&color=ea4aaa)](https://github.com/sponsors/leMaur)
[![Trees](https://img.shields.io/badge/dynamic/json?color=yellowgreen&style=flat-square&label=Trees&query=%24.total&url=https%3A%2F%2Fpublic.offset.earth%2Fusers%2Flemaur%2Ftrees)](https://ecologi.com/lemaur?r=6012e849de97da001ddfd6c9)

This package provides an object-oriented way to retrieve the Array data with the right type.  

If you are familiar with static analysis tool like phpstan, you've probably encountered `Cannot cast mixed to string` error (or similar).

This is usually happen when you try to cast a value returned from a method/function with a `mixed` return type.

With this package you can get a string value (and not only string) directly from the [Arr helper](https://laravel.com/docs/master/helpers#arrays) like:
```php
use \Illuminate\Support\Arr;

/** @var \Illuminate\Support\Stringable $myValue */
$myValue = Arr::string($data, 'my-value');
```


<br>

## Support Me

Hey folks,

Do you like this package? Do you find it useful, and it fits well in your project?

I am glad to help you, and I would be so grateful if you considered supporting my work.

You can even choose 😃:
* You can [sponsor me 😎](https://github.com/sponsors/leMaur) with a monthly subscription.
* You can [buy me a coffee ☕ or a pizza 🍕](https://github.com/sponsors/leMaur?frequency=one-time&sponsor=leMaur) just for this package.
* You can [plant trees 🌴](https://ecologi.com/lemaur?r=6012e849de97da001ddfd6c9). By using this link we will both receive 30 trees for free and the planet (and me) will thank you. 
* You can "Star ⭐" this repository (it's free 😉).


<br>

## Installation

You can install the package via composer:

```bash
composer require lemaur/laravel-typed-arr
```


<br>

## Usage

### Retrieving Stringable from Arr helper
You may use the `string` method to retrieve the Arr helper item as an instance of `Illuminate\Support\Stringable`:

```php
use \Illuminate\Support\Arr;

/** @var \Illuminate\Support\Stringable $name */
$name = Arr::string($data, 'name');
```

### Retrieving Boolean from Arr helper
You may use the `boolean` method to retrieve the Arr helper item as a boolean. The `boolean` method returns `true` for 1, "1", true, "true", "on", and "yes". All other values will return `false`: 

```php
use \Illuminate\Support\Arr;

/** @var bool $archived */
$archived = Arr::boolean($data, 'archived');
```

### Retrieving Integer from Arr helper
You may use the `integer` method to retrieve the Arr helper item as an integer: 

```php
use \Illuminate\Support\Arr;

/** @var int $count */
$count = Arr::integer($data, 'count');
```

### Retrieving Float from Arr helper
You may use the `float` method to retrieve the Arr helper item as a float: 

```php
use \Illuminate\Support\Arr;

/** @var float $amount */
$amount = Arr::float($data, 'amount');
```

### Retrieving Date from Arr helper
You may use the `date` method to retrieve the Arr helper item as a Carbon instance: 

```php
use \Illuminate\Support\Arr;

/** @var \Carbon\Carbon $birthday */
$birthday = Arr::date($data, 'birthday');
```

The second and third arguments accepted by the `date` method may be used to specify the date's format and timezone, respectively:

```php
use \Illuminate\Support\Arr;

/** @var \Carbon\Carbon $elapsed */
$elapsed = Arr::date($data, 'elapsed', '!H:i', 'Europe/Madrid');
```

In case of an invalid format, an `InvalidArgumentException` will be thrown.

### Retrieving Enum from Arr helper
You may use the `enum` method to retrieve the Arr helper item as a [PHP enum](https://www.php.net/manual/en/language.types.enumerations.php) instance.
In case of an invalid value or the enum does not have a backing value that matches the input value, `null` will be returned.
The `enum` method accepts the name of the input value and the enum class as its first and second arguments: 

```php
use App\Enums\Status;
use \Illuminate\Support\Arr;

/** @var Status $status */
$status = Arr::enum($data, 'status', Status::class);
```


<br>

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [leMaur](https://github.com/lemaur)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
