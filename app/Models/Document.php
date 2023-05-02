<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
class document extends  Model implements AuditableContract
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'documents';
    protected $primaryKey ='id';
    protected $fillable = [
        'id',
        'document_id',
        'document_file',
        'title',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

}
