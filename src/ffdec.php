<?php
// Verifica se o Java está instalado
$java_check = shell_exec("java -version 2>&1");
if (!$java_check) {
    die("Erro: Java não está instalado ou não está no PATH.");
}

$ffdec_path = __DIR__ . "/../ffdec/ffdec.jar";
if (!file_exists($ffdec_path)) die("Erro: ffdec.jar não encontrado em $ffdec_path");

function ffdec($command) {
    global $ffdec_path;
    $output = shell_exec("java -jar \"$ffdec_path\" $command 2>&1");
    echo "<pre>Saída do shell_exec:\n$output</pre>";
}

function exportImage($output_dir, $swf_dest_path) {
    ffdec("-export image \"$output_dir\" \"$swf_dest_path\"");
}

function exportScript($output_dir, $swf_dest_path) {
    ffdec("-export script \"$output_dir\" \"$swf_dest_path\"");
}

function exportBinaryData($output_dir, $swf_dest_path) {
    ffdec("-export binaryData \"$output_dir\" \"$swf_dest_path\"");
}

function importImages($swf_original, $swf_modified, $src_path) {
    ffdec("-importImages \"$swf_original\" \"$swf_modified\" \"$src_path\"");
}

function importScript($swf_original, $swf_modified, $src_path) {
    ffdec("-importScript \"$swf_original\" \"$swf_modified\" \"$src_path\"");
}

function replace($swf_original, $swf_modified, $character_id, $src_file) {
    ffdec("-replace \"$swf_original\" \"$swf_modified\" \"$character_id\" \"$src_file\"");
}

function swf2xml($swf_original, $output_xml) {
    ffdec("-swf2xml \"$swf_original\" \"$output_xml\"");
}

function xml2swf($xml_modified, $output_swf) {
    ffdec("-xml2swf \"$xml_modified\" \"$output_swf\"");
}