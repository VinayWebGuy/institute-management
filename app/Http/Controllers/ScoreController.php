<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\IeltsScore;
use App\Models\PteScore;
use App\Models\Student;
use Session;

class ScoreController extends Controller
{
    public function manageIeltsScore(){
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
        return view('manage-ielts-score',compact('users','key'));
    }
    public function addIeltsScore(Request $req){
        $kind = $req->kind;
        $date = $req->date;
        $type = $req->type;
        $user = User::where('unique_key',$req->user_key)->first();
        #Check Score
        $score = IeltsScore::where('date',$date)->where('user_id',$user->id)->first();
        if($score){
            return view('add-ielts-score',compact('kind','user','date','type','score'));
        }
        else{
            return view('add-ielts-score',compact('kind','user','date','type'));
        }
    }
    public function saveIeltsScore(Request $req){
        if(isset($req->score_id)){
            $score = IeltsScore::find($req->score_id);
        }
        else{
            $score = new IeltsScore;
            $student = Student::where('user_id',$req->user_id)->first();
            $score->user_id = $req->user_id;
            $score->student_id = $student->id;
            $score->date = $req->date;
        }
        $score->kind = $req->kind;
        $score->type = $req->type;
        $score->overall = $req->overall;
        $score->reading = $req->reading;
        $score->writing1 = $req->writing1;
        $score->writing2 = $req->writing2;
        $score->listening = $req->listening;
        $score->speaking = $req->speaking;
        $score->added_by = Session::get('id');
        $score->save();
        session()->flash('success','Score updated');
        if(Session::get('role')==1){
            return redirect('admin/ielts/manage-score');
        }
        else{
            return redirect('staff/ielts/manage-score');
        }
    }
    public function managePteScore(){
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
        return view('manage-pte-score',compact('users','key'));
    }
    public function addPteScore(Request $req){
        $date = $req->date;
        $type = $req->type;
        $user = User::where('unique_key',$req->user_key)->first();
        #Check Score
        $score = PteScore::where('date',$date)->where('user_id',$user->id)->first();
        if($score){
            return view('add-pte-score',compact('user','date','type','score'));
        }
        else{
            return view('add-pte-score',compact('user','date','type'));
        }
    }
    public function savePteScore(Request $req){
        if(isset($req->score_id)){
            $score = PteScore::find($req->score_id);
        }
        else{
            $score = new PteScore;
            $student = Student::where('user_id',$req->user_id)->first();
            $score->user_id = $req->user_id;
            $score->student_id = $student->id;
            $score->date = $req->date;
        }
        $score->type = $req->type;
        $score->overall = $req->overall;
        $score->reading = $req->reading;
        $score->writing = $req->writing;
        $score->listening = $req->listening;
        $score->speaking = $req->speaking;
        $score->added_by = Session::get('id');
        $score->save();
        session()->flash('success','Score updated');
        if(Session::get('role')==1){
            return redirect('admin/pte/manage-score');
        }
        else{
            return redirect('staff/pte/manage-score');
        }
    }

    public function ieltsScoreReport(Request $req){
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
        return view('ielts-score-report',compact('users','key'));
    }
    public function pteScoreReport(Request $req){
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
        return view('pte-score-report',compact('users','key'));
    }
    public function todayIeltsScoreSummary($key){
        $user = User::where('unique_key',$key)->first();
        $score = IeltsScore::where('user_id',$user->id)->where('date',date('Y-m-d'))->first();
        return view('today-ielts-score-summary',compact('score','user'));
    }
    public function todayPteScoreSummary($key){
        $user = User::where('unique_key',$key)->first();
        $score = PteScore::where('user_id',$user->id)->where('date',date('Y-m-d'))->first();
        return view('today-pte-score-summary',compact('score','user'));
    }
    public function overallIeltsScoreSummary($key){
        $user = User::where('unique_key',$key)->first();
        $scores = IeltsScore::where('user_id',$user->id)->orderBy('date','desc')->get();
        return view('overall-ielts-score-summary',compact('scores','user'));
    }
    public function overallPteScoreSummary($key){
        $user = User::where('unique_key',$key)->first();
        $scores = PteScore::where('user_id',$user->id)->orderBy('date','desc')->get();
        return view('overall-pte-score-summary',compact('scores','user'));
    }
    public function todayScore(){
        $student = Student::where('user_id',Session::get('id'))->first();
        if($student->course_type!='' && $student->course_type=="ielts"){
            $score =   IeltsScore::where('user_id',Session::get('id'))->where('date',date('Y-m-d'))->first();
        }
        elseif($student->course_type!='' && $student->course_type=="pte"){
            $score = PteScore::where('user_id',Session::get('id'))->where('date',date('Y-m-d'))->first();
        }
        return view('today-score',compact('score','student'));
    }
    public function overallScore(){
        $student = Student::where('user_id',Session::get('id'))->first();
        if($student->course_type!='' && $student->course_type=="ielts"){
            $scores = IeltsScore::where('user_id',Session::get('id'))->orderBy('date','desc')->get();
        }
        elseif($student->course_type!='' && $student->course_type=="pte"){
            $scores = PteScore::where('user_id',Session::get('id'))->orderBy('date','desc')->get();
        }
        return view('overall-score',compact('scores','student'));
    }
}
