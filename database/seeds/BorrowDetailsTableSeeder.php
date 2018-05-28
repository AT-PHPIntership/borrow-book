<?php

use Illuminate\Database\Seeder;

class BorrowDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        for ($i = 1; $i <= 20; $i++) {

            factory(App\Models\BorrowDetail::class)->create([
                'borrow_id' => $i
            ]);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
