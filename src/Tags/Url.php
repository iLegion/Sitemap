<?php

namespace ilegion\Sitemap\Tags;

use ilegion\Sitemap\Enums\ChangeFreq;

class Url
{
    public const CHANGE_FREQ_ALWAYS = 'always';
    public const CHANGE_FREQ_HOURLY = 'hourly';
    public const CHANGE_FREQ_DAILY = 'daily';
    public const CHANGE_FREQ_WEEKLY = 'weekly';
    public const CHANGE_FREQ_MONTHLY = 'monthly';
    public const CHANGE_FREQ_YEARLY = 'yearly';
    public const CHANGE_FREQ_NEVER = 'never';

    private string $loc;

    private ?string $lastMod = null;

    private ?ChangeFreq $changeFreq = null;

    private ?string $priority = null;

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

    public function generate(): string
    {
        $result = <<<END

            <url>
                <loc>$this->loc</loc>
        END;

        if ($this->lastMod) {
            $result .= "\r\n        <lastmod>$this->lastMod</lastmod>";
        }

        if ($this->changeFreq) {
            $result .= "\r\n        <changefreq>{$this->changeFreq->value}</changefreq>";
        }

        if ($this->priority) {
            $result .= "\r\n        <priority>$this->priority</priority>";
        }

        return $result .= "\r\n   </url>";
    }
}