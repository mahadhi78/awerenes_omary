<?php

namespace App\Http\Controllers\Phishing;


use DOMDocument;
use App\Helpers\Common;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Models\system\Lesson;
use App\Models\system\Courses;
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Level\LevelDaoImpl;
use App\Models\system\Template;

class TemplateController extends Controller
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
        $validator = Validator::make($data = $request->all(), Template::$rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $schoolExists = Template::where("temp_name", "=", $data['temp_name'])->first();
        if ($schoolExists) {
            $response = 'Template: ' . $data['lesson_name'] . ' already exists';
            return back()->with('error', $response);
        }

        $data['info'] = $this->uploadBySummernote($data['info']);
        try {
            $school = $this->phishing->createTemplate($data);
            if ($school) {
                $response = 'Template saved successfully';
                Log::channel('daily')->info($response . ': ' . $school);
                return back()->with('success', $response);
            }
        } catch (\Exception $error) {
            $response = 'Operation failed, please contact the system administrator: ' . $error->getMessage();
            Log::channel('daily')->error($response);
            return back()->with('error', $response);
        }
    }

    protected function uploadBySummernote($description)
    {
        $dom = new DomDocument();
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('imageFile');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name = "/upload/" . time() . $item . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }
        return $dom->saveHTML();
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
