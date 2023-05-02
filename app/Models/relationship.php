<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
class relationship extends  Model implements AuditableContract
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'relationship';
    protected $primaryKey ='id';
    protected $fillable = [
        'relationship_id',
        'student_id',
        'student_name',
        'teacher_id',
        'teacher_name',
        'subject',
        'level',
        
      
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
