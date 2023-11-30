<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{
    use HasFactory;
    protected $table = 'buku';
    protected $primaryKey = 'id';
    protected $dates = ['tgl_terbit'];
    protected $fillable = [
        'judul',
        'rating',
        'penulis',
        'harga',
        'tgl_terbit',
        'buku_seo',
        'filename', 
        'filepath', 
        'created_at',
        'update_at'
    ];


    /*
    * Relasi One-to-Many
    * ==================
    * Buat function bernama galleries(), dimana model 'Buku' memiliki
    * relasi One-to-Many (hasMany) terhadap model 'Gallery' yang
    * memiliki foreign key 'buku_id'
    */
    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function rating(): HasMany
    {
        return $this->hasMany(RatingModel::class);
    }

    public function favorites(): BelongsTo
    {
        return $this->belongsTo(FavoritesModel::class);
    }

}
