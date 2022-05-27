<?php 

namespace App\Traits;

use Illuminate\Filesystem\Filesystem;
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

    protected function handleImage(Request $request, $parent)
    {
        $folder = $parent->imageFolder;
        $class = get_class($parent);

        $fieldName = 'image';

        if ($class == "App\Models\Game") {
            $file = new Filesystem;
            if (!$file->isDirectory(storage_path($folder))) {
                $file->makeDirectory(storage_path($folder), 755, true, true);
            }
            if ($request->hasFile('icon')) {
                $fieldName = 'icon';
            }
        }
        else if ($class == "App\Models\Jam") {
            $fieldName = 'icon';
        }
        else if ($class == "App\Models\User") {
            $fieldName = 'avatar';
        }

        if ($request->hasFile($fieldName)) {
            $filename = $this->getFileName($request, $class, $parent);
            $title = $this->getTitle($request, $class, $parent);

            $imageData = $this->storeFile($request->file($fieldName), $folder, $filename, $title);

            $image = $this->saveImageToDB($imageData, $parent, $fieldName);
        }
    }

    private function saveImageToDB($imageData, $parent, $fieldName)
    {
        $image = null;

        if ($fieldName == 'image' || $parent->__get($fieldName) == null) {
            $image = $parent->images()->create($imageData);
        } else {
            $image = Image::where('id', $parent->__get($fieldName)->id)->update($imageData);
        }

        return $image;
    }

    private function getFileName(Request $request, $class, $parent)
    {
        if ($class == "App\Models\Game" && $request->hasFile('icon')) {
            return 'icon.' . $request->icon->extension();
        }
        else if ($class == "App\Models\Game") {
            return $request->image->getClientOriginalName();
        }
        else if ($class == "App\Models\Jam") {
            return 'jam-'.$parent->id.'-icon.' . $request->icon->extension();
        }
        else if ($class == "App\Models\User") {
            return 'avatar_'.$parent->id.'.' . $request->avatar->extension();
        }
    }

    private function getTitle(Request $request, $class, $parent)
    {
        if ($class == "App\Models\Game" && $request->hasFile('icon')) {
            return $parent->name.' icon';
        }
        else if ($class == "App\Models\Game") {
            return $request->input('title');
        }
        else if ($class == "App\Models\Jam") {
            return $parent->name.' icon';
        }
        else if ($class == "App\Models\User") {
            return $parent->name.' avatar';
        }

        return 'Nem találtunk feliratot.';
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