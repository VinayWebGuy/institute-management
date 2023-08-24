<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Notification;
use App\Models\User;
use DB;
use Carbon\Carbon;
use Session;

class TicketController extends Controller
{
    public function notification($title,$desc,$user_id){
        $n = new Notification;
        $n->title = $title;
        $n->description = $desc;
        $n->user_id = $user_id;
        $n->added_on = Carbon::now();
        $n->save();
    }
    public function raiseTicket(){
        return view('raise-ticket');
    }
    public function uploadTicket(Request $req){
        $req->validate([
            'title' => 'required|min:6|max:100',
            'description' => 'required',
        ]);

        $ticket = new Ticket;
        $ticket->title = $req->title;
        $ticket->description = $req->description;
        $ticket->unique_id = md5($req->title.'-'.time());
        $ticket->user_id = Session::get('id');
        $ticket->from = Session::get('id');
        $ticket->type = 'Ticket';

        $fName = '';
        if($req->has('file')){
            $files = $req->file('file');
            foreach($files as $f){
                $filename = time().'_'.$f->getClientOriginalName();
                $location = 'assets/tickets';
                $f->move($location,$filename);
                $fName.= $filename."|";
            }
        }
        $ticket->file = $fName;

        $ticket->save();
          // Notification Section Starts
          $this->notification('Ticket Raised','Ticket Raised Successfully ('.$ticket->unique_id.')',Session::get('id'));
        //   Ticket to Admin
        $user = User::where('role',1)->get();
        $u = User::find(Session::get('id'));
        foreach($user as $u){
            $this->notification('New Ticket','New Ticket Raised By '.$u->email.' ('.$ticket->unique_id.')',$u->id);
        }
          // Notification Section ends
        session()->flash('success','Ticket Raised Successfully');
        if(Session::get('role')==2){
            return redirect('staff/view-ticket/'.$ticket->unique_id);
        }
        else if(Session::get('role')==3){
            return redirect('student/view-ticket/'.$ticket->unique_id);
        }
    }
    public function myTickets(Request $req){
        $key = '';
            if(isset($req->ticket) && $req->ticket!=''){
                $key = $req->ticket;
                $tickets = Ticket::where('type','Ticket')->where('user_id',Session::get('id'))->orderBy('id','desc')->where(function($query) use ($key){
                    $query->where('title','LIKE','%'.$key.'%')->orWhere('description','LIKE','%'.$key.'%')->orWhere('unique_id',$key);;
                })->get();
            }
            else{
                $tickets = Ticket::where('type','Ticket')->where('user_id',Session::get('id'))->orderBy('id','desc')->get();
            }
        return view('my-tickets',compact('tickets','key'));
    }
    public function viewTicket($id){
        $ticket = Ticket::where('unique_id',$id)->where('type','Ticket')->where('user_id',Session::get('id'))->first();
        if($ticket){
            $comments = Ticket::where('unique_id',$id)->where('type','Comment')->where('user_id',Session::get('id'))->orderBy('created_at','desc')->get();
            return view('view-ticket',compact('ticket','comments'));
        }
        else{
            return redirect()->back();
        }

    }
    public function addTicketComment(Request $req){
        $req->validate([
            'description' => 'required',
        ]);

        $ot = Ticket::where('unique_id',$req->unique_id)->first();

        $ticket = new Ticket;
        $ticket->description = $req->description;
        $ticket->unique_id = $req->unique_id;
        $ticket->user_id = $ot->user_id;
        $ticket->from = Session::get('id');
        $ticket->type = 'Comment';

        $fName = '';
        if($req->has('file')){
            $files = $req->file('file');
            foreach($files as $f){
                $filename = time().'_'.$f->getClientOriginalName();
                $location = 'assets/tickets';
                $f->move($location,$filename);
                $fName.= $filename."|";
            }
        }
        $ticket->file = $fName;

        $ticket->save();

            // Notification Section Starts
            $this->notification('Ticket Comment Added','Ticket Comment Added Successfully ('.$ot->unique_id.')',Session::get('id'));
            //   Ticket to Admin
            if(Session::get('role')!=1){
                $user = User::where('role',1)->get();
                foreach($user as $u){
                    $this->notification('New Ticket Comment','New Ticket Comment Received By '.$u->email.' ('.$ot->unique_id.')',$u->id);
                }
            }
            else{
                $u = User::find(Session::get('id'));
                $this->notification('New Ticket Comment','New Ticket Comment Received By '.$u->email.' ('.$ot->unique_id.')',$ot->user_id);
            }
              // Notification Section ends
        session()->flash('success','Comment Added Successfully');
        return redirect()->back();
    }
    public function tickets(Request $req,$type=''){
        if($type==''){
            $key = '';
            if(isset($req->ticket) && $req->ticket!=''){
                $key = $req->ticket;
                $tickets = Ticket::where('type','Ticket')->orderBy('id','desc')->where(function($query) use ($key){
                    $query->where('title','LIKE','%'.$key.'%')->orWhere('description','LIKE','%'.$key.'%')->orWhere('unique_id',$key);
                })->get();
            }
            else{
                $tickets = Ticket::where('type','Ticket')->orderBy('id','desc')->get();
            }
        }
        else if($type=='pending'){
            $key = '';
            if(isset($req->ticket) && $req->ticket!=''){
                $key = $req->ticket;
                $tickets = Ticket::where('type','Ticket')->where('status',1)->orderBy('id','desc')->where(function($query) use ($key){
                    $query->where('title','LIKE','%'.$key.'%')->orWhere('description','LIKE','%'.$key.'%')->orWhere('unique_id',$key);;
                })->get();
            }
            else{
                $tickets = Ticket::where('type','Ticket')->where('status',1)->orderBy('id','desc')->get();
            }
        }
        else if($type=='progress'){
            $key = '';
            if(isset($req->ticket) && $req->ticket!=''){
                $key = $req->ticket;
                $tickets = Ticket::where('type','Ticket')->where('status',2)->orderBy('id','desc')->where(function($query) use ($key){
                    $query->where('title','LIKE','%'.$key.'%')->orWhere('description','LIKE','%'.$key.'%')->orWhere('unique_id',$key);;
                })->get();
            }
            else{
                $tickets = Ticket::where('type','Ticket')->where('status',2)->orderBy('id','desc')->get();
            }
        }
        else if($type=='closed'){
            $key = '';
            if(isset($req->ticket) && $req->ticket!=''){
                $key = $req->ticket;
                $tickets = Ticket::where('type','Ticket')->where('status',3)->orderBy('id','desc')->where(function($query) use ($key){
                    $query->where('title','LIKE','%'.$key.'%')->orWhere('description','LIKE','%'.$key.'%')->orWhere('unique_id',$key);;
                })->get();
            }
            else{
                $tickets = Ticket::where('type','Ticket')->where('status',3)->orderBy('id','desc')->get();
            }
        }
        else if($type=='resolved'){
            $key = '';
            if(isset($req->ticket) && $req->ticket!=''){
                $key = $req->ticket;
                $tickets = Ticket::where('type','Ticket')->where('status',4)->orderBy('id','desc')->where(function($query) use ($key){
                    $query->where('title','LIKE','%'.$key.'%')->orWhere('description','LIKE','%'.$key.'%')->orWhere('unique_id',$key);;
                })->get();
            }
            else{
                $tickets = Ticket::where('type','Ticket')->where('status',4)->orderBy('id','desc')->get();
            }
        }
        return view('tickets',compact('tickets','key','type'));
    }
    public function viewAdminTicket($id)
    {
        $ticket = Ticket::where('unique_id',$id)->where('type','Ticket')->first();
            $comments = Ticket::where('unique_id',$id)->where('type','Comment')->orderBy('created_at','desc')->get();
            return view('view-ticket',compact('ticket','comments'));
    }
    public function changeTicketStatus($id,$status){
        $tickets = Ticket::where('unique_id',$id)->get();
        $t = Ticket::where('unique_id',$id)->first();
        foreach($tickets as $ticket){
            $ticket->status = $status;
            $ticket->save();
        }
            // Notification Section Starts
            if($status==1){
                $s = "Pending";
            }
            else if($status==2){
                $s = "In Progress";
            }
            else if($status==3){
                $s = "Closed";
            }
            else if($status==4){
                $s = "Resolved";
            }
            
               // Notification Section starts
            $this->notification('Ticket Status Updated','Ticket Status Updated to '.$s.' ('.$t->unique_id.')',$ticket->user_id);
            $this->notification('Ticket Status Updated','Ticket Status Updated to '.$s.' ('.$t->unique_id.')',Session::get('id'));

              // Notification Section ends
        session()->flash('status','Status Updated Successfully.');
        return redirect()->back();
    }
}
