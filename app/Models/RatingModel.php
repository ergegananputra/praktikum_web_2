<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RatingModel extends Model
{
    use HasFactory;

    protected $table = 'buku_rating';
    protected $primaryKey = 'id';
    protected $fillable = [
        'rating',
        'buku_id'
    ];

    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class);
    }

}
