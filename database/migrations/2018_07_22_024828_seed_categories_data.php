<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name' => '分享',
                'description' => '悲伤可以自行料理；而欢乐的滋味如果要充分体会，你就必须有人分享才行。',
            ],
            [
                'name' => '教程',
                'description' => '在寻求真理的长河中，唯有学习，不断地学习，勤奋地学习，有创造性地学习，才能越重山跨峻岭。',
            ],
            [
                'name' => '对话',
                'description' => '与人交谈一次，往往比多年闭门劳作更能启发心智。思想必定是在与人交往中产生，而在孤独中进行加工和表达。',
            ],
            [
                'name' => '公告',
                'description' => '我们不应该像蚂蚁，单只收集；也不可像蜘蛛，只从自己肚中抽丝；而应该像蜜蜂，既采集又整理，这样才能酿出香甜蜂蜜来。',
            ],
        ];

        $date_time = date('Y-m-d H:i:s');
        $categories = array_map(function ($value) use ($date_time) {
            $value['created_at'] = $date_time;
            $value['updated_at'] = $date_time;

            return $value;
        }, $categories);

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('categories')->truncate();
    }
}
