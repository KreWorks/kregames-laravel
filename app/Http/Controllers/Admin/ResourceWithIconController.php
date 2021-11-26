<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Image;

abstract class ResourceWithIconController extends ResourceController
{
    protected function storeIcon(Request $request, $parent, $folder, $filename)
    {
        $path = $request->icon->storeAs($folder, $filename);

        $imageData = [
            'type' => Image::ICON, 
            'path' => $path, 
            'title' => $parent->deleteString. 'icon', 
            'alt_title' => $parent->deleteString. ' icon'
        ];

        if ($parent->icon == null) {
            $icon = $parent->icon()->create($imageData);
        } else {
            $icon = Image::where('id', $parent->icon->id)->update($imageData);
        }   
    }

    abstract protected function checkImage(Request $request, $entity);
}
