<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileModel extends Model
{
    // Table Name
    protected $table = 'file';

  	protected $fillable =[
        'name', 
        'email', 
        'phone', 
    ];

}
