<?php

namespace App\Entity\JSON;

class JSONConvertedValue
{
    public function __construct(
        private readonly string $type,
        private readonly string $key,
        private readonly string $value,
    ) {}

    public function saveArray(string $recordID): array
    {
        return [
            'record_id' => $recordID,
            'key' => $this->key,
            'type' => $this->type,
            'value' => $this->value,
        ];
    }
}
