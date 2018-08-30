<?php

namespace App\Http\Controllers;

use Image;
use Auth;
use App\client_company;
use DB;
use App\User;
use Illuminate\Http\Request;
use App\tbUserID;
use Illuminate\Support\Facades\Input;

class UserLocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $SiteLocal = tbUserID::all();
       
        $siteall = tbUserID::with('client_companys')->paginate(5);
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        $userlocal = User::with('tbUserIDs')
            ->where('P_ID','=',1)
            ->get();
        return view('mastertemplate.admin.UserLocal',
        [
            'userdatap' => $userinfo,
            'SiteLocal' => $SiteLocal,
            'siteall' => $siteall,
            'userlocal' => $userlocal,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $sitelocal = User::with('tbUserIDs')->find($id);
        
        return view('mastertemplate.admin.adminprofile',
        [
            'profileinfo' => $sitelocal,
            'userdatap' => $sitelocal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userlocal = User::find($id);
        $userlocal->delete();
        alert()->success('Deleted', 'User has deleted');                
        return redirect()->action('UserLocalController@index');
    }

   
}
