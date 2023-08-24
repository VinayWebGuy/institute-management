<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Batch;
use App\Models\Notification;
use Carbon\Carbon;
use Session;

class BatchController extends Controller
{
    public function notification($title,$desc,$user_id){
        $n = new Notification;
        $n->title = $title;
        $n->description = $desc;
        $n->user_id = $user_id;
        $n->added_on = Carbon::now();
        $n->save();
    }

    public function addBatch(){
        $staff = User::where('role',2)->where('status',1)->orderBy('username','asc')->get();
        return view('add-batch',compact('staff'));
    }
    public function saveBatch(Request $req){
        $req->validate([
            'name' => 'required'
        ]);
       $b = new Batch;
       $b->name = $req->name;
       $b->start_date = $req->start_date;
       $b->end_date = $req->end_date;
       $b->morning_evening = $req->morning_evening;
       $b->from_time = $req->from_time;
       $b->to_time = $req->to_time;
       $b->assigned_staff = $req->assigned_staff;
       $b->status = $req->status;
       $b->save();

        // Notification Section Starts
        $this->notification('Batch Added','Batch ('.$req->name.') added successfully!',Session::get('id'));
        // Notification Section ends

       session()->flash('success','Data added successfully!');
       return redirect()->back();
    }
    public function allBatches(Request $req){
        $key = '';
        if(isset($req->batch) && $req->batch!=''){
            $key = $req->batch;
            $batch = Batch::where('name','LIKE','%'.$key.'%')->get();
        }
        else{
            $batch = Batch::all();
        }
        return view('all-batch',compact('batch','key'));
    }
    public function changeBatchStatus($id){
        $batch = Batch::find($id);
        if($batch->status==1){
            $batch->status = 0;
        }
        else{
            $batch->status = 1;
        }
        $batch->save();
        session()->flash('done','Status updated successfully!');
        return redirect()->back();
    }
    public function editBatch($id){
        $staff = User::where('role',2)->where('status',1)->orderBy('username','asc')->get();
        $batch = Batch::find($id);
        return view('edit-batch',compact('batch','staff'));
    }
    public function updateBatch(Request $req){
        $req->validate([
            'name' => 'required'
        ]);
       $b = Batch::find($req->id);
       $b->name = $req->name;
       $b->start_date = $req->start_date;
       $b->end_date = $req->end_date;
       $b->morning_evening = $req->morning_evening;
       $b->from_time = $req->from_time;
       $b->to_time = $req->to_time;
       if($req->assigned_staff!=''){
           $b->assigned_staff = $req->assigned_staff;
       }
       $b->status = $req->status;
       $b->save();

        // Notification Section Starts
        $this->notification('Batch Updated','Batch ('.$req->name.') updated successfully!',Session::get('id'));
        // Notification Section ends

       session()->flash('success','Data updated successfully!');
       return redirect()->back();
    }
}
