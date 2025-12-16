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

.table-metier{
    padding:3px;
    font-family:"Courier New", Courier, monospace;
}
    </style>
</head>

<body>
<center>
<h1>Bases Larzac - tables par rubrique</h1>

<?php
/******************************************************************************
    Liste les tables par catégorie
    @license    GPL
    @history    2025-12-16 19:27:12+01:00, Thierry Graff : Creation
********************************************************************************/
$res = '<table class="wikitable">';

$dbs = ['gfa', 'lum', 'sctl'];

$tables = [];
foreach($dbs as $db){
    $tables[$db] = yaml_parse_file("output/$db/tables2.yml");
}

$rubrics = array_keys($tables['sctl']);

// table header
$res .= "    <tr><th></th>";
foreach($dbs as $db){
    $res .= "<th>$db</th>";
}
$res .= "</tr>\n";

$divclass = '<div class="table-metier">';
$divend = '</div>';
foreach($rubrics as $rubric){
    $res .= "    <tr>\n";
    $res .= "        <th>$rubric</th>\n";
    foreach($dbs as $db){
        $curtables = $tables[$db];
        $res .= "        <td>\n";
        $res .= $divclass . implode("$divend\n$divclass", $curtables[$rubric] ?? []) . $divend . "\n";
        $res .= "        </td>\n";
    }
    $res .= "    </tr>\n";
}

$res .= "</table>\n";

echo $res;
?>

</center>
</body>
</html>
