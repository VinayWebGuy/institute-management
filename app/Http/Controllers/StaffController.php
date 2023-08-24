<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\User;
use App\Models\UserMore;
use App\Models\Attendance;
use App\Models\Notification;
use App\Models\StudentAttendance;
use App\Models\SalaryDetails;
use App\Models\Salary;
use App\Models\Permission;
use App\Models\Expense;
use Carbon\Carbon;
use DB;

class StaffController extends Controller
{
    public function notification($title,$desc,$user_id){
        $n = new Notification;
        $n->title = $title;
        $n->description = $desc;
        $n->user_id = $user_id;
        $n->added_on = Carbon::now();
        $n->save();
    }
    public function manageStaffSalary(){
        $users = User::where('role',2)->orderBy('username','asc')->get();
        return view('manage-staff-salary',compact('users'));
    }
    public function saveStaffSalary(Request $req){
        $det = SalaryDetails::where('user_id',$req->user_id)->first();
        if($det){
            $det->salary_amount = $req->salary_amount;
            if($req->salary_date!=''){
                $det->salary_date = $req->salary_date;
            }
            $det->save();
        }
        else{
            $m = new SalaryDetails;
            $m->user_id = $req->user_id;
            $m->salary_amount = $req->salary_amount;
            $m->salary_date = $req->salary_date;
            $m->save();
        }
        session()->flash('success','Data updated');
        return redirect()->back();
    }
    public function getSalaryDetails(Request $req)
    {
       $det = SalaryDetails::where('user_id',$req->id)->first();
       if($det){
        return $det->salary_amount."|".$det->salary_date;
       }
    }
    public function manageStaffAttendance(Request $req){
        $key = '';
        if(isset($req->staff) && $req->staff!=''){
            $key = $req->staff;
            $users = User::orderBy('id','desc')->where('role',2)->where(function($query) use ($key){
                $query->where('username','LIKE','%'.$key.'%')->orWhere('email','LIKE','%'.$key.'%')->orWhere('mobile',$key);
            })->get();
        }
        else{
            $users = User::where('role',2)->get();
        }
        return view('manage-staff-attendance',compact('users','key'));
    }
    public function saveStaffAttendance(Request $req){
        $user_id =  $req->id;
        $time = $req->time;
        $today = Carbon::now();
        $date =  $today->toDateString();
        $u = User::find($user_id);
        if($u->role==2){
            $att = new Attendance;
        }
        else if($u->role==3){
            $att = new StudentAttendance;
        }
        $att->user_id = $user_id;
        $att->date = $date;
        $att->time = $time;
        $att->save();
        return "Done";
    }
   public function provideStaffSalary(Request $req){
    $key = '';
    if(isset($req->staff) && $req->staff!=''){
        $key = $req->staff;
        $users = User::orderBy('id','desc')->where('role',2)->where(function($query) use ($key){
            $query->where('username','LIKE','%'.$key.'%')->orWhere('email','LIKE','%'.$key.'%')->orWhere('mobile',$key);
        })->get();
    }
    else{
        $users = User::where('role',2)->get();
    }
    return view('provide-staff-salary',compact('users','key'));
   }
   public function addStaffSalary($key){
    $user = User::where('unique_key',$key)->first();
    $salaries = Salary::where('user_id',$user->id)->orderBy('added_on','desc')->get();
        if(count($salaries)){
            return view('add-staff-salary',compact('user','salaries'));
        }
        else{
            return view('add-staff-salary',compact('user'));
        }
    }
    public function saveSalary(Request $req){
        $usr = User::find($req->id);
        $salary = new Salary;
        $salary->user_id = $req->id;
        $salary->salary_detail_id = $req->salary_id;
        $salary->value = $req->value;
        $salary->month = $req->month;
        $salary->added_on = $req->added_on;
        $salary->save();

        $expense = new Expense;
        $expense->type = 'debit';
        $expense->user_id = $req->id;
        $expense->payment_id = $salary->id;
        $expense->value = $req->value;
        $expense->what = "Staff Salary";
        $expense->description = "Salary added of ".$usr->username.".";
        $expense->added_on = $req->added_on;
        $expense->save();
        session()->flash('success','Salary updated successully');
        return redirect()->back();
    }
    public function editStaffSalary($key,$sid){
        $user = User::where('unique_key',$key)->first();
        $salary = Salary::where('user_id',$user->id)->where('id',$sid)->first();
        if($salary){
            return view('edit-staff-salary', compact('salary','user'));
        }
    }
    public function updateSalary(Request $req){
        $salary = Salary::where('id',$req->sid)->where('user_id',$req->id)->first();
        $salary->value = $req->value;
        if($salary->month!=''){
            $salary->month = $req->month;
        }
        $salary->added_on = $req->added_on;
        $salary->save();

        $expense = Expense::where('user_id',$req->id)->where('payment_id',$req->sid)->first();
        $expense->value = $req->value;
        $expense->added_on = $req->added_on;
        $expense->save();
        session()->flash('success','Salary updated successully');
        return redirect()->back();
    }
    public function saveProfile(Request $req){
        $user = User::find(Session::get('id'));
        $user->username = $req->username;
        $user->save();

        $more = UserMore::where('user_id',Session::get('id'))->first();
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
          $this->notification('Profile Updated','Profile updated successfully!',Session::get('id'));
          // Notification Section ends
        session()->flash('success','Profile updated successfully');
        return redirect()->back();
    }
    public function manageStaffPermission($key){
        $user = User::where('unique_key',$key)->first();
        $permission = Permission::where('user_id',$user->id)->first();
        if($permission){
            return view('manage-staff-permission',compact('permission','user'));
        }
        else{
            return view('manage-staff-permission',compact('user'));
        }
    }
    public function updateStaffPermission(Request $req){
       #check permission
       $p = Permission::where('user_id',$req->user_id)->first();
        $permissions = $req->permission;
        $per = implode(',',$permissions);
        if($p){
            $p->permission = $per;
            $p->save();
        }
        else{
            $model = new Permission;
            $model->user_id = $req->user_id;
            $model->permission = $per;
            $model->save();  
        }
        session()->flash('success','Permission updated');
        return redirect()->back();
    }
    public function staffAttendance(Request $req,$id){
        $key = '';
        if(isset($req->date) && $req->date!=''){
            $key = $req->date;
        }
        if($key!=''){
            $attendance = Attendance::where('user_id',$id)->where('date',$key)->orderBy('date','desc')->get();
        }
        else{
            $attendance = Attendance::where('user_id',$id)->orderBy('date','desc')->get();
        }
        return view('staff-attendance',compact('attendance','key'));
    }
    public function todayAttendance(){
        $att = Attendance::where('date',date('Y-m-d'))->where('user_id',Session::get('id'))->first();
        return view('staff-today-attendance',compact('att'));
    }
    public function overallAttendance(Request $req){
        $key = '';
        if(isset($req->date) && $req->date!=''){
            $key = $req->date;
        }
        if($key!=''){
            $attendance = Attendance::where('user_id',Session::get('id'))->where('date',$key)->orderBy('date','desc')->get();
        }
        else{
            $attendance = Attendance::where('user_id',Session::get('id'))->orderBy('date','desc')->get();
        }
        return view('staff-overall-attendance',compact('attendance','key'));
    }
}
