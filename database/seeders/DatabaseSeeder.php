<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
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
      Artisan::call('permissions:generate');
      $this->call(RoleHasPermissionSeeder::class);
      $this->call(UserSeeder::class);
   }
}
