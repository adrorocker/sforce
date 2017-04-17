<?php

namespace Sforce\HeaderOption;

class PackageVersionHeader
{
    /**
     * @var array $packageVersions
     */
    public $packageVersions;
    
    /**
     * Class constructor.
     * 
     * @param array $packageVersions
     * @return void
     */
    public function __construct($packageVersions)
    {
        $this->packageVersions = $packageVersions;
    }
}