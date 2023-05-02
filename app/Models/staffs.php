<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
class staffs extends  Model implements AuditableContract
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'staffs';
    protected $primaryKey ='id';
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'role',
        'contract_type',
        'shift',
        'location',
        'joining_date',
      
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
