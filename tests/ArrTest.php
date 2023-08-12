<?php

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Stringable;
use Lemaur\LaravelTypedArr\Tests\Fixtures\TestEnum;

it('returns a string type', function () {
    $array = ['string' => 'string value'];

    expect(Arr::string($array, 'string'))
        ->toBeInstanceOf(Stringable::class)
        ->and(Arr::string($array, 'string')->toString())
        ->toBe('string value');
});

it('returns a boolean type', function () {
    $array = ['boolean' => true];

    expect(Arr::boolean($array, 'boolean'))
        ->toBeBool()->toBeTrue();
});

it('returns an integer type', function () {
    $array = ['integer' => 123];

    expect(Arr::integer($array, 'integer'))
        ->toBeInt()->toBe(123);
});

it('returns a float type', function () {
    $array = ['float' => 1.23];

    expect(Arr::float($array, 'float'))
        ->toBeFloat()->toBe(1.23);
});

it('returns a date type', function () {
    $array = ['date' => '2023-01-01 01:00:00'];

    expect(Arr::date($array, 'date'))
        ->toBeInstanceOf(Carbon::class)
        ->format('Y-m-d H:i:s')
        ->toBe('2023-01-01 01:00:00');
});

it('returns an enum type', function () {
    $array = ['enum' => 'one'];

    expect(Arr::enum($array, 'enum', TestEnum::class))
        ->toBeInstanceOf(TestEnum::class)
        ->toBe(TestEnum::ONE);
});

it('returns an array with kebab case keys', function (array $from, array $to) {
    expect(Arr::kebabCaseKeys($from))->toBe($to);
})->with([
    'camelCase' => [fn () => ['camelCase' => null], fn () => ['camel-case' => null]],
    'snake_case' => [fn () => ['snake_case' => null], fn () => ['snake-case' => null]],
    'kebab-case' => [fn () => ['kebab-case' => null], fn () => ['kebab-case' => null]],
    'StudlyCase' => [fn () => ['StudlyCase' => null], fn () => ['studly-case' => null]],
    'Mixed_Case_1' => [fn () => ['Mixed_Case_1' => null], fn () => ['mixed-case1' => null]],
    'Mixed-Case_2' => [fn () => ['Mixed-Case_2' => null], fn () => ['mixed-case2' => null]],
    'nested camelCase' => [fn () => ['data' => ['camelCase' => null]], fn () => ['data' => ['camel-case' => null]]],
    'nested snake_case' => [fn () => ['data' => ['snake_case' => null]], fn () => ['data' => ['snake-case' => null]]],
    'nested kebab-case' => [fn () => ['Data' => ['kebab-case' => null]], fn () => ['data' => ['kebab-case' => null]]],
    'nested StudlyCase' => [fn () => ['data' => ['StudlyCase' => null]], fn () => ['data' => ['studly-case' => null]]],
    'nested Mixed_Case_1' => [fn () => ['data' => ['Mixed_Case_1' => null]], fn () => ['data' => ['mixed-case1' => null]]],
    'nested Mixed-Case_2' => [fn () => ['data' => ['Mixed-Case_2' => null]], fn () => ['data' => ['mixed-case2' => null]]],
    '2x nested camelCase' => [fn () => ['data' => ['attributes' => ['camelCase' => null]]], fn () => ['data' => ['attributes' => ['camel-case' => null]]]],
    '2x nested snake_case' => [fn () => ['data' => ['attributes' => ['snake_case' => null]]], fn () => ['data' => ['attributes' => ['snake-case' => null]]]],
    '2x nested kebab-case' => [fn () => ['Data' => ['Attributes' => ['kebab-case' => null]]], fn () => ['data' => ['attributes' => ['kebab-case' => null]]]],
    '2x nested StudlyCase' => [fn () => ['data' => ['attributes' => ['StudlyCase' => null]]], fn () => ['data' => ['attributes' => ['studly-case' => null]]]],
    '2x nested Mixed_Case_1' => [fn () => ['data' => ['attributes' => ['Mixed_Case_1' => null]]], fn () => ['data' => ['attributes' => ['mixed-case1' => null]]]],
    '2x nested Mixed-Case_2' => [fn () => ['data' => ['attributes' => ['Mixed-Case_2' => null]]], fn () => ['data' => ['attributes' => ['mixed-case2' => null]]]],
    '3x nested camelCase' => [fn () => ['data' => [['attributes' => ['camelCase' => null]]]], fn () => ['data' => [['attributes' => ['camel-case' => null]]]]],
    '3x nested snake_case' => [fn () => ['data' => [['attributes' => ['snake_case' => null]]]], fn () => ['data' => [['attributes' => ['snake-case' => null]]]]],
    '3x nested kebab-case' => [fn () => ['Data' => [['Attributes' => ['kebab-case' => null]]]], fn () => ['data' => [['attributes' => ['kebab-case' => null]]]]],
    '3x nested StudlyCase' => [fn () => ['data' => [['attributes' => ['StudlyCase' => null]]]], fn () => ['data' => [['attributes' => ['studly-case' => null]]]]],
    '3x nested Mixed_Case_1' => [fn () => ['data' => [['attributes' => ['Mixed_Case_1' => null]]]], fn () => ['data' => [['attributes' => ['mixed-case1' => null]]]]],
    '3x nested Mixed-Case_2' => [fn () => ['data' => [['attributes' => ['Mixed-Case_2' => null]]]], fn () => ['data' => [['attributes' => ['mixed-case2' => null]]]]],
]);

