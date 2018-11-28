<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Escuela;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use DB;	
use Carbon\Carbon;
class PostController extends Controller
{
    //
      public function index(){

        $usuarios = DB::table('t_materias')
              ->select('id_t_materias','nombre')
               ->get();

        $usuarios2 = DB::table('t_alumnos')
              ->select('id_t_usuarios','nombre','ap_paterno','ap_materno')
               ->get();    



      $post = Escuela::paginate(4);
      return view('post.index',compact('post'),['users' => $usuarios,'users2' => $usuarios2]);

    }

    public function addPost(Request $request){

$rules = array (
            'id_t_usuarios' => 'required',
        'id_t_materias' => 'required',
        'calificacion' => 'required'
    );
    $validator = Validator::make ( Input::all (), $rules );
    
  
    if ($validator->fails ())
        return Response::json ( array (
                    
                'errors' => $validator->getMessageBag ()->toArray ()
        ) );
        else{
            $fecha_actual = Carbon::now();
            $date = $fecha_actual->format('Y-m-d');
           return Escuela::create([
            'id_t_materias'    => $request['id_t_materias'],
            'id_t_usuarios' =>$request['id_t_usuarios'],
            'calificacion'     => $request['calificacion'],
            'fecha_registro'     =>  $date,
        ]);
        
        return response()->json([ 'msg' => 'Calificacion Registrada']);
        }

   

          
}

public function Escuela(request $request){
  $post = Escuela::find ($request->id_t_calificaciones);
  $post->calificacion = $request->calificacion;
  $post->save();
  return response()->json($post);
}

public function editPost(request $request){
  $post= DB::table('t_calificaciones')
    ->where('id_t_calificaciones',  $request['id_t_calificaciones'])
    ->update(['calificacion' => $request['calificacion'] ]);
//$post = Escuela::find ($request->id_t_calificaciones)->update($request->all());
return response()->json([ 'msg' => 'Calificacion Registrada']);

}


public function deletePost(request $request){
    $post= DB::table('t_calificaciones')
  ->where('id_t_calificaciones',  $request['id_t_calificaciones'])
  ->delete();
return response()->json([ 'msg' => 'Calificacion eliminada']);
}

public function expedientePost(request $request){

$post = DB::table('t_calificaciones')
            ->join('t_materias', 't_calificaciones.id_t_materias', '=', 't_materias.id_t_materias')
            ->join('t_alumnos', 't_calificaciones.id_t_usuarios', '=', 't_alumnos.id_t_usuarios')
            ->select( 't_materias.nombre',DB::raw('CONCAT(t_alumnos.nombre, " ", t_alumnos.ap_paterno , " ", t_alumnos.ap_materno) AS Alumno , t_calificaciones.calificacion'),DB::raw('DATE_FORMAT(t_calificaciones.fecha_registro, "%d-%b-%Y") as fecha'))
            ->where('t_calificaciones.id_t_usuarios',  $request['id_t_usuarios'])
            ->get();

$subpro = DB::table('t_calificaciones')
          ->where('id_t_usuarios', $request['id_t_usuarios'])
          -> avg('calificacion');

 

            return response()->json($post."promedio:".$subpro);


  //return Redirect::action('PostController@index');
 
//return response()->json([ 'msg' => $request]);
}






}
