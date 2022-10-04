

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
        @foreach($vsabsents as $item)
            <tr>
                <td>{{$item->SEC_ID}}</td>
                <td>{{$item->PERIOS}}</td>
                <td>{{$item->FECREG}}</td>     
                <td>{{$item->FECREG}}</td>     
                <td>{{$item->FECREG}}</td>     
                <td>{{$item->FECREG}}</td>     
           
            </tr>
         @endforeach 
    </tbody>
</table>