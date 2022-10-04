

<table>
    <thead>
        <tr>
            <th>Empresa</th>
           
        </tr>
    </thead>
    <tbody>
       
            <tr>
                <td>Colegio de la salle</td>               
            </tr>
      
    </tbody>
  
</table>
<table>
    <thead>
        <tr>
            <th>SEC_ID</th>
            <th>PERIOS</th>
            <th>FECREG</th>
            <th>HORREG</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vscheduls as $emplox)
            <tr>
                <td>{{$emplox->SEC_ID}}</td>
                <td>{{$emplox->PERIOS}}</td>
                <td>{{$emplox->FECREG}}</td>
                <td>{{$emplox->HORREG}}</td>
            </tr>
         @endforeach 
    </tbody>
</table>