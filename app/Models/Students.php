<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
class Students extends  Model implements AuditableContract
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'students';
    protected $primaryKey ='id';
    protected $fillable = [
        'account_id',
        'first_name',
        'middle_name',
        'last_name',
        'student_birthdate',
        'email',
        'contact_number',
        'level',
        'section',
        'address',
        'age',
        'dropout',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
