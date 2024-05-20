<?php

namespace App\Http\Controllers\Phishing;


use App\Constants\Constants;
use App\Models\system\Compaign;
use App\Models\system\Template;
use Illuminate\Support\Facades\Auth;

class PhishingDaoImpl implements PhishingDao
{
    public function getCompaign()
    {
        if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)) {
            $data = Compaign::withTrashed()->get();
        }
        $data = Compaign::all();
        return $data;
    }
    public function getCompaignById($id)
    {
        return Compaign::findOrFail($id);
    }
    public function createCompaign($data)
    {
        return Compaign::create($data);
    }
    public function updateCompaignById($id, $data)
    {
        return $this->getCompaignById($id)->update($data);
    }
    public function deleteCompaignById($id)
    {
        return $this->getCompaignById($id)->delete();
    }
    public function getCompaignByIdAndName()
    {
        return  Compaign::where('status',Constants::STATUS_ACTIVE)->pluck('name', 'id')->all();
    }


    // template

    public function getTemplate()
    {
        // if (Auth::user()->hasRole(Constants::ROLE_SUPER_ADMINISTRATOR)) {
        //     $data = Template::withTrashed()->get();
        // }
        $data = Template::all();
        return $data;
    }
    public function getTemplateById($id)
    {
        return Template::findOrFail($id);
    }
    public function createTemplate($data)
    {
        return Template::create($data);
    }
    public function updateTemplateById($id, $data)
    {
        return $this->getCompaignById($id)->update($data);
    }
    public function deleteTemplateById($id)
    {
        return $this->getCompaignById($id)->delete();
    }
    public function getTemplateByIdAndName()
    {
        return  Template::pluck('temp_name', 'id')->all();
    }
}
