<?php

namespace App\Http\Controllers\Level;

use App\Models\system\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LevelController extends Controller
{
    protected $level;
    public function __construct(LevelDaoImpl $level)
    {
        $this->level = $level;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    public function index()
    {
        $d['level'] = $this->level->getLevel();
        return view("pages.system_settings.level.index", $d);
    }


    public function create()
    {
        //
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
