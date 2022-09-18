<?php

namespace App\Entity\JSON;

class ExtractedJSONFileConverter implements ExtractedJSONFileConvertable
{

    function convert(string $content): JSONConvertedRecords
    {
        $json = json_decode($content);

        $records = new JSONConvertedRecords();
        foreach ($json as $value) {
            $recordID = $value->recordID;
            $type = $value->type;
            $key = $value->key;
            $value = $value->value;

            if ($type === 'priority_date') {
                $records->addPriorityDate($recordID, $value);
                continue;
            }
            if ($type === 'priority_number') {
                $records->addPriorityNumber($recordID, intval($value));
                continue;
            }
            $records->append($recordID, new JSONConvertedValue($type, $key, $value));
        }
        return $records->validates();
    }

    /**
     * @param JSONConvertedRecord[] $records
     * @param string $recordID UUID
     * @return bool
     */
    private function isExist(array $records, string $recordID): bool
    {
        foreach ($records as $record) {
            if ($record->recordID === $recordID) return true;
        }
        return false;
    }
}
