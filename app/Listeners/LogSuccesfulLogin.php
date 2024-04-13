<?php

namespace App\Listeners;

use App\Models\LoginHistory;
use Illuminate\Support\Carbon;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Request;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccesfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    protected $history;
    public function __construct(LoginHistory $history)
    {
        $this->history = $history;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $loginHistory = $this->history;
        $loginHistory->user_id = $event->user->id;
        $loginHistory->ip_address = Request::ip();
        $loginHistory->login_at = Carbon::now();
        $loginHistory->user_agent = Request::header('User-Agent');
        $loginHistory->save();
    }
}
