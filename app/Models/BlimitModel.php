<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlimitModel extends Model
{
    // Table Name
    protected $table = 'old_limits';

    protected $primaryKey = 'b_limits_id';

  	protected $fillable =[
        'user_id', 
        'market_cost', 
        'travelling_cost', 
        'fuel_cost', 
        'postage_cost',
        'fax_cost',
    ];
}
