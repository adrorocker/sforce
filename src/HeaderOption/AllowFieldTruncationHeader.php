<?php

namespace Sforce\HeaderOption;

class AllowFieldTruncationHeader
{
    public $allowFieldTruncation;
    
    public function __construct($allowFieldTruncation)
    {
        $this->allowFieldTruncation = $allowFieldTruncation;
    }
}