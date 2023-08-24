<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMore;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Result;
use App\Models\Notification;
use Session;
use File;
use DB;
use Carbon\Carbon;
use Mail;

class ProcessController extends Controller
{

    public function notification($title,$desc,$user_id){
        $n = new Notification;
        $n->title = $title;
        $n->description = $desc;
        $n->user_id = $user_id;
        $n->added_on = Carbon::now();
        $n->save();
    }

    public function auth(Request $req){
       $req->validate([
        'email' => 'required',
        'password' => 'required'
       ]);
      $user = User::where('email',$req->email)->where('password',md5($req->password))->first();
      if($user){
        $user->lock_screen = 0;
        $user->save();
        if($user->status==1){
            session()->put('login',true);
            session()->put('id',$user->id);
            session()->put('role',$user->role);
            session()->put('username',$user->username);
            session()->put('email',$user->email);
            session()->put('mobile',$user->mobile);
            session()->put('login_with_key',"no");
            $setting = Setting::where('user_id',Session::get('id'))->first();
            if($setting && $setting->two_factor_authentication==1){
                $otp = rand(1111,9999);
                $user->otp = $otp;
                $user->save();
                // Send OTP
                $this->sendOtp($otp);
            }
            if($user->role==1){
                #Check Settings
                if($setting && $setting->by_default_home!=''){
                    if($setting->by_default_home=='settings'){
                        return redirect('/settings');
                    }
                    else if($setting->by_default_home=='calendar'){
                        return redirect('/calendar');
                    }
                    else if($setting->by_default_home=='add-student'){
                        return redirect('/admin/add-student');
                    }
                    else if($setting->by_default_home=='all-students'){
                        return redirect('/admin/all-students');
                    }
                    else if($setting->by_default_home=='add-staff'){
                        return redirect('/admin/add-staff');
                    }
                    else if($setting->by_default_home=='all-staff'){
                        return redirect('/admin/all-staff');
                    }
                    else if($setting->by_default_home=='add-batch'){
                        return redirect('/admin/add-batch');
                    }
                    else if($setting->by_default_home=='all-batch'){
                        return redirect('/admin/all-batch');
                    }
                    else if($setting->by_default_home=='manage-staff-salary'){
                        return redirect('/admin/manage-staff-salary');
                    }
                    else if($setting->by_default_home=='manage-staff-attendance'){
                        return redirect('/admin/manage-staff-attendance');
                    }
                     else if($setting->by_default_home=='theme-customizer'){
                        return redirect('/theme-customizer');
                    }
                    else{
                        return redirect('/admin');
                    }
                }
                else{
                    return redirect('/admin');
                }
            }
            elseif($user->role==2){
                if($setting && $setting->by_default_home!=''){
                    if($setting->by_default_home=='settings'){
                        return redirect('/settings');
                    }
                    else if($setting->by_default_home=='calendar'){
                        return redirect('/calendar');
                    }
                    else if($setting->by_default_home=='add-student'){
                        return redirect('/staff/add-student');
                    }
                    else if($setting->by_default_home=='all-students'){
                        return redirect('/staff/all-students');
                    }
                     else if($setting->by_default_home=='theme-customizer'){
                        return redirect('/theme-customizer');
                    }
                    else{
                        return redirect('/staff');
                    }
                }
                else{
                    return redirect('/staff');
                }
            }
            elseif($user->role==3){
                if($setting && $setting->by_default_home!=''){
                    if($setting->by_default_home=='settings'){
                        return redirect('/settings');
                    }
                    else if($setting->by_default_home=='calendar'){
                        return redirect('/calendar');
                    }
                     else if($setting->by_default_home=='theme-customizer'){
                        return redirect('/theme-customizer');
                    }
                    else{
                        return redirect('/student');
                    }
                }
                else{
                    return redirect('/student');
                }
            }
        }
        else{
            session()->flash('error','Your account has been blocked');
            return redirect()->back();
        }
       }
       else{
        session()->flash('error','Invalid Details');
        return redirect()->back();
       }
    }
    public function authWithKey(Request $req)
    {
        $req->validate([
            'key' => 'required',
           ]);
           $key = md5($req->key);
           $user = User::where('login_key',$key)->first();
           if($user){
            $user->lock_screen = 0;
            $user->save();
            if($user->status==1){
                session()->put('login',true);
                session()->put('id',$user->id);
                session()->put('role',$user->role);
                session()->put('username',$user->username);
                session()->put('email',$user->email);
                session()->put('mobile',$user->mobile);
                session()->put('login_with_key',"yes");
                $setting = Setting::where('user_id',Session::get('id'))->first();
                if($setting && $setting->two_factor_authentication==1){
                    $otp = rand(1111,9999);
                    $user->otp = $otp;
                    $user->save();
                    // Send OTP
                    $this->sendOtp($otp);
                }
                if($user->role==1){
                    #Check Settings
                if($setting && $setting->by_default_home!=''){
                    if($setting->by_default_home=='settings'){
                        return redirect('/settings');
                    }
                    else if($setting->by_default_home=='calendar'){
                        return redirect('/calendar');
                    }
                    else if($setting->by_default_home=='add-student'){
                        return redirect('/admin/add-student');
                    }
                    else if($setting->by_default_home=='all-students'){
                        return redirect('/admin/all-students');
                    }
                    else if($setting->by_default_home=='add-staff'){
                        return redirect('/admin/add-staff');
                    }
                    else if($setting->by_default_home=='all-staff'){
                        return redirect('/admin/all-staff');
                    }
                    else if($setting->by_default_home=='add-batch'){
                        return redirect('/admin/add-batch');
                    }
                    else if($setting->by_default_home=='all-batch'){
                        return redirect('/admin/all-batch');
                    }
                    else if($setting->by_default_home=='manage-staff-salary'){
                        return redirect('/admin/manage-staff-salary');
                    }
                    else if($setting->by_default_home=='manage-staff-attendance'){
                        return redirect('/admin/manage-staff-attendance');
                    }
                     else if($setting->by_default_home=='theme-customizer'){
                        return redirect('/theme-customizer');
                    }
                    else{
                        return redirect('/admin');
                    }
                }
                else{
                    return redirect('/admin');
                }
                }
                elseif($user->role==2){
                    if($setting && $setting->by_default_home!=''){
                        if($setting->by_default_home=='settings'){
                            return redirect('/settings');
                        }
                        else if($setting->by_default_home=='calendar'){
                            return redirect('/calendar');
                        }
                        else if($setting->by_default_home=='add-student'){
                            return redirect('/staff/add-student');
                        }
                        else if($setting->by_default_home=='all-students'){
                            return redirect('/staff/all-students');
                        }
                         else if($setting->by_default_home=='theme-customizer'){
                            return redirect('/theme-customizer');
                        }
                        else{
                            return redirect('/staff');
                        }
                    }
                    else{
                        return redirect('/staff');
                    }
                }
                elseif($user->role==3){
                    if($setting && $setting->by_default_home!=''){
                        if($setting->by_default_home=='settings'){
                            return redirect('/settings');
                        }
                        else if($setting->by_default_home=='calendar'){
                            return redirect('/calendar');
                        }
                         else if($setting->by_default_home=='theme-customizer'){
                            return redirect('/theme-customizer');
                        }
                        else{
                            return redirect('/student');
                        }
                    }
                    else{
                        return redirect('/student');
                    }
                }
            }
            else{
                session()->flash('key_error','Invalid Key');
            return redirect()->back();
            }
           }
           else{
            session()->flash('key_error','Invalid Key');
            return redirect()->back();
           }
    }
    public function lockscreen(Request $req)
    {
        $req->validate([
            'password' => 'required'
        ]);
        if(Session::has('login')){
            $user = User::find(Session::get('id'));
            if($user->password == md5($req->password)){
                $user->lock_screen = 0;
                $user->save();
                return redirect('/');
            }
            else{
                session()->flash('error','Invalid Password');
                return redirect()->back();
            }
        }
        else{
            return redirect('/');
        }
    }
    public function addStaff(Request $req)
    {
        $req->validate([
            'username' => 'required',
            'email' => 'required|unique:users',
            'mobile' => 'required|unique:users',
            'password' => 'required|min:6',
            'profile_pic' => 'mimes:png,jpeg,',
        ]);

        $user = new User;
        $user->username = $req->username;
        $user->email = $req->email;
        $user->mobile = $req->mobile;
        $user->password = md5($req->password);
        $user->unique_key = md5(time()).'-'.md5($req->email);
        $user->role = 2;
        $user->save();

        $more = new UserMore;
        $more->user_id = $user->id;
        $more->country = $req->country;
        $more->open_password = $req->password;
        $more->state = $req->state;
        $more->city = $req->city;
        $more->address = $req->address;
        $more->bank_name = $req->bank_name;
        $more->account_name = $req->account_name;
        $more->account_number = $req->account_number;
        $more->ifsc = $req->ifsc;
        if($req->hasFile('profile_pic')){
            $photo = $req->profile_pic;
            $filename = time().'_'.$photo->getClientOriginalName();
            $location = 'assets/images/staff-students';
            $photo->move($location,$filename);
            $more->profile_pic = $filename;
        }
        $more->save();
           // Notification Section Starts
           $this->notification('New Staff Added','Staff ('.$req->username.') added successfully in the portal.',Session::get('id'));
        
           $this->notification('Account Created','Your account created successfully.',$user->id);
           // Notification Section ends
        session()->flash('success','Staff data created successfully');
        return redirect()->back();
    }

