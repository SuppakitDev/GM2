<table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Energy</th>
            </tr>
        </thead>
    
    <tbody>
    @for ($i = 1; $i <= 31; $i++)
    <tr style="text-align:center;" >
        @foreach($Monthdata as $Monthdatas)
            @if($Monthdatas->x == $i)
            
                <td>{{$Monthdatas->x}}</td>
                <td>{{$Monthdatas->y}}</td>
              

            @endif
            
        @endforeach
       
        
                <td>{{$i}}</td>
                <td>0</td>
               
        </tr>
    @endfor
    </tbody>
    </table>