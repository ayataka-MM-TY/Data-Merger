<?php

namespace App\Entity\JSON;

use App\Models\Record;
use App\Models\Value;
use Carbon\Carbon;

class JSONConvertedRecord
{
    public ?string $priorityDate;
    public ?int $priorityNumber;
    /** @var JSONConvertedValue[] $values */
    public array $values = [];

    /**
     * @param string $recordID UUID
     */
    public function __construct(
        public readonly string $recordID,
    ) {}

    public function append(JSONConvertedValue $value): void
    {
        $this->values[] = $value;
    }

    public function isValid(): bool
    {
        return $this->priorityDate !== null
            && $this->priorityNumber !== null;
    }

    public function save(string $uploadID): void
    {
        $record = new Record;
        $record->upload_id = $uploadID;
        $record->priorityNumber = $this->priorityNumber;
        $record->priorityDate = new Carbon($this->priorityDate);
        $record->save();

        $values = array_map(fn(JSONConvertedValue $value) => $value->saveArray($record->id), $this->values);
        Value::upsert($values, ["id"]);
    }
}
