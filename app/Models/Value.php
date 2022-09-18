<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Value
 *
 * @property-read \App\Models\Record|null $record
 * @method static \Illuminate\Database\Eloquent\Builder|Value newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Value newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Value query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $record_id
 * @property string $key
 * @property string $type
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereRecordId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Value whereValue($value)
 */
class Value extends Model
{
    use HasFactory;

    public function record(): BelongsTo
    {
        return $this->belongsTo(Record::class);
    }
}
