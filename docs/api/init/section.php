<?php

class Section
{
    private $basePath;
    private $category;
    private $name;
    private $children;
    private $languages = ['php', 'java', 'python', 'javascript', 'go'];
    private $categoryPath;
    private $sectionPath;

    public function __construct($basePath, $category, $name, $children)
    {
        $this->basePath = $basePath;
        $this->category = ucwords($category);
        $this->name = $name;
        $this->children = $children;
        $this->categoryPath = $this->basePath . DIRECTORY_SEPARATOR . $this->category;
        $this->sectionPath = $this->categoryPath  . DIRECTORY_SEPARATOR . "src" . DIRECTORY_SEPARATOR . $this->name . DIRECTORY_SEPARATOR;
    }

    public function create()
    {
        $this->initCategoryAndSectionDirectories();
        $this->initChildSectionMds();
    }

    private function initCategoryAndSectionDirectories()
    {
        !is_dir($this->categoryPath) && mkdir($this->categoryPath, 0755, true);
        !is_dir($this->sectionPath) && mkdir($this->sectionPath, 0755, true);

        $languagesPaths = preg_filter("/^/", $this->sectionPath, $this->languages);
        array_map(function ($v) {
            !is_dir($v) && mkdir($v, 0755, true);
        }, $languagesPaths);
    }

    private function getChildTabString($section, $language)
    {
        $str = "\n" . str_pad("", 12) . '=== "' . ucfirst($section) . '"' . "\n" . str_pad("", 16);
        $str .= "``` ${language}\n " . str_pad("", 14) . " ${language} \n" . str_pad("", 16) . "```";
        return $str;
    }

    private function createChildTabMds($language)
    {
        $languagePath = $this->sectionPath .  $language;
        $filenames = [];
        $write = false;

        foreach ($this->children as $key => $child) {
            if (is_array($child)) {
                $filename = $languagePath . DIRECTORY_SEPARATOR . $key . '.mds';

                if (file_exists($filename)) {
                    $fileContent = file_get_contents($filename);
                    preg_match_all("/\s{12}={3}\s+\"(.*?)\"/", $fileContent, $matches);
                    $diff = array_diff(array_map("strtolower", $child), array_map("strtolower", $matches[1]));
                    if (count($diff)) {
                        $write = true;
                        $content = $fileContent . "\n" . implode("\n", array_map([$this, "getChildTabString"], $diff, array_pad([], count($diff), $language)));
                    }
                } else {
                    $write = true;
                    $content = implode("\n", array_map([$this, "getChildTabString"], $child, array_pad([], count($child), $language)));
                }
                $section = $key;
            } else {
                $filename = $languagePath . DIRECTORY_SEPARATOR . $child . '.mds';

                if (!file_exists($filename)) {
                    $write = true;
                }
                $content = $this->getChildTabString($child, $language);
                $section = $child;
            }
            $write && file_put_contents($filename, $content);
            $filenames[$section] = str_replace($this->basePath . DIRECTORY_SEPARATOR, '', $filename);
        }
        return [$language, $filenames];
    }

    private function initChildSectionMds()
    {
        $filenames = array_map([$this, "createChildTabMds"], $this->languages);

        $sectionFiles = array_map([$this, "createChildLanguageMds"], $filenames);

        $this->createCategoryMd($sectionFiles);
    }

    private function getIncludeContent($files, $padSize)
    {
        $content = "";
        foreach ($files as $key => $file) {
            $str = "\n" . str_pad("", $padSize - 4, " ") . '=== "' . ucfirst($key) . '"' . "\n" . str_pad("", $padSize, " ");
            $content .= $str . '{' . '% include "' . $file . '" %}' . "\n";
        }
        return $content;
    }

    private function createChildLanguageMds($data)
    {
        list($language, $files) = $data;
        $filename = $this->sectionPath .  $language . '.mds';

        $write = false;
        if (file_exists($filename)) {
            $fileContent = file_get_contents($filename);
            preg_match_all("/\s{8}={3}\s+\"(.*?)\"/", $fileContent, $matches);
            $diff = array_diff(array_map('strtolower', array_keys($files)), array_map('strtolower', $matches[1]));
            if (count($diff)) {
                $diffFile = array_filter($files, function ($k) use ($diff) {
                    return in_array($k, $diff);
                }, ARRAY_FILTER_USE_KEY);
                $write = true;
                $includeContent = $fileContent  . $this->getIncludeContent($diffFile, 12);
            }
        } else {
            $write = true;
            $includeContent = $this->getIncludeContent($files, 12);
        }

        $write && file_put_contents($filename, $includeContent);

        return [$language => str_replace($this->basePath . DIRECTORY_SEPARATOR, '', $filename)];
    }

    private function createCategoryMd($data)
    {
        $sectionFiles = call_user_func_array("array_merge", $data);

        $content = '!!! data "' . ucwords($this->name) . '"' . "\n" . $this->getIncludeContent($sectionFiles, 8);

        $categoryFile = $this->categoryPath . DIRECTORY_SEPARATOR . ucwords($this->name) . '.md';
        if (!file_exists($categoryFile)) {
            file_put_contents($categoryFile, $content);
        }
    }
}
