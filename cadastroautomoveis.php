<?php
//conectar ao servidor e ao banco de dados
$conectar = mysql_connect("localhost","root","");
//conectar ao banco (sql)
$banco = mysql_select_db("revenda");

//pesquisar modelos e categorias para select

$sql_modelos       = "SELECT * FROM modelos";
$pesquisar_modelos = mysql_query($sql_modelos);

$sql_categorias       = "SELECT * FROM categorias";
$pesquisar_categorias = mysql_query($sql_categorias);

// ---------------------------

//se escolher opção GRAVAR
if(isset($_POST["gravar"]))
{
    //receber as variavies do html
    $codigo = $_POST["codigo"];
    $descricao = $_POST["descricao"];
    $codmodelo = $_POST["codmodelo"];
    $codcategoria = $_POST["codcategoria"];
    $ano = $_POST["ano"];
    $cor = $_POST["cor"];
    $placa = $_POST["placa"];
    $localizacao = $_POST["localizacao"];
    $combustivel = $_POST["combustivel"];
    $opcionais = $_POST["opcionais"];
    $valor = $_POST["valor"];

    //comandoMYSQL para gravar banco
    $sql = "insert into automoveis (codigo,descricao,codmodelo,codcategoria,ano,cor,placa,localizacao,combustivel,opcionais,valor) 
            values ('$codigo','$descricao','$codmodelo','$codcategoria','$ano','$cor','$placa','$localizacao','$combustivel','$opcionais','$valor')";

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
    $descricao = $_POST["descricao"];
    $codmodelo = $_POST["codmodelo"];
    $codcategoria = $_POST["codcategoria"];
    $ano = $_POST["ano"];
    $cor = $_POST["cor"];
    $placa = $_POST["placa"];
    $localizacao = $_POST["localizacao"];
    $combustivel = $_POST["combustivel"];
    $opcionais = $_POST["opcionais"];
    $valor = $_POST["valor"];

    $sql = "update automoveis set opcionais = '$opcionais', valor = '$valor'
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
    $descricao = $_POST["descricao"];
    $codmodelo = $_POST["codmodelo"];
    $codcategoria = $_POST["codcategoria"];
    $ano = $_POST["ano"];
    $cor = $_POST["cor"];
    $placa = $_POST["placa"];
    $localizacao = $_POST["localizacao"];
    $combustivel = $_POST["combustivel"];
    $opcionais = $_POST["opcionais"];
    $valor = $_POST["valor"];

    $sql = "delete from automoveis
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
    $sql = "select * from automoveis";
    $resultado = mysql_query($sql);

    //verifica o resultado da pesquisa (0 ou 1)
    if (mysql_num_rows($resultado) == 0)
    {
        echo "Sua pesquisa não retornou resultados... ";
    }
    else
    {
        echo "Resultado da Pesquisa dos automoveis: "."<br>";
        //mostrar na tela os valores encontrados
        while($automoveis = mysql_fetch_array($resultado))
        {
            echo "Codigo: ".$automoveis['codigo']."<br>".
                 "Descricao: ".$automoveis['descricao']."<br>".
                 "Codigo Modelo: ".$automoveis['codmodelo']."<br>".
                 "Codigo Categoria: ".$automoveis['codcategoria']."<br>".
                 "Ano: ".$automoveis['ano']."<br>".
                 "Cor: ".$automoveis['cor']."<br>".
                 "Placa: ".$automoveis['placa']."<br>".
                 "Localizacao: ".$automoveis['localizacao']."<br>".
                 "Combustivel: ".$automoveis['combustivel']."<br>".
                 "Opcionais: ".$automoveis['opcionais']."<br>".
                 "Valor: ".$automoveis['valor']."<br><br>";
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
    <title>Cadastro Automoveis</title>
</head>
<body>
    <form name="formulario" method="post" action="cadastroautomoveis.php">
        <h1>Cadastro dos Automoveis - Revenda Carros</h1>
        Codigo: 
        <input type="text" name="codigo" id="codigo" size=30>
        <br><br>
        Descricao:
        <input type="text" name="descricao" id="descricao" size=30>
        <br><br>
        Cod Modelo:
        <select name="codmodelo" id="codmodelo">
        <option value=0>Selecionar o modelo</option>
        <?php
        if(mysql_num_rows($pesquisar_modelos) <> 0)
        {
            while($modelos = mysql_fetch_array($pesquisar_modelos))
            {
                echo '<option value="'.$modelos['codigo'].'">'.
                                       $modelos['nome'].'</option>';
            }
        }
        ?>
        </select>
        <br><br>
        Cod Categoria:
        <select name="codcategoria" id="codcategoria">
        <option value=0>Selecionar a categoria</option>
        <?php
        if(mysql_num_rows($pesquisar_categorias) <> 0)
        {
            while($categorias = mysql_fetch_array($pesquisar_categorias))
            {
                echo '<option value="'.$categorias['codigo'].'">'.
                                       $categorias['nome'].'</option>';
            }
        }
        ?>
        </select>
        <br><br>
        Ano:
        <input type="text" name="ano" id="ano" size=30>
        <br><br>
        Cor:
        <input type="text" name="cor" id="cor" size=30>
        <br><br>
        Placa:
        <input type="text" name="placa" id="placa" size=30>
        <br><br>
        Localizacao:
        <input type="text" name="localizacao" id="localizacao" size=30>
        <br><br>
        Combustivel:
        <input type="text" name="combustivel" id="combustivel" size=30>
        <br><br>
        Opcionais:
        <input type="text" name="opcionais" id="opcionais" size=30>
        <br><br>
        Valor:
        <input type="text" name="valor" id="valor" size=30>
        <br><br>
        
        <input type="submit" name="gravar" id="gravar" value="Gravar">
        <input type="submit" name="alterar" id="alterar" value="Alterar">
        <input type="submit" name="excluir" id="excluir" value="Excluir">
        <input type="submit" name="pesquisar" id="pesquisar" value="Pesquisar">
    </form>
</body>
</html>