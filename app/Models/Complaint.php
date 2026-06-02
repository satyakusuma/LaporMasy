<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignment).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image_path',
        'status',
    ];

    /**
     * Relasi ke model User (Masyarakat).
     * Menyatakan bahwa setiap pengaduan dimiliki oleh satu User (Masyarakat).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}