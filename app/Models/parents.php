<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
class parents extends  Model implements AuditableContract
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'parents';
    protected $primaryKey ='id';
    protected $fillable = [
        'account_id',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'child_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
