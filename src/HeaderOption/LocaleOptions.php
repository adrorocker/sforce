<?php

namespace Sforce\HeaderOption;

class LocaleOptions
{
    public $language;

    public function __construct($language)
    {
        $this->language = $language;
    }
}
