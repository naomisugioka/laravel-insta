<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    public function index(Request $request){
        if($request->search){
        //get list of all users, orderd by name
        $all_users = $this->user->where('name','LIKE','%'.$request->search.'%')->orderBy('name')->withTrashed()->paginate(10);
        //paginate(n)-pages with n items each
        //withtrashed()-includes soft-deleted record in the list
        
    }else{
        $all_users = $this->user->orderBy('name')->withTrashed()->paginate(10);
    }
        return view('admin.users.index')->with('all_users', $all_users)
                                          ->with('search',$request->search);
}

    public function deactivate($id){
        $this->user->destroy($id);

        return redirect()->back();
    }

    public function activate($id){
       //restore()=restores a SoftDeleted record
       //onlyTrashed() =gets only SoftDeleted records

       $this->user->onlyTrashed()->findOrFail($id)->restore();

       return redirect()->back();

    }
}
