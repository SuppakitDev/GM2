<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\z50pcs_info;
use App\z50_site;
use App\sum_of_z50info;
use App\error_code;
use App\model_type;
use App\Http\Requests\Updatez50userRequest;
use App\tbUserID;
use App\User;
use Excel;
use DateTime;
use DB;
use Auth;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

class Z50manageuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $z50user = User::find(Auth::user()->id);
        $serialnoz50 = Input::get('SerialNo');
        $Site = z50_site::find(Auth::user()->Site_ID);
       
        $Address = DB::table('z50_site')
        ->where('Site_ID', '=', Auth::user()->Site_ID)
        ->select('Address')
        ->get();
        foreach ($Address as $Addresss) {
            $Address = $Addresss->Address; 
        }
        $SiteName = DB::table('z50_site')
        ->where('Site_ID', '=', $z50user->Site_ID)
        ->select('SiteName')
        ->get();
    foreach ($SiteName as $SiteNames) 
    {
        $SiteName = $SiteNames->SiteName;
    }
    $userlevel = User::with('z50_sites')
    ->where('P_ID','=',2)
    ->where('CreateBy' ,'=', Auth::user()->id)
    ->get();
        
    $serialnolist = DB::table('z50_site')
                    ->where('Site_ID', '=', $z50user->Site_ID)
                    ->select('SerialNolist')
                    ->get();
    foreach ($serialnolist as $serialnolists) 
        {
            $SerialNolist = explode(",",$serialnolists->SerialNolist);
        }
        return view('producttemplate.Z50-GW.content.Managementuser',
        [
            'Site' => $Site,
            'Z50siteAddress' => $Address,
            'SiteName' => $SiteName,
            'serialnoz50' => $serialnoz50,
            'userlevel' => $userlevel,
            'SerialNolist' => $SerialNolist,
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
    public function update(Request $request, $id)
    {
    //     $user = User::find($id);
    //     $user->update($request->all());

    //     alert()->success('Success', 'This User has Updated!');                
    //     return redirect()->Back();

    $UserZ50 = User::find($id);
    $UserZ50->username = $request->username;
    $UserZ50->Fname = $request->Fname;
    $UserZ50->Lname = $request->Lname;
    $UserZ50->email = $request->email;
    $UserZ50->Tel = $request->Tel;
    $UserZ50->Status = $request->Status;
    $UserZ50->P_ID = $request->P_ID;
    $UserZ50->C_ID = $request->C_ID;
    $UserZ50->Site_ID = $request->site;
    $UserZ50->CreateBy = $request->CreateBy;

    $SerialNitem = implode(",",$request->SerialItemedit);

    $UserZ50->SerialNoitem  = $SerialNitem;
    $UserZ50->save();
    alert()->success('Success', 'Your profile Updated');                
    return redirect()->Back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userZ50manage = User::find($id);
        $userZ50manage->delete();
        alert()->success('Deleted', 'User has deleted');                
        return redirect()->action('Z50manageuserController@index');
    }
}
