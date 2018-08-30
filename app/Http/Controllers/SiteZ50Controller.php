<?php

namespace App\Http\Controllers;

use Image;
use Auth;
use App\client_company;
use App\z50_site;
use DB;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class SiteZ50Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = client_company::paginate(5);
        $siteall = z50_site::with('client_companyz50')->paginate(5);
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        return view('mastertemplate.admin.SiteZ50',
        [
            'userdatap' => $userinfo,
            'companydata' => $company,
            'siteall' => $siteall,
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
        $SiteZ50 = new z50_site();
        $SiteZ50->C_ID = $request->C_ID;
        $SiteZ50->SiteName = $request->Sname;
        $SiteZ50->FIT = $request->FIT;
        $SiteZ50->Co2_Criterion = $request->CO2;
        $SiteZ50->Notifytoken = $request->LineToken;
        $SiteZ50->Capacity = $request->Capacity;
        // ARRAY SERIAL

        $serial = Input::get('Serialarray');
      	
    	$SerialNo = implode(",",$serial);

        $SiteZ50->SerialNolist = $SerialNo;
     

        // 
        if($request->hasFile('simage'))
        {
            $filename = str_random(10) . '.' . $request->file('simage')->getClientOriginalExtension();
            $request->file('simage')->move(public_path() . '/img/imgproduct/',$filename);
            Image::make(public_path(). '/img/imgproduct/' . $filename)->resize(2000,2000)->save(public_path().'/img/imgproduct/resize/'.$filename);
            $SiteZ50->Site_img = $filename;
        }
        else
        {
            $SiteZ50->Site_img = "nopic.jpg";
        }
       

        $SiteZ50->Tal = $request->Tel;
        $SiteZ50->Address = $request->Address;
        // $SiteZ50->InstallationType = $request->InstallT;
        $SiteZ50->INVModel = $request->Invmodel;
        $SiteZ50->Email = $request->Email;
        $SiteZ50->save();
        alert()->success('Success', 'This Site has insert!');                
        return redirect()->action('SiteZ50Controller@index');
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
        $SiteZ50 = z50_site::find($id);
        $SiteZ50->SiteName = $request->Sname;
       
        // $site->Capacity = $request->Capacity;
        // $site->InstallationType = $request->InstallT;
        $SiteZ50->INVModel = $request->Invmodel;
        $SiteZ50->Tal = $request->Tel;
        $SiteZ50->Address = $request->Address;
        $SiteZ50->SerialNolist = $request->SerialNo;
        $SiteZ50->FIT = $request->FIT;
        $SiteZ50->Co2_Criterion = $request->CO2;
        $SiteZ50->Notifytoken = $request->LineToken;
         $SiteZ50->Capacity = $request->Capacity;

        if($request->hasFile('simage')){
            $filename = str_random(10) . '.' . $request->file('simage')->getClientOriginalExtension();
            $request->file('simage')->move(public_path() . '/Z50/img/siteimage/',$filename);
            Image::make(public_path(). '/Z50/img/siteimage/' . $filename)->resize(100,100)->save(public_path().'/Z50/img/siteimage/resize/'.$filename);
            $SiteZ50->Site_img = $filename;

        }else{

            $SiteImage = DB::table('z50_site')
                ->where('Site_ID','=',$id) //จำลองการกรองในอนาคต
                ->get();
                foreach($SiteImage as $Images){
            $filename = $Images->Site_img; 
            $SiteZ50->Site_img = $filename;
        }
        }
        $SiteZ50->save();
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
        $site = z50_site::find($id);
        $site->delete();
        alert()->success('Deleted', 'This Site has deleted');                
        return redirect()->action('SiteZ50Controller@index');
    }
}
