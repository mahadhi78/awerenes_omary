<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReportType extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "type_reports";
    protected $fillable = [
        'name',
        'status',

    ];

    public static $rules = [
        "name" => "required |min:3|max:50",
        "status" => "required",
    ];
}
