<?php

namespace ilegionxs\Sitemap;

use ilegionxs\Sitemap\Exceptions\InvalidPath;
use ilegionxs\Sitemap\Tags\Sitemap as SitemapTag;

class SitemapIndex
{
    private array $records = [];

    public static function create(): static
    {
        return new static();
    }

    public function add(string | SitemapTag $value): static
    {
        if (is_string($value)) {
            $value = new SitemapTag($value);
        }

        $this->records[] = $value;

        return $this;
    }

    /**
     * @throws InvalidPath
     */
    public function save(string $path): string
    {
        if (!SitemapFileManager::validatePath($path)) {
            throw new InvalidPath();
        }

        $fileManager = SitemapFileManager::create($path, false)
            ->appendTextToFile(self::getHeaderText());

        foreach ($this->records as $record) {
            $fileManager->appendTextToFile($record->generate());
        }

        return $fileManager
            ->appendTextToFile(self::getFooterText())
            ->close();
    }

    private static function getHeaderText(): string
    {
        return <<<'EOD'
        <?xml version="1.0" encoding="UTF-8"?>
        <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        EOD;
    }

    private static function getFooterText(): string
    {
        return <<<'EOD'

        </sitemapindex>
        EOD;
    }
}