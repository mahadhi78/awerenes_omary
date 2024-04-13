<?php

namespace App\Http\Controllers\Level;

use App\Constants\Constants;
use App\Models\system\Level;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Level\LevelDao;

class LevelDaoImpl implements LevelDao
{
    public function getLevel()
    {
        if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)) {
        $data = Level::withTrashed()->get();
        }
        $data = Level::all();
        return $data;
    }
    public function getLevelById($id)
    {
        return Level::findOrFail($id);
    }
    public function createLevel($data)
    {
        return Level::create($data);
    }
    public function updateLevelById($id, $data)
    {
        return Level::findOrFail($id)->update($data);
    }
    public function deleteLevelById($id)
    {
        return Level::findOrFail($id)->delete();
    }

    public function getAlevelByIdAndName(){
        return  Level::pluck('lv_name', 'id')->all();
       
    }
}
