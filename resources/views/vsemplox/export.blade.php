

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
            <th>Id</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Cedula</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vsemplox as $emplox)
            <tr>
                <td>{{$emplox->EMP_NO}}</td>
                <td>{{$emplox->LAS_NM}}</td>
                <td>{{$emplox->FIR_NM}}</td>
                <td>{{$emplox->IDTYPE}}</td>
            </tr>
         @endforeach 
    </tbody>
</table>