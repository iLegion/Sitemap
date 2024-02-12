<?php

use ilegion\Sitemap\Enums\ChangeFreq;
use ilegion\Sitemap\Exceptions\InvalidPath;
use ilegion\Sitemap\Sitemap;
use ilegion\Sitemap\Tags\News;
use ilegion\Sitemap\Tags\Url;
use PHPUnit\Framework\TestCase;

class SitemapCreateWithNewsTest extends TestCase
{
    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByStringUrlObjNews(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string-url-obj-news.xml';

        Sitemap::create()
            ->add(
                Url::create('https://sitemap1.test')
                    ->addNews(
                        News::create(
                            'Title 1',
                            (new DateTime())->format('Y-m-d'),
                            'Name 1',
                            'aa',
                        )
                    )
            )
            ->add(
                Url::create('https://sitemap2.test')
                    ->setChangeFreq(ChangeFreq::Daily)
                    ->addNews(
                        News::create(
                            'Title 2',
                            (new DateTime())->format('Y-m-d'),
                            'Name 2',
                            'aa',
                        )
                    )
            )
            ->add(
                Url::create('https://sitemap3.test')
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.1')
                    ->addNews(
                        News::create(
                            'Title 3',
                            (new DateTime())->format('Y-m-d'),
                            'Name 3',
                            'am',
                        )
                    )
            )
            ->add(
                Url::create('https://sitemap4.test')
                    ->setChangeFreq(ChangeFreq::Weekly)
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.3')
                    ->addNews(
                        News::create(
                            'Title 4',
                            (new DateTime())->format('Y-m-d'),
                            'Name 4',
                            'aa',
                        )
                    )
                    ->addNews(
                        News::create(
                            'Title 5',
                            (new DateTime())->format('Y-m-d'),
                            'Name 5',
                            'af',
                        )
                    )
            )
            ->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByArrayUrlObjNews(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-array-url-obj-news.xml';

        Sitemap::create()
            ->add([
                Url::create('https://sitemap1.test')
                    ->addNews(
                        News::create(
                            'Title 1',
                            (new DateTime())->format('Y-m-d'),
                            'Name 1',
                            'aa',
                        )
                    ),
                Url::create('https://sitemap2.test')
                    ->setChangeFreq(ChangeFreq::Yearly)
                    ->addNews(
                        News::create(
                            'Title 2',
                            (new DateTime())->format('Y-m-d'),
                            'Name 2',
                            'aa',
                        )
                    ),
                Url::create('https://sitemap3.test')
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.6')
                    ->addNews(
                        News::create(
                            'Title 3',
                            (new DateTime())->format('Y-m-d'),
                            'Name 3',
                            'aa',
                        )
                    ),
                Url::create('https://sitemap4.test')
                    ->setChangeFreq(ChangeFreq::Never)
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.9')
                    ->addNews(
                        News::create(
                            'Title 4',
                            (new DateTime())->format('Y-m-d'),
                            'Name 4',
                            'aa',
                        )
                    )
                    ->addNews(
                        News::create(
                            'Title 5',
                            (new DateTime())->format('Y-m-d'),
                            'Name 5',
                            'aa',
                        )
                    ),
            ])
            ->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByStringUrlObjNewsWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string-url-obj-news-with-big-data.xml';
        $sitemap = Sitemap::create();
        $data = array_fill(
            0,
            10000,
            Url::create('https://sitemap.test')
                ->addNews(
                    News::create(
                        'Title',
                        (new DateTime())->format('Y-m-d'),
                        'Name',
                        'aa',
                    )
                )
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
    public function testCreateByArrayUrlObjNewsWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-array-url-obj-news-with-big-data.xml';
        $data = array_fill(
            0,
            10000,
            Url::create('https://sitemap.test')
                ->addNews(
                    News::create(
                        'Title',
                        (new DateTime())->format('Y-m-d'),
                        'Name',
                        'aa',
                    )
                )
        );

        Sitemap::create()->add($data)->save($path);

        $this->assertFileExists($path);
    }
}