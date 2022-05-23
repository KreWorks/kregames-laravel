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

    protected function storeIcon(Request $request, $parent, $folder, $filename, $title)
    {
        $imageData = $this->storeFile($request->icon, $folder, $filename, $title);

        if ($parent->icon == null) {
            $icon = $parent->icon()->create($imageData);
        } else {
            $icon = Image::where('id', $parent->icon->id)->update($imageData);
        }
    }

    protected function storeAvatar(Request $request, $parent, $folder, $filename)
    {
        $imageData = $this->storeFile($request->avatar, $folder, $filename, $parent->username. ' avatar');

        if ($parent->avatar == null) {
            $icon = $parent->avatar()->create($imageData);
        } else {
            $icon = Image::where('id', $parent->avatar->id)->update($imageData);
        }
    }

    private function storeFile($file, $folder, $filename, $title)
    {
        $path = $file->storeAs($folder, $filename);

        return [
            'type' => Image::ICON, 
            'path' => $path, 
            'title' => $title, 
        ];
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