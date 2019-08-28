<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class FormDetails extends Model
{
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at','is_active','user_id'];

    public function formBooleans()
    {
        return $this->hasOne('App\FormBoolean', 'form_details_id');
    }
}