<?php

namespace App\Http\Services;

use File;

use Illuminate\Http\UploadedFile;

class UploaderService
{
    /**
     * @param UploadedFile $file
     * @param $folder
     * @return string
     */
    public function upload(UploadedFile $file, $folder)
    {
        $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';
        $path = public_path() . '/assets/uploads/' . $folder . '/' . $date_path;

        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        $file_name = date('YmdHis') . mt_rand() . '_' . $folder . '.' . $file->getClientOriginalExtension();

        if ($file->move($path, $file_name)) {
            return $img = '/assets/uploads/' . $folder . '/' . $date_path . $file_name;
        }
    }
    ////////////////////////////////////


    public function uploadWithArray($file, $folder)
    {
        foreach ($file as $image) {

            $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';
            $path = public_path() . '/assets/uploads/' . $folder . '/' . $date_path;

            if (!File::exists($path)) {
                File::makeDirectory($path, 0777, true);
            }

            $file_name = date('YmdHis') . mt_rand() . '_' . $folder . '.' . $image->getClientOriginalExtension();

            if ($image->move($path, $file_name)) {

                $img = '/assets/uploads/' . $folder . '/' . $date_path . $file_name;

                $data[] = $img;

            }
        }

        return json_encode($data);
    }

    ////////////////////////////////////

    public function uploadOutSide(UploadedFile $file, $folder)
    {
        $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';
        $path = '/home/rxegy/public_html/backend_exploration/public/assets/uploads/' . $folder . '/' . $date_path;

        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }

        $file_name = date('YmdHis') . mt_rand() . '_' . $folder . '.' . $file->getClientOriginalExtension();

        if ($file->move($path, $file_name)) {


            return $img = '/assets/uploads/' . $folder . '/' . $date_path . $file_name;
        }

    }

    public function deleteFile($file_name)
    {
        $file_path = public_path() . $file_name;
        if (File::exists($file_path)) {
            File::delete($file_path);
        }
        return true;
    }

    public function handleBase64Image($image, $folder)
    {

        $image_parts = explode(";base64,", $image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $date_path = date("Y") . '/' . date("m") . '/' . date("d") . '/';

        $path = public_path() . '/assets/uploads/' . $folder . '/' . $date_path;
        if (!File::exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
        $fileName = uniqid() . '.'.$image_type ;
        $file = $path. $fileName;
        file_put_contents($file, $image_base64);
        return $img = '/assets/uploads/' . $folder .'/'.$date_path . $fileName;

    }
}
