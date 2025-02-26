<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Daftar opsi penyakit kronis yang tersedia
     *
     * @var array
     */
    const CHRONIC_DISEASES = [
        'sakit jantung' => 'Sakit Jantung',
        'asma' => 'Asma',
        'alergi' => 'Alergi',
        'penyakit kronis lainnya' => 'Penyakit Kronis Lainnya',
        'tidak memiliki penyakit kronis' => 'Tidak Memiliki Penyakit Kronis'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'chronic_disease',
        // tambahkan kolom lain yang ada di tabel admin
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
}