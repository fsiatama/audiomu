<?php 
ini_set("display_errors",true);



$fileArray= array('samplepdfs/one.pdf', 'samplepdfs/two.pdf');

$datadir = "samplepdfs/";
$outputName = $datadir."merged.pdf";

$cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=$outputName ";
//Add each pdf file to the end of the command
foreach($fileArray as $file) {
    $cmd .= $file." ";
}
//echo $cmd;
$result = system($cmd);
print $result;