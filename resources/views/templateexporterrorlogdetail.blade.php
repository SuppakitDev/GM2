<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>TTE M250 Error log Report</h3>
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
    <tr>
        <td style="text-align:center;" > Masterbox id:   {{$INV->MBxID}}</td>
        
            
        
            
            <td>InvID: {{$INV->PcsID}}</td>  
            <td>SerialNo: {{$INV->SerialNo}}</td>  
            
          
        </tr>
    </table>
    <h3>Data report</h3>
    <table>
        <thead>
            <tr>
                <th>Time-stamp</th>
                <!-- <th>Master Box ID</th>                
                <th>PCS NO</th> -->
                <th>Serial No</th>
                <th>Error Code</th>
                <th>Description</th>
            </tr>
        </thead>
    
    <tbody>
    @foreach($info as $jj)
        <tr style="text-align:center;" >
            <td>{{$jj->Time}}</td>
            <!-- <td>{{$jj->MBxID}}</td>            
            <td>{{$jj->PcsID}}</td> -->
            <td>{{$jj->SerialNo}}</td>
            <td>{{$jj->ErrorCode}}</td>
            <td>{{$jj->tbErrorDescripts->Descript}}</td>
        </tr>
    @endforeach
    </tbody>
    </table>
</body>
</html>