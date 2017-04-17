<?php
/**
 * Aws3
 *
 * @link      https://github.com/adrorocker/sforce
 * @copyright Copyright (c) 2017 Adro Rocker
 * @author    Adro Rocker <alejandro.morelos@jarwebdev.com>
 */
namespace Adrosoftware\Aws3\Tests;

use Sforce\BaseClient;
use PHPUnit\Framework\TestCase;

class BaseClientTest extends TestCase
{
    public function testInstance()
    {
        $client = new BaseClient();
        $this->assertInstanceOf('Sforce\BaseClient', $client);
    }
}