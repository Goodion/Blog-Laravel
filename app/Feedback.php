<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $guarded = ['id'];

    protected $table = 'feedbacks';
}
