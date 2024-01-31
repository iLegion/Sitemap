<?php

use ilegionxs\Sitemap\Exceptions\InvalidPath;
use ilegionxs\Sitemap\SitemapIndex;
use PHPUnit\Framework\TestCase;

class SitemapIndexTest extends TestCase
{
    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testSimpleCreate(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-index.xml';

        SitemapIndex::create()
            ->add('https://sitemap1.test')
            ->save($path);

        $this->assertFileExists($path);
    }
}