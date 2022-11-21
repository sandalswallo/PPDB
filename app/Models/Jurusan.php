<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Jurusan extends Model
{
    use HasFactory;

    protected $table = 'Jurusan';

    protected $guarded = [];

    public function Siswa(){
        return $this->hasMany(Siswa::class);
    }
}
