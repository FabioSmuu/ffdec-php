<a href="/"><< Voltar</a><br><br>

<?php
include_once __DIR__ . '/ffdec.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['swf_file']) && isset($_POST['new_name'])) {
    $swf_tmp_path = $_FILES['swf_file']['tmp_name'];
    $nameOld = trim(str_replace('.swf', '', basename($_FILES['swf_file']['name'])));
    $nameNew = trim($_POST['new_name']);
    $output_dir = '../output/ffdec_output_' . uniqid();

    // Cria o diretório se não existir
    if (!mkdir($output_dir, 0777, true) && !is_dir($output_dir)) die("Erro ao criar diretório: $output_dir");

    swf2xml($swf_tmp_path, "$output_dir/tmp_old.xml");

    // Hexadecimal dos nomes antigos e novos
    $hexOld = bin2hex($nameOld);
    $hexNew = bin2hex($nameNew);

    // Carrega o XML gerado
    $xml = file_get_contents("$output_dir/tmp_old.xml");

    // Substitui os nomes no XML
    $xml = str_replace([ $nameOld, $hexOld ], [ $nameNew, $hexNew ], $xml);

    // Salva o novo XML
    file_put_contents("$output_dir/tmp_new.xml", $xml);

    xml2swf("$output_dir/tmp_new.xml", "$output_dir/{$nameNew}.swf");
    
    // Exclui os arquivos temporários XML
    unlink("$output_dir/tmp_new.xml");
    unlink("$output_dir/tmp_old.xml");

    // Exibe o SWF renomeado para download
    echo "<h3>SWF Renomeado:</h3>";
    echo "<a href='$output_dir/{$nameNew}.swf' download>Baixar o arquivo renomeado</a>";
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="swf_file" accept=".swf" required>
    <input type="text" name="new_name" placeholder="Novo nome (sem .swf)" required>
    <button type="submit">Renomear</button>
</form>
