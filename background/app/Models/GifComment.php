<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-9
 * Time: 15:36
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GifComment extends Model
{

    protected $fillable = ['gif_id', 'user_id', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}