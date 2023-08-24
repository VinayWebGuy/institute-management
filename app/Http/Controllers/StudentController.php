<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\User;
use App\Models\UserMore;
use App\Models\Student;
use App\Models\Result;
use App\Models\Expense;
use App\Models\Batch;
use App\Models\Fees;
use App\Models\StudyMaterial;
use App\Models\Permission;
use App\Models\Notification;
use App\Models\StudentAttendance;
use File;
use Carbon\Carbon;
use Session;


class StudentController extends Controller
{
    public function permission($prm){
        $havePer = false;
        $per = Permission::where('user_id',Session::get('id'))->first();
        if($per){
            $havePer = true;
            $p = $per->permission;
            $br_p = explode(',',$p);
        }
        if(Session::get('role')==1 || (Session::get('role')==2 && $havePer &&  in_array($prm, $br_p))){
            return true;
        }
    }

    public function notification($title,$desc,$user_id){
        $n = new Notification;
        $n->title = $title;
        $n->description = $desc;
        $n->user_id = $user_id;
        $n->added_on = Carbon::now();
        $n->save();
    }

    public function addStudent(){
        $countries = Country::all();
        $batch = Batch::where('status',1)->orderBy('name','asc')->get();
        if($this->permission('Add Student')){
            return view('add-student',compact('countries','batch'));
        }
        else{
            return redirect()->back();
        }
        
    }
    public function saveStudent(Request $req){
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
        $user->role = 3;
        $user->save();

        $more = new UserMore;
        $more->user_id = $user->id;
        $more->country = $req->country;
        $more->open_password = $req->password;
        $more->state = $req->state;
        $more->city = $req->city;
        $more->address = $req->address;
        if($req->hasFile('profile_pic')){
            $photo = $req->profile_pic;
            $filename = time().'_'.$photo->getClientOriginalName();
            $location = 'assets/images/staff-students';
            $photo->move($location,$filename);
            $more->profile_pic = $filename;
        }
        $more->save();

        $student = new Student;
        $student->user_id = $user->id;
        $student->username = $req->username;
        $student->father_name = $req->father_name;
        $student->mother_name = $req->mother_name;
        $student->course_type = $req->course_type;
        $student->course_duration = $req->course_duration;
        $student->status = $req->student_status;
        $student->batch_id = $req->batch;
        $student->demo_date = $req->demo_class_date;
        $student->enrollment_date = $req->enrollment_date;
        $student->dob = $req->dob;
        $student->gender = $req->gender;
        if($req->hasFile('passport')){
            $passport = $req->passport;
            $filename2 = time().'_'.$passport->getClientOriginalName();
            $location = 'assets/documents';
            $passport->move($location,$filename2);
            $student->passport = $filename2;
        }
        $student->save();
        $result = new Result;
        $result->user_id = $user->id;
        $result->student_id = $student->id;
        $result->test_date = $req->test_date;
        $result->trf_no = $req->trf_no;
        $result->test_result_date = $req->test_result_date;
        $result->overall_score = $req->overall_score;
        $result->reading_score = $req->reading_score;
        $result->writing_score = $req->writing_score;
        $result->listening_score = $req->listening_score;
        $result->speaking_score = $req->speaking_score;
        if($req->hasFile('trf')){
            $trf = $req->trf;
            $filename3 = time().'_'.$trf->getClientOriginalName();
            $location = 'assets/documents';
            $trf->move($location,$filename3);
            $result->trf = $filename3;
        }
        $result->save();
        session()->flash('success','Student data created successfully');
        // Notification Section Starts
        $this->notification('New Student Added','Student ('.$req->username.') added successfully in the portal.',Session::get('id'));
        
        $this->notification('Account Created','Your account created successfully.',$user->id);
        // Notification Section ends
        return redirect()->back();
    }
    public function allStudents(){
        if($this->permission('All Students')){
            $key = '';
            if(isset($req->student) && $req->student!=''){
                $key = $req->student;
                $users = User::orderBy('id','desc')->where('role',3)->where(function($query) use ($key){
                    $query->where('username','LIKE','%'.$key.'%')->orWhere('email','LIKE','%'.$key.'%')->orWhere('mobile',$key);
                })->get();
            }
            else{
                $users = User::where('role',3)->orderBy('id','desc')->get();
            }
            return view('all-students',compact('users','key'));
        }
        else{
            return redirect()->back();
        }
    }
    public function editStudent($user_id){
        $user = User::find($user_id);
        $countries = Country::all();
        $batch = Batch::where('status',1)->orderBy('name','asc')->get();
        if($this->permission('Edit Student')){
            return view('edit-student',compact('user','countries','batch'));
        }
        else{
            return redirect()->back();
        }
    }
    public function updateStudent(Request $req){
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
        if($req->hasFile('profile_pic')){
            $photo = $req->profile_pic;
            $filename = time().'_'.$photo->getClientOriginalName();
            $location = 'assets/images/staff-students';
            $photo->move($location,$filename);
            $more->profile_pic = $filename;
        }
        $more->save();

        $student = Student::where('user_id',$req->id)->first();
        $student->username = $req->username;
        $student->father_name = $req->father_name;
        $student->mother_name = $req->mother_name;
        $student->course_type = $req->course_type;
        $student->course_duration = $req->course_duration;
        $student->status = $req->student_status;
        $student->batch_id = $req->batch;
        $student->demo_date = $req->demo_class_date;
        $student->enrollment_date = $req->enrollment_date;
        $student->dob = $req->dob;
        $student->gender = $req->gender;
        if($req->hasFile('passport')){
            $passport = $req->passport;
            $filename2 = time().'_'.$passport->getClientOriginalName();
            $location = 'assets/documents';
            $passport->move($location,$filename2);
            $student->passport = $filename2;
        }
        $student->save();

        $result = Result::where('user_id',$req->id)->first();
        $result->test_date = $req->test_date;
        $result->trf_no = $req->trf_no;
        $result->test_result_date = $req->test_result_date;
        $result->overall_score = $req->overall_score;
        $result->reading_score = $req->reading_score;
        $result->writing_score = $req->writing_score;
        $result->listening_score = $req->listening_score;
        $result->speaking_score = $req->speaking_score;
        if($req->hasFile('trf')){
            $trf = $req->trf;
            $filename3 = time().'_'.$trf->getClientOriginalName();
            $location = 'assets/documents';
            $trf->move($location,$filename3);
            $result->trf = $filename3;
        }
        $result->save();
        session()->flash('success','Student data updated successfully');
         // Notification Section Starts
         $this->notification('Student Details Updated','Student ('.$req->username.') details updated successfully in the portal.',Session::get('id'));
         // Notification Section ends
        return redirect()->back();
    }
    public function manageStudentAttendance(Request $req){
        if($this->permission('Student Attendance')){
            $key = '';
            if(isset($req->student) && $req->student!=''){
                $key = $req->student;
                $users = User::orderBy('id','desc')->where('role',3)->where(function($query) use ($key){
                    $query->where('username','LIKE','%'.$key.'%')->orWhere('email','LIKE','%'.$key.'%')->orWhere('mobile',$key);
                })->get();
            }
            else{
                $users = User::where('role',3)->get();
            }
            return view('manage-student-attendance',compact('users','key'));
        }
        else{
            return redirect()->back();
        }
    }
    public function manageStudentFees(){
        if($this->permission('Student Fees')){
            $key = '';
            if(isset($req->student) && $req->student!=''){
                $key = $req->student;
                $users = User::orderBy('id','desc')->where('role',3)->where(function($query) use ($key){
                    $query->where('username','LIKE','%'.$key.'%')->orWhere('email','LIKE','%'.$key.'%')->orWhere('mobile',$key);
                })->get();
            }
            else{
                $users = User::where('role',3)->get();
            }
            return view('manage-student-fees',compact('users','key'));
        }
        else{
            return redirect()->back();
        }
    }
    public function addStudentFees($key){
        if($this->permission('Student Fees')){
            $user = User::where('unique_key',$key)->first();
            $fees = Fees::where('user_id',$user->id)->first();
            if($fees){
                return view('add-student-fees',compact('user','fees'));
            }
            else{
                return view('add-student-fees',compact('user'));
            }
        }
        else{
            return redirect()->back();
        }
    }
    public function saveStudentFees(Request $req){
       #Check Fees exists or not
       $f = Fees::where('user_id',$req->id)->first();

       $usr = User::find($req->id);
       #Implode
       $fees = implode('|',$req->fees);
       $received_date = implode('|',$req->fee_received_date);
       $due_date = implode('|',$req->next_due_date);
       $row=  count($req->fees);
       if($f){
        $f->rows = $row;
        $f->fees = $fees;
        $f->fee_received_date = $received_date;
        $f->next_due_date = $due_date;
        $f->added_by = Session::get('id');
        $f->save();

         #Expense
         $checkExpense = Expense::where('payment_id',$f->id)->delete();
         $fss = $req->fees;
         $x = 0;
         foreach($fss as $fs){
            $exp = new Expense;
            $exp->type = 'credit';
            $exp->user_id = $req->id;
            $exp->payment_id = $f->id;
            $exp->value = $req->fees[$x];
            $exp->what = "Student Fees";
            $exp->description = "Fees updated of ".$usr->username.".";
            $exp->added_on = $req->fee_received_date[$x];
            $exp->save();
            $x++;
         }
       }
       else{
        $model  = new Fees;
        $student = Student::where('user_id',$req->id)->first();
        $model->user_id = $req->id;
        $model->student_id = $student->id;
        $model->rows = $row;
        $model->fees = $fees;
        $model->fee_received_date = $received_date;
        $model->next_due_date = $due_date;
        $model->added_by = Session::get('id');
        $model->save();
        $fss = $req->fees;
        $x = 0;
        foreach($fss as $fs){
            $exp = new Expense;
            $exp->type = 'credit';
            $exp->user_id = $req->id;
            $exp->payment_id = $model->id;
            $exp->value = $req->fees[$x];
            $exp->what = "Student Fees";
            $exp->description = "Fees updated of ".$usr->username.".";
            $exp->added_on = $req->fee_received_date[$x];
            $exp->save();
            $x++;
         }
       }
       session()->flash('success','Fees updated successfully');
       return redirect()->back();
    }
    public function addStudyMaterial(){
        if($this->permission('Add Study Material')){
            return view('add-study-material');
        }
        else{
            return redirect()->back();
        }
    }
    public function saveStudyMaterial(Request $req){
        $req->validate([
            'title' => 'required',
            'for' => 'required',
            'file' => 'required'
        ]);
        $model = new StudyMaterial;
        $model->title = $req->title;
        $model->description = $req->description;
        $model->type = $req->type;
        $model->for = $req->for;
        $model->added_by = Session::get('id');
        $files = $req->file('file');
        if ($req->hasFile('file')){
                foreach ($files as $file){
                    $filename = time().'-'.$req->title.'-'.$file->getClientOriginalName();
                    $location = 'assets/study_materials';
                    $file->move($location,$filename);
                    $arr[] = $filename;
                }
                $material = implode("|", $arr);
            }
            else{
                $material = '';
            }
        $model->file = $material;
        $model->save();
        session()->flash('success','Study material added successfully!');
        return redirect()->back();
    }
    public function allStudyMaterials(Request $req){
        if($this->permission('View Study Material')){
            $key = '';
            if(isset($req->file) && $req->file!=''){
                $key = $req->file;
                $materials = StudyMaterial::orderBy('id','desc')->where(function($query) use ($key){
                    $query->where('title','LIKE','%'.$key.'%')->orWhere('type','LIKE','%'.$key.'%')->orWhere('for',$key);
                })->get();
            }
            else{
                $materials = StudyMaterial::orderBy('id','desc')->get();
            }
            return view('all-study-materials',compact('materials','key'));
        }
        else{
            return redirect()->back();
        }
    }
    public function changeStudyMaterialStatus($id){
        $s = StudyMaterial::find($id);
        if($s->status==1){
            $s->status = 0;
        }
        else{
            $s->status = 1;
        }
        $s->save();
        session()->flash('success','Status updated successfully');
        return redirect()->back();
    }
    public function deleteStudyMaterial($id){
        if($this->permission('Delete Study Material')){
            $sm = StudyMaterial::find($id);
            $br_sm = explode(',',$sm->file);
            $count = count($br_sm);
            for($i=0;$i<$count;$i++){
                # Delete files from folder
                File::delete(public_path('assets/study_materials/'.$br_sm[$i]));
            }
            $sm->delete();
            session()->flash('deleted','Study material deleted successfully.');
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }
    public function changeStudentStatus($id){
        $user  = User::find($id);
        $more  = UserMore::where('user_id',$id)->first();
        $student  = Student::where('user_id',$id)->first();
        if($user->status==1){
            $user->status=0;
            $more->status=0;
            $student->user_status=0;
        }
        else{
            $user->status = 1;
            $more->status = 1;
            $student->user_status = 1;
        }
        $user->save();
        $more->save();
        $student->save();
        session()->flash('success','Status updated');
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
        if($req->hasFile('profile_pic')){
            $photo = $req->profile_pic;
            $filename = time().'_'.$photo->getClientOriginalName();
            $location = 'assets/images/staff-students';
            $photo->move($location,$filename);
            $more->profile_pic = $filename;
        }
        $more->save();
         // Notification Section Starts
         $this->notification('Profile Updated','Profile Updated Successfully.',Session::get('id'));
         // Notification Section ends
        session()->flash('success','Profile updated successfully');
        return redirect()->back();
    }
    public function studyMaterial(Request $req){
        $student = Student::where('user_id',Session::get('id'))->first();
        $key = '';
        if($student->course_type!=''){
            if(isset($req->file) && $req->file!=''){
                $key = $req->file;
            }
            if($student->course_type=="ielts"){
                if($key!=''){
                    $materials = StudyMaterial::where('status',1)
                    ->where(function($query){
                        $query->where('for','all')->orWhere('for','ielts');
                    })->orderBy('id','desc')->where(function($q) use ($key){
                    $q->where('title','LIKE','%'.$key.'%')->orWhere('type','LIKE','%'.$key.'%')->orWhere('for',$key);
                })->get();
                }
                else{
                    $materials = StudyMaterial::where('status',1)
                    ->where(function($query){
                        $query->where('for','all')->orWhere('for','ielts');
                    })->orderBy('id','desc')->get();
                }
                
            }
            elseif($student->course_type=="pte"){
                if($key!=''){
                    $materials = StudyMaterial::where('status',1)
                    ->where(function($query){
                        $query->where('for','all')->orWhere('for','pte');
                    })->orderBy('id','desc')->where(function($q) use ($key){
                    $q->where('title','LIKE','%'.$key.'%')->orWhere('type','LIKE','%'.$key.'%')->orWhere('for',$key);
                    })->get();
                }
                else{
                    $materials = StudyMaterial::where('status',1)
                    ->where(function($query){
                        $query->where('for','all')->orWhere('for','pte');
                    })->orderBy('id','desc')->get();
                }
               
            }
            return view('study-material',compact('materials','key'));
        }
        else{
            return redirect()->back();
        }
    }
    public function todayAttendance(){
        $att = StudentAttendance::where('date',date('Y-m-d'))->where('user_id',Session::get('id'))->first();
        return view('today-attendance',compact('att'));
    }
    public function overallAttendance(Request $req){
        $key = '';
        if(isset($req->date) && $req->date!=''){
            $key = $req->date;
        }
        if($key!=''){
            $attendance = StudentAttendance::where('user_id',Session::get('id'))->where('date',$key)->orderBy('date','desc')->get();
        }
        else{
            $attendance = StudentAttendance::where('user_id',Session::get('id'))->orderBy('date','desc')->get();
        }
        return view('overall-attendance',compact('attendance','key'));
    }
    public function studentAttendance(Request $req,$id){
        $key = '';
        if(isset($req->date) && $req->date!=''){
            $key = $req->date;
        }
        if($key!=''){
            $attendance = StudentAttendance::where('user_id',$id)->where('date',$key)->orderBy('date','desc')->get();
        }
        else{
            $attendance = StudentAttendance::where('user_id',$id)->orderBy('date','desc')->get();
        }
        return view('student-attendance',compact('attendance','key'));
    }
}