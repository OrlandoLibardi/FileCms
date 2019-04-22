<?php

namespace OrlandoLibardi\FilesCms\app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;
use OrlandoLibardi\FilesCms\app\Repositories\ImageRepository;
use OrlandoLibardi\FilesCms\app\Http\Requests\ImageRequest;
use OrlandoLibardi\FilesCms\app\Http\Requests\FolderRequest;
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
                $file['dir'] = $fp['dirname'];
                $file['basename'] = $fp['basename'];
                $file['realname'] = $f;
                $file['url'] = Storage::url($f);
                $file['extension'] = $fp['extension'];
                $file['time'] = date('d/m/Y H:i:s', Storage::lastModified($f));
                $file['size'] = Storage::size($f);
                list($width, $height) = getimagesize(storage_path('app/'. $f));
                $file['width'] = $width;
                $file['height'] = $height;
                $file['temp'] = $f;
                $return[] = $file;
            }
        }
        return $return;
    }
    public function createFolder(Request $request)
    {
        $validator = validator($request->all(), [
            'name' => 'required',
            'base_path' => 'required'
        ]);

        if($validator->fails()) {
            return response()
                   ->json(array( 
                           'success' => false, 
                           'message' => __('messages.request_error'), 
                           'status'  =>  'error',  
                           'errors'   =>  $validator->errors()->all() 
                        ), 422);
        }

        $directory = $request->base_path . "/" . str_slug($request->name);
        Storage::makeDirectory($directory);

        return response()
               ->json(array( 
                   'message' => __('messages.create_success'), 
                   'status'  =>  
                   'success' ), 
                200);
    }
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

        $validator = validator($request->all(),  [
            'dir' => 'required',
            'file' => 'required'
        ]);
        if($validator->fails()) 
        {
            return response()
                ->json(array(
                    'success' => false, 
                    'message' => __('messages.request_error'), 
                    'status'  =>  'error',  
                    'errors'   =>  $validator->errors()->all() 
                ), 422);
        }
        foreach($request->file('file') as $file) 
        {
            $file->storeAs($request->dir, $file->getClientOriginalName());
        }
        return response()
                ->json(array(
                    'success' => false,
                    'message' => __('messages.create_success'), 
                    'status'  =>  'error',  
                    'errors'   =>  $request->all() 
                ), 201);

    }

    public function storeDirectorieFiles(Request $request)
    {
        $directory = ($request->directory) ?  $request->directory : "public/";
        $files = Storage::files($directory);
        $directories = Storage::directories($directory);        
        $dirs = [];
        $return = "";
        foreach($directories as $d)
        {
            $dirs[] = $this->pathInfo($d);
        }
        if($files){
            $return = $this->filesInfo($files);
        }
        return response()
               ->json(array( 
                   'status'  =>  'success', 
                   'message' => __('messages.load_success'), 
                   'directories' => $dirs, 
                   'files' => $return, 
                   'directory' => $directory), 
                   201);
    }
    /*
        @imageUpdate
    */
    public function imageUpdate(ImageRequest $request)
    {
        $image = new ImageRepository();

        if($request->rename==true){
            $new_name = $image->tempName($request->image);
            $image->cloneImage($request->image, $request->folder, $new_name);
            $request->image = $new_name;
        }

        if($request->size['r_width'] > 0 )
        {
            $size = array('width' => $request->size['r_width'], 'height' => $request->size['r_height']);
            $image->imageResize($request->folder, $request->image, $size);
        }
        else
        {
            if($request->size['x'] != 0 && $request->size['y'] != 0 )
            {
                $image->imageCrop($request->folder, $request->image, $request->size);
            }

            if($request->size['width'] != 0 &&  $request->size['height'] != 0 )
            {
                $image->imageResize($request->folder, $request->image, $request->size);
            }            
            
            if($request->size['directionX'] != 'false')
            {
                $image->imageFlip($request->folder, $request->image, "h");
            }

            if($request->size['directionY'] != 'false')
            {
                $image->imageFlip($request->folder, $request->image,  "v");
            }

            if($request->size['rotate'] != 0)
            {
                $image->imageRotate($request->folder, $request->image, $request->size);
            }
        }
        return response()
        ->json(array(
            'message' => __('messages.update_success'),
            'status'  =>  'success',
            'directory' => $request->folder
        ), 201);
    }    
    /**
     * @imageRename
     */
    public function imageRename(ImageRequest $request)
    {
        $image = new ImageRepository();
        $final_name =  $image->removeExtension($request->new_image);
        $final_name = str_slug($final_name);
        $image->rename($request->folder, $request->image, $final_name);
        return response()
        ->json(array(
            'message' => __('messages.update_success'),
            'status'  =>  'success',
            'directory' => $request->folder
        ), 201);
       
    }
    /**
     * imageDestroy
     */
    public function imageDestroy(ImageRequest $request)
    {
        $image = new ImageRepository();
        $image->delete($request->folder . "/", $request->image);
        return response()
        ->json(array(
            'message' => __('messages.delete_success'),
            'status'  =>  'success',
            'directory' => $request->folder
        ), 201);
    }
    /**
     * @folderRename
     */
    public function folderRename(FolderRequest $request)
    {
        $image = new ImageRepository();
        $image->renameFolder($request->folder, $request->new_folder);
        return response()
        ->json(array(
            'message' => __('messages.update_success'),
            'status'  =>  'success'
        ), 201);
    }
     /**
     * @folderDestroy
     */
    public function folderDestroy(FolderRequest $request)
    {
        $image = new ImageRepository();
        $image->deleteFolder($request->folder);
        return response()
        ->json(array(
            'message' => __('messages.delete_success'),
            'status'  =>  'success'
        ), 201);
    }


}