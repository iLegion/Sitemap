<?php

namespace ilegion\Sitemap\Tags;

class Sitemap
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

    public function setLoc(string $value): static
    {
        $this->loc = $value;

        return $this;
    }

    public function setLastMod(string $value): static
    {
        $this->lastMod = $value;

        return $this;
    }

    public function generate(): string
    {
        $result = <<<END

            <sitemap>
                <loc>$this->loc</loc>
        END;

        if ($this->lastMod) {
            $result .= "\r\n        <lastmod>$this->lastMod</lastmod>";
        }

        return $result .= "\r\n   </sitemap>";
    }
}