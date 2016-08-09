<?php

namespace lib;

class Validate
{
    private $dublicates = [];

    public function getDuplicates()
    {
        return $this->dublicates;
    }

    public function isValidate($path, array $files)
    {
        foreach ($files as $file) {
            if ($file instanceof \DirectoryIterator
                && $file->getPathname() != $path
                && self::hasDiff($path, $file->getPathname())
            ) {
                $this->dublicates[] = $file->getPathname();
            }
        }
    }

    public static function hasDiff($newFile, $oldFile)
    {
        if (!file_exists($newFile) && !file_exists($oldFile))
            throw new \Exception('Its not files.');

        return (sha1_file($newFile) === sha1_file($oldFile));
    }
}