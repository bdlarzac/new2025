<?php
/******************************************************************************
    Génère 
    @license    GPL
    @history    2025-12-16 19:27:12+01:00, Thierry Graff : Creation
********************************************************************************/



$dbs = ['gfa', 'lum', 'sctl'];

$MAX = 20; // max nb of tables per db ; 20 for sctl

$tables = [];
foreach($dbs as $db){
    $tables[$db] = file("output/$db/tables.txt", FILE_IGNORE_NEW_LINES);
    natcasesort($tables[$db]);
}
//echo "\n<pre>"; print_r($tables); echo "</pre>\n"; exit;

$res = '';
$res .= <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Tables lum gfa sctl</title>
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link rel="license" href="http://www.gnu.org/copyleft/gpl.html">
    <meta name="dcterms.rightsHolder" content="Thierry Graff">
    <meta name="dcterms.dateCopyrighted" content="2025-12-16">
    <style>
table.wikitable{
    margin:1rem;
    border-collapse:collapse;
}
table.wikitable > tr > th,
table.wikitable > * > tr > th {
    background-color:lightblue;
    text-align:center;
    vertical-align:top;
}
table.wikitable > tr > th,
table.wikitable > tr > td,
table.wikitable > * > tr > th,
table.wikitable > * > tr > td {
    border:1px solid #a2a9b1;
    padding:0.2rem 0.4rem;
    vertical-align:top;
}
table.wikitable tr td code{
    background:none;
}
    </style>
</head>

<body>

<table class="wikitable">
HTML;

// table header
$res .= "    <tr>";
foreach($dbs as $db){
    $res .= "<th>$db</th>";
}
$res .= "</tr>\n";

// table rows
for($i=0; $i < $MAX; $i++){
    $res .= "    <tr>\n";
    foreach($dbs as $db){
        $res .= '        <td>' . ($tables[$db][$i] ?? '') . "</td>\n";
    }
    $res .= "    </tr>\n";
}

$res .= "</table>\n";

echo $res;

