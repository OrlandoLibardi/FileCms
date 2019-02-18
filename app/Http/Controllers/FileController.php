<?php

namespace OrlandoLibardi\FilesCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class FileController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        return view ( 'admin.files.index' );

    }

    public function pathInfo($path){
        $p = array();
        $temp = explode("/",$path);
        $p['name'] = end($temp);
        $p['path'] = $path;
        $p['time'] = date('d/m/Y H:i:s', Storage::lastModified($path));
        return $p;
    }


    public function filesInfo($files)
    {
        $return = [];
        foreach ($files as $f){
            $fp = pathinfo($f);
            if(in_array(strtolower($fp['extension']), array("jpg", "jpeg", "gif", "png", "bmp"))){
                $file = [];
                $file['name'] = $fp['filename'];
                $file['realname'] = $f;
                $file['url'] = Storage::url($f);
                $file['extension'] = $fp['extension'];
                $file['time'] = date('d/m/Y H:i:s', Storage::lastModified($f));
                $file['size'] = Storage::size($f);

                $return[] = $file;
            }
        }

        return $return;

    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }
    public function createFolder(Request $request){
        $validator = validator($request->all(),
        [ 'name' => 'required',
        'base_path' => 'required'] );

        if($validator->fails()) {
            return response()->json(array( 'success' => false, 'message' => 'Os dados fornecidos são inválidos.', 'status'  =>  'error',  'errors'   =>  $validator->errors()->all() ), 422);
        }

        $directory = $request->base_path . "/" . $request->name;
        Storage::makeDirectory($directory);
        return response()->json(array( 'message' => 'Criado com sucesso!', 'status'  =>  'success' ), 201);
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

        $validator = validator($request->all(),
        [ 'dir' => 'required',
        'file' => 'required'] );
        if($validator->fails()) {
            return response()->json(array( 'success' => false, 'message' => 'Os dados fornecidos são inválidos.', 'status'  =>  'error',  'errors'   =>  $validator->errors()->all() ), 422);
        }


        foreach($request->file('file') as $file) {
            $file->storeAs($request->dir, $file->getClientOriginalName());
        }

        return response()->json(array( 'success' => false, 'message' => 'Chegamos aqui!', 'status'  =>  'error',  'errors'   =>  $request->all() ), 201);

    }




    public function storeDirectorieFiles(Request $request){

        $directory = ($request->directory) ?  $request->directory : "public/";

        $files = Storage::files($directory);
        $directories = Storage::directories($directory);
        $files = Storage::files($directory);
        $dirs = [];
        $return = "";
        foreach($directories as $d){
            $dirs[] = $this->pathInfo($d);
        }
        if($files){
            $return = $this->filesInfo($files);
        }

        return response()->json(array( 'status'  =>  'success', 'message' => 'Load Concluído!', 'directories' => $dirs, 'files' => $return, 'directory' => $directory), 201);
    }

}
