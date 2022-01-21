<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{

    public function run()
    {
        Comment::create([
            'body'=>' comment here from a simple user',
            'user_id'=>1,
            'post_id'=>1,
        ]);
        Comment::create([
            'body'=>' comment here from a simple user',
            'user_id'=>1,
            'post_id'=>2,
        ]);
        Comment::create([
            'body'=>' comment on post 1 ',
            'user_id'=>1,
            'post_id'=>3,
        ]);
    }
}
