<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-9
 * Time: 15:41
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GifCollection extends Model
{
    use SoftDeletes;

    protected $fillable = ['gif_id', 'user_id'];
    protected $table = 'gif_collections';

    /*public function gif()
    {
        $this->belongsTo(Gif::class,'id','gif_id');
    }*/
}