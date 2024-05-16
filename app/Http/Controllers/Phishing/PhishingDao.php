<?php 
namespace App\Http\Controllers\Phishing;

interface PhishingDao
{
    public function getCompaign();
    public function getCompaignById($id);
    public function createCompaign($data);
    public function updateCompaignById($id,$data);
    public function deleteCompaignById($id);
    public function getCompaignByIdAndName();


    // template

    public function getTemplate();
    public function getTemplateById($id);
    public function createTemplate($data);
    public function updateTemplateById($id,$data);
    public function deleteTemplateById($id);
    public function getTemplateByIdAndName();

}