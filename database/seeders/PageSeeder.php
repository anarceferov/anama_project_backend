<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageLocale;
use App\Models\SubPage;
use App\Models\SubPageLocale;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{

    public function run()
    {
        // $page = [
        //     'Agentlik menusu',
        //     'Fəaliyyət menusu:',
        //     'Qanunvericilik:',
        //     'Layihələr:',
        //     'Multimedia:',
        //     'Əlaqə'
        // ];

        // $subPages = [
        //     'Haqqımızda',
        //     'Rəhbərlik',
        //     'Struktur',
        //     'İctimai Şura',
        //     'Əməliyyatlar',
        //     'Monitorinq və Keyfiyyətə nəzarət',
        //     'İMSMA',
        //     'Maarifləndirmə İşləri',
        //     'Nizamnamə',
        //     'Qanun',
        //     'Milli standartlar',
        //     'Qarabağ',
        //     'İcra olunan layihələr',
        //     'Xəbərlər',
        //     'Press - Relizləər',
        //     'Foto/Video',
        // ];


        // $pages = [
        //     'Agentlik menusu' => [
        //         'Haqqımızda',
        //         'Rəhbərlik',
        //         'Struktur',
        //         'İctimai Şura'
        //     ],

        //     'Fəaliyyət menusu' => [
        //         'Əməliyyatlar',
        //         'Monitorinq və Keyfiyyətə nəzarət',
        //         'İMSMA',
        //         'Maarifləndirmə İşləri'
        //     ],

        //     'Qanunvericilik' => [
        //         'Nizamnamə',
        //         'Qanun',
        //         'Milli standartlar'
        //     ],

        //     'Layihələr' => [
        //         'Qarabağ',
        //         'İcra olunan layihələr'
        //     ],

        //     'Multimedia' => [
        //         'Xəbərlər',
        //         'Press - Relizləər',
        //         'Foto/Video'
        //     ],

        //     'Əlaqə' => []
        // ];

        // foreach ($pages as $key => $pageL) {
        //     $page = new Page;
        //     $page->key = 'boom';
        //     $page->is_active = 1;
        //     $page->save();

        //     $pageL = new PageLocale;
        //     $pageL->id = Str::uuid();
        //     $pageL->page_id = $page->id;
        //     $pageL->name = $key;
        //     $pageL->local = 'az';
        //     $pageL->save();
        // }



        // $enL = [
        //     'Agentlik menusu_EN',
        //     'Fəaliyyət menusu_EN',
        //     'Qanunvericilik_en',
        //     'Layihələr_en',
        //     'Multimedia_en',
        //     'Əlaqə_en'
        // ];

        // $i = 1;
        // foreach ($enL as $key => $en) {
        //     $pageL = new PageLocale;
        //     $pageL->id = Str::uuid();
        //     $pageL->page_id = $i;
        //     $pageL->name = $en;
        //     $pageL->local = 'en';
        //     $pageL->save();
        //     $i++;
        // }


        // $a = 0;
        // foreach($subPages as $page){
        //     $a++;
        //     $sub = new SubPage;
        //     $sub->key = 'key';
        //     $sub->is_active = 1;
        //     $sub->page_id = $a;
        //     $sub->save();
        // }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // $array1 = [
        //     'Haqqımızda',
        //     'Rəhbərlik',
        //     'Struktur',
        //     'İctimai Şura'
        // ];

        // $array1e = [
        //     'Haqqımızda_en',
        //     'Rəhbərlik_en',
        //     'Struktur_en',
        //     'İctimai Şura_en'
        // ];

        // $a = 1;
        // foreach ($array1 as $arr) {
        //     $sub = new SubPage;
        //     $sub->key = 'key';
        //     $sub->is_active = 1;
        //     $sub->page_id = 1;
        //     $sub->save();

        //     $subL = new SubPageLocale;
        //     $subL->sub_page_id = $a;
        //     $subL->name = $arr;
        //     $subL->local = 'az';
        //     $subL->save();
        //     $a++;
        // }

        // $a2 = 0;
        // foreach ($array1e as $arr) {
        //     $a2++;
        //     $subL = new SubPageLocale;
        //     $subL->sub_page_id = $a2;
        //     $subL->name = $arr;
        //     $subL->local = 'en';
        //     $subL->save();
        // }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        // $array2 = [
        //     'Əməliyyatlar',
        //     'Monitorinq və Keyfiyyətə nəzarət',
        //     'İMSMA',
        //     'Maarifləndirmə İşləri'
        // ];

        // $array2e = [
        //     'Əməliyyatlar_en',
        //     'Monitorinq və Keyfiyyətə nəzarət_en',
        //     'İMSMA_en',
        //     'Maarifləndirmə İşləri_en'
        // ];

        // $b = 1;
        // foreach ($array2 as $arr) {
        //     $sub = new SubPage;
        //     $sub->key = 'key';
        //     $sub->is_active = 1;
        //     $sub->page_id = 2;
        //     $sub->save();

        //     $subL = new SubPageLocale;
        //     $subL->sub_page_id = $b;
        //     $subL->name = $arr;
        //     $subL->local = 'az';
        //     $subL->save();
        //     $b++;
        // }

        // $a3 = 5;
        // foreach ($array2e as $arr) {
        //     $subL = new SubPageLocale;
        //     $subL->sub_page_id = $a3;
        //     $subL->name = $arr;
        //     $subL->local = 'en';
        //     $subL->save();
        //     $a3++;
        // }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // $array3 = [
        //     'Nizamnamə',
        //     'Qanun',
        //     'Milli standartlar'
        // ];

        // $array3e = [
        //     'Nizamnamə_en',
        //     'Qanun_en',
        //     'Milli standartlar_en'
        // ];

        // $c = 1;
        // foreach ($array3 as $arr) {
        //     $sub = new SubPage;
        //     $sub->key = 'key';
        //     $sub->is_active = 1;
        //     $sub->page_id = 3;
        //     $sub->save();

        //     $subL = new SubPageLocale;
        //     $subL->sub_page_id = $c;
        //     $subL->name = $arr;
        //     $subL->local = 'az';
        //     $subL->save();
        //     $c++;
        // }

        // $a4 = 9;
        // foreach ($array3e as $arr) {
        //     $subL = new SubPageLocale;
        //     $subL->sub_page_id = $a4;
        //     $subL->name = $arr;
        //     $subL->local = 'en';
        //     $subL->save();
        //     $a4++;
        // }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        // $array4 = [
        //     'Qarabağ',
        //     'İcra olunan layihələr'
        // ];

        // $array4e = [
        //     'Qarabağ_en',
        //     'İcra olunan layihələr_en'
        // ];

        // $d = 1;
        // foreach ($array4 as $arr) {
        //     $sub = new SubPage;
        //     $sub->key = 'key';
        //     $sub->is_active = 1;
        //     $sub->page_id = 4;
        //     $sub->save();

        //     $subL = new SubPageLocale;
        //     $subL->sub_page_id = $d;
        //     $subL->name = $arr;
        //     $subL->local = 'az';
        //     $subL->save();
        //     $d++;
        // }


        // $a5 = 12;
        // foreach ($array4e as $arr) {
        //     $subL = new SubPageLocale;
        //     $subL->sub_page_id = $a5;
        //     $subL->name = $arr;
        //     $subL->local = 'en';
        //     $subL->save();
        //     $a5++;
        // }

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        // $array5 = [
        //     'Xəbərlər',
        //     'Press - Relizləər',
        //     'Foto/Video'
        // ];

        // $array5e = [
        //     'Xəbərlər_en',
        //     'Press - Relizləər_en',
        //     'Foto/Video_en'
        // ];
        // $e = 1;
        // foreach ($array5 as $arr) {
        //     $sub = new SubPage;
        //     $sub->key = 'key';
        //     $sub->is_active = 1;
        //     $sub->page_id = 5;
        //     $sub->save();

        //     $subL = new SubPageLocale;
        //     $subL->sub_page_id = $e;
        //     $subL->name = $arr;
        //     $subL->local = 'az';
        //     $subL->save();
        //     $e++;
        // }

        // $a6 = 14;
        // foreach ($array5e as $arr) {
        //     $subL = new SubPageLocale;
        //     $subL->sub_page_id = $a6;
        //     $subL->name = $arr;
        //     $subL->local = 'en';
        //     $subL->save();
        //     $a6++;
        // }



        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

















    }
}
