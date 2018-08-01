<?php

use Illuminate\Database\Seeder;
use Faker\Generator;
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
            'http://pbuht5kwp.bkt.clouddn.com/128%20%289%29.jpg',
            'http://pbuht5kwp.bkt.clouddn.com/128.jpg',
            'http://pbuht5kwp.bkt.clouddn.com/128%20%2810%29.jpg',
            'http://pbuht5kwp.bkt.clouddn.com/128%20%288%29.jpg',
            'http://pbuht5kwp.bkt.clouddn.com/128%20%287%29.jpg',
            'http://pbuht5kwp.bkt.clouddn.com/128%20%286%29.jpg',
            'http://pbuht5kwp.bkt.clouddn.com/128%20%285%29.jpg',
            'http://pbuht5kwp.bkt.clouddn.com/128%20%284%29.jpg',
            'http://pbuht5kwp.bkt.clouddn.com/128%20%283%29.jpg',
            'http://pbuht5kwp.bkt.clouddn.com/128%20%282%29.jpg',
            'http://pbuht5kwp.bkt.clouddn.com/128%20%281%29.jpg',
            'http://pbuht5kwp.bkt.clouddn.com/128%20%2811%29.jpg',
        ];
        
        $factory = factory(User::class)
            ->times(11)
            ->make()
            ->each(function ($user, $index) use ($faker, $avatars) {
                $user->avatar = $faker->randomElement($avatars);
            });
        $array = $factory->makeVisible(['password', 'remember_token'])->toArray();
        
        User::insert($array);
        $user = User::find(1);
        $user->name = 'xiang.gao';
        $user->email = '4008353@qq.com';
        $user->avatar = 'http://pbfa6u6aq.bkt.clouddn.com/image/user/avatar/Ji3ohCho5Quov5UL.jpg';
        $user->save();
    }
}
