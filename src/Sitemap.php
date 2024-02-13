<?php

namespace ilegion\Sitemap;

use ilegion\Sitemap\Exceptions\InvalidPath;
use ilegion\Sitemap\Tags\Url;
use ilegion\Sitemap\Tags\UrlSet;

class Sitemap
{
    private UrlSet $urlSet;

    private bool $hasImages = false;

    private bool $hasVideos = false;

    private bool $hasNews = false;

    private bool $hasLocalizations = false;

    public function __construct()
    {
        $this->urlSet = UrlSet::create();
    }

    public static function create(): static
    {
        return new static();
    }
    
    public function add(string | array | Url $value): static
    {
        $urls = is_array($value) ? $value : [$value];

        foreach ($urls as $item) {
            if ($item instanceof Url) {
                $this->urlSet->add($item);

                if ($item->hasImages()) $this->hasImages = true;
                if ($item->hasVideos()) $this->hasVideos = true;
                if ($item->hasNews()) $this->hasNews = true;
                if ($item->hasLocalizations()) $this->hasLocalizations = true;
            } else if (is_string($item)) {
                $this->urlSet->add(new Url($item));
            }
        }

        return $this;
    }

    /**
     * @throws InvalidPath
     */
    public function save(string $path, bool $gzip = false): string
    {
        if (!SitemapFileManager::validatePath($path)) {
            throw new InvalidPath();
        }

        return SitemapFileManager::create($path, $gzip)
            ->appendTextToFile("<?xml version='1.0' encoding='UTF-8'?> \r\n")
            ->appendTextToFile($this->urlSet->generate($this->hasImages, $this->hasVideos, $this->hasNews, $this->hasLocalizations))
            ->close();
    }
}