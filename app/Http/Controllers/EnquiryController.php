<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\User;
use App\Models\Permission;
use App\Models\Notification;
use Session;
use Carbon\Carbon;
class EnquiryController extends Controller
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
    public function addEnquiry(Request $req){
        if($this->permission('Add Enquiry')){
            $type = $req->type;
            $branch = $req->branch;
            if(isset($type) && $type!='' && isset($branch) && $branch!=''){
                return view('add-enquiry',compact('type','branch'));
            }
            else{
                return view('add-enquiry');
            }
        }
        else{
            return redirect()->back();
        }
    }
    public function saveEnquiry(Request $req){
        $enq = new Enquiry;
        $enq->added_by = Session::get('id');
        $enq->branch = $req->branch;
        $enq->type = $req->type;
        $enq->name = $req->name;
        $enq->email = $req->email;
        $enq->mobile = $req->mobile;
        $enq->reference = $req->reference;
        $enq->full_address = $req->full_address;
        if($req->type=='ielts' || $req->type=='pte'){
            $enq->highest_qualification_name = $req->highest_qualification_name;
            $enq->highest_qualification_percent = $req->highest_qualification_percent;
            $enq->highest_qualification_year = $req->highest_qualification_year;
        }
        else if($req->type=='Study Visa'){
            $enq->tenth_name = $req->tenth_name;
            $enq->tenth_start = $req->tenth_start;
            $enq->tenth_end = $req->tenth_end;
            $enq->tenth_percent = $req->tenth_percent;
            $enq->twlefth_name = $req->twlefth_name;
            $enq->twlefth_start = $req->twlefth_start;
            $enq->twlefth_end = $req->twlefth_end;
            $enq->twlefth_percent = $req->twlefth_percent;
            $enq->bachelor_name = $req->bachelor_name;
            $enq->bachelor_start = $req->bachelor_start;
            $enq->bachelor_end = $req->bachelor_end;
            $enq->bachelor_percent = $req->bachelor_percent;
            $enq->master_name = $req->master_name;
            $enq->master_start = $req->master_start;
            $enq->master_end = $req->master_end;
            $enq->master_percent = $req->master_percent;
            $enq->diploma_name = $req->diploma_name;
            $enq->diploma_start = $req->diploma_start;
            $enq->diploma_end = $req->diploma_end;
            $enq->diploma_percent = $req->diploma_percent;
            $enq->course_of_interest = $req->course_of_interest;
            $enq->preferred_location = $req->preferred_location;
            $enq->field_of_interest = $req->field_of_interest;
            $enq->done_ielts_or_pte = $req->done_ielts_or_pte;
            if(isset($req->overall)){
                $enq->overall = $req->overall;
            }
            if(isset($req->listening)){
                $enq->listening = $req->listening;
            }
            if(isset($req->reading)){
                $enq->reading = $req->reading;
            }
            if(isset($req->writing)){
                $enq->writing = $req->writing;
            }
            if(isset($req->speaking)){
                $enq->speaking = $req->speaking;
            }
            #Break Country
             if($req->country_of_interest){
                $country = implode(',',$req->country_of_interest);
                $enq->country_of_interest = $country;
             }
            if($req->intake){
                $intake = implode(',',$req->intake);
                $enq->intake = $intake;
            }
        }
        $enq->save();
        // Notification Section Starts
        $this->notification('Enquiry Added','Enquiry Added successfully of '.$req->name.'('.$req->email.')',Session::get('id'));
        // Notification Section ends
        session()->flash('success','Enquiry added successfully');
        return redirect()->back();
    }
    public function allEnquiries(Request $req){
        if($this->permission('View Enquiries')){
            $key = '';
            if(isset($req->enquiry) && $req->enquiry!=''){
                $key = $req->enquiry;
                $enquiries = Enquiry::orderBy('id','desc')->where(function($query) use ($key){
                    $query->where('name','LIKE','%'.$key.'%')->orWhere('email','LIKE','%'.$key.'%')->orWhere('mobile',$key)->orWhere('country_of_interest','LIKE','%'.$key.'%');
                })->get();
            }
            else{
                $enquiries = Enquiry::orderBy('id','desc')->get();
            }
            return view('all-enquiries',compact('enquiries','key'));
        }
        else{
            return redirect()->back();
        }
    }
    public function viewEnquiry($id){
        $e = Enquiry::find($id);
        return view('view-enquiry',compact('e'));
    }
    public function updateEnquiry(Request $req){
        $e = Enquiry::find($req->id);
        $e->enquiry_status = $req->enquiry_status;
        $e->enquiry_remarks = $req->enquiry_remarks;
        $e->save();
        // Notification Section Starts
        $this->notification('Enquiry Updated','Enquiry Updated successfully of '.$e->name.'('.$e->email.')',Session::get('id'));
        // Notification Section ends
        session()->flash('success','Enquiry Updated');
        return redirect()->back();
    }
    public function deleteEnquiry($id){
        $enq = Enquiry::find($id);
        $enq->delete();
        session()->flash('deleted','Enquiry deleted successfully');
        return redirect()->back();
    }
    
    public function addUniversalEnquiry(Request $req){
       $type = $req->type;
            $branch = $req->branch;
            if(isset($type) && $type!='' && isset($branch) && $branch!=''){
                return view('add-universal-enquiry',compact('type','branch'));
            }
            else{
                return view('add-universal-enquiry');
            }
    }
    public function saveUniversalEnquiry(Request $req){
            $enq = new Enquiry;
        $enq->added_by = Session::get('id');
        $enq->branch = $req->branch;
        $enq->type = $req->type;
        $enq->name = $req->name;
        $enq->email = $req->email;
        $enq->mobile = $req->mobile;
         $enq->reference = $req->reference;
        $enq->full_address = $req->full_address;
        if($req->type=='ielts' || $req->type=='pte'){
            $enq->highest_qualification_name = $req->highest_qualification_name;
            $enq->highest_qualification_percent = $req->highest_qualification_percent;
            $enq->highest_qualification_year = $req->highest_qualification_year;
        }
        else if($req->type=='Study Visa'){
            $enq->tenth_name = $req->tenth_name;
            $enq->tenth_start = $req->tenth_start;
            $enq->tenth_end = $req->tenth_end;
            $enq->tenth_percent = $req->tenth_percent;
            $enq->twlefth_name = $req->twlefth_name;
            $enq->twlefth_start = $req->twlefth_start;
            $enq->twlefth_end = $req->twlefth_end;
            $enq->twlefth_percent = $req->twlefth_percent;
            $enq->bachelor_name = $req->bachelor_name;
            $enq->bachelor_start = $req->bachelor_start;
            $enq->bachelor_end = $req->bachelor_end;
            $enq->bachelor_percent = $req->bachelor_percent;
            $enq->master_name = $req->master_name;
            $enq->master_start = $req->master_start;
            $enq->master_end = $req->master_end;
            $enq->master_percent = $req->master_percent;
            $enq->diploma_name = $req->diploma_name;
            $enq->diploma_start = $req->diploma_start;
            $enq->diploma_end = $req->diploma_end;
            $enq->diploma_percent = $req->diploma_percent;
            $enq->course_of_interest = $req->course_of_interest;
            $enq->preferred_location = $req->preferred_location;
            $enq->field_of_interest = $req->field_of_interest;
            $enq->done_ielts_or_pte = $req->done_ielts_or_pte;
            if(isset($req->overall)){
                $enq->overall = $req->overall;
            }
            if(isset($req->listening)){
                $enq->listening = $req->listening;
            }
            if(isset($req->reading)){
                $enq->reading = $req->reading;
            }
            if(isset($req->writing)){
                $enq->writing = $req->writing;
            }
            if(isset($req->speaking)){
                $enq->speaking = $req->speaking;
            }
            #Break Country
            if($req->country_of_interest){
                 $country = implode(',',$req->country_of_interest);
                $enq->country_of_interest = $country;
            }
           if($req->intake){
                $intake = implode(',',$req->intake);
                $enq->intake = $intake;
           }
        }
          else if($req->type=='Tourist Visa'){
            $enq->tenth_name = $req->tenth_name;
            $enq->tenth_start = $req->tenth_start;
            $enq->tenth_end = $req->tenth_end;
            $enq->tenth_percent = $req->tenth_percent;
            $enq->twlefth_name = $req->twlefth_name;
            $enq->twlefth_start = $req->twlefth_start;
            $enq->twlefth_end = $req->twlefth_end;
            $enq->twlefth_percent = $req->twlefth_percent;
            $enq->bachelor_name = $req->bachelor_name;
            $enq->bachelor_start = $req->bachelor_start;
            $enq->bachelor_end = $req->bachelor_end;
            $enq->bachelor_percent = $req->bachelor_percent;
            $enq->master_name = $req->master_name;
            $enq->master_start = $req->master_start;
            $enq->master_end = $req->master_end;
            $enq->master_percent = $req->master_percent;
            $enq->diploma_name = $req->diploma_name;
            $enq->diploma_start = $req->diploma_start;
            $enq->diploma_end = $req->diploma_end;
            $enq->diploma_percent = $req->diploma_percent;
            $enq->course_of_interest = $req->course_of_interest;
            $enq->preferred_location = $req->preferred_location;
            $enq->field_of_interest = $req->field_of_interest;
            $enq->done_ielts_or_pte = $req->done_ielts_or_pte;
            if(isset($req->overall)){
                $enq->overall = $req->overall;
            }
            if(isset($req->listening)){
                $enq->listening = $req->listening;
            }
            if(isset($req->reading)){
                $enq->reading = $req->reading;
            }
            if(isset($req->writing)){
                $enq->writing = $req->writing;
            }
            if(isset($req->speaking)){
                $enq->speaking = $req->speaking;
            }
            #Break Country
            if($req->country_of_interest){
                 $country = implode(',',$req->country_of_interest);
                $enq->country_of_interest = $country;
            }
           if($req->intake){
                $intake = implode(',',$req->intake);
                $enq->intake = $intake;
           }
        }
        $enq->save();
       
        session()->flash('success','Enquiry added successfully');
        return redirect()->back();
    }
}
