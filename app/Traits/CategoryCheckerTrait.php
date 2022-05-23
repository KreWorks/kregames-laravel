<?php 

namespace App\Traits;

use Illuminate\Http\Request;
use App\Models\Image;

trait CategoryCheckerTrait 
{
    public function hasCategory($jam, $categoryId)
    {
        foreach($jam->categories as $category) 
        {
            if ($category->id == $categoryId) 
            {
                return true;
            }
        }

        return false;
    }
}