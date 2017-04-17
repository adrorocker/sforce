<?php

namespace Sforce\HeaderOption;

class MruHeader
{
    public $updateMruFlag;

    public function __construct($bool)
    {
        $this->updateMruFlag = $bool;
    }
}