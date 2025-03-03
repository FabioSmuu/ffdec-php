# Manipule swf usando FFDec com PHP.

> Este repositório tem o intuito facilitar o uso da ferramenta FFDec em conjunto com PHP.

Até o momento já é possível através deste projeto:
- Editar imagens, scripts e binários.
- Substituir qualquer item que tenha um characterId atribuído.
- Renomear de forma interna a swf.
- Manipular swf inteiramente por xml.

### Requisitos:
[PHP](https://www.php.net/downloads.php) - Linguagem usada (para ser compatível com CMS e projetos futuros).<br>
[Java](https://www.java.com/pt-BR/download/) - Necessário para rodar a ferramenta FFDec.<br>
[FFDec](https://github.com/jindrapetrik/jpexs-decompiler/releases/) - Ferramenta usada para a CLI.<br>
<br>
### Como usar:
Você pode abrir tanto [run.bat](/run.bat) *(windows)* quanto [run.sh](/run.sh) *(linux)*.
> Após a execução, abra o link: **[http://localhost:8080](http://localhost:8080)**.

Explorando os exemplos você verá que todos incluem o arquivo [FFDec.php](src/ffdec.php).
<br><br>
### Manipulação de swf por xml.
> Quando você transforma uma swf em xml, você pode salvar este xml como uma swf nova. Isso permite a criação de symbol e class, por exemplo.

Após incluir o arquivo [FFDec.php](src/ffdec.php) em seu projeto, você poderá chamar [swf2xml](/src/ffdec.php#L41) e [xml2swf](/src/ffdec.php#L45), além de outras funções.

### Exemplos:
- [export.php](/src/export.php) - Exporte as imagens, scripts e binários de um arquivo swf.
- [import.php](/src/import.php) - Importe pasta de recursos como Imagens e Scripts para um arquivo swf.
- [replace.php](/src/replace.php) - Subistitua recursos de imagens, scripts e binário usando o characterID *(id de referência)*.
- [rename.php](/src/rename.php) - Altere o nome original *(e interno)* da swf.
<br><br>

**Obrigado pela sua atenção!**
