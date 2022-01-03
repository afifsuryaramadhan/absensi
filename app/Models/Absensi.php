<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;

class Absensi extends Model
{
    use HasFactory;
    use MediaAlly;

    protected $table = 'absensi';

    protected $fillable = [
        'foto',
        'id_user',
        'id_kegiatan',
        'is_confirmed'
    ];


    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function univ()
    {
        return $this->belongsTo(Univ::class, 'id_univ');
    }
}
