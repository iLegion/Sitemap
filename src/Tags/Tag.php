<?php

namespace ilegion\Sitemap\Tags;

class Tag
{
    protected function formatTag(string $tagName, $value, string $attrs = '', int $tabs = 1): string
    {
        $tabsSymbol = str_repeat("\t", $tabs);

        return $value
            ? "$tabsSymbol<$tagName" . ($attrs ? " $attrs" : '') . ">$value</$tagName>\r\n"
            : '';
    }
}