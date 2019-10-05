<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Asset;
use Faker\Generator as Faker;

$factory->define(Asset::class, function (Faker $faker) {
    return [
        'title' => $faker->text(28),
        'category_id' => $faker->numberBetween(0, Asset::CATEGORY_MAX - 1),
        'cost' => $faker->randomElement([
            'MIT',
            'GPL-3.0-or-later',
            'MPL-2.0',
            'CC-BY-SA-4.0',
        ]),
        'godot_version' => $faker->regexify('3\.[0-2]'),
        'support_level_id' => $faker->numberBetween(0, Asset::SUPPORT_LEVEL_MAX - 1),
        'description' => $faker->text(500),
        'browse_url' => 'https://github.com/user/asset',
        'download_url' => 'https://github.com/user/asset/archive/master.zip',
    ];
});
