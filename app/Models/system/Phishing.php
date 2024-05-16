<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phishing extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "phishings";
    protected $fillable = [
        'compaign_id',
        'template_id',
        'user_id',
        'clicked'
    ];

    public static $rules = [
        "compaign_id" => "required|max:100",
        "template_id" => "required|max:20",
        'user_id' => 'required|array',
    ];
}
