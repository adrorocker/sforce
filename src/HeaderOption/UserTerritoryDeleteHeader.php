<?php

namespace Sforce\HeaderOption;

class UserTerritoryDeleteHeader
{
    public $transferToUserId;

    public function __construct($transferToUserId)
    {
        $this->transferToUserId = $transferToUserId;
    }
}