it('returns an array with snake case keys', function (array $from, array $to): void {
    expect(Arr::snakeCaseKeys($from))->toBe($to);
})->with([
    'camelCase' => [fn () => ['camelCase' => null], fn () => ['camel_case' => null]],
    'snake_case' => [fn () => ['snake_case' => null], fn () => ['snake_case' => null]],
    'kebab-case' => [fn () => ['kebab-case' => null], fn () => ['kebab_case' => null]],
    'StudlyCase' => [fn () => ['StudlyCase' => null], fn () => ['studly_case' => null]],
    'Mixed_Case_1' => [fn () => ['Mixed_Case_1' => null], fn () => ['mixed_case1' => null]],
    'Mixed-Case_2' => [fn () => ['Mixed-Case_2' => null], fn () => ['mixed_case2' => null]],
    'nested camelCase' => [fn () => ['data' => ['camelCase' => null]], fn () => ['data' => ['camel_case' => null]]],
    'nested snake_case' => [fn () => ['Data' => ['snake_case' => null]], fn () => ['data' => ['snake_case' => null]]],
    'nested kebab-case' => [fn () => ['data' => ['kebab-case' => null]], fn () => ['data' => ['kebab_case' => null]]],
    'nested StudlyCase' => [fn () => ['data' => ['StudlyCase' => null]], fn () => ['data' => ['studly_case' => null]]],
    'nested Mixed_Case_1' => [fn () => ['data' => ['Mixed_Case_1' => null]], fn () => ['data' => ['mixed_case1' => null]]],
    'nested Mixed-Case_2' => [fn () => ['data' => ['Mixed-Case_2' => null]], fn () => ['data' => ['mixed_case2' => null]]],
    '2x nested camelCase' => [fn () => ['data' => ['attributes' => ['camelCase' => null]]], fn () => ['data' => ['attributes' => ['camel_case' => null]]]],
    '2x nested snake_case' => [fn () => ['Data' => ['Attributes' => ['snake_case' => null]]], fn () => ['data' => ['attributes' => ['snake_case' => null]]]],
    '2x nested kebab-case' => [fn () => ['data' => ['attributes' => ['kebab-case' => null]]], fn () => ['data' => ['attributes' => ['kebab_case' => null]]]],
    '2x nested StudlyCase' => [fn () => ['data' => ['attributes' => ['StudlyCase' => null]]], fn () => ['data' => ['attributes' => ['studly_case' => null]]]],
    '2x nested Mixed_Case_1' => [fn () => ['data' => ['attributes' => ['Mixed_Case_1' => null]]], fn () => ['data' => ['attributes' => ['mixed_case1' => null]]]],
    '2x nested Mixed-Case_2' => [fn () => ['data' => ['attributes' => ['Mixed-Case_2' => null]]], fn () => ['data' => ['attributes' => ['mixed_case2' => null]]]],
    '3x nested camelCase' => [fn () => ['data' => [['attributes' => ['camelCase' => null]]]], fn () => ['data' => [['attributes' => ['camel_case' => null]]]]],
    '3x nested snake_case' => [fn () => ['Data' => [['Attributes' => ['snake_case' => null]]]], fn () => ['data' => [['attributes' => ['snake_case' => null]]]]],
    '3x nested kebab-case' => [fn () => ['data' => [['attributes' => ['kebab-case' => null]]]], fn () => ['data' => [['attributes' => ['kebab_case' => null]]]]],
    '3x nested StudlyCase' => [fn () => ['data' => [['attributes' => ['StudlyCase' => null]]]], fn () => ['data' => [['attributes' => ['studly_case' => null]]]]],
    '3x nested Mixed_Case_1' => [fn () => ['data' => [['attributes' => ['Mixed_Case_1' => null]]]], fn () => ['data' => [['attributes' => ['mixed_case1' => null]]]]],
    '3x nested Mixed-Case_2' => [fn () => ['data' => [['attributes' => ['Mixed-Case_2' => null]]]], fn () => ['data' => [['attributes' => ['mixed_case2' => null]]]]],
]);

