<?php

namespace App\Http\Controllers;

use Image;
use Auth;
use App\client_company;
use DB;
use App\User;
use Illuminate\Http\Request;
use App\z50_site;
use Illuminate\Support\Facades\Input;

class UserZ50Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Sitez50 = z50_site::all();
       
        $siteall = z50_site::with('client_companyz50')->paginate(5);
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        $userz50 = User::with('z50_sites')
            ->where('P_ID','=',2)
            ->where('Status','=','MANAGER')
            ->get();
        return view('mastertemplate.admin.UserZ50',
        [
            'userdatap' => $userinfo,
            'Sitez50' => $Sitez50,
            'siteall' => $siteall,
            'userZ50' => $userz50,
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
     *3
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
        $userZ50 = User::find($id);
        $userZ50->delete();
        alert()->success('Deleted', 'User has deleted');                
        return redirect()->action('Userz50Controller@index');
    }
}
