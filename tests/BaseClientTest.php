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
use Sforce\BaseClient;

class BaseClientTest extends TestCase
{
    public function testInstance()
    {
        $client = new BaseClient();
        $this->assertInstanceOf('Sforce\BaseClient', $client);
    }
}
