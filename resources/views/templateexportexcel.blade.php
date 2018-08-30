<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>TTE M250 Overview Report</h3>
@foreach($Site as $sites)  
<table>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td>{{$sites->Capacity}}</td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td>{{$sites->InstallationType}}</td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td>{{$sites->INVModel}}</td>
</tr>
<tr>
<td></td>
<td></td>
<td>{{$sites->SiteName}}</td>
<td></td>
<td>{{$sites->FIT}}</td>
</tr>
@endforeach
</table>
    <table>
    <thead>
        <tr>
        
            <th>Masterbox</th>
            <th>Inverter</th>
            <th>SerialNo</th>

        </tr>
    </thead>
    @foreach($MB as $MBs)
    <tr>
        <td style="text-align:center;" > Masterbox id:   {{$MBs->MBxID}}</td>
        @foreach($INV as $datas)
            @if($MBs->MBxID == $datas->MBxID)
        <tr>
            <td></td>
            <td>InvID: {{$datas->PcsID}}</td>  
            <td>SerialNo: {{$datas->SerialNo}}</td>  
            </tr>
            @endif      
        @endforeach
       
    </tr>
    
    @endforeach
    </table>
    <h3>Data report</h3>
    <table>
        <thead>
            <tr>
                <th>Time-stamp</th>
                <th>Temperature (°C)</th>
                <th>Solar Irradiation(W/m2)</th>
                <th>Energy(kWh)</th>
                <th>Power(kW)</th>
            </tr>
        </thead>
    
    <tbody>
    @foreach($info as $jj)
        <tr style="text-align:center;" >
            <td>{{$jj->Time}}</td>
            <td>0</td>
            <td>0</td>
            <td>{{$jj->energy}}</td>
            <td>{{$jj->power}}</td>
        </tr>
    @endforeach
    </tbody>
    </table>
</body>
</html>