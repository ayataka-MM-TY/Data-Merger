<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Ramsey\Uuid\Nonstandard\Uuid;

/**
 * App\Models\Record
 *
 * @property string $id
 * @property string $upload_id
 * @property string $priorityDate
 * @property int $priorityNumber
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Upload $upload
 * @method static \Illuminate\Database\Eloquent\Builder|Record newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Record newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Record query()
 * @method static \Illuminate\Database\Eloquent\Builder|Record whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record wherePriorityDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record wherePriorityNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Record whereUploadId($value)
 * @mixin \Eloquent
 */
class Record extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'uuid';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributes['id'] = Uuid::uuid4();
    }

    protected $casts = [
        'priorityDate' => 'datetime'
    ];

    public function upload(): BelongsTo
    {
        return $this->belongsTo(Upload::class);
    }
}
