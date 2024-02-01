<?php

namespace ilegion\Sitemap;

use ilegion\Sitemap\Exceptions\InvalidPath;
use ilegion\Sitemap\Tags\Url;

class Sitemap
{
    private array $records = [];

    public static function create(): static
    {
        return new static();
    }
    
    public function add(string | array | Url $value): static
    {
        $urls = is_array($value) ? $value : [$value];

        foreach ($urls as $item) {
            if ($item instanceof Url) {
                $this->records[] = $item;
            } else if (is_string($item)) {
                $this->records[] = new Url($item);
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

        $fileManager = SitemapFileManager::create($path, $gzip)->appendTextToFile(self::getHeaderText());

        foreach ($this->records as $record) {
            $fileManager->appendTextToFile($record->generate());
        }

        return $fileManager
            ->appendTextToFile(self::getFooterText())
            ->close();
    }

    /**
     * @description Nowdoc text version of header.
     */
    private static function getHeaderText(): string
    {
        return <<<'EOD'
        <?xml version="1.0" encoding="UTF-8"?>
        <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
        EOD;
    }

    /**
     * @description Nowdoc text version of footer.
     */
    private static function getFooterText(): string
    {
        return <<<'EOD'

        </urlset>
        EOD;
    }
}