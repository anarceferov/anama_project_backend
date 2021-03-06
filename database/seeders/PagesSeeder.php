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
            'Agency',
            'Activity',
            'Legislation',
            'Projects',
            'Multimedia',
            'Contacts'
        ];

        // $tests = array_combine($pagesEn, $pagesAz);

        foreach ($pagesEn as $k) {
            $page = new Page;
            $page->key = Str::slug($k);
            $page->is_active = 1;
            $page->save();
        }
        // PageLocales az dilinde 
        $a = 0;
        foreach ($pagesAz as $pageAz) {
            $a++;
            $page = new PageLocale;
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
            $page = new PageLocale;
            $page->id = Str::uuid();
            $page->page_id = $b;
            $page->name = $pageEn;
            $page->local = 'en';
            $page->save();
        }

        // SubPages create  Agentlik
        $en1 = [
            'About us',
            'Management',
            'Structure',
            'Public Council'
        ];

        foreach ($en1 as $en) {
            $sub = new SubPage;
            $sub->key = str::slug($en);
            $sub->is_active = 1;
            $sub->page_id = 1;
            $sub->save();
        }

        // SubPages create  Fəaliyyət
        $en2 = [
            'Operations',
            'Monitoring and quality control',
            'Imsma',
            'Enlightenment works'
        ];

        foreach ($en2 as $en) {
            $sub = new SubPage;
            $sub->key = str::slug($en);
            $sub->is_active = 1;
            $sub->page_id = 2;
            $sub->save();
        }

        // SubPages create  Qanunvericilik
        $en3 = [
            'Charter',
            'Law',
            'National standards'
        ];

        foreach ($en3 as $en) {
            $sub = new SubPage;
            $sub->key = str::slug($en);
            $sub->is_active = 1;
            $sub->page_id = 3;
            $sub->save();
        }

        // SubPages create  Layihələr
        $en4 = [
            'Karabakh',
            'Implemented projects'
        ];

        foreach ($en4 as $en) {
            $sub = new SubPage;
            $sub->key = str::slug($en);
            $sub->is_active = 1;
            $sub->page_id = 4;
            $sub->save();
        }

        // SubPages create  Multimedia
        $en5 = [
            'News',
            'Press Release',
            'Photo / Video'
        ];

        foreach ($en5 as $en) {
            $sub = new SubPage;
            $sub->key = str::slug($en);
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
