# A simple package for generate sitemap xml.

## Create a basic sitemap.

```php
use ilegionxs\Sitemap\Sitemap;

Sitemap::create()
    ->add('https://sitemap.test')
    ->add([
        'https://sitemap.test',
        'https://sitemap.test',
        'https://sitemap.test',
    ])
    ->save('var/www/storage/sitemap/sitemap.xml')
```

## Create a basic sitemap using Url.

```php
use ilegionxs\Sitemap\Sitemap;
use ilegionxs\Sitemap\Tags\Url;
use ilegionxs\Sitemap\Enums\ChangeFreq;

Sitemap::create()
    ->add(Url::create('https://sitemap.test'))
    ->add([
        Url::create('https://sitemap4.test'),
        Url::create('https://sitemap4.test')->setChangeFreq(ChangeFreq::Daily),
        Url::create('https://sitemap4.test')->setLastMod('test date')->setPriority('0.1'),
    ])
    ->save('var/www/storage/sitemap/sitemap.xml')
```

## Create a basic sitemap index.

```php
use ilegionxs\Sitemap\SitemapIndex;
use ilegionxs\Sitemap\Tags\Sitemap;

SitemapIndex::create()
    ->add('https://sitemap.test/sitemap/sitemap.xml')
    ->add(Sitemap::create('https://sitemap.test/sitemap/sitemap.xml'))
    ->save('var/www/storage/sitemap/sitemap.xml');
```
