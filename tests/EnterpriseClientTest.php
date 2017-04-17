<?php
/**
 * Sforce.
 *
 * @link      https://github.com/adrorocker/sforce
 *
 * @copyright Copyright (c) 2017 Adro Rocker
 * @author    Adro Rocker <alejandro.morelos@jarwebdev.com>
 */

namespace Sforce\Tests;

use PHPUnit\Framework\TestCase;
use Sforce\EnterpriseClient;

class EnterpriseClientTest extends TestCase
{
    public function testInstance()
    {
        $client = new EnterpriseClient();
        $this->assertInstanceOf('Sforce\BaseClient', $client);
    }
}
