<?php
namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait FileUploadTrait
{

    public function uploadFile($file, $file_original, $path)
    {
        $pathinfo = pathinfo($file_original, PATHINFO_FILENAME);
        $filename = $pathinfo."_".Str::random(10).".".$file->extension();
        return $url = \Storage::putFileAs($path,$file, $filename);

    }
}
