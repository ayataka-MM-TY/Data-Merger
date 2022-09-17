<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Ramsey\Uuid\Nonstandard\Uuid;
use function Symfony\Component\Translation\t;

/**
 * App\Models\Project
 *
 * @property string $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Upload[] $uploads
 * @property-read int|null $uploads_count
 */
class Project extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'uuid';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributes['id'] = Uuid::uuid4();
    }

    public function uploads(): HasMany
    {
        return $this->hasMany(Upload::class);
    }

    public function recordCount(): int
    {
        return $this->uploads
            ->flatMap(fn (Upload $upload) => $upload->records)
            ->count();
    }

    public function lastUploadDate(): ?Carbon
    {
        dump($this);
        dump($this->uploads);
        return $this->uploads->map(fn(Upload $upload) => $upload->created_at)->max();
    }
}
