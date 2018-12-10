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
        <td style="text-align:center;" >{{$SerialNo}}</td>
    </tr>
    
   
    </table>
    <h3>Data report</h3>
    <table>
        <thead>
            <tr>
                <th>Time</th>
                <th>Status</th>
                <th>Errorcode</th>
                <th>Energy(kWh)</th>
                <th>Power(kW)</th>
                <th>Co2</th>
                <th>Total Revenue</th>
                <th>Statuspowerfactor</th>
                <th>Input_Cstr1</th>
                <th>Acvoltage_str1</th>
                <th>Input_Vstr2</th>
                <th>Input_Cstr2</th>
                <th>Accurrent</th>
                <th>Input_Vstr3</th>
                <th>Input_Cstr3</th>
                <th>Frequency</th>
                <th>RT_powerfactor</th>
                <th>Suppression</th>
                <th>Recoverytime</th>
                <th>Zero Export</th>
                <th>Zero Export(Logic)</th>
                <th>Powermetervalue</th>
                <th>Sum_of_Pinv_and_Ppt</th>
            </tr>
        </thead>
    
    <tbody>

    @for($Record = 0 ; $Record <= $SIZEOFRECORD-1 ; $Record++)
        <tr style="text-align:center;" >
                @for($Column = 0 ; $Column <=22 ; $Column++)
                    <td>{{$CSVEXPORT[$Column][$Record]}}</td>
                @endfor
        </tr>
    @endfor
    </tbody>
    </table>
</body>
</html>