<?php
namespace App\Service;

interface ServiceDao
{

    // levels
    public function getAllLevel();
    public function createLevel($data);
    public function findLevel();
    public function deleteLevel();
    public function updateLevel();
    
}