<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use App\Models\RegionLocale;

class RegionSeeder extends Seeder
{

    public function run()
    {
        $azLanguages = [
            "baku" => "Bakı", "qakh" => "Qax", "aghsu" => "Ağsu", "babak" => "Babək", "barda" => "Bərdə", "khizi" => "Xızı",
            "khuba" => "Quba", "kusar" => "Qusar", "lerik" => "Lerik", "oghuz" => "Oğuz", "sheki" => "Şəki", "tovuz" => "Tovuz",
            "udjar" => "Ucar", "agdash" => "Ağdaş", "aghdam" => "Ağdam", "astara" => "Astara", "djulfa" => "Culfa", "fuzuli" => "Füzuli",
            "gandja" => "Gəncə", "goygol" => "Göygöl", "lachin" => "Laçın", "qazakh" => "Qazax", "saatli" => "Saatlı", "salyan" => "Salyan",
            "samukh" => "Samux", "sharur" => "Şərur", "shusha" => "Şuşa", "tartar" => "Tərtər", "zardab" => "Zərdab", "balaken" => "Balakən",
            "gedebey" => "Gədəbəy", "goychay" => "Göyçay", "imishli" => "İmişli", "khabala" => "Qəbələ", "khojali" => "Xocalı", "masalli" => "Masallı",
            "ordubad" => "Ordubad", "qubadli" => "Qubadlı", "sadarak" => "Sədərək", "shabran" => "Şabran", "shahbuz" => "Şahbuz", "shamkir" => "Şəmkir",
            "shirvan" => "Şirvan", "siyezen" => "Siyəzən", "xachmaz" => "Xaçmaz", "yevlakh" => "Yevlax", "absheron" => "Abşeron", "aghstafa" => "Ağstafa",
            "beyleqan" => "Beyləqan", "goranboy" => "Goranboy", "jabrayil" => "Cəbrayıl", "kangarli" => "Kəngərli", "kurdamir" => "Kürdəmir", "lenkeran" => "Lənkəran",
            "naftalan" => "Naftalan", "qobustan" => "Qobustan", "shamakhi" => "Şamaxı", "yardimli" => "Yardımlı", "zengilan" => "Zəngilan", "agchabedi" => "Ağcabədi",
            "bilesuvar" => "Biləsuvar", "dashkesen" => "Daşkəsən", "hacikabul" => "Hacıqabul", "ismayilli" => "İsmayıllı", "kalbadjar" => "Kəlbəcər", "khankandi" => "Xankəndi",
            "neftchala" => "Neftçala", "sabirabad" => "Sabirabad", "sumkhayit" => "Sumqayıt", "xochavend" => "Xocavənd", "zakhatala" => "Zaqatala", "djalilabad" => "Cəlilabad",
            "nakhchivan" => "Naxçıvan", "mingechevir" => "Mingəçevir"
        ];

        $enLanguages = ["baku"=> "Baku", "qakh"=> "Qakh", "aghsu"=> "Agsu", "babak"=> "Babek", "barda"=> "Barda", "khizi"=> "Khizi", "khuba"=> "Quba", "kusar"=> "Qusar", 
        "lerik"=> "Lerik", "oghuz"=> "Oghuz", "sheki"=> "Shaki", "tovuz"=> "Tovuz", "udjar"=> "Ujar", "agdash"=> "Ağdash", "aghdam"=> "Agdam", "astara"=> "Astara", 
        "djulfa"=> "Julfa", "fuzuli"=> "Fuzuli", "gandja"=> "Ganja", "goygol"=> "Goygol", "lachin"=> "Lachin", "qazakh"=> "Qazakh", "saatli"=> "Saatly", "salyan"=> "Salyan", 
        "samukh"=> "Samukh", "sharur"=> "Sharur", "shusha"=> "Shusha", "tartar"=> "Tartar", "zardab"=> "Zardab", "balaken"=> "Balakan", "gedebey"=> "Gadabay", 
        "goychay"=> "Goychay", "imishli"=> "Imishli", "khabala"=> "Qabala", "khojali"=> "Khojaly", "masalli"=> "Masally", "ordubad"=> "Ordubad", "qubadli"=> "Qubadli", 
        "sadarak"=> "Sadarak", "shabran"=> "Shabran", "shahbuz"=> "Shahbuz", "shamkir"=> "Shamkir", "shirvan"=> "Shirvan", "siyezen"=> "Siyazan", "xachmaz"=> "Khachmaz", 
        "yevlakh"=> "Yevlakh", "absheron"=> "Absheron", "aghstafa"=> "Agstafa", "beyleqan"=> "Beylagan", "goranboy"=> "Goranboy", "jabrayil"=> "Jabrayil", 
        "kangarli"=> "Kangarli", "kurdamir"=> "Kurdamir", "lenkeran"=> "Lankaran", "naftalan"=> "Naftalan", "qobustan"=> "Gobustan", "shamakhi"=> "Shamakhi", 
        "yardimli"=> "Yardimli", "zengilan"=> "Zangilan", "agchabedi"=> "Aghjabadi", "bilesuvar"=> "Bilasuvar", "dashkesen"=> "Dashkasan", "hacikabul"=> "Hajigabul", 
        "ismayilli"=> "Ismayilli", "kalbadjar"=> "Kalbajar", "khankandi"=> "Khankendi", "neftchala"=> "Neftchala", "sabirabad"=> "Sabirabad", "sumkhayit"=> "Sumqayit", 
        "xochavend"=> "Khojavend", "zakhatala"=> "Zaqatala", "djalilabad"=> "Jalilabad", "nakhchivan"=> "Nakhchivan", "mingechevir"=> "Mingachevir"];

        $languages = array_merge($azLanguages,$enLanguages);

        foreach($languages as $key=>$lan){
            $region = new Region;
            $region->save();


            $region->locales()->create([
                'local' => 'az',
                'region_id' => $region->id,
                'name' => $lan,
            ]);


            $region->locales()->create([
                'local' => 'en',
                'region_id' => $region->id,
                'name' => $lan,
            ]);

        }


    }





    // $user = User=>=>create($user_inputs);

    // $xyz = $user->xyz()->create($xyz_inputs);
}