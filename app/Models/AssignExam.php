<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
class AssignExam extends  Model implements AuditableContract
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'assign_exams';
    protected $primaryKey = 'id';
    protected $fillable = [
        'student_id',
        'exam_id',
        'date_assigned',
        'date_due',
        'score',
        'status',
        'notes',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
