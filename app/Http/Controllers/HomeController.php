<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Session;
use DB;
use Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserMore;
use App\Models\City;
use App\Models\State;
use App\Models\Country;
use App\Models\Setting;
use App\Models\Expense;
use App\Models\Student;
use App\Models\Permission;
use App\Models\Notification;
use App\Models\Help;
use Location; 
use Agent; 

class HomeController extends Controller
{
    public function permission($prm){
        $havePer = false;
        $per = Permission::where('user_id',Session::get('id'))->first();
        if($per){
            $havePer = true;
            $p = $per->permission;
            $br_p = explode(',',$p);
        }
        if(Session::get('role')!=2 || (Session::get('role')==2 && $havePer &&  in_array($prm, $br_p))){
            return true;
        }
    }
    public function login(){
        if(Session::has('login')){
            if(Session::get('role')==1){
                return redirect('/admin');
            }
            elseif(Session::get('role')==2){
                return redirect('/staff');
            }
           else{
            return redirect('/student');
           }
        }
        return view('login');
    }
    public function admin_index(){
        $students = User::where('role',3)->where('status',1)->count();
        $staff = User::where('role',2)->where('status',1)->count();
        $expense = Expense::where('type','debit')->sum('value');
        $income = Expense::where('type','credit')->sum('value');
        return view('admin_index',compact('students','staff','expense' ,'income'));
    }
    public function staff_index(){
        $students = User::where('role',3)->where('status',1)->count();
        $ielts_students = Student::where('course_type','ielts')->where('user_status',1)->count();
        $pte_students = Student::where('course_type','pte')->where('user_status',1)->count();
        return view('staff_index',compact('students','ielts_students','pte_students'));
    }
    public function student_index(){
        $students = User::where('role',3)->where('status',1)->count();
        $ielts_students = Student::where('course_type','ielts')->where('user_status',1)->count();
        $pte_students = Student::where('course_type','pte')->where('user_status',1)->count();
        return view('student_index',compact('students','ielts_students','pte_students'));
    }
    public function lockscreen(){
        if(Session::has('login')){
            $user = User::find(Session::get('id'));
            $user->lock_screen = 1;
            $user->save();
            if($user->lock_screen==1){
                return view('lockscreen');
            }
            else{
                return redirect('/');
            }
        }
        else{
            return redirect('/');
        }
    }
    public function addStaff()
    {
        $countries = Country::all();
        return view('add-staff',compact('countries'));
    }
    public function allStaff(Request $req)
    {
        $key = '';
        if(isset($req->staff) && $req->staff!=''){
            $key = $req->staff;
            $users = User::orderBy('id','desc')->where('role',2)->where(function($query) use ($key){
                $query->where('username','LIKE','%'.$key.'%')->orWhere('email','LIKE','%'.$key.'%')->orWhere('mobile',$key);
            })->get();
        }
        else{
            $users = User::where('role',2)->orderBy('id','desc')->get();
        }
        return view('all-staff',compact('users','key'));
    }
    public function getState(Request $req){
        $data = '<option label="Choose one"></option>';

        $cid = $req->id;
        $state = State::where('country_id',$cid)->get();
        foreach($state as $s){
            $data .= '<option value="'.$s->id.'">'.$s->name.'</option>';
        }
        return $data;
    }
    public function getCity(Request $req){
        $data = '<option label="Choose one"></option>';

        $sid = $req->id;
        $city = City::where('state_id',$sid)->get();
        foreach($city as $c){
            $data .= '<option value="'.$c->id.'">'.$c->name.'</option>';
        }
        return $data;
    }
    public function editStaff($user_id){
        $user = User::find($user_id);
        $countries = Country::all();
        return view('edit-staff',compact('user','countries'));
    }
   
