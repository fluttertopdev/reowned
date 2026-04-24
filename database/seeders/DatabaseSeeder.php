<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
   {
      $this->call(BannerSeeder::class);
      $this->call(CMSSeeder::class);
      $this->call(LanguageCodesSeeder::class);
      $this->call(LanguagesSeeder::class);
      $this->call(SettingsSeeder::class);
      $this->call(TranslationAdminSeeder::class);
      $this->call(TranslationAdminArabicSeeder::class);
      $this->call(TranslationWebsiteSeeder::class);
      $this->call(TranslationWebsiteArabicSeeder::class);
      $this->call(RoleHasPermissionSeeder::class);
      $this->call(UserSeeder::class);
   }
}
