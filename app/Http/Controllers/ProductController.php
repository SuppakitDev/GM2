<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product_list;
use App\User;
use Auth;
use File;
use Image;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = product_list::paginate(5);
        $userinfo = User::with('product_lists')->find(Auth::user()->id);
        return view('mastertemplate.admin.product',
        [
            'userdatap' => $userinfo,
            'productdata' => $product,
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
        $product = new product_list();
        $product->P_Name = $request->pname;
        $product->P_Model = $request->pmodel;
        $product->Comment = $request->pcomment;

        if($request->hasFile('pimage'))
        {
            $filename = str_random(10) . '.' . $request->file('pimage')->getClientOriginalExtension();
            $request->file('pimage')->move(public_path() . '/img/imgproduct/',$filename);
            Image::make(public_path(). '/img/imgproduct/' . $filename)->resize(2000,2000)->save(public_path().'/img/imgproduct/resize/'.$filename);
            $product->P_Img = $filename;
        }
        else
        {
            $product->P_Img = "noproductimg.jpg";
        }
        if($request->hasFile('Specification'))
        {
            $specfilename = str_random(10) . '.' . $request->file('Specification')->getClientOriginalExtension();
            $request->file('Specification')->move(public_path() . '/img/productspec/',$specfilename);
            Image::make(public_path(). '/img/productspec/' . $specfilename)->resize(2000,2000)->save(public_path().'/img/productspec/resize/'.$specfilename);
            $product->spec = $specfilename;
        }
        else
        {
            $product->spec = "noproductspec.jpg";
        }


        $product->save();
        alert()->success('Success', 'This product has insert!');                
        return redirect()->action('ProductController@index');
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
        $product = product_list::find($id);
        $product->P_Name = $request->pname;
        $product->P_Model = $request->pmodel;
        $product->Comment = $request->pcomment;

        if($request->hasFile('pimage'))
        {
            $filename = str_random(10) . '.' . $request->file('pimage')->getClientOriginalExtension();
            $request->file('pimage')->move(public_path() . '/img/imgproduct/',$filename);
            Image::make(public_path(). '/img/imgproduct/' . $filename)->resize(2000,2000)->save(public_path().'/img/imgproduct/resize/'.$filename);
            $product->P_Img = $filename;
        }
        else
        {
            $product->P_Img = $product->P_Img;
        }
        if($request->hasFile('Specification'))
        {
            $specfilename = str_random(10) . '.' . $request->file('Specification')->getClientOriginalExtension();
            $request->file('Specification')->move(public_path() . '/img/productspec/',$specfilename);
            Image::make(public_path(). '/img/productspec/' . $specfilename)->resize(2000,2000)->save(public_path().'/img/productspec/resize/'.$specfilename);
            $product->spec = $specfilename;
        }
        else
        {
            $product->spec = $product->spec ;
        }

        $product->save();
        alert()->success('Success', 'This Product has Updated!');                
        return redirect()->action('ProductController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = product_list::find($id);
        $product->delete();
        alert()->success('Deleted', 'This product has deleted');                
        return redirect()->action('ProductController@index');
    }


    public function testurl()
    {
        $product = new product_list();
        $product->P_Name = "testURL";
        $product->P_Model = "URLmodel";
        $product->Comment = "URLcomment";
        $product->save();
    }
}
