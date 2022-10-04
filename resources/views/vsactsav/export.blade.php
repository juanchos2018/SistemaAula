

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
            <th>Seccion</th>
            <th>Asignatura</th>
            <th>Regimen</th>
            <th>Docente</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vsactsavs as $item)
            <tr>
                <td>{{$item->SEC_NM}}</td>
                <td>{{$item->MAT_NM}}</td>
                <td>{{$item->REGIME}}</td>
                <td>{{$item->FIR_NM}}</td>
            </tr>
         @endforeach 
    </tbody>
</table>