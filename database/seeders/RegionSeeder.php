<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use App\Models\RegionLocale;
use Illuminate\Support\Str;

class RegionSeeder extends Seeder
{

    public function run()
    {
        $azLanguages = [
            "aghdam" => "Ağdam",
            "fuzuli" => "Füzuli",
            "lachin" => "Laçın",
            "shusha" => "Şuşa",
            "tartar" => "Tərtər",
            "khojali" => "Xocalı",
            "qubadli" => "Qubadlı",
            "jabrayil" => "Cəbrayıl",
            "zengilan" => "Zəngilan",
            "kalbadjar" => "Kəlbəcər",
            "khankandi" => "Xankəndi",
            "xochavend" => "Xocavənd"
        ];

        $enLanguages = [
            "aghdam" => "Agdam",
            "fuzuli" => "Fuzuli",
            "lachin" => "Lachin",
            "shusha" => "Shusha",
            "tartar" => "Tartar",
            "khojali" => "Khojaly",
            "qubadli" => "Qubadli",
            "jabrayil" => "Jabrayil",
            "zengilan" => "Zangilan",
            "kalbadjar" => "Kalbajar",
            "khankandi" => "Khankendi",
            "xochavend" => "Khojavend"
        ];

        $azL = [];
        foreach ($azLanguages as $key => $az) {
            array_push($azL, $az);
        }


        $enL = [];
        foreach ($enLanguages as $key => $en) {
            array_push($enL, $en);
        }


        // $languages = array_merge($azL, $enL);


        for ($i = 0; $i < 12; $i++) {
            $region = new Region;
            $region->save();
        }


        $b = 0;
        foreach ($azL as $key => $az) {
            $b++;
            RegionLocale::insert([
                'id' => Str::uuid(),
                'local' => 'az',
                'region_id' => $b,
                'name' => $az,
            ]);
        }

        $a = 0;
        foreach ($enL as $key => $en) {
            $a++;
            RegionLocale::insert([
                'id' => Str::uuid(),
                'local' => 'en',
                'region_id' => $a,
                'name' => $en,
            ]);
        }
    }
}
