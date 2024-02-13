<?php

namespace ilegion\Sitemap\Tags;

class Link extends Tag
{
    private string $lang;

    private string $url;

    public function __construct(string $lang, string $url)
    {
        $this->lang = $lang;
        $this->url = $url;
    }

    public static function create(string $lang, string $url): static
    {
        return new static($lang, $url);
    }

    public function generate(): string
    {
        $result = "\t<xhtml:link\r\n";
        $result .= "\t\t\trel='alternate'\r\n";
        $result .= "\t\t\threflang='$this->lang'\r\n";
        $result .= "\t\t\thref='$this->url'";
        $result .= " /> \r\n";

        return $result;
    }
}