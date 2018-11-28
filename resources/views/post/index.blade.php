{{-- calling layouts \ app.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="row">
  <div class="col-md-12">
    
  </div>
</div>

<div class="row">
  <div class="table table-responsive">
    <table class="table table-bordered" id="table">
      <tr>
        <th width="150px">No</th>
        <th>Matricula</th>
        <th>Materia</th>
        <th>Calificacion</th>
        <th>Fecha de Registro</th>
        <th class="text-center" width="150px">
          <a href="#" class="create-modal btn btn-success btn-sm">
            <i class="glyphicon glyphicon-plus"></i>
          </a>
        </th>
      </tr>
      {{ csrf_field() }}
      <?php  $no=1; ?>
      @foreach ($post as $value)
        <tr class="{{$value->id_t_calificaciones}}">
          <td>{{ $no++ }}</td>
          <td>{{ $value->id_t_usuarios }}</td>
          <td>{{ $value->id_t_materias }}</td>
          <td>{{ $value->calificacion }}</td>
          <td>{{ $value->fecha_registro }}</td>
          <td>
            <a href="#" class="show-modal btn btn-info btn-sm" data-id_t_calificaciones="{{$value->id_t_calificaciones}}" data-id_t_materias="{{$value->id_t_materias}}" data-calificacion="{{$value->calificacion}}" data-id_t_usuarios="{{$value->id_t_usuarios}}">
              <i class="fa fa-eye"></i>
            </a> 
            <a href="#" class="edit-modal btn btn-warning btn-sm" data-id_t_calificaciones="{{$value->id_t_calificaciones}}" data-id_t_materias="{{$value->id_t_materias}}" data-calificacion="{{$value->calificacion}}">
              <i class="glyphicon glyphicon-pencil"></i>
            </a>
            <a href="#" class="delete-modal btn btn-danger btn-sm" data-id_t_calificaciones="{{$value->id_t_calificaciones}}" data-id_t_materias="{{$value->id_t_materias}}" data-calificacion="{{$value->calificacion}}">
              <i class="glyphicon glyphicon-trash"></i>
            </a>
          </td>
        </tr>
      @endforeach
    </table>
  </div>
  {{$post->links()}}
</div>
{{-- Modal Form Create Post --}}
<div id="create" class="modal fade" role="dialog">
  <div  class="modal-dialog">
    <div id="post-it" class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form id="anidar" class="form-horizontal" role="form">
          <div class="form-group row add">
            <label class="control-label col-sm-2" for="id_t_materias">Materia</label>
            <div class="col-sm-10">
          <select class="form-control" id="id_t_materias" name="id_t_materias">
              
          @foreach($users as $user)
          <option value='{{$user->id_t_materias}}'> {{ $user->nombre }} </option>
          @endforeach
             </select>
              <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="calificacion">Calificacion</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="calificacion" name="calificacion"
              placeholder="Ingresa la calificacion" required>
              <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>

              <div class="form-group">
            <label class="control-label col-sm-2" for="id_t_usuarios">Alumno</label>
            <div class="col-sm-10">
            <select class="form-control" id="id_t_usuarios" name="id_t_usuarios">
                    @foreach($users2 as $user2)
          <option value="{{$user2->id_t_usuarios}}"> {{ $user2->nombre. ' '.$user2->ap_paterno . ' '.$user2->ap_materno }} </option>
          @endforeach
          </select>
               <p class="error text-center alert alert-danger hidden"></p>
            </div>
          </div>


        </form>
      </div>
          <div class="modal-footer">
            <button class="btn btn-success" type="submit" id="add">
              <span class="glyphicon glyphicon-plus"></span>Guardar
            </button>
          </div>
    </div>
  </div>
</div></div>
{{-- Modal Form Show POST --}}
<div id="show" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
                  </div>
                    <div class="modal-body">
                    <div class="form-group">
                      <label for="">Alumno :</label>
                      <b id="ti"/>
                    </div>
                    <div class="form-group">
                      <label for="">Materia:</label>
                      <b id="by"/>
                    </div>
                   <div class="form-group">
                      <label for="">Calificacion:</label>
                      <b id="ca"/>
                    </div>
                    </div>
                    </div>
                  </div>
</div>
{{-- Modal Form Edit and Delete Post --}}
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div id="post-it2" class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="modal">
          <div class="form-group">
       
            <div class="col-sm-10">
              <input type="hidden" class="form-control" id="fid" disabled>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2"for="calificacion">Calificacion</label>
            <div class="col-sm-10">
            <input type="name" class="form-control" id="t">
            </div>
          </div>
        </form>
                {{-- Form Delete Post --}}
        <div class="deleteContent">
          ¿Seguro que lo eliminaras<span class="title"></span>?
          <span class="hidden id_t_calificaciones"></span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn actionBtn" data-dismiss="modal">
          <span id="footer_action_button" class="glyphicon"></span>
        </button>
     
      </div>
    </div>
  </div>
</div>
@endsection