<a href="/"><< Voltar</a><br><br>

<?php
include_once __DIR__ . '/ffdec.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['swf_file'])) {
    $swf_tmp_path = $_FILES['swf_file']['tmp_name'];
    $output_dir = '../output/ffdec_output_' . uniqid();

    // Cria o diretório se não existir
    if (!mkdir($output_dir, 0777, true) && !is_dir($output_dir)) die("Erro ao criar diretório: $output_dir");

    // Copiar o arquivo SWF para o diretório de saída
    $swf_filename = basename($_FILES['swf_file']['name']);
    $swf_dest_path = $output_dir . '/' . $swf_filename;

    if (!move_uploaded_file($swf_tmp_path, $swf_dest_path)) {
        die("Erro ao mover o arquivo SWF para o diretório de saída.");
    }

    // Executar o ffdec para extrair as imagens
    switch ($_POST['type']) {
        case 'image':
            exportImage($output_dir, $swf_dest_path);
            break;
        case 'script':
            exportScript($output_dir, $swf_dest_path);
            break;
        case 'bin':
            exportBinaryData($output_dir, $swf_dest_path);
            break;
    }

    // Verifica se imagens foram extraídas
    $images = glob("$output_dir/*.png");

    if (empty($images)) die("Nenhuma imagem foi extraída. Verifique se o SWF contém imagens.");

    echo "<h3>Imagens extraídas:</h3>";
    foreach ($images as $img) {
        echo "<img src='data:image/png;base64," . base64_encode(file_get_contents($img)) . "'><br>";
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="swf_file" accept=".swf" required>
    <select name="type" id="type">
        <option value="image">Extrair imagens</option>
        <option value="script">Extrair script</option>
        <option value="bin">Extrair binaryData</option>
    </select>
    <button type="submit">Extrair</button>
</form>
