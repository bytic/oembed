<?php

namespace ByTIC\Oembed\Tests;

use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTest
 * @package ByTIC\Oembed\Tests\Utilities
 */
abstract class AbstractTest extends TestCase
{
    protected function tearDown()
    {
        parent::tearDown();
        m::close();
    }
}
