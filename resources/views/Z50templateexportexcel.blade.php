<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h3>TTE GW-Z50 Report</h3>
@foreach($ZS0Site as $ZS0Sites)  
<table>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td>{{$ZS0Sites->C_ID}}</td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td>{{$ZS0Sites->INVModel}}</td>
</tr>
<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td>{{$ZS0Sites->Co2_Criterion}}</td>  <!-- เปลี่ยนเป็น Co2 -->
</tr>
<tr>
<td></td>
<td></td>
<td>{{$ZS0Sites->SiteName}}</td>
<td></td>
<td>{{$ZS0Sites->FIT}}</td>
</tr>
@endforeach
</table>
    <table>
    <thead>
        <tr>
            <th>SerialNo</th>
        </tr>
    </thead>
    <tr>
        @foreach($Z50serialnolist as $Z50serialnolists)
        <tr>
            <td></td>  
            <td>SerialNo: {{$Z50serialnolists}}</td>  
            </tr>
                
        @endforeach
       
    </tr>  
    </table>
    <h3>Data report</h3>
    <table>
        <thead>
            <tr>
                <th>Time</th>
                <th>Powerout Total</th>
                <th>Poweraccum Total</th>
                <th>Co2</th>
                <th>Total Revenue</th>
            </tr>
        </thead>
    
    <tbody>
    @foreach($info as $jj)
        <tr style="text-align:center;" >
            <td>{{$jj->created_at}}</td>
            <td>{{$jj->RT_powerout}}</td>
            <td>{{$jj->RT_poweraccum}}</td> 
            <td><?php
             echo number_format($jj->RT_poweraccum*$Co2 , 2, '.', '');?>
            </td> 
            <td><?php
             echo number_format($jj->RT_poweraccum*$FIT , 2, '.', '');?>
            </td>        
        </tr>
    @endforeach
    </tbody>
    </table>
</body>
</html>