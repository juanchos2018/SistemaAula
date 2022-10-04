

<table>
    <thead>
        <tr>
            <th>SEgundo Descarga</th>
            <th>SEgundo Descarga</th>
           
        </tr>
    </thead>
    <tbody>
       
            <tr>
                <td>Colegio de la salle</td>               
                <td>{{$USU_ROL}}</td>               
            </tr>
      
    </tbody>
  
</table>
<table>
    <thead>
        <tr>
            <th>Periodo</th>
            <th>Seccion</th>
            <th>Aisgnatura</th>
            <th>Regimen</th>
            <th>Orden</th>
            <th>UrlClase</th>            
        </tr>
    </thead>
    <tbody>
        @foreach($vsmatter as $item)
            <tr>
                <td>{{$item->PERIOS}}</td>
                <td>{{$item->vsections->SEC_NM}}</td>
                <td>{{$item->vsematers->MAT_NM}}</td>     
                <td>{{$item->vsematers->REGIME}}</td>
                <td>{{$item->ORDERS}}</td>
                <td>{{$item->CLINKS}}</td>
            </tr>
         @endforeach 
    </tbody>
</table>