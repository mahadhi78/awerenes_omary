<?php

namespace App\Http\Controllers\LoginHistory;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'prevent-back-history']);
    }
    public function index()
    {
        $d['history'] = LoginHistory::where('user_id',auth()->user()->id)->get();
        return view("pages.LoginHistory.index", $d);
    }
}
