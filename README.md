# A simple package for generate sitemap xml.

Run command: `composer require ilegion/sitemap`.

## Create a sitemap.

```php
use ilegion\Sitemap\Sitemap;
use ilegion\Sitemap\Tags\Url;
use ilegion\Sitemap\Enums\ChangeFreq;

Sitemap::create()
    ->add('https://sitemap.test')
    ->add([
        'https://sitemap.test',
        'https://sitemap.test',
        'https://sitemap.test',
    ])
    ->add(Url::create('https://sitemap.test'))
    ->add([
        Url::create('https://sitemap.test'),
        Url::create('https://sitemap.test')->setChangeFreq(ChangeFreq::Daily),
        Url::create('https://sitemap.test')->setLastMod((new DateTime())->format('Y-m-d'))->setPriority('0.1'),
    ])
    ->save('var/www/storage/sitemap/sitemap.xml')
```

## Create a sitemap with images.
```php
use ilegion\Sitemap\Sitemap;
use ilegion\Sitemap\Tags\Url;
use ilegion\Sitemap\Enums\ChangeFreq;

Sitemap::create()
    ->add(
        Url::create('https://sitemap.test')
            ->addImage(Image::create('https://sitemap.test/image.jpg'))
    )
    ->save('var/www/storage/sitemap/sitemap.xml')
```

## Create a sitemap with localization.
```php
use ilegion\Sitemap\Sitemap;
use ilegion\Sitemap\Tags\Url;
use ilegion\Sitemap\Enums\ChangeFreq;

Sitemap::create()
    ->add(
        Url::create('https://sitemap.test')
            ->addLocalization(Link::create('de', 'https://sitemap.de'))
    )
    ->save('var/www/storage/sitemap/sitemap.xml')
```

## Create a sitemap with news.
```php
use ilegion\Sitemap\Sitemap;
use ilegion\Sitemap\Tags\Url;
use ilegion\Sitemap\Enums\ChangeFreq;

Sitemap::create()
    ->add(
        Url::create('https://sitemap.test')
            ->addNews(
                News::create(
                    'Title 4',
                    (new DateTime())->format('Y-m-d'),
                    'Name 4',
                    'aa',
                )
            )
    )
    ->save('var/www/storage/sitemap/sitemap.xml')
```

## Create a sitemap with videos.
```php
use ilegion\Sitemap\Sitemap;
use ilegion\Sitemap\Tags\Url;
use ilegion\Sitemap\Enums\ChangeFreq;

Sitemap::create()
    ->add(
        Url::create('https://sitemap.test')
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
    ->save('var/www/storage/sitemap/sitemap.xml')
```

## Create a sitemap index.

```php
use ilegion\Sitemap\SitemapIndex;
use ilegion\Sitemap\Tags\Sitemap;

SitemapIndex::create()
    ->add('https://sitemap.test/sitemap/sitemap.xml')
    ->add(Sitemap::create('https://sitemap.test/sitemap/sitemap.xml')->setLastMod((new DateTime())->format('Y-m-d')))
    ->save('var/www/storage/sitemap/sitemap.xml');
```