    public function generateLoginKey(Request $req)
    {
        $user = User::find($req->id);
        $key = rand (1111111111,9999999999);
        $key = $user->id.$key;
        $hashed_key = md5($key);
        $user->login_key = $hashed_key;
        $user->save();
        return $key;
    }

    public function changeStaffStatus($user_id)
    {
        $user = User::find($user_id);
        $more  = UserMore::where('user_id',$user_id)->first();
        if($user->status==1){
            $user->status = 0;
            $more->status = 0;
        }
        else{
            $user->status = 1;
            $more->status = 1;
        }
        $user->save();
        return redirect()->back();
    }
    public function getUserName(Request $req){
        $uid =  $req->id;
        $user = User::find($uid);
        return $user->username;
    }

    public function deleteUser($user_id){
        $user = User::find($user_id);
        $user->delete();
        $img = UserMore::where('user_id',$user_id)->first();
        if($img->profile_pic!=''){
            File::delete(public_path('assets/images/staff-students/'.$img->profile_pic));
        }
        $more = DB::table('user_more')->where('user_id',$user_id)->delete();
        if($user->role==3){
            $student = Student::where('user_id',$user_id)->delete();
            $result = Result::where('user_id',$user_id)->delete();
        }
          // Notification Section Starts
          if($user->role==2){
            $role = "Staff";
          }
          else if($user->role==3){
            $role = "Student";
          }
          $this->notification($role.' Data Deleted Successfully',$user->username.' ('.$req->email.') details deleted successfully from the portal.',Session::get('id'));
          // Notification Section ends
        session()->flash('deleted','Data deleted successfully');
        return redirect()->back();
    }
    public function editStaff(Request $req){
        $req->validate([
            'username' => 'required',
            'profile_pic' => 'mimes:png,jpeg,',
        ]);

        $user = User::find($req->id);
        if($req->password!=''){
            $user->password = md5($req->password);
        }
        $user->save();

        $more = UserMore::where('user_id',$req->id)->first();
        $more->user_id = $user->id;
        if($req->password!=''){
            $more->open_password = $req->password;
        }
        if($req->country!=''){
            $more->country = $req->country;
        }
        if($req->state!=''){
            $more->state = $req->state;
        }
        if($req->city!=''){
            $more->city = $req->city;
        }
        $more->address = $req->address;
        $more->bank_name = $req->bank_name;
        $more->account_name = $req->account_name;
        $more->account_number = $req->account_number;
        $more->ifsc = $req->ifsc;
        if($req->hasFile('profile_pic')){
            $photo = $req->profile_pic;
            $filename = time().'_'.$photo->getClientOriginalName();
            $location = 'assets/images/staff-students';
            $photo->move($location,$filename);
            $more->profile_pic = $filename;
        }
        $more->save();
          // Notification Section Starts
          $this->notification('Staff Details Updated','Staff ('.$req->username.') details updated successfully in the portal.',Session::get('id'));
          // Notification Section ends
        session()->flash('success','Staff data updated successfully');
        return redirect()->back();
    }
    public function logout()
    {
        session()->forget('login');
        session()->forget('id');
        session()->forget('role');
        session()->forget('username');
        session()->forget('email');
        session()->forget('mobile');
        session()->forget('login_with_key');
        return redirect('login');
    }
    public function settings(Request $req){
        #Check Settings Exists or not
        $setting = Setting::where('user_id',Session::get('id'))->first();
        if($setting){
            $setting->by_default_home = $req->by_default_home;
            if($req->show_notifications==1){
                $setting->show_notifications = 1;
            }
            else{
                $setting->show_notifications = 0;
            }
            if($req->enable_lockscreen==1){
                $setting->enable_lockscreen = 1;
            }
            else{
                $setting->enable_lockscreen = 0;
            }
            $setting->save();
        }
        else{
            $s = new Setting;
            $s->user_id = Session::get('id');
            $s->by_default_home = $req->by_default_home;
            if($req->show_notifications==1){
                $s->show_notifications = 1;
            }
            else{
                $s->show_notifications = 0;
            }
            if($req->enable_lockscreen==1){
                $s->enable_lockscreen = 1;
            }
            else{
                $s->enable_lockscreen = 0;
            }
            $s->save();
        }
        session()->flash('success','Settings updated successfully');
        return redirect()->back();
    }
    public function changePassword(Request $req){
        $req->validate([
            'old_password' => 'required',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);
       $user  = User::find(Session::get('id'));
       #Check Password
       if($user->password == md5($req->old_password)){
        $user->password = md5($req->password);
        $user->save();
        if(Session::get('role')!=1){
            $more = UserMore::where('user_id',Session::get('id'))->first();
            $more->open_password = $req->password;
            $more->save();
        }
        session()->flash('success','Password changed successfulluy');
       }
       else{
            session()->flash('invalid','Invalid old password');
        }
    return redirect()->back();
    }
    public function twoFactorAuthentication(Request $req){
         #Check Settings Exists or not
         $setting = Setting::where('user_id',Session::get('id'))->first();
         if($setting){
             if($req->two_factor_authentication==1){
                 $setting->two_factor_authentication = 1;
             }
             else{
                 $setting->two_factor_authentication = 0;
             }
             $setting->save();
         }
         else{
             $s = new Setting;
             $s->user_id = Session::get('id');
             if($req->two_factor_authentication==1){
                 $s->two_factor_authentication = 1;
             }
             else{
                 $s->two_factor_authentication = 0;
             }
             $s->save();
         }
         session()->flash('success','Settings updated successfully');
         return redirect()->back();
    }
    public function letMeVerifyYou(Request $req)
    {
        $req->validate([
            'otp' => 'required|digits:4'
        ]);
        $user = User::find(Session::get('id'));
        if($req->otp==$user->otp){
            $user->otp = '';
            $user->save();
            if($user->role==1){
                return redirect('admin');               
            }
            else if($user->role==2){
                    return redirect('staff');
            }
            else if($user->role==3){
                    return redirect('student');
            }
        }
        else{
            session()->flash('error','Invalid OTP.');
            return redirect()->back();
        }
    }
    public function resendOtp(){
        if(Session::has('login')){
            $setting = Setting::where('user_id',Session::get('id'))->first();
            if($setting && ($setting->two_factor_authentication==1)){
                $user = User::find(Session::get('id'));
                $otp = rand(1111,9999);
                $user->otp = $otp;
                $user->save();
                // Send OTP
                $this->sendOtp($otp);
                session()->flash('success','OTP sent successfully.');
                return redirect()->back();
            }
            else{
                return redirect()->back();
            }
        }   
        else{
            return redirect('login');
        }
    }

    public function sendOtp($otp){
        $user = User::find(Session::get('id'));
        $data = [
            "name" => $user->username,
            "otp" => $otp
        ];
        $sender = $user->email;
        $userMail = Mail::send('email.otp', $data, function($message) use($sender) {
         $message->to($sender)->subject
            ('Two Factor Authentication');
         $message->from('noreply@key2success.info','Key 2 Success');
      });
    }

    public function sendResetPasswordLink($email,$link){
        $user = User::where('email',$email)->first();
        $data = [
            "name" => $user->username,
            "link" => $link
        ];
        $sender = $email;
        $userMail = Mail::send('email.reset-password', $data, function($message) use($sender) {
         $message->to($sender)->subject
            ('Reset Password');
         $message->from('noreply@key2success.info','Key 2 Success');
      });
    }

    public function forgetPassword(Request $req){
        $req->validate([
            'email' => 'required'
        ]);
        $email = $req->email;
        $user = User::where('email',$email)->first();
        if($user){
            $link = md5(Carbon::now()).'-'.md5($user->mobile).'-reset-portal-password';
            $expiry = Carbon::now()->addDays('2');
            $user->reset_password_link = $link;
            $user->reset_password_link_expiry = $expiry;
            $user->save();
            $this->sendResetPasswordLink($user->email,$link);
            session()->flash('success','Link sent successfully!');
            return redirect()->back();
        }
        else{
            session()->flash('error','This email address does not exist in our database.');
            return redirect()->back();
        }
    }
    public function resetPassword(Request $req){
        $req->validate([
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password'
        ]);
        $user = User::find($req->id);
        $user->password = md5($req->new_password);
        $user->reset_password_link = null;
        $user->reset_password_link_expiry = null;
        $user->save();
        if($user->role!=1){
            $more = UserMore::where('user_id',$req->id)->first();
            if($more){
                $more->open_password = $req->new_password;
                $more->save();
            }
        }
        session()->flash('success','Password reset successfully.');
        return redirect('login');
    }
    public function forgetPasswordOnLockscreen(){
        $user = User::find(Session::get('id'));
        if($user){
            $link = md5(Carbon::now()).'-'.md5($user->mobile).'-reset-portal-password';
            $expiry = Carbon::now()->addDays('2');
            $user->reset_password_link = $link;
            $user->reset_password_link_expiry = $expiry;
            $user->save();
            $this->sendResetPasswordLink($user->email,$link);
            session()->flash('success','Link sent successfully!');
            $this->logout();
            return redirect('login');

        }
    }
    public function viewNotification(Request $req,$id){
        $notification = Notification::find($id);
        if($notification->user_id == Session::get('id')){
            if(empty($req->mark)){
                $notification->status = 0;
                $notification->save();
            }
            return view('view-notification',compact('notification'));
        }
        else{
            return redirect()->back();
        }
    }
    public function changeNotificationStatus($id){
        $notification = Notification::find($id);
        if($notification->user_id == Session::get('id')){
            if($notification->status==0){
                $notification->status = 1;
                $notification->save();
                return redirect('view-notification/'.$id.'?mark=unread');
            }
            else{
                $notification->status = 0;
                $notification->save();
                return redirect('view-notification/'.$id.'?mark=read');
            }
        }
        else{
            return redirect()->back();
        }
    }
    public function allNotifications(){
        $notifications = Notification::where('user_id',Session::get('id'))->orderBy('created_at','desc')->paginate(10);
        return view('all-notifications',compact('notifications'));
    }
    public function markAllNotificationsAsRead(){
        $notifications = Notification::where('user_id',Session::get('id'))->get();
        foreach($notifications as $notification){
            $notification->status = 0;
            $notification->save();
        }
        return redirect()->back();
    }
    public function deleteNotification($id){
        $notification = Notification::find($id);
        if($notification->user_id == Session::get('id')){
                $notification->delete();
                return redirect('/');
        }
        else{
            return redirect()->back();
        }
    }
    public function saveCustomNotification(Request $req){
        $req->validate([
            'title' => 'required|min:6|max:30',
            'description' => 'required',
            'notification_for' => 'required',
        ]);
       if($req->notification_for==1){
            $users = User::where('id','!=',Session::get('id'))->where('status',1)->get();
            foreach($users as $user){
                $this->notification($req->title,$req->description,$user->id);
            }
       }
       else if($req->notification_for==2){
            $users = User::where('role',2)->where('status',1)->get();
            foreach($users as $user){
                $this->notification($req->title,$req->description,$user->id);
            }
       }
       else if($req->notification_for==3){
            $users = User::where('role',3)->where('status',1)->get();
            foreach($users as $user){
                $this->notification($req->title,$req->description,$user->id);
            }
       }
       else if($req->notification_for==4){
            $users = $req->user;
            foreach($users as $user){
                $this->notification($req->title,$req->description,$user);
            }
       }
       session()->flash('success','Notification Added Successfully.');
       return redirect()->back();
    }
}