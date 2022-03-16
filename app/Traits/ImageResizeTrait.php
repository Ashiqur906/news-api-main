<?php
namespace App\Traits;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Models\Post;

trait ImageResizeTrait{

    
    private function upload($file , $imageable_id , $existing_id)
    {
        
        // Get file from request 
        // $file = $request->file('thumbnail');
       
        // Get filename with extension
      $filenameWithExt = $file->getClientOriginalName();

        // Get file path
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Remove unwanted characters
        $filename = preg_replace("/[^A-Za-z0-9 ]/", '', $filename);
        $filename = preg_replace("/\s+/", '-', $filename);

        // Get the original image extension
        $extension = $file->getClientOriginalExtension();

        // Create unique file name
        $fileNameToStore = $filename . '_' . time() . '.' . $extension;

        // Refer image to method resizeImage
        $save = $this->resizeImage($file, $fileNameToStore , $imageable_id , $existing_id);

        // return $save;
    }

    public function resizeImage($file, $fileNameToStore , $imageable_id ,  $existing_id)
    { 
        $date = date('Y-m');
        $folder_name = str_replace(':', '', $date);
        // $member =auth()->user();
        // $name = $request->get('name');
        // $size = $request->get('size');
        $attributes = [
            'imageable_id' => $imageable_id,
            'imageable_type' => Post::class,
            'name' => null,
            'file_name' => null,
            'featured' => false,
            'mime_type' => null,
            'is_active' => 'Yes',
        ];
       
        $sizes = [
            'small' => [150, 150],
            'medium' => [300, 169],
            'thumbnail' => [768, 432],
            'full' => [1024, 576],
        ];
        


        foreach ($sizes as $key => $size) {
            // Resize image
            $resize = Image::make($file)->fit($size[0], $size[1])->encode('jpg');
            // Create hash value
            $hash = md5($resize->__toString());
            // Prepare qualified image name
            $image = $hash . "jpg";
            // Put image to storage
            $save = Storage::put("dropzon/{$folder_name}/{$key}/{$fileNameToStore}", $resize->__toString());

            if ($save) {
                $attributes[$key] = "/dropzon/{$folder_name}/{$key}/{$fileNameToStore}";
            }
        }
        
        $pictures = Picture::where('imageable_id' , $imageable_id)->get();
        foreach ($pictures as $key => $value) {
            $value->delete(); 
        }
        $insert = Picture::create($attributes);
       
    }


}