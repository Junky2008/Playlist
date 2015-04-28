<?php

include("functions.php");
$HTML = "";
if($_POST) {
    $playlist = getcwd() . "/list.m3u";
    $playlistHandle = fopen($playlist, 'w') or die("Creation failed");
    foreach($_POST as $value)
    {
        foreach(getFileList($value) as $file)
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
    foreach (getDirList() as $key => $value) {
        $HTML .= "<input type='checkbox' name=" . $key . " value=\"" . $value . "\">" . $value . "</input></br>";
    }
    $HTML .= "<input type='submit' value='Get list' />";
    $HTML .= "</form>";
    echo $HTML;
}
?>