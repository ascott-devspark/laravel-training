<?php

namespace App\Http\Controllers;

use App\Location;
use App\Tag;
use Illuminate\Http\Request;

class MetadataController extends Controller {
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
    $tags = Tag::orderBy('name')->get();
    $locations = Location::orderBy('name')->get();

    return view('metadata.index')
      ->with('tags', $tags)
      ->with('locations', $locations);
  }
}
