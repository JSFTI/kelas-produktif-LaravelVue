<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        $faker = Factory::create();

        Schema::disableForeignKeyConstraints();
        Post::truncate();
        DB::beginTransaction();

        $writer = User::where('username', 'admin')->first();

        $posts = [];
        for($i = 0; $i < 40; $i++){
            $posts[] = [
                'title' => $faker->sentence(),
                'image' => $faker->imageUrl(640, 480, 'blogs', true),
                'content' => $faker->text(400),
                'slug' => $faker->sentence(),
                'shares' => $faker->numberBetween(0, 100),
                'user_id' => $writer->id
            ];
        }

        Post::insert($posts);
        DB::commit();
    }
}
