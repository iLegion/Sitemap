<?php

namespace ilegion\Sitemap;

/**
 * @description Service for generation sitemap files for many languages with buffer saver.
 * File open, write and close when string size exceeds BUFFER_SIZE.
 * This was done in order to manually monitor and clear the buffer when working with a large amount of data.
 */
class SitemapFileManager
{
    private const BUFFER_SIZE = 4096;

    public string $filePath;

    private string $path;

    private bool $gzip;

    private string $buffer;

    public function __construct(string $path, bool $gzip = true)
    {
        $this->path = $path;
        $this->gzip = $gzip;
        $this->buffer = '';
        $this->filePath = $path . ($this->gzip ? '.gz' : '');

        $this->deletePrevFile();
    }

    public static function create(string $path, bool $gzip = true): static
    {
        return new static($path, $gzip);
    }

    public static function validatePath(string $path): bool
    {
        return !!preg_match('/(?:[^\s\/]+\.[a-zA-Z]{2,})/', $path);
    }

    public function flushBufferToFile(): void
    {
        $this->createDirectory();

        if ($this->gzip) {
            $file = gzopen($this->filePath, 'a');
        } else {
            $file = fopen($this->filePath, 'a');
        }

        if ($file) {
            if ($this->gzip) {
                gzwrite($file, $this->buffer);
                gzclose($file);
            } else {
                fwrite($file, $this->buffer);
                fclose($file);
            }

            $this->buffer = '';
        }
    }

    public function appendTextToFile(string $text): static
    {
        $this->buffer .= $text;

        if (strlen($this->buffer) >= self::BUFFER_SIZE) {
            $this->flushBufferToFile();
        }

        return $this;
    }

    public function close(): string
    {
        if (!empty($this->buffer)) $this->flushBufferToFile();

        return $this->filePath;
    }

    private function createDirectory(): void
    {
        if (!file_exists(dirname($this->path))) {
            mkdir($this->path, 0755, true);
        }
    }

    private function deletePrevFile(): void
    {
        if (file_exists($this->path)) {
            unlink($this->path);
        }
    }
}