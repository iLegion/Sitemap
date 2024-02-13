<?php

use ilegion\Sitemap\Enums\ChangeFreq;
use ilegion\Sitemap\Exceptions\InvalidPath;
use ilegion\Sitemap\Sitemap;
use ilegion\Sitemap\Tags\Link;
use ilegion\Sitemap\Tags\Url;
use PHPUnit\Framework\TestCase;

class SitemapCreateWithLocalizationTest extends TestCase
{
    /**
     * @covers ::save
     * @throws InvalidPath
     */
    public function testCreateByStringUrlObjLocalizations(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string-url-obj-localizations.xml';

        Sitemap::create()
            ->add(
                Url::create('https://sitemap1.test')
                    ->addLocalization(
                        Link::create(
                            'de',
                            'https://sitemap1.de',
                        )
                    )
            )
            ->add(
                Url::create('https://sitemap2.test')
                    ->setChangeFreq(ChangeFreq::Daily)
                    ->addLocalization(
                        Link::create(
                            'de',
                            'https://sitemap2.de',
                        )
                    )
            )
            ->add(
                Url::create('https://sitemap3.test')
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.1')
                    ->addLocalization(
                        Link::create(
                            'de',
                            'https://sitemap3.de',
                        )
                    )
            )
            ->add(
                Url::create('https://sitemap4.test')
                    ->setChangeFreq(ChangeFreq::Weekly)
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.3')
                    ->addLocalization(
                        Link::create(
                            'de',
                            'https://sitemap4.de',
                        )
                    )
                    ->addLocalization(
                        Link::create(
                            'de',
                            'https://sitemap4.de',
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
    public function testCreateByArrayUrlObjLocalizations(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-array-url-obj-localizations.xml';

        Sitemap::create()
            ->add([
                Url::create('https://sitemap1.test')
                    ->addLocalization(
                        Link::create(
                            'de',
                            'https://sitemap1.de',
                        )
                    ),
                Url::create('https://sitemap2.test')
                    ->setChangeFreq(ChangeFreq::Yearly)
                    ->addLocalization(
                        Link::create(
                            'de',
                            'https://sitemap2.de',
                        )
                    ),
                Url::create('https://sitemap3.test')
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.6')
                    ->addLocalization(
                        Link::create(
                            'de',
                            'https://sitemap3.de',
                        )
                    ),
                Url::create('https://sitemap4.test')
                    ->setChangeFreq(ChangeFreq::Never)
                    ->setLastMod((new DateTime())->format('Y-m-d'))
                    ->setPriority('0.9')
                    ->addLocalization(
                        Link::create(
                            'de',
                            'https://sitemap4.de',
                        )
                    )
                    ->addLocalization(
                        Link::create(
                            'de',
                            'https://sitemap4.de',
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
    public function testCreateByStringUrlObjLocalizationsWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-string-url-obj-localizations-with-big-data.xml';
        $sitemap = Sitemap::create();
        $data = array_fill(
            0,
            10000,
            Url::create('https://sitemap.test')
                ->addLocalization(
                    Link::create(
                        'de',
                        'https://sitemap.de',
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
    public function testCreateByArrayUrlObjLocalizationsWithBigData(): void
    {
        $path = '/var/www/storage/app/sitemap/sitemap-create/by-array-url-obj-localizations-with-big-data.xml';
        $data = array_fill(
            0,
            10000,
            Url::create('https://sitemap.test')
                ->addLocalization(
                    Link::create(
                        'de',
                        'https://sitemap.de',
                    )
                )
        );

        Sitemap::create()->add($data)->save($path);

        $this->assertFileExists($path);
    }
}