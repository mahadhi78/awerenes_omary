<?php

namespace App\Http\Controllers\setting\Dao;

interface SettingDao
{
    public function getAllsettings();
    public function UpdateSettings($type, $desc);
}
