<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{

    public function run()
    {
        $pages = [
                'Agentlik menusu',
                'Haqqımızda',
                'Rəhbərlik',
                'Struktur',
                'İctimai Şura',
                'Fəaliyyət menusu:',
                'Əməliyyatlar',
                'Monitorinq və Keyfiyyətə nəzarət',
                'İMSMA',
                'Maarifləndirmə  İşləri',
                'Qanunvericilik:',
                'Nizamnamə',
                'Qanun',
                'Milli standartlar',
                'Layihələr:',
                'Qarabağ',
                'İcra olunan layihələr',
                'Multimedia:',
                'Xəbərlər',
                'Press - Relizləər',
                'Foto/Video',
                'Əlaqə'
        ];


        foreach($pages as $page) 
        {
            Page::create([
                'name' => $page,
                // 'name_en' =>'EN--'.$page,
                'is_active'=> 1
            ]);
        }

    }
}