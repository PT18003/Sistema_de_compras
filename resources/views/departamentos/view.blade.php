@extends('layouts.app')
@section('title','Departamentos')
@section('content')


  <div class="py-12">
   
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container card-body ">                  
                    <div class="branding">
                   <h1>Departamentos</h1>
                    <p>  <a class="" href="{{route('departamentos.create')}}" role="button">Agregar.</a></p>
                    </div>   

                    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departamentos as $item)
                            <tr>
                            <!---
                                    route('areatrabajos.show',$areatrabajo->id) 
                                    -->
                                <th scope="row">{{$item->id}}</th>
                                <td>{{$item->departamento}}</td>
                                <td>
                                    <a href="{{route('departamentos.edit',$item->id)}}"><i class="material-icons md-18">edit</i></a>
                                    {{-- BOTON PARA BORRAR, pero usa un GET --}}
                                    <a href="{{route('departamentos.destroy',$item)}}"><i class="material-icons md-18">delete</i></a>
                                    {{-- BOTON PARA BORRAR, pero usa un POST con el metodo DELETE DEL ROUTE --}}
                                    {{--             
                                    <form action="{{route('departamentos.destroy',$item)}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger"><i class="material-icons md-18">delete</i></button>
                                    </form> 
                                    --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $departamentos->links() }}
 
                  </div>
                  
                           
            </div>
        </div> 
    </div>

    <div class="py-12 d-none">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container card-body ">                  
                    <div class="branding">
                   <h1>Departamentos</h1>
                    <p>  <a class="" href="{{route('departamentos.create')}}" role="button">Agregar.</a></p>
                    </div>   
                       {{--de aquie en adelante--}}
      

                    
                    <div class="container">
                    
                        <div class="panel panel-default">              
                            <div>
                                <div id="message"></div>
                                    <div class=>
                                        <table class="table table-hover ">
                                            <thead>
                                                <tr>
                                                    <th scope="col">id</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cuerpo">
                                            
                                            </tbody>
                                        </table>
                                        {{ csrf_field() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--hasta aqui--}}
                    
                </div>
            </div>
        </div> 
    </div>  
              
  @endsection         
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
     $(document).ready(function(){
       
        fetch_data();
        function fetch_data()
        {
            $.ajax({
                url:"{{ route('departamentos.get_data') }}", 
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    html +='<tr>';
                     html +='<td></td>';
                    html +='<td contenteditable id="departamento"></td>';
                    html +='<td><button type="button" class="btn btn-success btn-sm" id="add">Agregar</button></td></tr>';
                    
                    for(var count=0;count < data.length;count++)
                    {
                        html += '<tr>';
                        html += '<td class="column_name" data-column_name="id" data-id="'+data[count].id+'"> '+data[count].id+'</td>';
                        html += '<td contenteditable class="column_name" data-column_name="departamento" data-id="'+data[count].id+'"> '+data[count].departamento+'</td>';

                    
                        html += '<td><button type="button" class="btn btn-danger btn-sm delete" id="'+data[count].id+'">Eliminar</button></td></tr>';
                    }
                     $('#cuerpo').html(html);
                }
            });
        }
        var _token = $('input[name="_token"]').val();

        $(document).on('click', '#add', function(){
          
            var departamento = $('#departamento').text();
           
            if(departamento != '')
            {
                $.ajax({
                    url:"{{ route('departamentos.add_data') }}",
                    method:"POST",
                    data:{ departamento:departamento, _token:_token},
                    success:function(data)
                    {
                    $('#message').html(data);
                    fetch_data();
                    }
                });
            }
            else
            {
                $('#message').html("<div class='alert alert-danger'>Asegurese de llenar todos los campos</div>");
            }
        });

         $(document).on('blur', '.column_name', function(){
            var column_name = $(this).data("column_name");
            var column_value = $(this).text();
            var id = $(this).data("id");
          
            if(column_value != '')
            {
            $.ajax({
                url:"{{ route('departamentos.update_data') }}",
                method:"POST",
                data:{column_name:column_name, column_value:column_value, id:id, _token:_token},
                success:function(data)
                {
                $('#message').html(data);
                }
            })
            }
            else
            {
                $('#message').html("<div class='alert alert-danger'>Enter some value</div>");
            }
        });

        $(document).on('click', '.delete', function(){
            var id = $(this).attr("id");
            if(confirm("¿Seguro que quiere eliminar?"))
            {
            $.ajax({
                url:"{{ route('departamentos.delete_data') }}",
                method:"POST",
                data:{id:id, _token:_token},
                success:function(data)
                {
                $('#message').html(data);
                fetch_data();
                }
            });
            }
        });

    });
    </script>