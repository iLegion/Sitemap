<?php

namespace ilegion\Sitemap\Tags;

class Video extends Tag
{
    private string $thumbnailLoc;

    private string $title;

    private string $description;

    private string $contentLoc;

    private string $playerLoc;

    private ?int $duration = null;

    private ?string $expirationDate = null;

    private ?float $rating = null;

    private ?int $viewCount = null;

    private ?string $publicationDate = null;

    private ?string $familyFriendly = null;

    private array $restriction = [];

    private array $platform = [];

    private ?string $requiresSubscription = null;

    private array $uploader = [];

    private ?string $live = null;

    private array $tags = [];

    public function __construct(
        string $thumbnailLoc,
        string $title,
        string $description,
        string $contentLoc,
        string $playerLoc
    ) {
        $this->thumbnailLoc = $thumbnailLoc;
        $this->title = $title;
        $this->description = $description;
        $this->contentLoc = $contentLoc;
        $this->playerLoc = $playerLoc;
    }

    public static function create(
        string $thumbnailLoc,
        string $title,
        string $description,
        string $contentLoc,
        string $playerLoc
    ): static {
        return new static($thumbnailLoc, $title, $description, $contentLoc, $playerLoc);
    }

    public function setDuration(int $value): static
    {
        $this->duration = $value;

        return $this;
    }

    public function setExpirationDate(string $value): static
    {
        $this->expirationDate = $value;

        return $this;
    }

    public function setRating(float $value): static
    {
        $this->rating = $value;

        return $this;
    }

    public function setViewCount(int $value): static
    {
        $this->viewCount = $value;

        return $this;
    }

    public function setPublicationDate(string $value): static
    {
        $this->publicationDate = $value;

        return $this;
    }

    public function setFamilyFriendly(string $value): static
    {
        $this->familyFriendly = $value;

        return $this;
    }

    public function setRestriction(string $relationship, string $value): static
    {
        $this->restriction = ['relationship' => $relationship, 'value' => $value];

        return $this;
    }

    public function setPlatform(string $relationship, string $value): static
    {
        $this->platform = ['relationship' => $relationship, 'value' => $value];

        return $this;
    }

    public function setRequiresSubscription(string $value): static
    {
        $this->requiresSubscription = $value;

        return $this;
    }

    public function setUploader(string $value, string $info = null): static
    {
        $this->uploader = ['info' => $info, 'value' => $value];

        return $this;
    }

    public function setLive(string $value): static
    {
        $this->live = $value;

        return $this;
    }

    public function setTags(array $value): static
    {
        $this->tags = $value;

        return $this;
    }

    public function generate(): string
    {
        $xmlTags = [
            'video:thumbnail_loc' => $this->thumbnailLoc,
            'video:title' => $this->title,
            'video:description' => $this->description,
            'video:content_loc' => $this->contentLoc,
            'video:player_loc' => $this->playerLoc,
            'video:duration' => $this->duration,
            'video:expiration_date' => $this->expirationDate,
            'video:rating' => $this->rating,
            'video:view_count' => $this->viewCount,
            'video:publication_date' => $this->publicationDate,
            'video:family_friendly' => $this->familyFriendly,
            'video:restriction' => $this->restriction ? ['value' => $this->restriction['value'], 'attrs' => 'relationship="' . $this->restriction['relationship'] . '"'] : null,
            'video:platform' => $this->platform ? ['value' => $this->platform['value'], 'attrs' => 'relationship="' . $this->platform['relationship'] . '"'] : null,
            'video:requires_subscription' => $this->requiresSubscription,
            'video:uploader' => $this->uploader ? ['value' => $this->uploader['value'], 'attrs' => $this->uploader['info'] ? 'info="' . $this->uploader['info'] . '"' : ''] : null,
            'video:live' => $this->live,
        ];

        $result = "\t<video:video>\r\n";

        foreach ($xmlTags as $tagName => $tagValue) {
            $isArray = is_array($tagValue);
            $formattedValue = $isArray ? $tagValue['value'] : $tagValue;
            $formattedAttrs = $isArray ? $tagValue['attrs'] : '';
            $result .= $this->formatTag($tagName, $formattedValue, $formattedAttrs, 3);
        }

        foreach ($this->tags as $value) {
            $result .= $this->formatTag('video:tag', $value, tabs: 3);
        }

        $result .= "\t\t</video:video>\r\n";

        return $result;
    }
}