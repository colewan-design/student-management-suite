<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
class attendance extends  Model implements AuditableContract
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'attendances';
    protected $primaryKey ='id';
    protected $fillable = [
        'student_id',
        'date',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
