<?php 

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Image;

trait ImageTrait 
{
    private $size = [
        Image::ICON => [
            'x' => 300, 
            'y' => 300
        ],
        IMAGE::SCREENSHOT => [
            'x' => 640, 
            'y' => 360
        ]
    ];

    protected function storeIcon(Request $request, $parent, $folder, $filename)
    {

        $path = $request->icon->storeAs($folder, $filename);

        $imageData = [
            'type' => Image::ICON, 
            'path' => $path, 
            'title' => "/app/".$parent->deleteString. 'icon', 
        ];

        if ($parent->icon == null) {
            $icon = $parent->icon()->create($imageData);
        } else {
            $icon = Image::where('id', $parent->icon->id)->update($imageData);
        }   
    }

//TODO
    function resize_image($file, $w, $h, $crop=FALSE) {
        list($width, $height) = getimagesize($file);
        $r = $width / $height;
        if ($crop) {
            if ($width > $height) {
                $width = ceil($width-($width*abs($r-$w/$h)));
            } else {
                $height = ceil($height-($height*abs($r-$w/$h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w/$h > $r) {
                $newwidth = $h*$r;
                $newheight = $h;
            } else {
                $newheight = $w/$r;
                $newwidth = $w;
            }
        }
        $src = imagecreatefromjpeg($file);
        $dst = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    
        return $dst;
    }


/*
    private function storeIcon(Request $request, $parent)
    {
        $folder = 'storage/images/jams';
        $filename = $request->input('slug') . "." . $request->icon->extension();
        $path = $request->icon->storeAs($folder, $filename);

        $imageData = [
            'type' => Image::ICON,
            'path' => $path
        ];

        if ($parent->icon == null) {
            $icon = $parent->icon()->create($imageData);
        } else {
            $icon = Image::where('id', $parent->icon->id)->update($imageData);
        }

    }*/
}