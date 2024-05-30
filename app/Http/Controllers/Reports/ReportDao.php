<?php
namespace App\Http\Controllers\Reports;

interface ReportDao
{
    public function getType();
    public function getTypeById($id);
    public function getTypeData($data);
    public function createType($data);
    public function updateTypeById($id, $data);
    public function deleteTypeById($id);

    // reports
    public function getReport();
    public function getReportById($id);
    public function getReportData($data);
    public function createReport($data);
    public function updateReportById($id, $data);
    public function deleteReportById($id);
}