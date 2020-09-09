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
    protected function setUp(): void
    {
        parent::setUp();

        array_map(
            'unlink',
            array_filter(
                (array)glob(PROJECT_BASE_PATH . '/cache/*.serialized')
            )
        );
    }


    protected function tearDown(): void
    {
        parent::tearDown();
        m::close();
    }
}
