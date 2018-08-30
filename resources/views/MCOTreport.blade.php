<table >  
@foreach($Site as $sites)
    <tbody>
    <tr></tr>
    <tr></tr>
    <tr></tr>
        <tr>
       

        <td style="text-align:left;" >Report of </td>
        <td style="text-align:left;"></td>
    
        </tr>
        <tr>
       

        <td style="text-align:left;">Create at </td>
        <!-- <td style="text-align:left;" >{{":".$sites->SiteName}}</td> -->
        </tr>
        <tr></tr>
     
        <tr>
        

        <td style="text-align:left;">Money per unit </td>
        <td style="text-align:left;" >{{":  ".$sites->FIT." "."   THB"}}</td>
        </tr>
        <tr>
        

        <td style="text-align:left;">Co2_Criterion </td>
        <td style="text-align:left;" >{{":  ".$sites->Co2_Criterion."/kwh"}}</td>
        </tr>
        <tr>
        <td style="text-align:left;">Total power generate </td>
        <td style="text-align:left;" >{{":  ".$PoweraccumTOTAL." "."   kWh"}}</td>
        
        </tr>
        <tr></tr>

        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td style="text-align:left;">: {{$PoweraccumTOTAL*$sites->FIT." THB."}}</td>
      <td></td>
      <td></td>
      <td></td>

      <td style="text-align:left;">: {{number_format($PoweraccumTOTAL*$sites->Co2_Criterion,0)." kg."}}</td>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      <tr></tr>
      
    </tbody>
    @endforeach
    </table>
   
   <th>Date-Time</th>
   <td></td>
   <th>Serial No</th>
   <!-- <td></td>
   <th>Notify</th> -->
   <td></td>
   <th font-weight:bold; >Description</th>


       <!--  -->
       <tr></tr>
    <tr></tr>
    
    @for($i = 0; $i < count($Date_time); $i++)

    
    <tr>
    <td>{{$Date_time[$i]}}</td>
    <td>{{$SerialNo[$i]}}</td>
    </tr> 
    <tr></tr>
    @endfor
 
    <!--  -->
    <td></td>
    
    

 