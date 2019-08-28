<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormBoolean extends Model
{

    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at','form_details_id'];

}