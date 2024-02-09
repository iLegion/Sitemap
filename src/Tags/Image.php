<?php

namespace ilegion\Sitemap\Tags;

class Image extends Tag
{
    private string $loc;

    public function __construct(string $url)
    {
        $this->loc = $url;
    }

    public static function create(string $url): static
    {
        return new static($url);
    }

    public function generate(): string
    {
        $result = "\t<image:image>\r\n";
        $result .= $this->formatTag('image:loc', $this->loc, tabs: 3);
        $result .= "\t\t</image:image>\r\n";

        return $result;
    }
}