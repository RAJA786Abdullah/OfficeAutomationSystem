<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\length;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = Setting::getSettings();
        $customSettings = [];
        foreach ($settings as $setting) {
            $customSettings[$setting->group][$setting->tab][] = $setting;
        }
        return view('setting.edit',compact('customSettings'));
    }

    public function update(Request $request,Factory $cache)
    {
        $parameter_names = array_keys($request->all());
        $settingCodes = [];
        $settings = [];
        $settingCode = [];
        foreach ($parameter_names as $name) {
            $settingCodes[] = $name;
            $settingCodes[] = array_search($settingCodes, array_keys($request->all()));
        }
        foreach ($settingCodes as $code){
            if ($code != false)
            {
                $settingCode[] = $code;
                $settings[] = Setting::where('settingCode',$code)->first();
            }
        }
        foreach ($settings as $key => $setting){
            if ($setting != null){
                if ($request->has($settings[$key]->settingCode)){
                    $inputValues = $request->only($settings[$key]->settingCode);
                    $setting->where('settingCode',$settings[$key]->settingCode)->update(
                        [
                            'defaultValue' => $inputValues[$settings[$key]->settingCode]
                        ]
                    );
                }
            }
        }
        $cache->forget('user_settings');
        return to_route('setting.edit',Auth::id());
    }

    public function destroy(Setting $setting)
    {
        //
    }
}
