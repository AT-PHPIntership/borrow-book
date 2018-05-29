<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\Models\User::class, 10)->create();
        factory(App\Models\Category::class, 10)->create();
        factory(App\Models\Book::class, 10)->create();
        factory(App\Models\ImageBook::class, 10)->create();
        factory(App\Models\Post::class, 10)->create();
        factory(App\Models\Favorite::class, 10)->create();
        factory(App\Models\Rating::class, 10)->create();
        factory(App\Models\Borrow::class, 20)->create();
        $this->call(BorrowDetailsTableSeeder::class);
    }
}
