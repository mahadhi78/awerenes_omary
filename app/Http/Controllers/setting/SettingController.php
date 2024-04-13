<?php

namespace App\Http\Controllers\setting;

use App\Helpers\Common;
use App\Http\Controllers\setting\Dao\SettingDaoImp;
use App\Http\Controllers\Controller;
use App\Http\Controllers\setting\UpdateSettingRequest;


class SettingController extends Controller
{
    protected $settings;

    public function __construct(SettingDaoImp $settings)
    {
        $this->settings = $settings;
    }

    public function index()
    {
        $s = $this->settings->getAllsettings();
        $d['s'] = $s->flatMap(function ($s) {
            return [$s->type => $s->description];
        });
        return view('pages.system_settings.settings.index', $d);
    }


    public function update(UpdateSettingRequest $req)
    {
        $sets = $req->except('_token', '_method', 'logo');
        $keys = array_keys($sets);
        $values = array_values($sets);
        for ($i = 0; $i < count($sets); $i++) {
            $this->settings->UpdateSettings($keys[$i], $values[$i]);
        }

        if ($req->hasFile('logo')) {
            $extensions = array("jpe", "jpeg", "png", "gif", "jpg");
            $getFileExtension = $req->file('logo')->extension();
            if (!in_array($getFileExtension, $extensions)) {
                return ['success' => 'failure', 'response' => 'Please Upload a Valid Photo'];
            }
            if ($req->file('logo')->isValid()) {
                
                $initialName = 'logo';
                $fileName = str_replace(' ', '_', $initialName) . '.' . $getFileExtension;
                $pathName = '/uploads/setting/';
               
                $destinationPath = public_path() . $pathName;
                $req->file('logo')->move($destinationPath, $fileName);
                $logo_path = $pathName . $fileName;
                $this->settings->UpdateSettings('logo', $logo_path);
            }
        }

        return back()->with('success', 'Configuration was successfully');

    }
}
