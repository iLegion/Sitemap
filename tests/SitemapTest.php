<?php

use ilegionxs\Sitemap\Enums\ChangeFreq;
use ilegionxs\Sitemap\Exceptions\InvalidPath;
use ilegionxs\Sitemap\Sitemap;
use ilegionxs\Sitemap\Tags\Url;
use PHPUnit\Framework\TestCase;

final class SitemapTest extends TestCase
{
    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreate(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create.xml';

        Sitemap::create()
            ->add([
                'https://sitemap1.test',
                'https://sitemap2.test',
                'https://sitemap3.test',
            ])
            ->add([
                Url::create('https://sitemap4.test'),
                Url::create('https://sitemap5.test')->setChangeFreq(ChangeFreq::Daily),
                Url::create('https://sitemap6.test')->setLastMod('test date')->setPriority('0.1'),
            ])
            ->add('https://sitemap7.test')
            ->add(
                Url::create('https://sitemap8.test')
            )
            ->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-with-big-data.xml';
        $data = array_fill(0, 10000, 'https://sitemap.test');

        Sitemap::create()
            ->add($data)
            ->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateWithBigDataUsingUrlTag(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-with-big-data-using-url-tag.xml';
        $data = array_fill(
            0,
            50000,
            Url::create('https://sitemap.test')->setLastMod('2024-01-31 00:00:00')
        );

        Sitemap::create()
            ->add($data)
            ->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testSimpleCreateGZ(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap.xml';

        Sitemap::create()
            ->add([
                'https://sitemap1.test',
                'https://sitemap2.test',
                'https://sitemap3.test',
            ])
            ->add([
                Url::create('https://sitemap4.test'),
                Url::create('https://sitemap5.test')->setChangeFreq(ChangeFreq::Daily),
                Url::create('https://sitemap6.test')->setLastMod('test date')->setPriority('0.1'),
            ])
            ->add('https://sitemap7.test')
            ->add(
                Url::create('https://sitemap8.test')
            )
            ->save($path, true);

        $this->assertFileExists($path . '.gz');
    }
}