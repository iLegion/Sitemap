<?php

namespace Exceptions;

use ilegionxs\Sitemap\Exceptions\InvalidPath;
use ilegionxs\Sitemap\Sitemap;
use PHPUnit\Framework\TestCase;

class InvalidPathTest extends TestCase
{
    /**
     * @covers Sitemap::save
     * @throws InvalidPath
     */
    public function testException()
    {
        $this->expectException(InvalidPath::class);

        Sitemap::create()
            ->add('https://sitemap1.test')
            ->save('');
    }
}