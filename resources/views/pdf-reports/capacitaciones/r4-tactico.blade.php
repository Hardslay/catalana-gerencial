<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>{{$text}}</title>
  </head>
  <body>
  <style>
    .page-break {
        page-break-after: always;
    }    
    </style>
    <div class="col-md-12">
        <div class="row mb-2">
            <div class="col-md-5 text-left">
                <img src="{{asset('images/logos/catalana.jpg')}}" height="70px" width="175px" alt="">
            </div>
            <div class="col-md-7">
                <div class="card">
                    <h4 class="card-title text-center pt-2"> Reporte de empleados que resuelven o no una capacitación</h4>
                </div>        
            </div>
        </div>
    </div>    
    <div class="text-center">
        <div class="card">
            <div class="card-body">
                <table class="table table-sm table-bordered" style="margin-top: -3rem; margin-bottom:-0.75rem;">
                    <thead class="thead-dark">                    
                        <tr>
                            <th style="font-size:90%" scope="col" colspan="2">Parámetros</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="font-size:90%" colspan="1"><strong>Capacitación</strong></td>
                            @if ($tipo =="TODAS")
                                <td style="font-size:90%" colspan="1">{{$tipo}}</td>
                            @else
                                <td style="font-size:90%" colspan="1">{{$tipo->training}}</td>
                            @endif                        
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
    @foreach ($query as $key => $table)
        <div class="text-center">
            <div class="card">
                <div class="card-body">
                    @if ($tipo == "TODAS")
                        <h5 class="card-title text-left">{{$table->training}}</h5>
                    @endif
                    <h6 class="card-subtitle mb-2 text-left">Realizados</h6>                
                    <table class="table table-sm table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th style="font-size:90%"scope="col" width="30px">#</th>
                                <th style="font-size:90%"scope="col" width="30px">ID</th>
                                <th style="font-size:90%"scope="col" width="300px">Empleado</th>
                                <th style="font-size:90%"scope="col" width="100px">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>                        
                            @if ($aprobados[$key]->count() == 0)
                                <tr><td style="font-size:90%" colspan="4"><p>No se encontraron registros</p></td></tr>                
                            @else
                                @foreach ($aprobados[$key] as $num => $apr)
                                    <tr>
                                        <td style="font-size:90%">{{$num+1}}</td>
                                        <td style="font-size:90%">{{$apr->employee->id}}</td>
                                        <td style="font-size:90%">{{$apr->employee->names}} {{$apr->employee->lastnames}}</td>
                                        @if ($apr->date == NULL)
                                            <td style="font-size:90%">Sin fecha</td>
                                        @else
                                            <td style="font-size:90%">{{$apr->date}}</td>
                                        @endif                                    
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="page-break"></div>
                    <h6 class="card-subtitle mb-2 text-left">No realizados</h6>
                    <table class="table table-sm table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th style="font-size:90%"scope="col" width="30px">#</th>
                                <th style="font-size:90%"scope="col" width="30px">ID</th>
                                <th style="font-size:90%"scope="col" width="300px">Empleado</th>
                            </tr>
                        </thead>                        
                        <tbody>        
                            @if ($reprobados[$key]->count() == 0)
                                <tr><td style="font-size:90%" colspan="4"><p>No se encontraron registros</p></td></tr>                
                            @else
                                @foreach ($reprobados[$key] as $num => $repr)
                                    <tr>
                                        <td style="font-size:90%">{{$num+1}}</td>
                                        <td style="font-size:90%">{{$repr->employee->id}}</td>
                                        <td style="font-size:90%">{{$repr->employee->names}} {{$repr->employee->lastnames}}</td>
                                    </tr>
                                @endforeach                                  
                            @endif        
                        </tbody>
                    </table>
                </div>
            </div>        
        </div>
    @endforeach        

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>