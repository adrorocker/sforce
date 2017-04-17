<?php

namespace Sforce\HeaderOption;

class LoginScopeHeader
{
    public $organizationId;

    public $portalId;

    public function __construct($orgId = null, $portalId = null)
    {
        $this->organizationId = $orgId;
        $this->portalId = $portalId;
    }
}
