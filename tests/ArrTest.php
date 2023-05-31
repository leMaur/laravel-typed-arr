<?php

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Lemaur\LaravelTypedArr\Tests\Fixtures\TestEnum;

it('returns a string type', function () {
    $input = ['string' => 'string value'];

    expect(Arr::string($input, 'string'))
        ->toBeInstanceOf(\Illuminate\Support\Stringable::class)
        ->and(Arr::string($input, 'string')->toString())
        ->toBe('string value');
});

it('returns a boolean type', function () {
    $input = ['boolean' => true];

    expect(Arr::boolean($input, 'boolean'))
        ->toBeBool()->toBeTrue();
});

it('returns an integer type', function () {
    $input = ['integer' => 123];

    expect(Arr::integer($input, 'integer'))
        ->toBeInt()->toBe(123);
});

it('returns a float type', function () {
    $input = ['float' => 1.23];

    expect(Arr::float($input, 'float'))
        ->toBeFloat()->toBe(1.23);
});

it('returns a date type', function () {
    $input = ['date' => '2023-01-01 01:00:00'];

    expect(Arr::date($input, 'date'))
        ->toBeInstanceOf(Carbon::class)
        ->format('Y-m-d H:i:s')
        ->toBe('2023-01-01 01:00:00');
});

it('returns an enum type', function () {
    $input = ['enum' => 'one'];

    expect(Arr::enum($input, 'enum', TestEnum::class))
        ->toBeInstanceOf(TestEnum::class)
        ->toBe(TestEnum::ONE);
});
