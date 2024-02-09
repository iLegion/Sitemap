<?php

namespace ilegion\Sitemap\Tags;

use ilegion\Sitemap\Enums\ChangeFreq;

class Url extends Tag
{
    private string $loc;

    private ?string $lastMod = null;

    private ?ChangeFreq $changeFreq = null;

    private ?string $priority = null;

    /**
     * @var Image[]
     */
    private array $images = [];

    /**
     * @var Video[]
     */
    private array $videos = [];

    public function __construct(string $url)
    {
        $this->loc = $url;
    }

    public static function create(string $url): static
    {
        return new static($url);
    }

    public function hasImages(): bool
    {
        return !!$this->images;
    }

    public function hasVideos(): bool
    {
        return !!$this->videos;
    }

    public function setLastMod(string $value): static
    {
        $this->lastMod = $value;

        return $this;
    }

    public function setChangeFreq(ChangeFreq $value): static
    {
        $this->changeFreq = $value;

        return $this;
    }

    public function setPriority(string $value): static
    {
        $this->priority = $value;

        return $this;
    }

    public function addImage(Image $image): static
    {
        $this->images[] = $image;

        return $this;
    }

    public function addVideo(Video $video): static
    {
        $this->videos[] = $video;

        return $this;
    }

    public function generate(): string
    {
        $result = "\t<url>\r\n";
        $result .= $this->formatTag('loc', $this->loc, tabs: 2);
        $result .= $this->formatTag('lastmod', $this->lastMod, tabs: 2);
        $result .= $this->formatTag('changefreq', $this->changeFreq?->value, tabs: 2);
        $result .= $this->formatTag('priority', $this->priority, tabs: 2);

        foreach ($this->images as $image) {
            $result .= "\t {$image->generate()}";
        }

        foreach ($this->videos as $video) {
            $result .= "\t {$video->generate()}";
        }

        $result .= "\t</url>\r\n";

        return $result;
    }
}