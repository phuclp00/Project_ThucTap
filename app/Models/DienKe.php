<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DienKe extends Model
{
    use HasFactory;
    protected $table = "dienke";
    protected $primaryKey = 'madk';
    public $incrementing = false;
    protected $keyType = 'string';
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
    protected $fillable = [
        'madk',
        'makh',
        'ngaysx',
        'ngaylap',
        'mota',
        'trangthai',
        'create_at',
        'create_by',
        'update_at',
        'update_by'
    ];
    protected $casts = [
        'ngaysx' => 'datetime',
        'ngaylap' => 'datetime',
        'update_at' => 'datetime',  
        'create_at'  => 'datetime',
    ];

    /**
     * Get the user that owns the DienKe
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function khachhang()
    {
        return $this->belongsTo(KhachHangModel::class, 'makh');
    }
}
