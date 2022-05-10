<?php

namespace App\Models;

use App\Traits\ModelUuid;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Movie
 * @package App\Models
 * @version 1.0
 *
 * @uses \App\Traits\ModelUuid
 * @uses \Illuminate\Database\Eloquent\Model
 * @uses \Illuminate\Database\Eloquent\Relations\BelongsToMany
 * @uses \Illuminate\Database\Eloquent\SoftDeletes
 *
 * @property-read string[] fillable
 * @property-read bool timestamps
 *
 * @property int id
 * @property string $title
 * @property int $year
 * @property DateTime $created_at
 * @property DateTime $updated_at
 * @property DateTime $deleted_at
 * @property BelongsToMany $actors
 *
 * @method static findOrFail(string $id)
 * @method static paginate(int $int)
 * @method static firstOrCreate(array $args, array $data)
 */
class Movie extends Model
{
    use HasFactory;
    use ModelUuid;
    use SoftDeletes;

    /**
     * @var string[]
     */
    protected $fillable = [
        'year',
        'title',
    ];

    /**
     * Has timestamps
     * @var bool
     */
    public $timestamps = true;

    /**
     * Gets the actors
     * @return BelongsToMany<Actor>
     */
    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(Actor::class);
    }
}
