<?php

namespace ilegion\Sitemap\Tags;

class News extends Tag
{
    private string $name;

    private string $language;

    private string $publicationDate;

    private string $title;

    public function __construct(string $title, string $publicationDate, string $name, string $language)
    {
        $this->title = $title;
        $this->publicationDate = $publicationDate;
        $this->name = $name;
        $this->language = $language;
    }

    public static function create(string $title, string $publicationDate, string $name, string $language): static
    {
        return new static($title, $publicationDate, $name, $language);
    }

    public function generate(): string
    {
        $result = "\t<news:news>\r\n";
        $result .= "\t\t\t<news:publication>\r\n";
        $result .= $this->formatTag('news:name', $this->name, tabs: 4);
        $result .= $this->formatTag('news:language', $this->language, tabs: 4);
        $result .= "\t\t\t</news:publication>\r\n";
        $result .= $this->formatTag('news:publication_date', $this->publicationDate, tabs: 3);
        $result .= $this->formatTag('news:title', $this->title, tabs: 3);
        $result .= "\t\t</news:news>\r\n";

        return $result;
    }
}