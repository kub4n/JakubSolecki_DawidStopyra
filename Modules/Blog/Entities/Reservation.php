<?php

namespace Modules\Blog\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use Translatable;

    protected $table = 'blog__reservations';
    public $translatedAttributes = ['user_id', 'owner_id', 'data', 'comment_ask', 'comment_reply', 'status'];
    protected $fillable = ['post_id', 'user_id', 'owner_id', 'data', 'comment_ask', 'comment_reply', 'status'];
}
