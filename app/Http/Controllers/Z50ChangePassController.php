<?php

namespace App\Http\Controllers;
use App\User;
use App\z50_site;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePasswordRequest;
use Hash;

class Z50ChangePassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        $Site = z50_site::find(Auth::user()->Site_ID);
        return view('producttemplate.Z50-GW.content.changepass',
        [
            'profileinfo' => $userinfo,
            'userdatap' => $userinfo,
            'Site' => $Site,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePasswordRequest $request, $id)
    {
        $data = $request->all();
        
           $user = User::find(auth()->user()->id);
           if(!Hash::check($data['current-password'], $user->password)){
                alert()->error('Error', 'Password Incorrect!');          
                return back();
           }else{                      
                $obj_user = User::find($id);
                $obj_user->password = Hash::make($data['password']);;
                $obj_user->save();
                alert()->success('Success', 'Your Password Changed!! ');
                return redirect('Z50Profile')->with('message', 'Login Failed');
                
           }
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
