<?php

namespace App\Models;

use App\Traits\ModelUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Actor
 * @package App\Models
 * @version 1.0
 *
 * @uses \App\Traits\ModelUuid
 * @uses \Illuminate\Database\Eloquent\Model
 * @uses \Illuminate\Database\Eloquent\Relations\BelongsToMany
 *
 * @property-read string[] fillable
 * @property-read bool timestamps
 *
 * @property string id
 * @property string name
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @property BelongsToMany actors
 *
 * @method static firstOrCreate(array $args, array $data)
 */
class Actor extends Model
{
    use HasFactory;
    use ModelUuid;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Has timestamps
     * @var bool
     */
    public $timestamps = true;

    /**
     * Gets the actors
     * @return BelongsToMany<Movie>
     */
    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(Movie::class);
    }
}
