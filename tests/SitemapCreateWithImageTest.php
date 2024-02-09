<?php

use ilegion\Sitemap\Enums\ChangeFreq;
use ilegion\Sitemap\Exceptions\InvalidPath;
use ilegion\Sitemap\Sitemap;
use ilegion\Sitemap\Tags\Image;
use ilegion\Sitemap\Tags\Url;
use PHPUnit\Framework\TestCase;

class SitemapCreateWithImageTest extends TestCase
{
    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByStringUrlObjImages(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string-url-obj-images.xml';

        Sitemap::create()
            ->add(
                Url::create('https://sitemap1.test')
                    ->addImage(Image::create('https://sitemap1.test/image.jpg'))
            )
            ->add(
                Url::create('https://sitemap2.test')
                    ->setChangeFreq(ChangeFreq::Daily)
                    ->addImage(Image::create('https://sitemap2.test/image.jpg'))
            )
            ->add(
                Url::create('https://sitemap3.test')
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.1')
                    ->addImage(Image::create('https://sitemap3.test/image.jpg'))
            )
            ->add(
                Url::create('https://sitemap4.test')
                    ->setChangeFreq(ChangeFreq::Weekly)
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.3')
                    ->addImage(Image::create('https://sitemap4.test/image1.jpg'))
                    ->addImage(Image::create('https://sitemap4.test/image2.jpg'))
            )
            ->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByArrayUrlObjImages(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-array-url-obj-images.xml';

        Sitemap::create()
            ->add([
                Url::create('https://sitemap1.test')
                    ->addImage(Image::create('https://sitemap1.test/image.jpg')),
                Url::create('https://sitemap2.test')
                    ->setChangeFreq(ChangeFreq::Yearly)
                    ->addImage(Image::create('https://sitemap2.test/image.jpg')),
                Url::create('https://sitemap3.test')
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.6')
                    ->addImage(Image::create('https://sitemap3.test/image.jpg')),
                Url::create('https://sitemap4.test')
                    ->setChangeFreq(ChangeFreq::Never)
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.9')
                    ->addImage(Image::create('https://sitemap4.test/image1.jpg'))
                    ->addImage(Image::create('https://sitemap4.test/image2.jpg')),
            ])
            ->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByStringUrlObjImagesWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string-url-obj-images-with-big-data.xml';
        $sitemap = Sitemap::create();
        $data = array_fill(
            0,
            10000,
            Url::create('https://sitemap.test')->addImage(Image::create('https://sitemap.test/image.jpg'))
        );

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
    public function testCreateByArrayUrlObjImagesWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-array-url-obj-images-with-big-data.xml';
        $data = array_fill(
            0,
            10000,
            Url::create('https://sitemap.test')->addImage(Image::create('https://sitemap.test/image.jpg'))
        );

        Sitemap::create()->add($data)->save($path);

        $this->assertFileExists($path);
    }
}