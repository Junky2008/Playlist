<?php

function getDirList()
{
    $list = array();
    $directory = "../";
    $it = new RecursiveDirectoryIterator($directory);

    $it->rewind();
    while($it->valid())
    {
        if(!$it->isDot() && $it->isDir() && $it->getFilename() != "list" && $it->getFilename() != '$RECYCLE.BIN')
        {
            $list[] = $it->getFilename();
        }
        $it->next();
    }
    asort($list);
    return $list;
}

function getFileList($dir)
{
    $list = array();
    $directory = "../" . $dir;
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

    $it->rewind();
    while($it->valid())
    {
        if(!$it->isDot() && !$it->isDir())
        {
            $list[] = str_replace("../", "http://music.bloodrush.nl:81/", $it->key());
        }
        $it->next();
    }
    asort($list);
    return $list;
}

?>