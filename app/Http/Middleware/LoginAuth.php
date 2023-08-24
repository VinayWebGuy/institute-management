<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use App\Models\Setting;

class LoginAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::has('login')){
            $user = User::find(Session::get('id'));
            $setting = Setting::where('user_id',Session::get('id'))->first();
            if(isset($setting) && $setting->two_factor_authentication==1 && $user->otp!=''){
                return redirect('let-me-verify-you');
            }
            else{
                if($user->lock_screen==1){
                    return redirect('lockscreen');
                }
                else{
                    return $next($request);
                }
            }
          
        }
        else{
            session()->flash('error','Access denied');
            return redirect('login');
        }
    }
}
