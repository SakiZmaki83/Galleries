<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;
use App\Image;

use JWTAuth;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gallery::with('images')->with('user')->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, JWTAuth $auth)
    {
       $gallery = new Gallery();

       $validator = Validator::make($request->all(), [
           'name' => 'required|unique:galleries',
           'description' => 'required',
           'imageUrl' => 'required'
       ]);

       if($validator->fails()) 
       {
           return new JsonResponse($validator->errors(), 400);
       }

       $gallery->user_id = $auth->parseToken()->toUser()->id;
       $gallery->name = $request->input('name');
       $gallery->description = $request->input('description');
       $imageUrls = $request->input('imageUrl');

       $gallery->save();
       $imageArr= [];

       foreach($imageUrls as $imageUrl)
       $gallery->images()->create(['imageUrl'=> $imageUrl]);
       return $gallery;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Gallery::where('id', $id)->with('images', 'user')->first();  
      }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::find($id);
        $gallery->gallery_name = $request->input('gallery_name');
        $gallery->description = $request->input('description');
    
        $gallery->save();
        return $gallery;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
