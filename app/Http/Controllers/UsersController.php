<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Users::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'email' => 'required|string|unique:users,email'
        ]);

        return Users::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //find one user
        return Users::find($id);
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
        //checking for instances of username email cross sections
        $username = Users::where('username', '=', $request->username)->first();
        $email = Users::where('email', '=', $request->email)->first();

        //Check for existing usernames and emails before allowing of edit
        if($username !== null && $username->id !== $id) return ['error'=> 'username ' .$request->username. ' is already taken'];
        if($email !== null && $email->id === $id) return ['error'=> 'email ' .$request->email. ' is already taken'];

        $user = Users::find($id);
        $user-> update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //unused
    }
}
