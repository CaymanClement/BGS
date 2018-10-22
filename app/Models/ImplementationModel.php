<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImplementationModel extends Model
{
          // Table Name
    protected $table = 'implementation';

    protected $primaryKey = 'implementation_id';

  	protected $fillable =[
         
        'budget_id', 
        'date_of_visit', 
        'place',
        'activities',
        'description',
        'remarks',
        'actual_cost',
        'total_cost',
        'expected_premium',
        'bgen_date',
        'reason',
        'status',
    ];
}