    public function themeCustomizer(){
        return view('theme-customizer');
    }
    public function calendar(){
        return view('calender');
    }
    public function settings(){
        $setting = Setting::where('user_id',Session::get('id'))->first();
        if($setting){
            return view('settings', compact('setting'));
        }
        else{
            return view('settings');
        }
    }
    public function changePassword(){
        if($this->permission('Change Password')){
            return view('change-password');
        }
        else{
            return redirect()->back();
        }
    }
    public function profile(){
        if(Session::has('login_with_key') && Session::get('login_with_key')=="no"){
            $user = User::find(Session::get('id'));
            $more = UserMore::where('user_id',Session::get('id'))->first();
            $countries = Country::all();
            return view('profile',compact('user','more','countries'));
        }
        else{
            return redirect()->back();
        }
    }
    public function twoFactorAuthentication(){
        $setting = Setting::where('user_id',Session::get('id'))->first();
        return view('2fa',compact('setting'));
    }
    public function letMeVerifyYou(){
        $user = User::find(Session::get('id'));
        if($user){
            if($user->otp!=''){
                return view('let-me-verify-you');   
            }
            else{
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
        }
        else{
            return redirect('login');
        }
    }
  public function forgetPassword(){
    if(Session::has('login')){
        return redirect('/');
    }
    else{
        return view('forget-password');
    }
  }
  public function resetPassword($link){
    if(Session::has('login')){
        return redirect('/');
    }
    else{
        $user = User::where('reset_password_link',$link)->first();
        if($user){
            if($user->reset_password_link_expiry>Carbon::now()){
                return view('reset-password',compact('user'));
            }
            else{
                session()->flash('error','This link has been expired');
                return redirect('forget-password');
            }
        }
        else{
            session()->flash('error','Invalid Link.');
            return redirect('forget-password');
        }
      }
    }
    public function addCustomNotification(){
        $users = User::where('status',1)->orderBy('username','desc')->where('id','!=',Session::get('id'))->get();
        return view('add-custom-notification',compact('users'));
    }
    public function allCustomNotifications(){
        return view('all-custom-notifications');
    }

    public function addHelpBlock(){
        return view('add-help-block');
    }
    public function saveHelpBlock(Request $req){
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'for' => 'required',
        ]);
        $h = new Help;
        $h->title = $req->title;
        $h->description = $req->description;
        $h->category = $req->category;
        $h->for = $req->for;
        $h->link = $req->link;
        $h->save();
        session()->flash('success','Help Block Added');
        return redirect()->back();
    }
    public function help(Request $req){
        $key = '';
        if(Session::get('role')==1){
            if(isset($req->help) && $req->help!=''){
                $key = $req->help;
                $help = Help::where('title','LIKE','%'.$key.'%')->orderBy('id','desc')->where('status',1)->where(function($query) use ($key){
                     $query->where('for','admin')->orWhere('for','all');
                    })->get();
            }
            else{
                $help = Help::where('for','admin')->orWhere('for','all')->orderBy('id','desc')->where('status',1)->get();
            }
        }
        else if(Session::get('role')==2){
            if(isset($req->help) && $req->help!=''){
                $key = $req->help;
                $help = Help::where('title','LIKE','%'.$key.'%')->orderBy('id','desc')->where('status',1)->where(function($query) use ($key){
                     $query->where('for','staff')->orWhere('for','all');
                    })->get();
            }
            else{
                $help = Help::where('for','staff')->orWhere('for','all')->orderBy('id','desc')->where('status',1)->get();
            }
        }
        else if(Session::get('role')==2){
            if(isset($req->help) && $req->help!=''){
                $key = $req->help;
                $help = Help::where('title','LIKE','%'.$key.'%')->orderBy('id','desc')->where('status',1)->where(function($query) use ($key){
                     $query->where('for','students')->orWhere('for','all');
                    })->get();
            }
            else{
                $help = Help::where('for','students')->orWhere('for','all')->orderBy('id','desc')->where('status',1)->get();
            }
        }
        return view('help',compact('help','key'));
    }
    public function allHelpBlock(Request $req){
        $key = '';
        if(isset($req->help) && $req->help!=''){
            $key = $req->help;
            $help = Help::where('title','LIKE','%'.$key.'%')->orderBy('id','desc')->orWhere('category','LIKE','%'.$key.'%')->paginate(500);
        }
        else{
            $help = Help::orderBy('id','desc')->paginate(10);
        }
        return view('all-help-block',compact('key','help'));
    }
    public function changeHelpBlockStatus($status,$id){
        $help = Help::find($id);
        $help->status=  $status;
        $help->save();
        session()->flash('status','Updated');
        return redirect()->back();
    }
    public function editHelpBlock($id){
        $help = Help::find($id);
        return view('edit-help-block',compact('help'));
    }
    public function updateHelpBlock(Request $req){
        $req->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required',
            'for' => 'required',
        ]);
        $h =  Help::find($req->id);
        $h->title = $req->title;
        $h->description = $req->description;
        $h->category = $req->category;
        $h->for = $req->for;
        $h->link = $req->link;
        $h->save();
        session()->flash('success','Help Block Updated');
        return redirect()->back();
    }
    public function deleteHelpBlock($id){
        $help = Help::find($id);
        $help->delete();
        session()->flash('deleted','Help Block Deleted');
        return redirect()->back();
    }
}
