<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    static public function getImage($id)
    {
        $media = self::where('id', $id)->first();
        return $media->name;
    }
}
