<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = app(Generator::class);
        $avatars = [
            
        ];
        
        $factory = factory(User::class)
            ->times(15)
            ->make()
            ->each(function ($user, $index) use ($faker, $avatars) {
                $user->avatar = $faker->randomElement($avatars);
            });
        
        $array = $factory->makeVisible(['password', 'remember_token'])->toArray();
        
        User::insert($array);
    }
}
