<?php

namespace App\Http\Controllers;

use App\Video;
use App\Location;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

//https://scotch.io/tutorials/simple-laravel-crud-with-resource-controllers
class VideoController extends Controller {

  private $rootPath = 'videos';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    // get all the nerds
    $videos = Video::orderBy('title')->get();

    return view('videos.index')
            ->with('videos', $videos);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $locations = Location::orderBy('name')->get(['id', 'name'])->toArray();
    $tags = Tag::orderBy('name')->get(['id', 'name'])->toArray();

    $valLoc = [];
    foreach ($locations as $location) {
      $valLoc[$location['id']] = $location['name'];
    }
    
    foreach ($tags as $key => $tag) {
      $tags[$key]['checked'] = false;
    }

    return view('videos.create')
            ->with('locations', $valLoc)
            ->with('tags', $tags);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $this->validate($request, [
      'title' => 'required|max:200',
      'file' => 'required|mimes:mp4,m4v',
    ]);

    $file = $request->file('file');
    $fileName = $this->getFilename($file);

    $file->storeAs($this->rootPath, $fileName);

    $video = new Video;
    $video->title = $request->title;
    $video->duration = $request->duration;
    $video->bit_rate = $request->bit_rate;
    $video->path = $fileName;
    $video->size = $file->getSize();
    $video->format = $file->getMimeType();

    $video->location_id = $request->location_id | 0;

    $video->save();

    $video->tags()->sync(array_values($request->tag));

    Session::flash('message', 'Video created successfully');
    return Redirect::route('video.index');
  }

  /**
   * Display the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    $video = Video::find($id);

    // show the edit form and pass the video
    return view('videos.show')
            ->with('video', $video);
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $video = Video::find($id);
    $locations = Location::orderBy('name')->get(['id', 'name'])->toArray();
    $tags = Tag::orderBy('name')->get(['id', 'name'])->toArray();

    $selecTags = [];
    $videoTags = $video->tags()->get(['tag_id'])->toArray();
    foreach ($videoTags as $videoTag) {
      $selecTags[] = $videoTag['tag_id'];
    }

    foreach ($tags as $key => $tag) {
      $tags[$key]['checked'] = in_array($tag['id'], $selecTags);
    }

    $valLoc = [];
    foreach ($locations as $location) {
      $valLoc[$location['id']] = $location['name'];
    }

    // show the edit form and pass the video
    return view('videos.edit')
            ->with('video', $video)
            ->with('locations', $valLoc)
            ->with('tags', $tags);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {

    $this->validate($request, [
      'title' => 'required|max:200',
      'file' => 'mimes:mp4,m4v',
    ]);

    $video = Video::find($id);

    $file = $request->file('file');
    if ($file) {
      // Delete previous file
      Storage::delete(Storage::url($video->path));

      $fileName = $this->getFilename($file);

      $file->storeAs($this->rootPath, $fileName);

      $video->path = $fileName;
      $video->size = $file->getSize();
      $video->format = $file->getMimeType();
    }

    $video->title = $request->title;
    $video->duration = $request->duration;
    $video->bit_rate = $request->bit_rate;
    $video->location_id = $request->location_id | 0;

    $video->save();

    $video->tags()->sync(array_values($request->tag));

    Session::flash('message', 'Video updated successfully');
    return Redirect::route('video.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function confirm($id) {
    $video = Video::find($id);

    // show the edit form and pass the video
    return view('videos.confirm')
            ->with('video', $video);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {

    $video = Video::find($id);

    // Delete previous file
    Storage::delete(Storage::url($video->path));

    $video->delete();

    // redirect
    Session::flash('message', 'Video deleted successfully');
    return Redirect::route('video.index');
  }

  private function getFilename(UploadedFile $file) {
    $fileName = time() . '.' . $file->getClientOriginalName();
    return $fileName;
  }

}
