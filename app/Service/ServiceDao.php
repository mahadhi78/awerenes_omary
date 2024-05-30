<?php
namespace App\Service;

interface ServiceDao
{
// setting
public function updateSetting($data);
    // levels
    public function getAllLevel();
    public function createLevel($data);
    public function findLevel($id);
    public function deleteLevel($id);
    public function updateLevel($id,$data);
    
    //user
    public function createUser($data);
    public function findUser($id);
    public function updateUser($id,$data);
    public function deleteUser($id);


}