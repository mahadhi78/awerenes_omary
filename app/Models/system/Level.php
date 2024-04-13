<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "levels";
    protected $fillable = [
        'lv_name'
    ];

    public static $rules = [
        "lv_name" => "required |min:3|max:50",
    ];
}
