<?php
use App\product_list;
use App\Department;
use App\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', 'WelcomeController@index');


Route::get('/', function () {
    $product = product_list::all();
    return view('welcome',
    [
        'productdata' => $product,
    ]);
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::get('/userfilter','UserfilterController@filter');
Route::get('/admingotoEMS','UserfilterController@admingotoems');
Route::get('/admingotoM250','UserfilterController@admingotom250');


Route::get('/getdepartment',function(){
        $BID = Input::get('BID');
        $department = Department::where('B_ID', '=' ,$BID)->get();

        return Response::json($department);
});



//profile

Route::resource('profiles','ProfilesController');
Route::resource('adminprofile','AdminprofileConroller');
Route::resource('changepass','ChangePassController');
Route::resource('m250changepass','M250ChangePassController');
Route::resource('Z50changepass','Z50ChangePassController');
Route::resource('adminchangepass','adminChangePassController');
Route::resource('company','CompanyController');

Route::resource('product','ProductController');
Route::resource('theme','ThemeController');
Route::resource('manager','ManagerController');
Route::resource('user','UserController');

Route::resource('productinfo','ProductinfoController');
Route::resource('overviewmonitor','OverviewController');

Route::get('/por', function () {
    return view('testchartDB');
});

Route::get('/testlalong', function () {
    return view('TESTLALONG');
});

Route::get('/getDashboard','powerchartController@getDashboard');
Route::get('/getDaily','powerchartController@getDaily');
Route::get('/getMonthly','powerchartController@getMonthly');
Route::get('/getYearly','powerchartController@getYearly');
Route::get('/getDailydata','OverviewController@getDailydata');

Route::get('/getDailydataINV','OverviewController@getDailydataINV');
Route::get('/getMonthlydata','OverviewController@getMonthlydata');
Route::get('/getMonthlydataINV','OverviewController@getMonthlydataINV');

Route::get('/getYearlydataINV','OverviewController@getYearlydataINV');
Route::get('/getYearlydata','OverviewController@getYearlydata');
Route::get('/getlivedata','OverviewController@getlivedata');
Route::get('/getlastdata','OverviewController@getlastdata');
Route::get('/Siteinfo','InverterController@InverterDashboard');
Route::get('/Profile','InverterController@Profile');
Route::get('/m250changepass','InverterController@m250changepass');

Route::get('/getInvdata','InverterController@getInvdata');
Route::get('/getPcsStatus','InverterController@getPcsStatus');
Route::get('/InvDetail','InverterController@InvDetail');

Route::get('/InvDetaildaily','powerchartController@InvDetaildaily');
Route::get('/InvDetailmonthly','powerchartController@InvDetailmonthly');
Route::get('/InvDetailyearly','powerchartController@InvDetailyearly');
Route::get('/Export','powerchartController@export');


Route::get('/AllInv','InverterController@AllInv');
Route::get('/getlivePV','InverterController@getPvdata');
Route::get('/getPvdetail','InverterController@getPvdetail');



Route::get('/getsiteinfo','InverterController@getsiteinfo');
Route::get('/getInvinfo','InverterController@getInvinfo');
Route::get('/getmasterbox','InverterController@getmasterbox');

Route::get('/ExportexcelDay','ExportController@exportexcelDay');
Route::get('/exporterrorday','ExportController@exporterrorday');
Route::get('/exportexcelDaydetail','ExportController@exportexcelDaydetail');
Route::get('/exporterrordaydetail','ExportController@exporterrordaydetail');



Route::get('/ExportexcelMonth','ExportController@exportexcelMonth');
Route::get('/exporterrormonth','ExportController@exporterrormonth');
Route::get('/exportexcelMonthdetail','ExportController@exportexcelMonthdetail');
Route::get('/exporterrormonthdetail','ExportController@exporterrormonthdetail');


Route::get('/ExportexcelYear','ExportController@exportexcelYear');
Route::get('/exporterroryear','ExportController@exporterroryear');
Route::get('/exportexcelYeardetail','ExportController@exportexcelYeardetail');
Route::get('/exporterrorYeardetail','ExportController@exporterrorYeardetail');



Route::get('/Summary','ExportController@Summary');




Route::resource('site','SiteController');
Route::resource('Userlocal','UserLocalController');

// Z50-GW Project Controller.

Route::resource('Sitez50','SiteZ50Controller');
Route::resource('Userz50','Userz50Controller');


Route::get('/Z50APIINSERT','APIController@Z50APIINSERT');
Route::get('/TESTCOUNT','APIController@TESTCOUNT');

Route::get('/z50getDashboard','Z50Controller@z50getDashboard');

Route::get('/z50getlastpower','Z50Controller@z50getlastpower');
Route::get('/z50getlastpowerchart','Z50Controller@z50getlastpowerchart');

Route::get('/z50getlastpoweraccum','Z50Controller@z50getlastpoweraccum');
Route::get('/z50getlastpoweraccumchart','Z50Controller@z50getlastpoweraccumchart');


Route::get('/z50getlastRevenue','Z50Controller@z50getlastRevenue');

Route::get('/z50gettodayenergy','Z50Controller@z50gettodayenergy');


Route::get('/z50getlivedata','Z50Controller@z50getlivedata');
Route::get('/z50getlastdata','Z50Controller@z50getlastdata');

Route::get('/getInverror','Z50Controller@getInverror');
Route::get('/getInvsuppression','Z50Controller@getInvsuppression');
Route::get('/getInvrecoverytime','Z50Controller@getInvrecoverytime');


Route::get('/z50getlastmodel','Z50Controller@z50getlastmodel');
Route::get('/z50getlastSerial','Z50Controller@z50getlastSerial');
Route::get('/z50getlaststatus','Z50Controller@z50getlaststatus');


// Debug Zone
Route::get('/Debugz50','Z50debugcontroller@index');

Route::get('/Debugdaily','Z50debugcontroller@Debugdaily');
Route::get('/Debugmonthly','Z50debugcontroller@Debugmonthly');
Route::get('/Debugyearly','Z50debugcontroller@Debugyearly');

Route::get('/getDailyDebug','Z50debugcontroller@getDailyDebug');
Route::get('/getMonthlyDebug','Z50debugcontroller@getMonthlyDebug');
Route::get('/getYearlyDebug','Z50debugcontroller@getYearlyDebug');
// TEST ONLY
Route::get('/testfillter','Z50Controller@testfillter');
Route::get('/Insertsumofdata','Z50Controller@Insertsumofdata');
Route::get('/getserialnolist','Z50Controller@getserialnolist');
Route::get('/getstatustranfer','Z50Controller@getstatustranfer');
Route::get('/getstatusInverter','Z50Controller@getstatusInverter');
Route::get('/getstatuszeroexport','Z50Controller@getstatuszeroexport');

Route::get('/todayenergyItem','Z50Controller@todayenergyItem');

Route::get('/z50getinvoverview','Z50Controller@z50getinvoverview');
Route::get('/GotothisSite','Z50Controller@GotothisSite');
Route::get('/getZ50power_out','Z50Controller@getZ50power_out');
Route::get('/getINVStatus','Z50Controller@getINVStatus');

Route::get('/Z50detail','Z50Controller@Z50detail');
Route::get('/z50getlastpowerchartDetail','Z50Controller@z50getlastpowerchartDetail');
Route::get('/z50getlastpowerDetail','Z50Controller@z50getlastpowerDetail');
Route::get('/z50getlastpoweraccumchartDetail','Z50Controller@z50getlastpoweraccumchartDetail');
Route::get('/z50getlastpoweraccumDetail','Z50Controller@z50getlastpoweraccumDetail');
Route::get('/z50gettodayenergyDetail','Z50Controller@z50gettodayenergyDetail');
Route::get('/z50getlivedataDetail','Z50Controller@z50getlivedataDetail');
Route::get('/z50getlastdataDetail','Z50Controller@z50getlastdataDetail');
Route::get('/getInverrorDetail','Z50Controller@getInverrorDetail');
Route::get('/getInvsuppressionDetail','Z50Controller@getInvsuppressionDetail');
Route::get('/z50getlastRevenueDetail','Z50Controller@z50getlastRevenueDetail');
Route::get('/getInvrecoverytimeDetail','Z50Controller@getInvrecoverytimeDetail');
Route::get('/z50getlastdatalayoutdetail','Z50Controller@z50getlastdatalayoutdetail');
Route::get('/z50gettodayenergylayoutdetail','Z50Controller@z50gettodayenergylayoutdetail');
Route::get('/z50getlastmodellayoutdetail','Z50Controller@z50getlastmodellayoutdetail');
Route::get('/z50getlastSeriallayoutdetail','Z50Controller@z50getlastSeriallayoutdetail');
Route::get('/z50getlaststatuslayoutdetail','Z50Controller@z50getlaststatuslayoutdetail');
Route::get('/getzeroexportdetail','Z50Controller@getzeroexportdetail');
Route::get('/getstring1','Z50Controller@getstring1');
Route::get('/getstring2','Z50Controller@getstring2');
Route::get('/getstring3','Z50Controller@getstring3');

// Z50Export Zone
Route::get('/Z50Exportdaydetail','Z50exportController@Z50Exportdaydetail');
Route::get('/Z50Exportmonthdetail','Z50exportController@Z50Exportmonthdetail');
Route::get('/Z50Exportyeardetail','Z50exportController@Z50Exportyeardetail');

Route::get('/Z50ZExportday','Z50exportController@Z50ZExportday');
Route::get('/Z50ZExportmonth','Z50exportController@Z50ZExportmonth');
Route::get('/Z50ZExportyear','Z50exportController@Z50ZExportyear');

Route::get('/checktranfertime','Z50Controller@checktranfertime');


Route::get('/Z50Profile','Z50Controller@Z50Profile');


Route::get('/Updatesumofdata','Z50Controller@Updatesumofdata');


Route::get('/testurl','ProductController@testurl');

Route::get('/Linenotify','APIController@Linenotify');
Route::get('/TestNotify','APIController@TestNotify');
Route::get('/AlertModuleRestart','APIController@AlertModuleRestart');


Route::get('/MCOTmonthly','Z50exportController@MCOTmonthly');

Route::get('/Modulerestart','APIController@Modulerestart');

Route::get('/IntervalSumofZ50info','APIController@IntervalSumofZ50info');

Route::get('/Z50Managementuser','Z50manageuserController@index');
Route::resource('Userz50manage','Z50manageuserController');


Route::get('getlastaccumofallitem','Z50Controller@getlastaccumofallitem');

Route::get('getMonthlydataZ50','Z50PeriodGraphController@getMonthlydataZ50');
Route::get('getYearlydataZ50','Z50PeriodGraphController@getYearlydataZ50');



