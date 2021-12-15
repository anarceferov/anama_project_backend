<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageLocale;
use App\Models\SubPage;
use App\Models\SubPageLocale;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class PagesSeeder extends Seeder
{

    public function run()
    {
        $pagesAz = [
            'Agentlik',
            'Fəaliyyət',
            'Qanunvericilik',
            'Layihələr',
            'Multimedia',
            'Əlaqə'
        ];

        $pagesEn = [
            'Agentlik_en',
            'Fəaliyyət_en',
            'Qanunvericilik_en',
            'Layihələr_en',
            'Multimedia_en',
            'Əlaqə_en'
        ];
        // Page creat
        for ($i = 0; $i < count($pagesAz); $i++) {
            $page = new Page();
            $page->key = 'boom';
            $page->is_active = 1;
            $page->save();
        }
        // PageLocales az dilinde 
        $a = 0;
        foreach ($pagesAz as $pageAz) {
            $a++;
            $page = new PageLocale();
            $page->id = Str::uuid();
            $page->page_id = $a;
            $page->name = $pageAz;
            $page->local = 'az';
            $page->save();
        }
        // PageLocales en dilinde 
        $b = 0;
        foreach ($pagesEn as $pageEn) {
            $b++;
            $page = new PageLocale();
            $page->id = Str::uuid();
            $page->page_id = $b;
            $page->name = $pageEn;
            $page->local = 'en';
            $page->save();
        }

        // SubPages create  Agentlik
        for ($i = 0; $i < 4; $i++) {
            $a++;
            $sub = new SubPage;
            $sub->key = 'key';
            $sub->is_active = 1;
            $sub->page_id = 1;
            $sub->save();
        }

        // SubPages create  Fəaliyyət

        for ($i = 0; $i < 4; $i++) {
            $sub = new SubPage;
            $sub->key = 'key';
            $sub->is_active = 1;
            $sub->page_id = 2;
            $sub->save();
        }

        // SubPages create  Qanunvericilik

        for ($i = 0; $i < 3; $i++) {
            $sub = new SubPage;
            $sub->key = 'key';
            $sub->is_active = 1;
            $sub->page_id = 3;
            $sub->save();
        }

        // SubPages create  Layihələr

        for ($i = 0; $i < 2; $i++) {
            $sub = new SubPage;
            $sub->key = 'key';
            $sub->is_active = 1;
            $sub->page_id = 4;
            $sub->save();
        }

        // SubPages create  Multimedia

        for ($i = 0; $i < 3; $i++) {
            $sub = new SubPage;
            $sub->key = 'key';
            $sub->is_active = 1;
            $sub->page_id = 5;
            $sub->save();
        }

        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //  SubPage Locales // Agentlik


        $az1 = [
            'Haqqımızda',
            'Rəhbərlik',
            'Struktur',
            'İctimai Şura'
        ];

        $en1 = [
            'Haqqımızda_en',
            'Rəhbərlik_en',
            'Struktur_en',
            'İctimai Şura_en'
        ];

        $a = 0;
        foreach ($az1 as $az) {
            $a++;
            $subL = new SubPageLocale;
            $subL->sub_page_id = $a;
            $subL->name = $az;
            $subL->local = 'az';
            $subL->save();
        }

        $a = 0;
        foreach ($en1 as $en) {
            $a++;
            $subL = new SubPageLocale;
            $subL->sub_page_id = $a;
            $subL->name = $en;
            $subL->local = 'en';
            $subL->save();
        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        //  SubPage Locales // Fəaliyyət

        $az2 = [
            'Əməliyyatlar',
            'Monitorinq və Keyfiyyətə nəzarət',
            'İMSMA',
            'Maarifləndirmə İşləri'
        ];

        $en2 = [
            'Əməliyyatlar_en',
            'Monitorinq və Keyfiyyətə nəzarət_en',
            'İMSMA_en',
            'Maarifləndirmə İşləri_en'
        ];

        $a = 4;
        foreach ($az2 as $az) {
            $a++;
            $subL = new SubPageLocale;
            $subL->sub_page_id = $a;
            $subL->name = $az;
            $subL->local = 'az';
            $subL->save();
        }

        $a = 4;
        foreach ($en2 as $en) {
            $a++;
            $subL = new SubPageLocale;
            $subL->sub_page_id = $a;
            $subL->name = $en;
            $subL->local = 'en';
            $subL->save();
        }


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        //  SubPage Locales // Qanunvericilik

        $az3 = [
            'Nizamnamə',
            'Qanun',
            'Milli standartlar'
        ];

        $en3 = [
            'Nizamnamə_en',
            'Qanun_en',
            'Milli standartlar_en'
        ];

        $a = 8;
        foreach ($az3 as $az) {
            $a++;
            $subL = new SubPageLocale;
            $subL->sub_page_id = $a;
            $subL->name = $az;
            $subL->local = 'az';
            $subL->save();
        }

        $a = 8;
        foreach ($en3 as $en) {
            $a++;
            $subL = new SubPageLocale;
            $subL->sub_page_id = $a;
            $subL->name = $en;
            $subL->local = 'en';
            $subL->save();
        }


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        //  SubPage Locales // Layihələr

        $az4 = [
            'Qarabağ',
            'İcra olunan layihələr'
        ];

        $en4 = [
            'Qarabağ_en',
            'İcra olunan layihələr_en'
        ];


        $a = 11;
        foreach ($az4 as $az) {
            $a++;
            $subL = new SubPageLocale;
            $subL->sub_page_id = $a;
            $subL->name = $az;
            $subL->local = 'az';
            $subL->save();
        }

        $a = 11;
        foreach ($en4 as $en) {
            $a++;
            $subL = new SubPageLocale;
            $subL->sub_page_id = $a;
            $subL->name = $en;
            $subL->local = 'en';
            $subL->save();
        }


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        //  SubPage Locales // Multimedia

        $az5 = [
            'Xəbərlər',
            'Press - Relizləər',
            'Foto/Video'
        ];

        $en5 = [
            'Xəbərlər_en',
            'Press - Relizləər_en',
            'Foto/Video_en'
        ];


        $a = 13;
        foreach ($az5 as $az) {
            $a++;
            $subL = new SubPageLocale;
            $subL->sub_page_id = $a;
            $subL->name = $az;
            $subL->local = 'az';
            $subL->save();
        }

        $a = 13;
        foreach ($en5 as $en) {
            $a++;
            $subL = new SubPageLocale;
            $subL->sub_page_id = $a;
            $subL->name = $en;
            $subL->local = 'en';
            $subL->save();
        }
    }
}
