<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arySettings = [
            ['settingTypeCode' => 'client', 'fieldTypeCode' => 'number','settingName' => 'Decimal Places','settingCode' => 'decimal_places','label' => 'Decimal Places','tab' => 'Settings','group' => 'Client','sortOrder' => 1, 'defaultValue' => '0'],
			['settingTypeCode' => 'client', 'fieldTypeCode' => 'radio','settingName' => 'Fixed Units in Product','settingCode' => 'is_units_in_product_fixed','label' => 'Fixed Units in Product?','tab' => 'Settings','group' => 'Client','sortOrder' => 1, 'defaultValue' => '0'],
			['settingTypeCode' => 'client', 'fieldTypeCode' => 'radio','settingName' => 'Show damaged Units','settingCode' => 'is_show_damaged_units','label' => 'Show damaged units?','tab' => 'Settings','group' => 'Client','sortOrder' => 1, 'defaultValue' => '0'],
			['settingTypeCode' => 'user', 'fieldTypeCode' => 'number','settingName' => 'Records Per Page','settingCode' => 'records_per_page','label' => 'Records Per Page','tab' => 'Page','group' => 'Listings','sortOrder' => 1, 'defaultValue' => '50'],
            ['settingTypeCode' => 'client', 'fieldTypeCode' => 'radio','settingName' => 'Show Exchange Rate','settingCode' => 'is_show_exchange_rate','label' => 'Show Exchange Rate','tab' => 'Settings','group' => 'Client','sortOrder' => 1, 'defaultValue' => '1'],
        ];

        foreach ($arySettings as $setting) {
			$settingTypeID = \App\Models\SettingType::where('settingTypeCode',$setting['settingTypeCode'])->pluck('settingTypeID')->first();
			$fieldTypeID = \App\Models\FieldType::where('fieldTypeCode',$setting['fieldTypeCode'])->pluck('fieldTypeID')->first();
            DB::table('setting')->insert([
				'settingTypeID' => $settingTypeID,
				'fieldTypeID' => $fieldTypeID,
				'settingName' => $setting['settingName'],
				'settingCode' => $setting['settingCode'],
				'label' => $setting['label'],
				'tab' => $setting['tab'],
				'group' => $setting['group'],
				'sortOrder' => $setting['sortOrder'],
				'defaultValue' => $setting['defaultValue']
			]);
        }
    }
}
