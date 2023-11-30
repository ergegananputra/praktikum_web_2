<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FavoritesModel extends Model
{
    use HasFactory;

    protected $table = 'favorites';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'buku_id'
    ];

    public function buku() : HasMany
    {
        return $this->hasMany(Buku::class);
    }

    public function user() : HasMany
    {
        return $this->hasMany(User::class);
    }
}
