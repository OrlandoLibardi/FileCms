<?php

namespace OrlandoLibardi\FilesCms\app\Repositories;

use Intervention\Image\ImageManagerStatic as Image;
use Storage;
use File;
use Log;

class ImageRepository{
 
    public function __construct(){
        Log::info( "-- ImageRepository -- \n"  . PHP_EOL );
    }

    public function teste(){
        return "ola";
    }

    /**
     * Salva e redimenciona uma imagem
     * @param $path, $image, array $size
     * @return string $image 
     */

    public function saveImage($path, $image, $size){
        
        Log::info( "-- saveImage -- \n"  . PHP_EOL );

        Log::info( "-- saveImage path: {$path} -- \n"  . PHP_EOL );
        Log::info( "-- saveImage image: {$image} -- \n"  . PHP_EOL );

        $temp = implode(",", $size);
        Log::info( "-- saveImage size {$temp} -- \n"  . PHP_EOL );
        

        $this->checkFolder($path);

        $name = $this->tempName($image);

        $image = $this->replaces($image);

        $this->save($image, $path, $name);

        $this->imageResize($path, $name, $size);

        return $name;

    }

    public function replaces($image){
        return str_replace("storage/", "public/", $image);
    }

    /**
     * Redimenciona a imagem
     * @param $path, $image, array $size
     * @return void
     */
    public function imageResize($path, $image, $size)
    {
        $path = str_replace("public/", "storage/", $path);
        $path = str_replace("/", "\\", $path);
        $temp  = public_path(  $path . "\\" . $image);        
        Image::make($temp)->fit($size['width'], $size['height'])->save($temp);

    }

    /**
     * Gera um nome único para o arquivo
     * @param $file
     * @return string $name;
     */
    public function tempName($file)
    {
        $original_name = $file;
        $ext = explode(".", $original_name);
        $ext = end($ext);
        return sha1($original_name . time() ) . "." .$ext;
    }

    /**
     * Salva a imagem ou arquivo
     */
    public function save($file, $path, $alias)
    {
        if(Storage::exists($file))
        {

            $this->delete($path, $alias);

            Storage::copy($file, $path . $alias);

            return "";
        }

        $file->storeAs($path, $alias);
    }

    /**
     * Verifica se o diretório existe se não existir tentar cria-lo
     * @param $path
     */
    public function checkFolder($path)
    {
        if(!Storage::exists($path)){
            Storage::makeDirectory($path);
        }
    }
    /**
     * Path info
     */
    public function pathInfo($path){
        $p = array();
        $temp = explode("/",$path);
        $p['name'] = end($temp);
        $p['path'] = $path;
        $p['time'] = date('d/m/Y H:i:s', Storage::lastModified($path));
        return $p;
    }
    /**
     * File info para imagens
     */
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
    public function rename($path, $original_name, $final_name)
    {

        if(substr_count($final_name, ".") == 0){
            $ext = explode(".", $original_name);
            $ext = end($ext);
            $final_name = $final_name . "." . $ext;
        }

        $this->delete($path, $final_name);

        Storage::move($path . $original_name , $path . $final_name);

        return $final_name;

    }
    public function delete($path, $file)
    {
        if(Storage::exists($path . $file))
        {
            Storage::delete($path . $file);
        }
    }
}