<?php

namespace App\Http\Controllers;
use App\product_list;
use App\client_company;
use App\User;
use Auth;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = client_company::paginate(5);
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        return view('mastertemplate.admin.company',
        [
            'userdatap' => $userinfo,
            'companydata' => $company,
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
        $company = new client_company();
        $company->C_Name = $request->cname;
        $company->Startdate = $request->cdate;
        $company->Tel = $request->ctel;
        $company->Email = $request->cemail;
        $company->Address = $request->caddress;

        $company->save();
        alert()->success('Success', 'This company has insert!');                
        return redirect()->action('CompanyController@index');
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
        $company = client_company::find($id);
        $company->C_Name = $request->cname;
        $company->Startdate = $request->cdate;
        $company->Tel = $request->ctel;
        $company->Email = $request->cemail;
        $company->Address = $request->caddress;
        $company->save();
        alert()->success('Success', 'This company has Updated!');                
        return redirect()->action('CompanyController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = client_company::find($id);
        $company->delete();
        alert()->success('Deleted', 'This company has deleted');                
        return redirect()->action('CompanyController@index');


    }
}
