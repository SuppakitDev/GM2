<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

     /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected function redirectTo()
    {
        alert()->success('Success', 'Add User Complete!!'); 
        return url()->previous();
    }
    
        /**
         * Create a new controller instance.
         *
         * @return void
         */
        public function __construct()
        {
           $this->middleware('auth');
        }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'Fname' => 'required|string|max:255',
            'Lname' => 'required|string|max:255',
            'Tel' => 'required|string|max:10',
            'CreateBy' =>'required',            
            'C_ID' =>'required',
            // 'B_ID' =>'required',
            'Status' =>'required',
            'P_ID' =>'required',
            'site' =>'required',
            'SerialItem' =>'required',
            // 'dept' =>'required',
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // <!-- เฉพาะ Manager level ของ Mcot -->
        if(($data['Status'] == 'MANAGER') && ($data['P_ID'] == 2))
        {
            $SR = DB::table('z50_site')
                ->where('Site_ID', '=', $data['C_ID'])
                ->select('SerialNolist')
                ->get();
                foreach ($SR as $SRs) 
                {
                    $SR = $SRs->SerialNolist;
                }
            $SerialNo = $SR;
        }elseif(($data['Status'] == 'USER') && ($data['P_ID'] == 2))
        {
            $SerialNo = implode(",",$data['SerialItem']);
        }else
        {
            $SerialNo = null;
        }
        

           
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),            
            'Fname' => $data['Fname'],
            'Lname' => $data['Lname'],
            'Tel' => $data['Tel'],
            'CreateBy' => $data['CreateBy'],            
            'C_ID' => $data['C_ID'],
            // 'B_ID' => $data['B_ID'],
            'Status' => $data['Status'],
            'P_ID' => $data['P_ID'],
            'Site_ID' => $data['site'],
            // 'List_DeptID' => $data['dept'],
            
    
            'SerialNoitem' => $SerialNo,
            
        ]);
    }
}
