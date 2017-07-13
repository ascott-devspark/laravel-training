<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;


class UserController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {

    $users = User::orderBy('name')->get();

    return view('users.index')
      ->with('users', $users);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $roles = Role::orderBy('display_name')->get(['id', 'display_name'])->toArray();

    foreach ($roles as $key => $rol) {
      $roles[$key]['checked'] = false;
    }

    return view('users.create')
      ->with('roles', $roles);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $this->validate($request, [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:6|confirmed',
    ]);

    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = bcrypt($request->password);
    $user->save();

    if ($request->rol) {
      $user->roles()->sync(array_values($request->rol));
    }

    Session::flash('message', 'User created successfully');
    return Redirect::route('user.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $user = User::find($id);
    $roles = Role::orderBy('display_name')->get(['id', 'display_name'])->toArray();

    $selecRoles = [];
    $userRoles = $user->roles()->get(['id'])->toArray();
    foreach ($userRoles as $userRol) {
      $selecRoles[] = $userRol['id'];
    }

    foreach ($roles as $key => $rol) {
      $roles[$key]['checked'] = in_array($rol['id'], $selecRoles);
    }

    // show the edit form and pass the video
    return view('users.edit')
      ->with('user', $user)
      ->with('roles', $roles);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $this->validate($request, [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email,'.$id,
      'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user = User::find($id);
    $user->name = $request->name;
    $user->email = $request->email;

    // Only override password if is not empty
    if ($request->password) {
      $user->password = bcrypt($request->password);
    }
    $user->save();

    if ($request->rol) {
      $user->roles()->sync(array_values($request->rol));
    }

    Session::flash('message', 'User updated successfully');
    return Redirect::route('user.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    //
  }
}
