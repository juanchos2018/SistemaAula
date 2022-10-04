

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
                  
            </tr>
      
    </tbody>
  
</table>
<table>
    <thead>
        <tr>
            <th>Año</th>
            <th>Peridoo</th>
            <th>Tipo Id</th>
            <th>No Id</th>
            <th>Estado</th>
            <th>Seccion</th>            
        </tr>
    </thead>
    <tbody>
        @foreach($vstudents as $item)
            <tr>
                <td>{{$item->STD_NO}}</td>
                <td>{{$item->SEC_NO}}</td>
                <td>{{$item->PERIOS}}</td>     
                <td>{{$item->LAS_NM}}</td>
                <td>{{$item->IDTYPE}}</td>
                <td>{{$item->IDE_NO}}</td>
            </tr>
         @endforeach 
    </tbody>
</table>