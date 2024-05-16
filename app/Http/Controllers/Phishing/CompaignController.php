<?php

namespace App\Http\Controllers\Phishing;


use App\Helpers\Common;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Models\system\Courses;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Level\LevelDaoImpl;
use App\Http\Controllers\Course\CourseDaoImpl;
use App\Models\system\Compaign;

class CompaignController extends Controller
{

    protected $phishing;
    public function __construct(PhishingDaoImpl $phishing)
    {
        $this->phishing = $phishing;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    public function index()
    {
        if (Auth::user()->userType == Constants::LEARNER) {
            return redirect()->route('learning.home');
        }
        $d['comaign'] = $this->phishing->getCompaign();

        return view("pages.phishing.index", $d);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($data = $request->all(), Compaign::$rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $schoolExists = Compaign::where([
            [
                "name", $data['name'],
                ['status', $data['status']]
            ]
        ])->first();
        if ($schoolExists) {
            $response = 'Compaign: ' . $data['name'] . ' already exists';
            return back()->with('error', $response);
        }
        try {
            $school = $this->phishing->createCompaign($data);
            if ($school) {
                $response = 'Compaign saved successfully';
                Log::channel('daily')->info($response . ': ' . $school);
                return back()->with('success', $response);

            }
        } catch (\Exception $error) {
            $response = 'Operation failed, please contact the system administrator: ' . $error->getMessage();
            Log::channel('daily')->error($response);
            return back()->with('error', $response);

        }
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
