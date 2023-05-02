<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
class Rooms extends  Model implements AuditableContract
{
    use HasFactory;
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    protected $table = 'rooms';
    protected $primaryKey ='id';
    protected $fillable = [
        'room_id',
        'room_name',
        'building_id',
        'room_number',
        'maximum_capacity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
