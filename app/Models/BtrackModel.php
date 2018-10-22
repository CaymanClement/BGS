<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BtrackModel extends Model
{
    protected $table = 'budget_track';

    protected $primaryKey = 'bt_id';

  	protected $fillable =[
        'user_id', 
        'budget_id', 
        'status_info', 
        'comment',
    ];
}
