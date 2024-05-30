<?php

namespace App\Http\Controllers\Reports;

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
        return Report::all();
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
}
