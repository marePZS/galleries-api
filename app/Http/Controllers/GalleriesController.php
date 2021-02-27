<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;


class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $filter = $request->query('filter', '');
        $galleries = Gallery::search($filter)->with('user', 'pictures')->orderBy('id', 'DESC')->get();
        return response()->json($galleries);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGalleryRequest $request)
    {
        $data = $request->validated();
        $newGallery = auth()->user()->galleries()->create($data);
        return response()->json($newGallery);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return response()->json($gallery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGalleryRequest $request, $id)
    {
        $data = $request->validated();
        $gallery = Gallery::findOrFail($id);
        $gallery->update($data);
        return response()->json($gallery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return response()->json($gallery);
    }
}
