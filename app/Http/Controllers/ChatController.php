<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserMore;
use App\Models\Discussion;
use App\Models\Notification;
use App\Models\Club;
use Session;
use Carbon\Carbon;
use File;

class ChatController extends Controller
{
    public function notification($title,$desc,$user_id,$msg_id){
        $n = new Notification;
        $n->title = $title;
        $n->description = $desc;
        $n->user_id = $user_id;
        $n->type = "Message";
        $n->msg_id = $msg_id;
        $n->added_on = Carbon::now();
        $n->save();
    }
    public function discussionHub(){
        $msgs = Discussion::where('status',1)->orderBy('created_at','asc')->get();
        return view('discussion-hub',compact('msgs'));
    }
    public function sendDiscussion(Request $req){
        $req->validate([
            'msg' => 'required',
            'file' => 'mimes:png,jpg|max:2048',
        ]);
        $fileName = null;
        if($req->has('file')){
            $fileName = time().'.'.$req->file->extension();
            $req->file->move(public_path('assets/discussionHub'),$fileName);
        }
        $dis = new Discussion;
        $dis->user_id = Session::get('id');
        $dis->msg = $req->msg;
        $dis->file = $fileName;
        $dis->save();
        return response()->json([
            'msg' => $req->msg,
            'file' => $fileName
        ]);
    }
    public function club(Request $req){
        // $msgs = Club::where('status',1)->orderBy('created_at','asc')->get();
        $key = '';
        if(isset($req->member) && $req->member!=''){
            $key = $req->member;
            $users = User::orderBy('username','asc')->where('id','!=',Session::get('id'))->where(function($query) use ($key){
                $query->where('username','LIKE','%'.$key.'%')->orWhere('email','LIKE','%'.$key.'%')->orWhere('mobile',$key);
            })->get();
        }
        else{
            $users = User::where('id','!=',Session::get('id'))->orderBy('username','asc')->get();
        }
        return view('club',compact('users','key'));
    }
    public function enterClub($key){
        $mine = User::find(Session::get('id'));
        // $msgs = Club::where('status',1)->orderBy('created_at','asc')->where(function($query) use ($key,$mine){
        //     $query->where('from_id',$key)->orWhere('from_id',$key)->orWhere('from_id',$mine->unique_key)->orWhere('to_id',$mine->unique_key);
        // })->get();
        $msgs = Club::where(function($query) use ($key,$mine){
            $query->where('to_id',$key)->where('from_id',$mine->unique_key);
        })->orWhere(function($q) use ($key,$mine){
            $q->where('from_id',$key)->where('to_id',$mine->unique_key);
        })->get();
        $user = User::where('unique_key',$key)->first();
        $det = UserMore::where('user_id',$user->id)->first();
        $my_msgs  = Club::where('from_id',$key)->where('to_id',$mine->unique_key)->where('read',0)->get();  
        foreach($my_msgs as $mm){
            $mm->read = 1;
            $mm->save();
        }
         
        return view('enter-club',compact('msgs','user','key','det','mine'));
    }
    public function saveClubMessage(Request $req){
        $req->validate([
            'msg' => 'required',
            'file' => 'mimes:png,jpg|max:2048',
        ]);
        $fileName = null;
        if($req->has('file')){
            $fileName = time().'.'.$req->file->extension();
            $req->file->move(public_path('assets/club'),$fileName);
        }
        $c = new Club;
        #get From Id
        $my = User::find(Session::get('id'));
        $c->from_id = $my->unique_key;
        $c->to_id = $req->to_id;
        $c->msg = $req->msg;
        $c->file = $fileName;
        $c->save();

        // Notification Section Starts
        $rec = User::where('unique_key',$req->to_id)->first();
        $this->notification('New Message from '.$my->username,$req->msg,$rec->id,$my->unique_key);
        // Notification Section ends

        return response()->json([
            'msg' => $req->msg,
            'file' => $fileName
        ]);
    }
}
