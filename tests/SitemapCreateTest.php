<?php

use ilegion\Sitemap\Enums\ChangeFreq;
use ilegion\Sitemap\Exceptions\InvalidPath;
use ilegion\Sitemap\Sitemap;
use ilegion\Sitemap\Tags\Image;
use ilegion\Sitemap\Tags\Url;
use ilegion\Sitemap\Tags\Video;
use PHPUnit\Framework\TestCase;

final class SitemapCreateTest extends TestCase
{
    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByString(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string.xml';

        Sitemap::create()
            ->add('https://sitemap1.test')
            ->add('https://sitemap2.test')
            ->add('https://sitemap3.test')
            ->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByArray(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-array.xml';

        Sitemap::create()
            ->add([
                'https://sitemap1.test',
                'https://sitemap2.test',
                'https://sitemap3.test',
            ])
            ->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByStringWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string-with-big-data.xml';
        $data = array_fill(0, 10000, 'https://sitemap.test');
        $sitemap = Sitemap::create();

        foreach ($data as $item) {
            $sitemap->add($item);
        }

        $sitemap->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByArrayWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-array-with-big-data.xml';
        $data = array_fill(0, 10000, 'https://sitemap.test');

        Sitemap::create()->add($data)->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByStringUrlObj(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string-url-obj.xml';

        Sitemap::create()
            ->add(Url::create('https://sitemap1.test'))
            ->add(Url::create('https://sitemap2.test')->setChangeFreq(ChangeFreq::Daily))
            ->add(
                Url::create('https://sitemap3.test')
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.1')
            )
            ->add(
                Url::create('https://sitemap4.test')
                    ->setChangeFreq(ChangeFreq::Weekly)
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.3')
            )
            ->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByArrayUrlObj(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-array-url-obj.xml';

        Sitemap::create()
            ->add([
                Url::create('https://sitemap1.test'),
                Url::create('https://sitemap2.test')->setChangeFreq(ChangeFreq::Yearly),
                Url::create('https://sitemap3.test')
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.6'),
                Url::create('https://sitemap4.test')
                    ->setChangeFreq(ChangeFreq::Never)
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.9'),
            ])
            ->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByStringUrlObjWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string-url-obj-with-big-data.xml';
        $data = array_fill(0, 10000, Url::create('https://sitemap.test'));
        $sitemap = Sitemap::create();

        foreach ($data as $item) {
            $sitemap->add($item);
        }

        $sitemap->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByArrayUrlObjWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-array-url-obj-with-big-data.xml';
        $data = array_fill(0, 10000, Url::create('https://sitemap.test'));

        Sitemap::create()->add($data)->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateGZ(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/gz.xml';

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