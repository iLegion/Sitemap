<?php

namespace ilegion\Sitemap\Tags;

class Sitemap extends Tag
{
    private string $loc;

    private ?string $lastMod = null;

    public function __construct(string $url)
    {
        $this->loc = $url;
    }

    public static function create(string $url): static
    {
        return new static($url);
    }

    public function setLastMod(string $value): static
    {
        $this->lastMod = $value;

        return $this;
    }

    public function generate(): string
    {
        $result = "<sitemap>\r\n";
        $result .= $this->formatTag('loc', $this->loc);
        $result .= $this->formatTag('lastmod', $this->lastMod);
        $result .= "</sitemap>";

        return $result;
    }
}