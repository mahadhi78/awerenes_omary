<?php

namespace App\Http\Controllers\Phishing;


use App\Models\User;
use App\Helpers\Common;
use App\Mail\PhishingEmail;
use App\Constants\Constants;
use Illuminate\Http\Request;
use App\Models\system\Courses;

use App\Models\system\Phishing;
use App\Models\system\Template;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Level\LevelDaoImpl;
use App\Http\Controllers\Course\CourseDaoImpl;
use App\Http\Controllers\Phishing\PhishingDaoImpl;
use App\Http\Controllers\UserManagement\Dao\UserDaoImpl;

class PhishingController extends Controller
{
    protected $phishing, $userDaoImpl;
    public function __construct(PhishingDaoImpl $phishing, UserDaoImpl $userDaoImpl)
    {
        $this->phishing = $phishing;
        $this->userDaoImpl = $userDaoImpl;
        $this->middleware(['auth', 'prevent-back-history']);
    }

    public function index()
    {
        if (Auth::user()->userType == Constants::LEARNER) {
            return redirect()->route('learning.home');
        }
        $d['compaign'] = $this->phishing->getCompaign();
        $d['activeStatus'] = Constants::STATUS_ACTIVE;
        $d['templates'] = $this->phishing->getTemplate();

        return view("pages.phishing.index", $d);
    }

    public function create(Request $request)
    {
        $d['users'] = $this->userDaoImpl->getApprovedlearners();
        $d['compaign'] = $this->phishing->getCompaignByIdAndName();
        $d['template'] = $this->phishing->getTemplateByIdAndName();

        return view("pages.phishing.create", $d);
    }

    public function store(Request $request)
    {
        $request->validate(Phishing::$rules);
        // dd($request->all());

        if (in_array("all", $request->input('user_id'))) {
            $users = User::where('userType', Constants::STATUS_ACTIVE)->get();
        } else {
            $users = User::whereIn('id', $request->input('user_id'))->get();
        }

        $template = Template::findOrFail($request->input('template_id'));
        $filePath = public_path('uploads/' . $template->info);


        $contents = json_decode(file_get_contents($filePath), true);
        try {
            foreach ($users as $user) {
                Mail::to($user->email)->send(new PhishingEmail($contents->temp_name, $contents->info));

                $info = Phishing::create([
                    'user_id' => $user->id,
                    'compaign_id' => $request->input('compaign_id'),
                    'template_id' => $request->input('template_id'),
                ]);
            }
            if ($info) {
                Log::channel('daily')->info('data' . ': ' . $info);
                return redirect()->back()->with('success', 'Emails sent successfully.');
            }
        } catch (\Exception $error) {
            $response = 'Operation failed, please contact the system administrator: ' . $error->getMessage();
            Log::channel('daily')->error($response);
            return back()->with('error', $response);
        }
    }
}
