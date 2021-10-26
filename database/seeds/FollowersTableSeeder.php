<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::all();
        $user =$user->first();
        //一号用户的id
        $user_id =$user->id;
        //获取去除掉Id为1的所有用户ID数组
        $followers = $user->slice(1);
        $follower_ids = $followers->pluck('id')->toArray();
        //关注除了1好用户以外的所有用户
        $user->follow($follower_ids);
        //除了1号用户以外的所有用户都来关注1好用户
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
