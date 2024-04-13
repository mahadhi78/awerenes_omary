<?php

namespace App\Http\Controllers\setting\Dao;
use App\Http\Controllers\setting\Models\Setting;


class SettingDaoImp implements SettingDao
{
    public function getAllsettings(){
        $settings = Setting::all();
        return $settings;
    }
   
    public function UpdateSettings($type, $desc)
    {
        return Setting::where('type', $type)->update(['description' => $desc]);
    }


}
