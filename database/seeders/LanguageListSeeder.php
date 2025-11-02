<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'English', 'slug' => 'en'],
            ['name' => 'Español', 'slug' => 'es'],
        ];

        foreach ($languages as $lang) {
            DB::table('language_list')->updateOrInsert(
                ['slug' => $lang['slug']], // unique key
                ['name' => $lang['name']]
            );
        }

        $this->command->info('✅ Language list seeded successfully.');
    }
}
