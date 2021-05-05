<?php

namespace App\Models;

use App\Http\Controllers\DienkeController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHangModel extends Model
{
    use HasFactory;
    protected $table = "khachhang";
    protected $primaryKey = 'makh';
    public $incrementing = false;
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
    protected $keyType = 'string';
    protected $fillable = [
        'makh',
        'tenkh',
        'diachi',
        'dt',
        'cmnd',
        'create_at',
        'create_by',
        'update_at',
        'update_by'
    ];
    protected $casts = [
        'update_at' => 'datetime',
        'create_at'  => 'datetime',
    ];
    /**
     * Get all of the comments for the KhachHangModel
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function dienke()
    {
        return $this->hasMany(DienKe::class, 'makh');
    }
}
