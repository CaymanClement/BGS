<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BudgetTrackModel extends Model
{
       // Table Name
    protected $table = 'budget_track';

    protected $primaryKey = 'bt_id';

  	protected $fillable =[
        'user_id', 
        'budget_id', 
        'status_info', 
        'comment',
    ];
}
