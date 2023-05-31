<?php

namespace Lemaur\LaravelTypedArr;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Date;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTypedArrServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package->name('laravel-typed-arr');
    }

    public function packageBooted(): void
    {
        /**
         * Retrieve value from the array as a Stringable instance.
         *
         * @param  \ArrayAccess|array  $array
         * @param  string|int|null  $key
         * @param  mixed  $default
         * @return \Illuminate\Support\Stringable
         */
        Arr::macro('string', function ($array, $key, $default = null) {
            return str(static::get($array, $key, $default));
        });

        /**
         * Retrieve array item as a boolean value.
         *
         * Returns true when value is "1", "true", "on", and "yes". Otherwise, returns false.
         *
         * @param  \ArrayAccess|array  $array
         * @param  string|null  $key
         * @param  bool  $default
         * @return bool
         */
        Arr::macro('boolean', function ($array, $key = null, $default = null) {
            return filter_var(static::get($array, $key, $default), FILTER_VALIDATE_BOOLEAN);
        });

        /**
         * Retrieve array item as an integer value.
         *
         * @param  \ArrayAccess|array  $array
         * @param  string  $key
         * @param  int  $default
         * @return int
         */
        Arr::macro('integer', function ($array, $key, $default = 0) {
            return intval(static::get($array, $key, $default));
        });

        /**
         * Retrieve array item as a float value.
         *
         * @param  \ArrayAccess|array  $array
         * @param  string  $key
         * @param  float  $default
         * @return float
         */
        Arr::macro('float', function ($array, $key, $default = 0.0) {
            return floatval(static::get($array, $key, $default));
        });

        /**
         * Retrieve value from the configuration as a Carbon instance.
         *
         * @param  \ArrayAccess|array  $array
         * @param  string  $key
         * @param  string|null  $format
         * @param  string|null  $tz
         * @return \Illuminate\Support\Carbon|null
         *
         * @throws \Carbon\Exceptions\InvalidFormatException
         */
        Arr::macro('date', function ($array, $key, $format = null, $tz = null) {
            if (static::isNotFilled($array, $key)) {
                return null;
            }

            if (is_null($format)) {
                return Date::parse(static::get($array, $key), $tz);
            }

            return Date::createFromFormat($format, static::get($array, $key), $tz);
        });

        /**
         * Retrieve value from the configuration as an enum.
         *
         * @template TEnum
         *
         * @param  \ArrayAccess|array  $array
         * @param  string  $key
         * @param  class-string<TEnum>  $enumClass
         * @return TEnum|null
         */
        Arr::macro('enum', function ($array, $key, $enumClass) {
            if (static::isNotFilled($array, $key) ||
                ! enum_exists($enumClass) ||
                ! method_exists($enumClass, 'tryFrom')) {
                return null;
            }

            return $enumClass::tryFrom(static::get($array, $key));
        });

        /**
         * Determine if the given array item is an empty string for "filled".
         *
         * @param  \ArrayAccess|array  $array
         * @param  string  $key
         * @return bool
         */
        Arr::macro('isEmptyString', function ($array, $key) {
            $value = static::get($array, $key);

            return ! is_bool($value) && ! is_array($value) && trim((string) $value) === '';
        });

        /**
         * Determine if the array item contains a non-empty value for a configuration item.
         *
         * @param  \ArrayAccess|array  $array
         * @param  string|array  $key
         * @return bool
         */
        Arr::macro('filled', function ($array, $key) {
            return ! static::isEmptyString($array, $key);
        });

        /**
         * Determine if the array item contains an empty value for a configuration item.
         *
         * @param  \ArrayAccess|array  $array
         * @param  string|array  $key
         * @return bool
         */
        Arr::macro('isNotFilled', function ($array, $key) {
            return static::isEmptyString($array, $key);
        });
    }
}
