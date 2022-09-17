<?php

namespace App\Entity\Merge;

use App\Models\Record;
use App\Models\Value;
use Illuminate\Database\Eloquent\Collection;

class MergeRecords
{
    public function __construct(
        private readonly Collection $records,
    ) {
        $this->records->load('values');
    }

    public function json(): array {
        return $this->records
            ->map(function (Record $record) {
                $collection = collect();
                $collection = $collection->merge([
                    'priorityDate' => $record->priorityDate,
                    'priorityNumber' => $record->priorityNumber,
                ]);
                foreach ($this->mergeTitles() as $title => $candidates) {
                    $value = $record->values->first(fn(Value $value) => in_array($value->key, $candidates, true)) ?? '';
                    $collection = $collection->merge([$title => $value]);
                }
                return $collection->flatten();
            })
            ->sortBy(['priorityDate', 'priorityNumber'])
            ->all();
    }

    /**
     * @return string[]
     */
    public function titles(): array
    {
        $allKeys = $this->records->flatMap(
            fn(Record $record) => $record->values->flatMap(
                fn(Value $value) => $value->key
            )
        );
        $keys = $allKeys->unique();
        return $keys->toArray();
    }

    private function mergeTitles(): array
    {
        return [
            '乗車時刻' => [
                '乗車時刻',
                '拾い時刻',
            ],
            '降車時刻' => [
                '降車時刻',
                '目的到達時刻',
            ],
            '乗車場所' => [
                '乗車場所',
                '拾い場所',
            ],
            '目的地' => [
                '目的地',
                '到着場所',
            ],
            '日付' => [
                '日付',
                'date'
            ],
        ];
    }

}
