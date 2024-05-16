<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compaign extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "compaigns";
    protected $fillable = [
        'name',
        'status',
        'start_at',
        'end_at'
    ];

    public static $rules = [
        "name" => "required|max:100",
        "status" => "required|max:20",
        "start_at" => "required",
        "end_at" => "required", 
    ];
}
