<?php

namespace ilegion\Sitemap\Tags;

class UrlSet extends Tag
{
    private const URL = 'http://www.sitemaps.org/schemas/sitemap/0.9';

    private const IMAGE_URL = 'http://www.google.com/schemas/sitemap-image/1.1';

    private const VIDEO_URL = 'http://www.google.com/schemas/sitemap-video/1.1';

    private const NEWS_URL = 'http://www.google.com/schemas/sitemap-news/0.9';

    /**
     * @var Url[]
     */
    private array $records = [];

    public static function create(): static
    {
        return new static();
    }

    public function add(Url $value): static
    {
        $this->records[] = $value;

        return $this;
    }

    public function generate($enableImage = false, $enableVideo = false, $enableNews = false): string
    {
        $url = self::URL;
        $imageUrl = self::IMAGE_URL;
        $videoUrl = self::VIDEO_URL;
        $newsUrl = self::NEWS_URL;

        $result = "<urlset xmlns='$url'";

        if ($enableImage) {
            $result .= " xmlns:image='$imageUrl'";
        }

        if ($enableVideo) {
            $result .= " xmlns:video='$videoUrl'";
        }

        if ($enableNews) {
            $result .= " xmlns:news='$newsUrl'";
        }

        $result .= ">\r\n";

        foreach ($this->records as $record) {
            $result .= $record->generate();
        }

        $result .= "</urlset>";

        return $result;
    }
}