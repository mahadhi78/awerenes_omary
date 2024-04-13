<?php 
namespace App\Http\Controllers\Level;

interface LevelDao
{
    public function getLevel();
    public function getLevelById($id);
    public function createLevel($data);
    public function updateLevelById($id,$data);
    public function deleteLevelById($id);
    public function getAlevelByIdAndName();

}