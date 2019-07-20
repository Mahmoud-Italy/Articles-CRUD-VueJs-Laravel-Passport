<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Article;
use Faker\Generator as Faker;

$autoIncrement = autoIncrement();
$factory->define(Article::class, function (Faker $faker) use ($autoIncrement) {
	$autoIncrement->next();
    return [
    	'user_id' => 1,
    	'image' => 'uploads/articles/faker-'.$autoIncrement->current().'.jpg',
        'title' => $faker->text(50),
        'body'  => $faker->text(500)
    ];
});

function autoIncrement()
{
    for ($i = 0; $i <= 10; $i++) {
        yield $i;
    }
}
