<?php

namespace App\Http\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ImagesService
{
    public $image;

    public function __contstruct($image)
    {
        $this->image = $image;
    }

    public function hashFile($image)
    {
        return Carbon::now()->toDateString()
            . Hash::make($image->getClientOriginalName())
            . "." . $image->getClientOriginalExtension();
    }
}
