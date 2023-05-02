<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
class Teacher extends  Model implements AuditableContract
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'teachers';
    protected $primaryKey ='id';
    protected $fillable = [
        'position',
        'major_subject',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'room_name',
        'contact_number',
      
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
