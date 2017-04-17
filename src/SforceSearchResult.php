<?php

namespace Sforce;

class SforceSearchResult
{
    public $searchRecords;

    public function __construct($response)
    {
        if ($response instanceof self) {
            $this->searchRecords = $response->searchRecords;
        } else {
            $this->searchRecords = [];
            if (isset($response->searchRecords)) {
                if (is_array($response->searchRecords)) {
                    foreach ($response->searchRecords as $record) {
                        $sobject = new SObject($record->record);
                        array_push($this->searchRecords, $sobject);
                    }
                } else {
                    $sobject = new SObject($response->searchRecords->record);
                    array_push($this->records, $sobject);
                }
            }
        }
    }
}
