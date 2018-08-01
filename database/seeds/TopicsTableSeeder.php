<?php

use App\Models\Categories;
use App\Models\Topics;
use App\Models\User;
use Faker\Generator;
use Illuminate\Database\Seeder;

class TopicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds     = User::all()->pluck('id')->toArray();
        $categoryIds = Categories::all()->pluck('id')->toArray();
        $faker       = app(Generator::class);

        $factory = factory(Topics::class)
            ->times(100)
            ->make()
            ->each(function ($topic, $index) use ($faker, $userIds, $categoryIds) {
                $topic->user_id = $faker->randomElement($userIds);
                $topic->category_id = $faker->randomElement($categoryIds);
            });
        $array = $factory->toArray();

        Topics::insert($array);
    }
}
