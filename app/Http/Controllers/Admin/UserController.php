<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Password;
use Mockery\Generator\StringManipulation\Pass\Pass;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acc_type = Auth::user()->account_type;
        return view('Admin.Users.index',[
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
        return view('Admin.Users.create',[
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
        // Validation using form request
        $dataValidated = $request->validated();
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
        return redirect(route('admin.users.index'));
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
        return view('Admin.Users.edit',[
            'user'  => User::find($id),
            'roles' => Role::all()
        ]);
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
        return redirect(route('admin.users.index'));
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
        return redirect(route('admin.users.index'));
    }
}
