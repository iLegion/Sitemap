<?php

namespace ilegion\Sitemap\Interfaces;

interface Tag
{
    /**
     * @description Method for generate tag content.
     */
    public function generate(): string;
}