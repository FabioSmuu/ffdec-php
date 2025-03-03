<a href="/"><< Voltar</a><br><br>

<?php
include_once __DIR__ . '/ffdec.php';

// Caminho da pasta "output"
$output_dir = __DIR__ . '/../output';

// Verifica se o diretório existe
$folders = [];
if (is_dir($output_dir)) {
    $itens = scandir($output_dir);
    
    foreach ($itens as $item) {
        if ($item != '.' && $item != '..' && is_dir($output_dir . '/' . $item)) {
            $folders[] = $item;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['folder']) && isset($_POST['characterID']) && isset($_FILES['new_file'])) {
    $file_tmp_path = $_FILES['new_file']['tmp_name'];
    $characterID = (int) $_POST['characterID'];

    // Caminho completo para a pasta selecionada
    $folderSelect = $output_dir . '/' . $_POST['folder'];

    // Verifica se há um arquivo SWF na pasta selecionada
    $fileSWF = glob($folderSelect . '/*.swf');
    if (count($fileSWF) >= 1) {
        // O único arquivo SWF encontrado
        $swf = $fileSWF[0];

        replace($swf, $swf, $characterID, $file_tmp_path);
    } else {
        die("Não há arquivos SWF na pasta.");
    }
}
?>

<form method="post" enctype="multipart/form-data">
    <label for="folder">Selecione a pasta:</label>
    <select name="folder" id="folder">
        <?php if (!empty($folders)): ?>
            <?php foreach ($folders as $folder): ?>
                <option value="<?php echo htmlspecialchars($folder); ?>">
                    <?php echo htmlspecialchars($folder); ?>
                </option>
            <?php endforeach; ?>
        <?php else: ?>
            <option disabled selected>Nenhuma pasta encontrada</option>
        <?php endif; ?>
    </select>

    <label for="characterID">Character ID:</label>
    <input name="characterID" type="number" value="0" required />

    <label for="new_file">Selecione o arquivo XML:</label>
    <input type="file" name="new_file" id="new_file" required>

    <button type="submit">Importar</button>
</form>
