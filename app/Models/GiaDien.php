<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiaDien extends Model
{
    use HasFactory;
    protected $table = "giadien";
    protected $primaryKey = 'mabac';
    public $incrementing = false;
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
    protected $fillable = [
        'mabac',
        'tenbac',
        'tusokw',
        'densokw',
        'dongia',
        'ngayapdung',
        'create_at',
        'create_by',
        'update_at',
        'update_by'
    ];
    protected $casts = [
        'update_at' => 'datetime',
        'create_at'  => 'datetime',
    ];
}