it('returns an array with camel case keys', function (array $array, array $result) {
    expect(Arr::camelCaseKeys($array))->toBe($result);
})->with([
    'camelCase' => [fn () => ['camelCase' => null], fn () => ['camelCase' => null]],
    'snake_case' => [fn () => ['snake_case' => null], fn () => ['snakeCase' => null]],
    'kebab-case' => [fn () => ['kebab-case' => null], fn () => ['kebabCase' => null]],
    'StudlyCase' => [fn () => ['StudlyCase' => null], fn () => ['studlyCase' => null]],
    'Mixed_Case_1' => [fn () => ['Mixed_Case_1' => null], fn () => ['mixedCase1' => null]],
    'Mixed-Case_2' => [fn () => ['Mixed-Case_2' => null], fn () => ['mixedCase2' => null]],
    'nested camelCase' => [fn () => ['Data' => ['Attributes' => null]], fn () => ['data' => ['attributes' => null]]],
    'nested snake_case' => [fn () => ['data' => ['attributes' => null]], fn () => ['data' => ['attributes' => null]]],
    'nested kebab-case' => [fn () => ['data' => ['attributes' => null]], fn () => ['data' => ['attributes' => null]]],
    'nested StudlyCase' => [fn () => ['data' => ['attributes' => null]], fn () => ['data' => ['attributes' => null]]],
    'nested Mixed_Case_1' => [fn () => ['data' => ['attributes' => null]], fn () => ['data' => ['attributes' => null]]],
    'nested Mixed-Case_2' => [fn () => ['data' => ['attributes' => null]], fn () => ['data' => ['attributes' => null]]],
    '2x nested camelCase' => [fn () => ['Data' => ['Attributes' => ['camelCase' => null]]], fn () => ['data' => ['attributes' => ['camelCase' => null]]]],
    '2x nested snake_case' => [fn () => ['data' => ['attributes' => ['snake_case' => null]]], fn () => ['data' => ['attributes' => ['snakeCase' => null]]]],
    '2x nested kebab-case' => [fn () => ['data' => ['attributes' => ['kebab-case' => null]]], fn () => ['data' => ['attributes' => ['kebabCase' => null]]]],
    '2x nested StudlyCase' => [fn () => ['data' => ['attributes' => ['StudlyCase' => null]]], fn () => ['data' => ['attributes' => ['studlyCase' => null]]]],
    '2x nested Mixed_Case_1' => [fn () => ['data' => ['attributes' => ['Mixed_Case_1' => null]]], fn () => ['data' => ['attributes' => ['mixedCase1' => null]]]],
    '2x nested Mixed-Case_2' => [fn () => ['data' => ['attributes' => ['Mixed-Case_2' => null]]], fn () => ['data' => ['attributes' => ['mixedCase2' => null]]]],
    '3x nested camelCase' => [fn () => ['Data' => [['attributes' => ['camelCase' => null]]]], fn () => ['data' => [['attributes' => ['camelCase' => null]]]]],
    '3x nested snake_case' => [fn () => ['data' => [['attributes' => ['snake_case' => null]]]], fn () => ['data' => [['attributes' => ['snakeCase' => null]]]]],
    '3x nested kebab-case' => [fn () => ['data' => [['attributes' => ['kebab-case' => null]]]], fn () => ['data' => [['attributes' => ['kebabCase' => null]]]]],
    '3x nested StudlyCase' => [fn () => ['data' => [['attributes' => ['StudlyCase' => null]]]], fn () => ['data' => [['attributes' => ['studlyCase' => null]]]]],
    '3x nested Mixed_Case_1' => [fn () => ['data' => [['attributes' => ['Mixed_Case_1' => null]]]], fn () => ['data' => [['attributes' => ['mixedCase1' => null]]]]],
    '3x nested Mixed-Case_2' => [fn () => ['data' => [['attributes' => ['Mixed-Case_2' => null]]]], fn () => ['data' => [['attributes' => ['mixedCase2' => null]]]]],
]);

