<table >  
@foreach($Site as $sites)
    <tbody>
    <tr></tr>
    <tr></tr>
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Report date :</td>
        <td></td>
        </tr>
        <tr></tr>
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Site Name :</td>
        <td>{{$sites->SiteName}}</td>
        </tr>
        <tr></tr>
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Feed-in tariff :</td>
        <td>{{$sites->FIT}}</td>
        </tr>
        <tr></tr>
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Capacity :</td>
        <td>{{$sites->Capacity}}</td>
        </tr>
        <tr></tr>
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Installation type :</td>
        <td>{{$sites->InstallationType}}</td>
        </tr>
        <tr></tr>
        <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>Inverter model :</td>
        <td>{{$sites->INVModel}}</td>
        </tr>
        <tr></tr>
        <tr></tr>
      
    </tbody>
   
    </table>
    <table>
    <td></td>
    @foreach($totalmonth as $totalmonths)
    <td>Monthly energy :</td>
    <td></td>    
    <td>{{$totalmonths->y}}</td>
    <td>kWh</td>    
    <tr></tr>
    <tr></tr>
    <td></td>
    <td>Return money :</td>
    <td></td>    
    <td>{{$totalmonths->y*$sites->FIT}}</td>
    <td>THB</td>    
    <tr></tr>
    @endforeach
    @endforeach
    <tr></tr>
    <td></td>
    @foreach($mbxinfo as $mbxinfos)
    <td>Average temp :</td>
    <td></td>    
    <td>{{$mbxinfos->Temp}}</td>
    <td>°C</td>
    
    <tr></tr>
    <tr></tr>
    <td></td>
    <td>Irradiant (Max) :</td>
    <td></td>    
    <td>{{$mbxinfos->Irr}}</td>
    <td>Wh/m^2</td>
    
    <tr></tr>
    @endforeach
    </table>