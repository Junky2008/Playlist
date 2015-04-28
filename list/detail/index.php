<?php

include("../functions/functions.php");

$basedir = "../../";

$HTML = "";
if($_POST) {
    $playlist = getcwd() . "/list.m3u";
    $playlistHandle = fopen($playlist, 'w') or die("Creation failed");
    foreach($_POST as $value)
    {
        foreach(getFileList($basedir . $value, $basedir) as $file)
        {
            fwrite($playlistHandle, $file . "\n");
        }
    }
    fclose($playlistHandle);
    header("Content-Type: application/octet-stream");
    header("Content-Transfer-Encoding: Binary");
    header("Content-disposition: attachment; filename=\"" . basename($playlist) . "\"");
    readfile($playlist);
} else {
    $HTML .= "<form method='post'>";
    foreach (getSubDirList($basedir) as $key => $value) {
        if(sizeof($value) == 0) {
            $HTML .= "<input type='checkbox' name=" . $key . " value=\"" . $key . "\"><b>" . $key . "</b></input></br>";
        }
        else {
            $HTML .= "<div id='" . $key . "' style='margin-left:20px;'>";
            $HTML .= "<div id='" . "Label" . $key . "'><b>" . $key . "</b></div>";
            $HTML .= "<div id='" . "Content" . $key . "'>";
            foreach ($value as $key2 => $value2) {
                $HTML .= "<input type='checkbox' name=" . $key2 . " value=\"" . $key . "/" . $value2 . "\">" . $value2 . "</input></br>";
            }
            $HTML .= "</div></div>";
        }
    }
    $HTML .= "<input type='submit' value='Get list' />";
    $HTML .= "</form>";
    echo $HTML;
}
?>