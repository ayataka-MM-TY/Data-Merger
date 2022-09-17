<?php

namespace App\Entity\Merge;

use App\Models\Record;
use App\Models\Value;
use Illuminate\Support\Collection;

class MergeRecords
{
    public function __construct(
        private readonly Collection $records,
    ) {}

    public function json(): array {
        return $this->records
            ->map(function (Record $record) {
                $array = [];
                $array["priorityDate"] = $record->priorityDate->toDateTimeString();
                $array['priorityNumber'] = $record->priorityNumber;
                foreach ($this->titleCandidates() as $title => $candidates) {
                    $value = $record->values->first(fn(Value $value) => in_array($value->key, $candidates, true)) ?? '';
                    $array[$title] = $value->value;
                }
                return $array;
            })
            ->sortBy(['priorityDate', 'priorityNumber'])
            ->all();
    }

    /** @return string[] */
    public function titles(): array
    {
        $titles = [];
        foreach ($this->titleCandidates() as $key => $_) {
            $titles[] = $key;
        }
        return $titles;
    }

    public function titleCandidates(): array
    {
        $titles = collect([]);
        foreach ($this->allTitles() as $title) {
            $titles = $titles->merge(collect($this->asset($title)));
        }
        return $titles->all();
    }

    private function allTitles(): Collection
    {
        /** @var string[] $titles */
        $titles = [];
        foreach ($this->records as $record) {
            foreach ($record->values as $value) {
                $titles[] = $value->key;
            }
        }
        return collect($titles);
    }

    /**
     * 対応するキー。なければそのまま返す。
     * @return array<string, string[]>
     */
    private function asset(string $title): array
    {
        foreach ($this->mergeTitlesAssets() as $key => $asset) {
            if (in_array($title, $asset)) return [$key => $asset];
        }
        return [$title => [$title]];
    }

    /** 対応 */
    private function mergeTitlesAssets(): array
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
