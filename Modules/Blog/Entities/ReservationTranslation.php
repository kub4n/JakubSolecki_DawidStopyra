<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;

class ReservationTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['user_id', 'owner_id', 'data', 'comment_ask', 'comment_reply', 'status'];
    protected $table = 'blog__reservation_translations';
}
