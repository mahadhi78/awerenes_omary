<?php

namespace App\Helpers;

class Qs
{
    public static function iboxTitle($h4Text, $buttons)
    {
        return '
            <a href="javascript:history.back()" class="btn btn-default  fa fa-arrow-circle-left"></a>
             <h4>' . $h4Text . '</h4>
             ' . $buttons . '
        ';
    }
    public static function modalButton($text)
    {
        return '
        <button type="button" class="btn btn-primary pull-right" data-toggle="modal"
            data-target="#myModal">
            <i class="fa fa-plus"></i>
            ' . $text . '
        </button>
        ';
    }

    public static function systemSettingPermissions()
    {
        $data = [
            'settings-list', 'settings-edit', 'settings-save',
            'schools-list', 'schools-edit', 'schools-save',
            'class-list', 'class-edit', 'class-save',
            'section-list', 'section-edit', 'section-save',
            'subjects-list', 'subjects-edit', 'subjects-save',
           
        ];
        return $data;
    }
    public static function studentPermissions()
    {
        $data = [
            'student_registration-save'
        ];
        return $data;
    }
    public static function staffsPermissions()
    {
        $data = [
            'staffs-save', 'staffs_subjects-save', 'staffs_input-save'
        ];
        return $data;
    }
    public static function driverPermissions()
    {
        $data = [
            'drivers-save', 'driver_roots-list', 'driver_roots-save', 'driver_roots-edit'
        ];
        return $data;
    }
    public static function approvalPermissions()
    {
        $data = [
            'staffs_approval-list'
        ];
        return $data;
    }
    public static function uniformPermissions()
    {
        $data = [
            'uniforms_published-save'
        ];
        return $data;
    }

    public static function renderDataTable()
    {
        return '
            <script>
                $(function() {
                    $(\'#dataTableList\').DataTable({
                        "processing": true,
                        "pageLength": 10,
                        "pagingType": "full_numbers",
                        "scrollCollapse": true,
                        "language": {
                            "lengthMenu": "Show _MENU_",
                        },
                        "dom": "<\'row\'" +
                            "<\'col-sm-6 d-flex align-items-center justify-conten-start\'l>" +
                            "<\'col-sm-6 d-flex align-items-center justify-content-end\'f>" +
                            ">" +
                            "<tr>" +
                            "<\'row\'" +
                            "<\'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start\'i>" +
                            "<\'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end\'p>" +
                            ">"
                    });
                })
            </script>
        ';
    }
}
