<?php

namespace lib;

class ScanDirs
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var array
     */
    private static $vcsPatterns = [
        '.svn',
        '_svn',
        'CVS',
        '_darcs',
        '.arch-params',
        '.monotone',
        '.bzr',
        '.git',
        '.hg',
    ];

    /**
     * @return ScanDirs
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @param string $path
     * @param bool $recursive
     * @return array
     * @throws \Exception
     */
    public function inDirectory($path, $recursive = false)
    {
        $files = [];
        if (!is_dir($path))
            throw new \Exception('Canot this dirs.');

        foreach (new \DirectoryIterator($path) as $file) {
            if (!$file->isDot() && !$file->isFile() && $file->isDir() && $recursive) {
                $files = array_merge_recursive($files, self::inDirectory($file->getRealPath()));
            } else if ($file->isFile() && !in_array($file->getExtension(), self::$vcsPatterns)) {
                $files[] = clone $file;
            }
        }

        return $files;
    }
}