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

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = client_company::paginate(5);
        $siteall = tbUserID::with('client_companys')->paginate(5);
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        return view('mastertemplate.admin.SiteLocal',
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
        $SiteLocal = new tbUserID();
        $SiteLocal->C_ID = $request->C_ID;
        $SiteLocal->SiteName = $request->Sname;

        if($request->hasFile('simage'))
        {
            $filename = str_random(10) . '.' . $request->file('simage')->getClientOriginalExtension();
            $request->file('simage')->move(public_path() . '/img/imgproduct/',$filename);
            Image::make(public_path(). '/img/imgproduct/' . $filename)->resize(2000,2000)->save(public_path().'/img/imgproduct/resize/'.$filename);
            $SiteLocal->SiteImg = $filename;
        }
        else
        {
            $SiteLocal->SiteImg = "nopic.jpg";
        }
       

        $SiteLocal->FIT = $request->fit;
        $SiteLocal->Capacity = $request->Capacity;
        $SiteLocal->InstallationType = $request->InstallT;
        $SiteLocal->INVModel = $request->Invmodel;
        $SiteLocal->Email = $request->Email;
        $solarsensor =  Input::has('SolarS') ? true : false;
        $SiteLocal->SRI_sensor = $solarsensor;
        $tempsensor =  Input::has('TempS') ? true : false;        
        $SiteLocal->Temp_sensor = $tempsensor;
        
    
        $SiteLocal->save();
        alert()->success('Success', 'This Site has insert!');                
        return redirect()->action('SiteController@index');
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
        $site = tbuserID::find($id);
        $site->SiteName = $request->Sname;
       
        $site->Capacity = $request->Capacity;
        $site->InstallationType = $request->InstallT;
        $site->INVModel = $request->Invmodel;
        $site->FIT = $request->fit;
        $solarsensor =  Input::has('SolarS') ? true : false;
        $site->SRI_sensor = $solarsensor;
        $tempsensor =  Input::has('TempS') ? true : false;        
        $site->Temp_sensor = $tempsensor;

        if($request->hasFile('simage')){
            $filename = str_random(10) . '.' . $request->file('simage')->getClientOriginalExtension();
            $request->file('simage')->move(public_path() . '/M250/img/siteimage/',$filename);
            Image::make(public_path(). '/M250/img/siteimage/' . $filename)->resize(100,100)->save(public_path().'/M250/img/siteimage/resize/'.$filename);

            $site->SiteImg = $filename;

        }else{

            $SiteImage = DB::table('tbUserID')
                ->where('UserID','=',$id) //จำลองการกรองในอนาคต
                ->get();
                foreach($SiteImage as $Images){
            $filename = $Images->SiteImg; 
            $site->SiteImg = $filename;
        }
        }
        $site->save();
        alert()->success('Success', 'Your profile Updated');                
        return redirect()->action('UserfilterController@filter');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $site = tbUserID::find($id);
        $site->delete();
        alert()->success('Deleted', 'This Site has deleted');                
        return redirect()->action('SiteController@index');
    }



    
}