it('returns an array with studly case keys', function (array $from, array $to): void {
    expect(Arr::studlyCaseKeys($from))->toBe($to);
})->with([
    'camelCase' => [fn () => ['camelCase' => null], fn () => ['CamelCase' => null]],
    'snake_case' => [fn () => ['snake_case' => null], fn () => ['SnakeCase' => null]],
    'kebab-case' => [fn () => ['kebab-case' => null], fn () => ['KebabCase' => null]],
    'StudlyCase' => [fn () => ['StudlyCase' => null], fn () => ['StudlyCase' => null]],
    'Mixed_Case_1' => [fn () => ['Mixed_Case_1' => null], fn () => ['MixedCase1' => null]],
    'Mixed-Case_2' => [fn () => ['Mixed-Case_2' => null], fn () => ['MixedCase2' => null]],
    'nested camelCase' => [fn () => ['data' => ['camelCase' => null]], fn () => ['Data' => ['CamelCase' => null]]],
    'nested snake_case' => [fn () => ['data' => ['snake_case' => null]], fn () => ['Data' => ['SnakeCase' => null]]],
    'nested kebab-case' => [fn () => ['data' => ['kebab-case' => null]], fn () => ['Data' => ['KebabCase' => null]]],
    'nested StudlyCase' => [fn () => ['Data' => ['StudlyCase' => null]], fn () => ['Data' => ['StudlyCase' => null]]],
    'nested Mixed_Case_1' => [fn () => ['data' => ['Mixed_Case_1' => null]], fn () => ['Data' => ['MixedCase1' => null]]],
    'nested Mixed-Case_2' => [fn () => ['data' => ['Mixed-Case_2' => null]], fn () => ['Data' => ['MixedCase2' => null]]],
    '2x nested camelCase' => [fn () => ['data' => ['attributes' => ['camelCase' => null]]], fn () => ['Data' => ['Attributes' => ['CamelCase' => null]]]],
    '2x nested snake_case' => [fn () => ['data' => ['attributes' => ['snake_case' => null]]], fn () => ['Data' => ['Attributes' => ['SnakeCase' => null]]]],
    '2x nested kebab-case' => [fn () => ['data' => ['attributes' => ['kebab-case' => null]]], fn () => ['Data' => ['Attributes' => ['KebabCase' => null]]]],
    '2x nested StudlyCase' => [fn () => ['Data' => ['Attributes' => ['StudlyCase' => null]]], fn () => ['Data' => ['Attributes' => ['StudlyCase' => null]]]],
    '2x nested Mixed_Case_1' => [fn () => ['data' => ['attributes' => ['Mixed_Case_1' => null]]], fn () => ['Data' => ['Attributes' => ['MixedCase1' => null]]]],
    '2x nested Mixed-Case_2' => [fn () => ['data' => ['attributes' => ['Mixed-Case_2' => null]]], fn () => ['Data' => ['Attributes' => ['MixedCase2' => null]]]],
    '3x nested camelCase' => [fn () => ['data' => [['attributes' => ['camelCase' => null]]]], fn () => ['Data' => [['Attributes' => ['CamelCase' => null]]]]],
    '3x nested snake_case' => [fn () => ['data' => [['attributes' => ['snake_case' => null]]]], fn () => ['Data' => [['Attributes' => ['SnakeCase' => null]]]]],
    '3x nested kebab-case' => [fn () => ['data' => [['attributes' => ['kebab-case' => null]]]], fn () => ['Data' => [['Attributes' => ['KebabCase' => null]]]]],
    '3x nested StudlyCase' => [fn () => ['Data' => [['Attributes' => ['StudlyCase' => null]]]], fn () => ['Data' => [['Attributes' => ['StudlyCase' => null]]]]],
    '3x nested Mixed_Case_1' => [fn () => ['data' => [['attributes' => ['Mixed_Case_1' => null]]]], fn () => ['Data' => [['Attributes' => ['MixedCase1' => null]]]]],
    '3x nested Mixed-Case_2' => [fn () => ['data' => [['attributes' => ['Mixed-Case_2' => null]]]], fn () => ['Data' => [['Attributes' => ['MixedCase2' => null]]]]],
]);
