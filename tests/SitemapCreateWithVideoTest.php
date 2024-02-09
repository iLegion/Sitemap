<?php

use ilegion\Sitemap\Enums\ChangeFreq;
use ilegion\Sitemap\Exceptions\InvalidPath;
use ilegion\Sitemap\Sitemap;
use ilegion\Sitemap\Tags\Url;
use ilegion\Sitemap\Tags\Video;
use PHPUnit\Framework\TestCase;

class SitemapCreateWithVideoTest extends TestCase
{
    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByStringUrlObjVideos(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string-url-obj-videos.xml';

        Sitemap::create()
            ->add(
                Url::create('https://sitemap1.test')
                    ->addVideo(
                        Video::create(
                            'https://sitemap1.test/thumbnail.jpg',
                            'Title',
                            'Description',
                            'https://sitemap1.test/content.mp4',
                            'https://sitemap1.test/player',
                        )
                    )
            )
            ->add(
                Url::create('https://sitemap2.test')
                    ->setChangeFreq(ChangeFreq::Daily)
                    ->addVideo(
                        Video::create(
                            'https://sitemap2.test/thumbnail.jpg',
                            'Title',
                            'Description',
                            'https://sitemap2.test/content.mp4',
                            'https://sitemap2.test/player',
                        )
                    )
            )
            ->add(
                Url::create('https://sitemap3.test')
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.1')
                    ->addVideo(
                        Video::create(
                            'https://sitemap3.test/thumbnail.jpg',
                            'Title',
                            'Description',
                            'https://sitemap3.test/content.mp4',
                            'https://sitemap3.test/player',
                        )
                    )
            )
            ->add(
                Url::create('https://sitemap4.test')
                    ->setChangeFreq(ChangeFreq::Weekly)
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.3')
                    ->addVideo(
                        Video::create(
                            'https://sitemap4.test/thumbnail.jpg',
                            'Title',
                            'Description',
                            'https://sitemap4.test/content.mp4',
                            'https://sitemap4.test/player',
                        )
                    )
                    ->addVideo(
                        Video::create(
                            'https://sitemap4.test/thumbnail2.jpg',
                            'Title',
                            'Description',
                            'https://sitemap4.test/content2.mp4',
                            'https://sitemap4.test/player2',
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
    public function testCreateByStringUrlObjVideosWithFullData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string-url-obj-videos-with-full-data.xml';

        Sitemap::create()
            ->add(
                Url::create('https://sitemap1.test')
                    ->addVideo(
                        Video::create(
                            'https://sitemap1.test/thumbnail.jpg',
                            'Title',
                            'Description',
                            'https://sitemap1.test/content.mp4',
                            'https://sitemap1.test/player',
                        )
                        ->setDuration(100)
                        ->setExpirationDate('2024-11-02')
                        ->setRating(0.1)
                        ->setViewCount(1503)
                        ->setPublicationDate('2024-01-01')
                        ->setRestriction('allow', 'CA MX')
                        ->setPlatform('allow', 'web')
                        ->setUploader('https://sitemap1.test')
                        ->setLive('no')
                        ->setTags(['life', 'work'])
                    )
            )
            ->add(
                Url::create('https://sitemap2.test')
                    ->setChangeFreq(ChangeFreq::Daily)
                    ->addVideo(
                        Video::create(
                            'https://sitemap2.test/thumbnail.jpg',
                            'Title',
                            'Description',
                            'https://sitemap2.test/content.mp4',
                            'https://sitemap2.test/player',
                        )
                            ->setDuration(23)
                            ->setExpirationDate('2024-04-11')
                            ->setRating(1.3)
                            ->setViewCount(13453)
                            ->setPublicationDate('2024-01-02')
                            ->setFamilyFriendly('yes')
                            ->setRestriction('deny', 'CA MX')
                            ->setPlatform('allow', 'mobile')
                            ->setRequiresSubscription('no')
                            ->setUploader('https://sitemap2.test', 'Name')
                            ->setLive('yes')
                            ->setTags(['blog', 'posts', 'tests'])
                    )
            )
            ->add(
                Url::create('https://sitemap3.test')
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.1')
                    ->addVideo(
                        Video::create(
                            'https://sitemap3.test/thumbnail.jpg',
                            'Title',
                            'Description',
                            'https://sitemap3.test/content.mp4',
                            'https://sitemap3.test/player',
                        )
                            ->setDuration(147)
                            ->setExpirationDate('2024-06-02')
                            ->setRating(4.1)
                            ->setViewCount(23503)
                            ->setPublicationDate('2024-01-03')
                            ->setFamilyFriendly('no')
                            ->setRestriction('allow', 'CA')
                            ->setPlatform('allow', 'tv')
                            ->setRequiresSubscription('yes')
                            ->setUploader('https://sitemap3.test', 'Name1')
                            ->setLive('no')
                            ->setTags(['telegram', 'instagram', 'facebook'])
                    )
            )
            ->add(
                Url::create('https://sitemap4.test')
                    ->setChangeFreq(ChangeFreq::Weekly)
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.3')
                    ->addVideo(
                        Video::create(
                            'https://sitemap4.test/thumbnail.jpg',
                            'Title',
                            'Description',
                            'https://sitemap4.test/content.mp4',
                            'https://sitemap4.test/player',
                        )
                            ->setDuration(329)
                            ->setExpirationDate('2024-06-22')
                            ->setRating(3.9)
                            ->setViewCount(346457)
                            ->setPublicationDate('2024-01-04')
                            ->setFamilyFriendly('no')
                            ->setRestriction('deny', 'CA')
                            ->setPlatform('deny', 'web tv')
                            ->setRequiresSubscription('yes')
                            ->setUploader('https://sitemap4.test', 'Name2')
                            ->setLive('no')
                            ->setTags(['pc', 'ps5', 'mouse'])
                    )
                    ->addVideo(
                        Video::create(
                            'https://sitemap4.test/thumbnail2.jpg',
                            'Title',
                            'Description',
                            'https://sitemap4.test/content2.mp4',
                            'https://sitemap4.test/player2',
                        )
                            ->setDuration(678)
                            ->setExpirationDate('2024-09-11')
                            ->setRating(5.0)
                            ->setViewCount(94545)
                            ->setPublicationDate('2024-01-05')
                            ->setFamilyFriendly('yes')
                            ->setRestriction('deny', 'MX')
                            ->setPlatform('deny', 'mobile')
                            ->setRequiresSubscription('no')
                            ->setLive('yes')
                            ->setTags(['html', 'css', 'js', 'php'])
                    )
            )
            ->save($path);

        $this->assertFileExists($path);
    }

    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByArrayUrlObjVideos(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-array-url-obj-videos.xml';

        Sitemap::create()
            ->add([
                Url::create('https://sitemap1.test')
                    ->addVideo(
                        Video::create(
                            'https://sitemap1.test/thumbnail.jpg',
                            'Title',
                            'Description',
                            'https://sitemap1.test/content.mp4',
                            'https://sitemap1.test/player',
                        )
                    ),
                Url::create('https://sitemap2.test')
                    ->setChangeFreq(ChangeFreq::Yearly)
                    ->addVideo(
                        Video::create(
                            'https://sitemap2.test/thumbnail.jpg',
                            'Title',
                            'Description',
                            'https://sitemap2.test/content.mp4',
                            'https://sitemap2.test/player',
                        )
                    ),
                Url::create('https://sitemap3.test')
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.6')
                    ->addVideo(
                        Video::create(
                            'https://sitemap3.test/thumbnail.jpg',
                            'Title',
                            'Description',
                            'https://sitemap3.test/content.mp4',
                            'https://sitemap3.test/player',
                        )
                    ),
                Url::create('https://sitemap4.test')
                    ->setChangeFreq(ChangeFreq::Never)
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.9')
                    ->addVideo(
                        Video::create(
                            'https://sitemap4.test/thumbnail.jpg',
                            'Title',
                            'Description',
                            'https://sitemap4.test/content.mp4',
                            'https://sitemap4.test/player',
                        )
                    )
                    ->addVideo(
                        Video::create(
                            'https://sitemap4.test/thumbnail2.jpg',
                            'Title',
                            'Description',
                            'https://sitemap4.test/content2.mp4',
                            'https://sitemap4.test/player2',
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
    public function testCreateByStringUrlObjVideosWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string-url-obj-videos-with-big-data.xml';
        $sitemap = Sitemap::create();
        $data = array_fill(
            0,
            10000,
            Url::create('https://sitemap.test')
                ->addVideo(
                    Video::create(
                        'https://sitemap.test/thumbnail.jpg',
                        'Title',
                        'Description',
                        'https://sitemap.test/content.mp4',
                        'https://sitemap.test/player',
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
    public function testCreateByArrayUrlObjVideosWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-array-url-obj-videos-with-big-data.xml';
        $data = array_fill(
            0,
            10000,
            Url::create('https://sitemap.test')
                ->addVideo(
                    Video::create(
                        'https://sitemap.test/thumbnail.jpg',
                        'Title',
                        'Description',
                        'https://sitemap.test/content.mp4',
                        'https://sitemap.test/player',
                    )
                )
        );

        Sitemap::create()->add($data)->save($path);

        $this->assertFileExists($path);
    }
}