<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/svg+xml" href="img/calificaciones.ico" sizes="any">
    <link rel="stylesheet" type="text/css" href="css/post.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calificaciones</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<nav class="navbar navbar-default navbar-ststic-top">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="{{route('post.index')}}">Control de Calificaciones</a>
    </div>
  </div>
</nav>
<div class="container">
  @yield('content')
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
{{-- ajax Form Add Post--}}
  $(document).on('click','.create-modal', function() {
    $('#create').modal('show');
    $('.form-horizontal').show();
    $('.modal-title').text('Agregar Calificacion');
  });
  $("#add").click(function() {

   var f=new Date();
    $.ajax({
      type: 'POST',
      url: 'addPost',
      data: {
        '_token': $('input[name=_token]').val(),
        'calificacion': $('input[name=calificacion]').val(),
        'id_t_usuarios': $('select[name=id_t_usuarios]').val(),
        'id_t_materias': $('select[name=id_t_materias]').val()
         
      },
      success: function(data){
         
if ((data.errors)) {
          $('.error').removeClass('hidden');
          $('.error').text(data.errors.calificacion);
          $('.error').text(data.errors.id_t_usuarios);
          $('.error').text(data.errors.id_t_materias);
        } else {
          $('.error').remove();
          $('#table').append("<tr class='post" + data.id_t_calificaciones + "'>"+
          "<td>" + data.id+ "</td>"+
          "<td>" + data.id_t_materias + "</td>"+
          "<td>" + data.calificacion + "</td>"+
          "<td>" + data.id_t_materias + "</td>"+
          "<td>" + data.fecha_registro + "</td>"+
          "<td><button class='show-modal btn btn-info btn-sm' data-id_t_calificaciones='" + data.id_t_calificaciones + "' data-id_t_materias='" + data.id_t_materias + "' data-calificacion='" + data.calificacion + "' data-id_t_usuarios="+data.id_t_usuarios+"'><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id_t_calificaciones='" + data.id_t_calificaciones + "' data-id_t_materias='" + data.id_t_materias + "' data-calificacion='" + data.calificacion + "' data-id_t_usuarios="+data.id_t_usuarios+"'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id_t_calificaciones='" + data.id_t_calificaciones + "' data-id_t_materias='" + data.id_t_materias + "' data-calificacion='" + data.calificacion + "' data-id_t_usuarios="+data.id_t_usuarios+"'><span class='glyphicon glyphicon-trash'></span></button></td>"+
          "</tr>");
        }

      },
    });
    $('#id_t_materias').val('');
    $('#id_t_usuarios').val('');
    $('#calificacion').val('');
  });

// function Edit POST
$(document).on('click', '.edit-modal', function() {
$('#footer_action_button').text(" Modificar");
$('#footer_action_button').addClass('glyphicon-check');
$('#footer_action_button').removeClass('glyphicon-trash');
$('.actionBtn').addClass('btn-success');
$('.actionBtn').removeClass('btn-danger');
$('.actionBtn').addClass('edit');
$('.modal-title').text('Editar');
$('.deleteContent').hide();
$('.form-horizontal').show();
$('#fid').val($(this).data('id_t_calificaciones'));
$('#t').val($(this).data('calificacion'));
$('#myModal').modal('show');
});

$('.modal-footer').on('click', '.edit', function() {
  $.ajax({
    type: 'POST',
    url: 'editPost',
    data: {
'_token': $('input[name=_token]').val(),
'id_t_calificaciones': $("#fid").val(),
'calificacion': $('#t').val()
    },
success: function(data) {
      $('.post' + data.id_t_calificaciones).replaceWith(" "+
      "<tr class='post" + data.id_t_calificaciones + "'>"+
      "<td>" + data.id_t_calificaciones + "</td>"+
      "<td>" + data.id_t_materias + "</td>"+
      "<td>" + data.calificacion + "</td>"+
      "<td>" + data.fecha_registro + "</td>"+
        "<td><button class='show-modal btn btn-info btn-sm' data-id_t_calificaciones='" + data.id_t_calificaciones + "' data-id_t_materias='" + data.id_t_materias + "' data-calificacion='" + data.calificacion + "' data-id_t_usuarios="+data.id_t_usuarios+"' ><span class='fa fa-eye'></span></button> <button class='edit-modal btn btn-warning btn-sm' data-id_t_calificaciones='" + data.id_t_calificaciones + "' data-id_t_materias='" + data.id_t_materias + "' data-calificacion='" + data.calificacion + "' data-id_t_usuarios="+data.id_t_usuarios+"'><span class='glyphicon glyphicon-pencil'></span></button> <button class='delete-modal btn btn-danger btn-sm' data-id_t_calificaciones='" + data.id_t_calificaciones + "' data-id_t_materias='" + data.id_t_materias + "' data-calificacion='" + data.calificacion + "' data-id_t_usuarios="+data.id_t_usuarios+"'><span class='glyphicon glyphicon-trash'></span></button></td>"+
      "</tr>");
      location.reload(true);
    }
  });
});

// form Delete function
$(document).on('click', '.delete-modal', function() {
$('#footer_action_button').text(" Borrar");
$('#footer_action_button').removeClass('glyphicon-check');
$('#footer_action_button').addClass('glyphicon-trash');
$('.actionBtn').removeClass('btn-success');
$('.actionBtn').addClass('btn-danger');
$('.actionBtn').addClass('delete');
$('.modal-title').text('Borrar');
$('.id_t_calificaciones').text($(this).data('id_t_calificaciones'));
$('.deleteContent').show();
$('.form-horizontal').hide();
$('.calificacion').html($(this).data('calificacion'));
$('#myModal').modal('show');
});

$('.modal-footer').on('click', '.delete', function(){
  $.ajax({
    type: 'POST',
    url: 'deletePost',
    data: {
      '_token': $('input[name=_token]').val(),
      'id_t_calificaciones': $('.id_t_calificaciones').text()
    },
    success: function(data){
       $('.post' + $('.id_calificaciones').text()).remove();
       location.reload(true);
    }
  });
});

  // Show function
  $(document).on('click', '.show-modal', function() {
    var valor1 = $(this).data('id_t_usuarios');
     $.ajax({
    type: 'get',
    url: 'expedientePost',
    format: "dd/mm/yyyy",
    data: {
      '_token': $('input[name=_token]').val(),
      'id_t_usuarios': valor1
    },
    success: function(data){
       //alert(JSON.stringify(data));
    }
  });
  });
</script>
  </body>
</html>
