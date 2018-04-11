<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-9
 * Time: 15:40
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GifSupport extends Model
{
    protected $fillable = ['user_id', 'gif_id', 'support'];
}