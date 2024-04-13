<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Home\HomeDaoImpl;

class HomeController extends Controller
{
    protected $home;

    public function __construct(HomeDaoImpl $home)
    {
        $this->home = $home;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $d['usersActive'] = $this->home->countStaff();

        return view('home',$d);
    }
    


}
