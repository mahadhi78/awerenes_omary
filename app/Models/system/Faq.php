<?php

namespace App\Models\system;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faq extends Model
{
    use HasFactory,SoftDeletes;

    
    protected $table = "faqs";
    protected $fillable = [
        'description',
        'name',

    ];

    public static $rules = [
        "name" => "required |min:3|max:150",
    ];
}
