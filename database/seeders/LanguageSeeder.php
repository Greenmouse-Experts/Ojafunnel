<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    const LanguagesJSON = __DIR__.'/languages.json';
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $createLanguage = [
            [
               "uid" => "ar_AR",
               "code" => "ar",
               "region_code" => "ar_AR",
               "name" => "Arabic",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "az_AZ",
               "code" => "az",
               "region_code" => "az_AZ",
               "name" => "Azerbaijan",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "da_DK",
               "code" => "da",
               "region_code" => "da_DK",
               "name" => "Danish",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "de_DE",
               "code" => "de",
               "region_code" => "de_DE",
               "name" => "German",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "el_GR",
               "code" => "el",
               "region_code" => "el_GR",
               "name" => "Greek",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "en_US",
               "code" => "en",
               "region_code" => "en_US",
               "name" => "English",
               "status" => "active",
               "is_default" => 1,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "es_ES",
               "code" => "es",
               "region_code" => "es_ES",
               "name" => "Spanish",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "fa_IR",
               "code" => "fa",
               "region_code" => "fa_IR",
               "name" => "Persian",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "fr_FR",
               "code" => "fr",
               "region_code" => "fr_FR",
               "name" => "French",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "he_IL",
               "code" => "he",
               "region_code" => "he_IL",
               "name" => "Hebrew",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "id_ID",
               "code" => "id",
               "region_code" => "id_ID",
               "name" => "Indonesian",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "it_IT",
               "code" => "it",
               "region_code" => "it_IT",
               "name" => "Italian",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "ja-JP",
               "code" => "ja",
               "region_code" => "ja-JP",
               "name" => "Japanese",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "nl_NL",
               "code" => "nl",
               "region_code" => "nl_NL",
               "name" => "Dutch",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "no_NO",
               "code" => "no",
               "region_code" => "no_NO",
               "name" => "Norwegian",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "pt_BR",
               "code" => "pt_BR",
               "region_code" => "pt_BR",
               "name" => "Brazilian Portuguese",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "ru-RU",
               "code" => "ru",
               "region_code" => "ru-RU",
               "name" => "Russian",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "sv_SE",
               "code" => "sv",
               "region_code" => "sv_SE",
               "name" => "Swedish",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "th_TH",
               "code" => "th",
               "region_code" => "th_TH",
               "name" => "Thai",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "tr_TR",
               "code" => "tr",
               "region_code" => "tr_TR",
               "name" => "Turkish",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "uk-UA",
               "code" => "uk",
               "region_code" => "uk-UA",
               "name" => "Ukrainian",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ],
            [
               "uid" => "zh-CN",
               "code" => "zh",
               "region_code" => "zh-CN",
               "name" => "Chinese",
               "status" => "active",
               "is_default" => 0,
               "created_at" => now(),
               "updated_at" => now()
            ]
        ];

        Language::insert($createLanguage);
    }
}
