<?php

namespace App\Http\Controllers\Level;

use App\Constants\Constants;
use App\Models\system\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Service\ServiceDaoImpl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    protected $level, $service;
    public function __construct(LevelDaoImpl $level, ServiceDaoImpl $service)
    {
        $this->level = $level;
        $this->service = $service;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    public function index()
    {
        if (Auth::user()->userType == Constants::LEARNER) {
            return redirect()->route('learning.home');
        }
        $d['level'] = $this->level->getLevel();
        return view("pages.system_settings.level.index", $d);
    }


    public function store(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), Level::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'response' => $validator->errors()];
            }

            $schoolExists = Level::where("lv_name", "=", $data['lv_name'])->first();
            if ($schoolExists) {
                $response = 'Level Name: ' . $data['name'] . ' already exists';
                return ['success' => 'failure', 'response' => $response];
            }

            try {
                $school = $this->level->createLevel($data);
                //  $this->service->createLevel($data);
                if ($school) {
                    $response = 'Level Name saved successfully';
                    Log::channel('daily')->info($response . ': ' . $school);
                    return ['success' => true, 'response' => $response];
                }
            } catch (\Exception $error) {
                $response = 'Operation failed, please contact the system administrator: ' . $error->getMessage();
                Log::channel('daily')->error($response);
                return ['success' => 'failure', 'response' => $response];
            }
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        return response()->json($this->level->getLevelById($id));
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($data = $request->all(), Level::$rules);

            if ($validator->fails()) {
                return ['success' => false, 'errors' => $validator->errors()];
            }
            try {
                $this->level->updateLevelById($data['id'], $data);
                $response = 'Data Updated Successfully';
                return ['success' => true, 'response' => $response];
            } catch (\Exception $error) {
                $response = 'Operation Failed,Please Contact System Administrator ' . $error;
                Log::channel('daily')->error($response . ' ' . $error->getMessage());

                return ['success' => 'failure', 'errors' => $response];
            }
        }
    }

    public function destroy(Request $request)
    {
        $class = $this->level->deleteLevelById($request['id']);
        try {
            $response = 'Data Deleted Successfully';
            Log::channel('daily')->info($response . ' ' . $class);
            return ['success' => true, 'response' => $response];
        } catch (\Exception $error) {
            $response = 'Operation Failed,Please Contact System Administrator ' . $error;
            Log::channel('daily')->error($response . ' ' . $error->getMessage());
            return ['success' => 'failure', 'response' => $response];
        }
    }
}
