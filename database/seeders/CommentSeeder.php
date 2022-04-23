<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CommentSeeder extends Seeder
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
        Comment::truncate();
        DB::beginTransaction();

        $posts = Post::all();

        for($i = 0; $i < $posts->count(); $i++){
            $comments = [];
            for($j = 0; $j < 10; $j++){
                $comments[] = [
                    'text' => $faker->sentence(),
                    'post_id' => $posts[$i]->id
                ];
            }
            Comment::insert($comments);
        }

        DB::commit();
    }
}
