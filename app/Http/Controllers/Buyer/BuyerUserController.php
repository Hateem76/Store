<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Password;
use Mockery\Generator\StringManipulation\Pass\Pass;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BuyerUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $serialNo = 1;
        $acc_type = Auth::user()->account_type;
        return view('Buyer.Users.index',[
            'serialNo'  => $serialNo,
            'users' => User::where('account_type',$acc_type)
                        ->where('parent_id',Auth::user()->id)
                        ->where('parent_child',0)
                        ->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Buyer.Users.create',[
            'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $id = Auth::user()->id;
        if(Gate::allows('child-buyer')){
            $id = Auth::user()->parent_id;
        }
        // Validation using form request
        $dataValidated = $request->validated();
        $users = User::where('parent_id',$id)->get();
        $count = $users->count();
        if($count > 5){
            $request->session()->flash('danger','You already have 5 Users created');
            return redirect(route('buyer.users.index'));
        }
        $acc_type = Auth::user()->account_type;
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'account_type' => $acc_type,
            'parent_child' => 0,
            'parent_id' => $id,

        ]);
        
        // // validation using laravel fortify
        // $newUser = new CreateNewUser();
        // $user = $newUser->create($request->all());
        // $user->roles()->sync($request->roles);
        // Password::sendResetLink($request->only(['email']));
        $request->session()->flash('success','You have Created the User');
        return redirect(route('buyer.users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(User::where('id',$id)->where('parent_id',Auth::user()->id)->exists()){
            return view('Buyer.Users.edit',[
                'user'  => User::find($id),
                'roles' => Role::all()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $dataValidated = $request->validated();
        $user = User::find($id);

        if(!$user){
            $request->session()->flash('danger','You cannot edit this user');
            return redirect(route('admin.users.index'));
        }
        $user->update($request->except(['_tokens','roles']));
        $user->roles()->sync($request->roles);

        $request->session()->flash('success','You have edited the user');
        return redirect(route('buyer.users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        User::destroy($id);
        $request->session()->flash('success','You have deleted the user');
        return redirect(route('buyer.users.index'));
    }
}
