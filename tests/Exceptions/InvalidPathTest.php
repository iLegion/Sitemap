<?php

namespace Exceptions;

use ilegion\Sitemap\Exceptions\InvalidPath;
use ilegion\Sitemap\Sitemap;
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
            ->add('https://sitemap.test')
            ->save('');
    }
}