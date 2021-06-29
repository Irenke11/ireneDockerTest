<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class timeTest extends Model
{
    protected $table = 'timeTest';
    protected $primaryKey = 'id';
    protected $fillable = [
        'settingTime',
    ];
}
