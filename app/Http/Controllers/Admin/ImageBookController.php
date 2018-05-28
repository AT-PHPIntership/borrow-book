<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ImageBook;

class ImageBookController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param ImageBook $image image
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ImageBook $image)
    {
        $image->delete();
        return response()->json($image);
    }
}
