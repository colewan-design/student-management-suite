<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
class Subjects extends  Model implements AuditableContract
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'subjects';
    protected $primaryKey ='id';
    protected $fillable = [
        'subject_id',
        'subject_name',
        'grade',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
