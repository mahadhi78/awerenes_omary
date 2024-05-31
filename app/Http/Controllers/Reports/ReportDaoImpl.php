<?php

namespace App\Http\Controllers\Reports;

use App\Models\system\NewData;
use App\Models\system\Report;
use App\Models\system\ReportType;

class ReportDaoImpl implements ReportDao
{
    public function getType()
    {
        return ReportType::all();
    }
    public function getTypeData($data)
    {
        return ReportType::where($data)->get();
    }

    public function getTypeById($id)
    {
        return ReportType::findOrFail($id);
    }
    public function createType($data)
    {
        return ReportType::create($data);
    }
    public function updateTypeById($id, $data)
    {
        return $this->getTypeById($id)->update($data);
    }
    public function deleteTypeById($id)
    {
        return $this->getTypeById($id)->delete();
    }

    public function getReport()
    {
        return Report::join('type_reports', 'type_reports.id', '=', 'reports.type_report_id')
            ->join('users', 'users.id', '=', 'reports.user_id')
            ->select('reports.*', 'users.firstname', 'users.lastname', 'users.middlename', 'type_reports.name as type_name')
            ->get();
    }
    public function getReportById($id)
    {
        return Report::findOrFail($id);
    }
    public function getReportData($data)
    {
        return Report::where($data);
    }
    public function createReport($data)
    {
        return Report::create($data);
    }
    public function updateReportById($id, $data)
    {
        return $this->getReportById($id)->update($data);
    }
    public function deleteReportById($id)
    {
        return $this->getReportById($id)->delete();
    }

    // news
    public function getNews()
    {
        return NewData::all();
    }
    public function getNewsById($id)
    {
        return NewData::findOrFail($id);
    }
    public function getNewsData($data)
    {
        return NewData::where($data);
    }
    public function createNews($data)
    {
        return NewData::create($data);
    }
    public function updateNewsById($id, $data)
    {
        return $this->getNewsById($id)->update($data);
    }
    public function deleteNewsById($id)
    {
        return $this->getNewsById($id)->delete();
    }
}
