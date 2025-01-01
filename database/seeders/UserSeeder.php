<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogUser;
use App\Models\User;
use App\Models\Blog as Blogs;

use function Pest\Laravel\seed;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create()->each(function ($user) {
            srand(time());
            $count = rand(1, 10);
            Blogs::factory($count)->create(['author_id' => $user->id]);
            BlogUser::factory()->create(['user_id' => $user->id]);
        });
    }
}
