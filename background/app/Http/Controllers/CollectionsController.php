<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-13
 * Time: 15:15
 */

namespace App\Http\Controllers;

use App\Transformers\GifTransformer;
use Illuminate\Support\Facades\Auth;

class CollectionsController extends Controller
{

    public function index()
    {
        $collections = Auth::user()->collections;
        return $this->response->collection($collections,new GifTransformer());
    }
}