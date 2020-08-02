<?php


namespace App\Library;
use Image;

class Help
{
    public static function saveImage($image,$folderName){
        $position = strpos($image, ';');
        $sub = substr($image, 0, $position);
        $ext = explode('/', $sub)[1];

        $name = time().".".$ext;
        $img = Image::make($image)->resize(240,200);
        $upload_path = 'backend/'.$folderName.'/';
        $image_url = $upload_path.$name;
        $img->save($image_url);

        return "/".$image_url;
    }

    public static function updateModelWithImage($model,$image,$folderName){
        $imgUrl = self::saveImage($image,$folderName);

        if ($imgUrl) {
            $image_path = substr($model->photo,1);
            if(file_exists($image_path)){
                unlink($image_path);
            }
        }

        return $imgUrl;
    }
}
