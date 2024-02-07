<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            [
                'name' => 'YFC-1 (Kyauk Myaung Branch)',
                'address' => 'အမှတ် (၂၆)၊ မြေညီထပ်၊ ဣစ္ဆာသယလမ်း၊ ကျားကွက်သစ်ရပ်ကွက်၊ ကျောက်မြောင်းဈေးမှတ်တိုင်အနီး၊ တာမွေမြို့နယ်၊ ရန်ကုန်မြို့။'
            ],
            [
                'name' => 'YFC-2 (Pazundaung Branch)',
                'address' => 'အမှတ်(၁၂၂)၊ မြေညီ+ပထမထပ်၊ (၅၁)လမ်း အလယ်ဘလောက်၊ ပုဇွန်တောင်မြို့နယ်၊ ရန်ကုန်မြို့။'
            ],
            [
                'name' => 'YFC-3 (Kyimyindaing Branch)',
                'address' => 'အမှတ် (၄၆/၄၈)၊မြေညီထပ်၊ ညောင်ပင်လမ်း၊ ကြည့်မြင်တိုင်ညဈေးအနီး၊ ကမ်းနားဈေးမှတ်တိုင်၊ ကြည့်မြင်တိုင်မြို့နယ်၊ ရန်ကုန်မြို့။'
            ],
            [
                'name' => 'YFC-4 (Pansoedan Branch)',
                'address' => 'အမှတ် (၁၇၀/၁၇၄)၊ ပ-ထပ်၊ အနော်ရထာလမ်းမကြီး၊ 34လမ်းထိပ်၊ (အိပ်မက်စိမ်းဖိနပ်ဆိုင် မျက်နှာချင်းဆိုင်)၊ ကျောက်တံတားမြို့နယ်၊ ရန်ကုန်မြို့။'
            ],
            [
                'name' => 'YFC-5 (Htauk Kyant Branch)',
                'address' => 'သပြေညိုမင်္ဂလာခန်းမအပေါ်ထပ်၊ ပဲခူးလမ်းမကြီး၊ ထောက်ကြန့်။'
            ],
            [
                'name' => 'YFC-6 (Latha Branch)',
                'address' => 'အမှတ် (၆၀၆)၊ ပ-ထပ်၊ မဟာဗန္ဓုလလမ်းမကြီး၊ ၂၃လမ်းထိပ် (သိမ်ကြီးဈေးဂမုန်းပွင့်အနီး)၊ လသာမြို့နယ်၊ ရန်ကုန်မြို့။'
            ],
            [
                'name' => 'YFC-7 (Sanchaung Branch)',
                'address' => 'အမှတ် (၄၃)၊ ကျွန်းတောလမ်းမကြီး၊ (ကျွန်းတောလမ်းနှင့် မအူပင်လမ်းထောင့်)၊ စမ်းချောင်းမြို့နယ်၊ ရန်ကုန်မြို့။ (Baby Idol ဆိုင်အပေါ်ထပ်)'
            ],
            [
                'name' => 'YFC-8 (Thingangyun Branch)',
                'address' => 'အမှတ် (၃၈/ခ)၊ ဒု-ထပ်၊ လေးထောင့်ကန်လမ်းမကြီး၊ AKK Shopping Mall မျက်စောင်းထိုး၊ United Vision အပေါ်ထပ်၊ ဇဝနမှတ်တိုင်အနီး၊ သင်္ဃန်းကျွန်းမြို့နယ်၊ ရန်ကုန်မြို့။'
            ],
            [
                'name' => 'YFC-9 (Hlegu Branch)',
                'address' => 'အမှတ် (င/၆၁)၊ အနောက်မင်းလမ်း၊ လှည်းကူးစျေးရှေ့၊ ရိပ်သာရပ်ကွက်၊ လှည်းကူးမြို့နယ်။'
            ],
            [
                'name' => 'YFC-10 (U Chit Maung Branch)',
                'address' => 'အမှတ် (၂၉)၊ ၁၆၇ လမ်း၊ တာမွေမြို့နယ်၊ ရန်ကုန်မြို့။'
            ],
        ];

        foreach($branches as $branch){
            Branch::create([
                'name' => $branch['name'],
                'address' => $branch['address'] 
            ]);
        }
    }
}
