<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()

    {
        dd(220); 
        return Gallery::with('Image')->get();
    }

    public function show($id)
    {
        $gallery = Gallery::find($id);

        if(!isset($gallery)) {
            abort(404, "Gallery not found");
        }
        return $gallery;
    }
}
