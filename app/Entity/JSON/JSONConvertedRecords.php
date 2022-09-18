<?php

namespace App\Entity\JSON;

use App\Models\Project;
use App\Models\Record;
use App\Models\Upload;
use Illuminate\Support\Carbon;
use Ramsey\Uuid\Uuid;

class JSONConvertedRecords
{
    /**
     * @param array<string, JSONConvertedRecord> $records recordID => record
     */
    public function __construct(
        private array $records = [],
    ) {}

    public function addPriorityDate(string $recordID, string $date): void
    {
        $this->createIfNotExists($recordID);
        $this->records[$recordID]->priorityDate = $date;
    }

    public function addPriorityNumber(string $recordID, string $number): void
    {
        $this->createIfNotExists($recordID);
        $this->records[$recordID]->priorityNumber = $number;
    }

    public function append(string $recordID, JSONConvertedValue $value): void
    {
        $this->createIfNotExists($recordID);
        $this->records[$recordID]->append($value);
    }

    private function createIfNotExists(string $recordID): void
    {
        if (!$this->isExists($recordID)) {
            $this->records[$recordID] = new JSONConvertedRecord($recordID);
        }
    }

    private function isExists(string $recordID): bool
    {
        return array_key_exists($recordID, $this->records);
    }

    /**
     * @param string $projectID UUID
     * @param string $filename
     * @param Carbon $date
     * @return string アップロードID
     */
    function save(string $projectID, string $filename, Carbon $date): string
    {
        $upload = new Upload;
        $upload->date = $date;
        $upload->filename = $filename;
        $upload->project_id = $projectID;
        $upload->save();

        $saveArrays = [];
        foreach ($this->records as $record) {
            $record->save($upload->id);
        }
        Record::upsert($saveArrays, ['id']);
        return $upload->id;
    }

    public function validates(): self
    {
        $validateRecords = [];
        foreach ($this->records as $id => $record) {
            if (!$record->isValid()) continue;
            $validateRecords[$id] = $record;
        }
        return new self($validateRecords);
    }
}
