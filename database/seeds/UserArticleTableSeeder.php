<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Article;

class UserArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 3)
            ->create()
            ->each(function (User $user) {
                collect(range(1, 5))->each(function () use ($user) {
                    $user->hasManyArticles()->save(factory(Article::class)->make());
                });
            });
    }
}
