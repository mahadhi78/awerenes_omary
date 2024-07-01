<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = "reports";
    protected $fillable = [
        'type_report_id',
        'user_id',
        'description',

    ];

    public static $rules = [
        "type_report_id" => "required",
    ];
}
