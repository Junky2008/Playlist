<?php

function getDirList($directory)
{
    $list = array();
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

function getSubDirList($directory)
{
    $list = array();
    foreach(getDirList($directory) as $value)
    {
        $list[$value] = getDirList($directory . $value);
    }
    return $list;
}

function getFileList($directory, $basedir)
{
    $list = array();
    $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

    $it->rewind();
    while($it->valid())
    {
        if(!$it->isDot() && !$it->isDir())
        {
            $list[] = str_replace($basedir, "http://music.bloodrush.nl:81/", $it->key());
        }
        $it->next();
    }
    asort($list);
    return $list;
}

?>