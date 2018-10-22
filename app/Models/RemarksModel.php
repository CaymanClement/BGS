<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RemarksModel extends Model
{
    protected $table = 'remarks';

     protected $primaryKey = 'remark_id';

  protected $fillable =[
    	'budget_id',
        'actual_cost',
        'final_remarks',
        'reviewer',
        'reviewer2',
        'reviewer3',
        'remark_status',
    ];

}
