<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\User;
use App\Models\Notification;
use DB;
use Session;
use Carbon\Carbon;

class ExpenseController extends Controller
{
    public function notification($title,$desc,$user_id){
        $n = new Notification;
        $n->title = $title;
        $n->description = $desc;
        $n->user_id = $user_id;
        $n->added_on = Carbon::now();
        $n->save();
    }
    public function expenseManager(Request $req){
        $key = '';
        if(isset($req->expense) && $req->expense!=''){
            $key = $req->expense;
            $expenses = Expense::where('what','LIKE','%'.$key.'%')->orWhere('value',$key)->orderBy('added_on','desc')->get();
        }
        else{
            $expenses = Expense::orderBy('added_on','desc')->get();
        }
        return view('expense-manager',compact('expenses','key'));
    }
    public function addExpense(){
        return view('add-expense');
    }
    public function saveExpense(Request $req){
        $req->validate([
            'what' => 'required',
            'type' => 'required',
            'value' => 'required',
            'added_on' => 'required',
        ]);
        $expense = new Expense;
        $expense->what = $req->what;
        $expense->type = $req->type;
        $expense->description = $req->description;
        $expense->value = $req->value;
        $expense->added_on = $req->added_on;
        $expense->save();
        // Notification Section Starts
        $this->notification('Expense Manager Updated','Expense Manager is updated with Rs. '.$req->value.'('.$req->type.')',Session::get('id'));
        // Notification Section ends
        session()->flash('success','Expense added successfully');
        return redirect()->back();
    }
}
