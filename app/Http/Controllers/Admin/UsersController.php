<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oRoles = Role::whereIn('name', ['admin','editor'])->pluck('id', 'name')->toArray();
//        $oUsers = User::paginate(15);
        $oUsers = User::whereHas('roles', function($q){$q->whereIn('name', ['admin','editor']);})->paginate(15);
        return view('admin.users.index', compact('oRoles', 'oUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oUser = null;
        $oRoles = Role::whereIn('name', ['admin','editor'])->orderBy('name', 'ASC')->get();
        return view('admin.users.add', compact('oRoles', 'oUser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $oUser = new User;
        $oUser->name = $request->input('name');
        $oUser->username = $request->input('username');
        $oUser->email = $request->input('email');
        $oUser->phone = $request->input('phone');
        $oUser->password = bcrypt($request->input('password'));
        $oUser->status = (boolean)$request->input('status');

        $oUser->company_name = ($request->input('company_name'))?:'';
        $oUser->address = ($request->input('address'))?:'';
        $oUser->state = ($request->input('state'))?:'';
        $oUser->city = ($request->input('city'))?:'';
        $oUser->zip = ($request->input('zip'))?:'';
        $oUser->country_id = ($request->input('country_id'))?:'0';
        $oUser->other_info = '';
        if($oUser->save()){
            $oUser->roles()->attach($request->input('role_id'));
        }

        \Session::flash('flash_message', 'User Information saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oUser = User::whereHas('roles', function($q){$q->whereIn('name', ['admin', 'editor']);})->where('id', $id)->firstOrFail();
        $oRoles = Role::orderBy('name', 'ASC')->get();
        return view('admin.users.edit', compact('oRoles', 'oUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $oUser = User::findOrFail($id);
        $oUser->name = $request->input('name');
        $oUser->username = $request->input('username');
        $oUser->email = $request->input('email');
        $oUser->phone = $request->input('phone');
        if($request->input('password')!='') {
            $oUser->password = bcrypt($request->input('password'));
        }
        $oUser->status = (boolean)$request->input('status');
        $oUser->company_name = ($request->input('company_name'))?:'';
        $oUser->address = ($request->input('address'))?:'';
        $oUser->state = ($request->input('state'))?:'';
        $oUser->city = ($request->input('city'))?:'';
        $oUser->zip = ($request->input('zip'))?:'';
        $oUser->country_id = ($request->input('country_id'))?:'0';
        $oUser->other_info = '';
        $oUser->save();
        $oUser->detachRoles();

        $oUser->roles()->attach($request->input('role_id'));

        \Session::flash('flash_message', 'User Information saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $oUser = User::where('id',$id)->first();
        if(!$oUser){
            \Session::flash('flash_message', 'User is not valid or has been removed.');
            \Session::flash('flash_type', 'alert-error');
            return \Redirect::to('admin/users');
        }

        $oUser->delete();
        \Session::flash('flash_message', 'User Information has been removed.');
        \Session::flash('flash_type', 'alert-success');
        return \Redirect::to('admin/users');
    }
}