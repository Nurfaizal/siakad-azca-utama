<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementNews extends Model
{
    protected $table = 'announcement_news';

    protected $guarded = ['id_news'];

    protected $primaryKey = 'id_news';
}
