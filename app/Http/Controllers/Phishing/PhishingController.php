<?php

namespace App\Http\Controllers\Phishing;


use App\Models\User;
use App\Helpers\Common;
use App\Mail\PhishingEmail;
use App\Constants\Constants;
use Illuminate\Http\Request;

use App\Models\system\Phishing;
use App\Models\system\Template;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

    // public function store(Request $request)
    // {
    //     $request->validate(Phishing::$rules);

    //     if (in_array("all", $request->input('user_id'))) {
    //         $users = User::where('userType', Constants::STATUS_ACTIVE)->get();
    //     } else {
    //         $users = User::whereIn('id', $request->input('user_id'))->get();
    //     }

    //     $template = $this->phishing->getTemplateById($request->input('template_id'));
    //     $contents = json_decode(file_get_contents($template->info), true);
    //     $contents['info'] = $this->convertRelativeUrlsToAbsolute($contents['info']);

    //     try {
    //         foreach ($users as $user) {

    //             $info = Phishing::create([
    //                 'user_id' => $user->id,
    //                 'compaign_id' => $request->input('compaign_id'),
    //                 'template_id' => $request->input('template_id'),
    //             ]);
    //             Mail::to($user->email)->send(new PhishingEmail(
    //                 $contents['temp_name'],
    //                 $contents['info'],
    //                 Common::hash($info->id),
    //                 Common::hash($request->input('template_id'))
    //             ));
    //         }
    //         if ($info) {
    //             Log::channel('daily')->info('data' . ': ' . $info);
    //             return redirect()->back()->with('success', 'Emails sent successfully.');
    //         }
    //     } catch (\Exception $error) {
    //         $response = 'Operation failed, please contact the system administrator: ' . $error->getMessage();
    //         Log::channel('daily')->error($response);
    //         return back()->with('error', $response);
    //     }
    // }
    public function store(Request $request)
    {
        $request->validate(Phishing::$rules);

        if (in_array("all", $request->input('user_id'))) {
            $users = User::where('userType', Constants::STATUS_ACTIVE)->get();
        } else {
            $users = User::whereIn('id', $request->input('user_id'))->get();
        }

        $template = $this->phishing->getTemplateById($request->input('template_id'));
        $contents = json_decode(file_get_contents($template->info), true);
        $contents['info'] = $this->convertRelativeUrlsToAbsolute($contents['info']);

        try {
            foreach ($users as $user) {
                $info = Phishing::create([
                    'user_id' => $user->id,
                    'compaign_id' => $request->input('compaign_id'),
                    'template_id' => $request->input('template_id'),
                ]);

                Mail::to($user->email)->send(new PhishingEmail(
                    $contents['temp_name'],
                    $contents['info'],
                    Common::hash($info->id),
                    Common::hash($request->input('template_id'))
                ));
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


    private function convertRelativeUrlsToAbsolute($html)
    {
        $baseUrl = url('/'); // Gets the base URL of your application
        $pattern = "/<img src=['\"](.*?)['\"]/i";
        return preg_replace_callback($pattern, function ($matches) use ($baseUrl) {
            $url = $matches[1];
            if (!preg_match("/^https?:\/\//i", $url)) {
                $url = $baseUrl . '/' . ltrim($url, '/');
            }
            return str_replace($matches[1], $url, $matches[0]);
        }, $html);
    }

    public function countClicked($template_name, $template_id, $info_id)
    {
        Phishing::findOrFail(Common::decodeHash($info_id))->update([
            'clicked' => true
        ]);

        $template = $this->phishing->getTemplateById(Common::decodeHash($template_id));


        $filePath = public_path($template->info);
        $d['contents'] = json_decode(file_get_contents($filePath), true);
        // $contents['info'] = $this->convertRelativeUrlsToAbsolute($contents['info']);

        $d['message'] = 'You have been failed by clicking phishing link be awere with attacking issue';
        return view("pages.phishing.clicked_view", $d);
    }
}
