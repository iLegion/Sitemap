# A simple package for generate sitemap xml.

## Create a sitemap.

```php
use ilegion\Sitemap\Sitemap;
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

## Create a sitemap index.

```php
use ilegion\Sitemap\SitemapIndex;
use ilegion\Sitemap\Tags\Sitemap;

SitemapIndex::create()
    ->add('https://sitemap.test/sitemap/sitemap.xml')
    ->add(Sitemap::create('https://sitemap.test/sitemap/sitemap.xml')->setLastMod((new DateTime())->format('Y-m-d')))
    ->save('var/www/storage/sitemap/sitemap.xml');
```
