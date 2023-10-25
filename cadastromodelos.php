<?php
//conectar ao servidor e ao banco de dados
$conectar = mysql_connect("localhost","root","");
//conectar ao banco (sql)
$banco = mysql_select_db("revenda");

//pesquisar marcas para select

$sql_marcas       = "SELECT * FROM marcas";
$pesquisar_marcas = mysql_query($sql_marcas);

// ---------------------------

//se escolher opção GRAVAR
if(isset($_POST["gravar"]))
{
    //receber as variavies do html
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];
    $codmarca = $_POST["codmarca"];

    //comandoMYSQL para gravar banco
    $sql = "insert into modelos (codigo,nome,codmarca) 
            values ('$codigo','$nome','$codmarca')";

    //executar o comando sql no banco dados
    $resultado = mysql_query($sql);

    //verificar se gravou (sem erros)
    if ($resultado)
    {
        echo "Dados gravados com sucesso!";
    }
    else
    {
        echo "ERRO ao gravar!";
    }
}

//se escolher opção ALTERAR
if(isset($_POST["alterar"]))
{
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];
    $codmarca = $_POST["codmarca"];

    $sql = "update modelos set nome = '$nome'
            where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado)
    {
        echo "Dados alterados com sucesso!";
    }
    else
    {
        echo "ERRO ao alterar dados!";
    }
}

//se escolher opção EXCLUIR
if(isset($_POST["excluir"]))
{
    $codigo = $_POST["codigo"];
    $nome = $_POST["nome"];
    $codmarca = $_POST["codmarca"];

    $sql = "delete from modelos
            where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if ($resultado)
    {
        echo "Dados excluídos com sucesso!";
    }
    else
    {
        echo "ERRO ao excluir dados!";
    }
}

//se escolher opção PESQUISAR
if(isset($_POST["pesquisar"]))
{
    $sql = "select * from modelos";
    $resultado = mysql_query($sql);

    //verifica o resultado da pesquisa (0 ou 1)
    if (mysql_num_rows($resultado) == 0)
    {
        echo "Sua pesquisa não retornou resultados... ";
    }
    else
    {
        echo "Resultado da Pesquisa dos modelos: "."<br>";
        //mostrar na tela os valores encontrados
        while($modelos = mysql_fetch_array($resultado))
        {
            echo "Codigo: ".$modelos['codigo']."<br>".
                 "Nome: ".$modelos['nome']."<br>".
                 "Codigo Marca: ".$modelos['codmarca']."<br><br>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Modelos</title>
</head>
<body>
    <form name="formulario" method="post" action="cadastromodelos.php">
        <h1>Cadastro dos Modelos - Revenda Carros</h1>
        Codigo: 
        <input type="text" name="codigo" id="codigo" size=30>
        <br><br>
        Nome:
        <input type="text" name="nome" id="nome" size=30>
        <br><br>

        <!-- pesquisar as marcas antes -->
        Cod Marca:
        <select name="codmarca" id="codmarca">
        <option value=0>Selecionar a marca</option>
        <?php
        if(mysql_num_rows($pesquisar_marcas) <> 0)
        {
            while($marcas = mysql_fetch_array($pesquisar_marcas))
            {
                echo '<option value="'.$marcas['codigo'].'">'.
                                       $marcas['nome'].'</option>';
            }
        }
        ?>
        </select>
        <br><br>
        
        <input type="submit" name="gravar" id="gravar" value="Gravar">
        <input type="submit" name="alterar" id="alterar" value="Alterar">
        <input type="submit" name="excluir" id="excluir" value="Excluir">
        <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar">
    </form>
</body>
</html>