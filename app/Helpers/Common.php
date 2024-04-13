<?php

namespace App\Helpers;

use App\Constants\Constants;
use App\Http\Controllers\academic\Models\AcademicYear;
use App\Http\Controllers\schools\Models\School;
use App\Http\Controllers\setting\Models\Setting;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;

class Common extends Qs
{
    public static function getDaysOfTheWeek()
    {
        return ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    }
    public static function getPublicUploadPath($location)
    {
        return 'uploads/' . $location . '';
    }

    public static function getUserUploadPath()
    {
        return 'uploads/' . date('Y') . '/' . date('m') . '/' . date('d') . '/';
    }

    public static function getUploadPath($user_type)
    {
        return 'uploads/' . $user_type . '/';
    }

    public static function getFileMetaData($file)
    {
        //$dataFile['name'] = $file->getClientOriginalName();
        $dataFile['ext'] = $file->getClientOriginalExtension();
        // $dataFile['name'] = $file->getClientOriginalName();
        $dataFile['type'] = $file->getClientMimeType();
        $dataFile['size'] = self::formatBytes($file->getSize());
        return $dataFile;
    }

    public static function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('B', 'KB', 'MB', 'GB', 'TB');

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    public static function getSetting($type)
    {
        return Setting::where('type', $type)->first()->description;
    }

    public static function getSystemTitle()
    {
        return self::getSetting('system_title');
    }
    public static function getSystemName()
    {
        return self::getSetting('system_name');
    }
    public static function getSystemLogo()
    {
        return self::getSetting('logo');
    }
    public static function getSystemEmail()
    {
        return self::getSetting('system_email');
    }
    public static function getSystemAddress()
    {
        return self::getSetting('address');
    }
    public static function getSystemSymbol()
    {
        return self::getSetting('academic_year_format');
    }
    public static function getSystemPhone()
    {
        return self::getSetting('phone');
    }

    public static function AcademicYear($data)
    {
        // return AcademicYear::where("status", Constants::STATUS_ACTIVE)->value('current_year');
        // return AcademicYear::where("status", Constants::STATUS_ACTIVE)->value($data);
    }
    public static function getAcademicYear()
    {
        // return AcademicYear::where("status", Constants::STATUS_ACTIVE)->value('current_year');
        // return self::AcademicYear('current_year');
    }
    public static function schoolDataByUserLogin($data)
    {
        return School::where('id', Auth()->user()->school_id)->value($data);
    }

    public static function getScholName()
    {
        return self::schoolDataByUserLogin('sc_name');
    }
    public static function getSchoolLogo()
    {
        return self::schoolDataByUserLogin('logo');
    }
    public static function getSchoolInitial()
    {
        return self::schoolDataByUserLogin('initial');
    }


    public static function permissionsData()
    {
        return Permission::pluck('name')->toArray();
    }

    // notification table

    public static function getNotification()
    {
        // return AcademicYear::where("status", Constants::STATUS_ACTIVE)->value('current_year');
        return DB::table('notifications')->get();
    }
    public static function CountNotification()
    {
        return DB::table('notifications')->count();
    }




    public static function handleFileUpload($request, $fileInputName, $destinationPath, $oldFileName = null)
    {
        $extensions = ["jpe", "jpeg", "png", "gif", "jpg"];

        if (!$request->hasFile($fileInputName)) {
            return ['success' => 'failure', 'response' => 'No file provided'];
        }

        $uploadedFile = $request->file($fileInputName);

        if (!$uploadedFile->isValid()) {
            return ['success' => 'failure', 'response' => 'Invalid file'];
        }

        $getFileExtension = $uploadedFile->getClientOriginalExtension();

        if (!in_array($getFileExtension, $extensions)) {
            return ['success' => 'failure', 'response' => 'Please upload a valid file'];
        }

        try {
            // Remove the old file
            if ($oldFileName && is_file(public_path($destinationPath . $oldFileName))) {
                unlink(public_path($destinationPath . $oldFileName));
            }

            // Generate a unique file name
            $originalFileName = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
            $fileName = Str::slug($originalFileName) . '_' . uniqid() . '.' . $getFileExtension;

            $fullDestinationPath = public_path($destinationPath);
            $uploadedFile->move($fullDestinationPath, $fileName);

            return ['success' => true, 'response' => $destinationPath . $fileName];
        } catch (\Exception $error) {
            return ['success' => 'failure', 'response' => 'Error during file upload: ' . $error->getMessage()];
        }
    }
}
