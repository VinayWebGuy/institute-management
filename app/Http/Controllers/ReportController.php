<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Expense;
use App\Models\Permission;
use App\Models\Enquiry;
use App\Models\Notification;
use Session;
use DB;
use Carbon\Carbon;
use PDF;

class ReportController extends Controller
{
    public function notification($title,$desc,$user_id){
        $n = new Notification;
        $n->title = $title;
        $n->description = $desc;
        $n->user_id = $user_id;
        $n->added_on = Carbon::now();
        $n->save();
    }
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
    public function reports(){
        if($this->permission('Reports')){
            return view('reports');
        }
        else{
            return redirect()->back();
        }
    }
    public function generateReport(Request $req){
        $kind = $req->kind;
        if($kind=='expense'){
            if($req->types=='all'){
                $expenses = Expense::whereBetween('added_on',[$req->fromDate,$req->toDate])->orderBy('added_on','desc')->get();
            }
            else{
                $expenses = Expense::whereBetween('added_on',[$req->fromDate,$req->toDate])->where('type',$req->types)->orderBy('added_on','desc')->get();
            }
            $pdf = PDF::loadView('reports.expenses',compact('expenses'));
            // Notification Section Starts
            $this->notification('Report Generated','Expense Report Generated Successfully',Session::get('id'));
            // Notification Section ends
            return $pdf->download('expenses-report.pdf');
        }
        else if($kind=='student'){
            $columns = $req->column;
            $users = User::where('role',3)->orderBy('username','desc')->get();
            $pdf = PDF::loadView('reports.students',compact('users','columns'));
            // Notification Section Starts
            $this->notification('Report Generated','Student Report Generated Successfully',Session::get('id'));
            // Notification Section ends
            return $pdf->download('student-report.pdf');
        }
        else if($kind=='staff'){
            $columns = $req->column;
            $users = User::where('role',2)->orderBy('username','desc')->get();
            $pdf = PDF::loadView('reports.staff',compact('users','columns'));
            // Notification Section Starts
          $this->notification('Report Generated','Staff Report Generated Successfully',Session::get('id'));
          // Notification Section ends
          return $pdf->download('staff-report.pdf');
        }
    }
    public function createPDF(){
      $users = User::get();
      $pdf = PDF::loadView('reports.all-users',compact('users'));
      return $pdf->download('myfile.pdf');
    }
    public function downloadEnglishEnquiry($id){
        $e = Enquiry::find($id);
        $pdf = PDF::loadView('reports.english-enquiry',compact('e'));
          // Notification Section Starts
          $this->notification('Report Generated','Enquiry Report Generated Successfully',Session::get('id'));
          // Notification Section ends
        return $pdf->download('enquiry-report.pdf');
    }
    public function downloadStudyVisaEnquiry($id){
        $e = Enquiry::find($id);
        $pdf = PDF::loadView('reports.study-visa-enquiry',compact('e'));
          // Notification Section Starts
          $this->notification('Report Generated','Enquiry Report Generated Successfully',Session::get('id'));
          // Notification Section ends
        return $pdf->download('enquiry-report.pdf');
    }
}
