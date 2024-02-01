# A simple package for generate sitemap xml.

## Create a basic sitemap.

```php
use ilegion\Sitemap\Sitemap;

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
use ilegion\Sitemap\Sitemap;
use ilegion\Sitemap\Tags\Url;
use ilegion\Sitemap\Enums\ChangeFreq;

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
use ilegion\Sitemap\SitemapIndex;
use ilegion\Sitemap\Tags\Sitemap;

SitemapIndex::create()
    ->add('https://sitemap.test/sitemap/sitemap.xml')
    ->add(Sitemap::create('https://sitemap.test/sitemap/sitemap.xml'))
    ->save('var/www/storage/sitemap/sitemap.xml');
```
