<?php
$conectar = mysql_connect('localhost','root','');
$banco = mysql_select_db('revenda');

//------- pesquisa categorias
$sql_categorias  = "SELECT * FROM categorias";
$pega_categorias = mysql_query($sql_categorias);

//------- pesquisa marcas
$sql_marcas  = "SELECT * FROM marcas";
$pega_marcas = mysql_query($sql_marcas);

//------- pesquisa modelos
$sql_modelos  = "SELECT codigo, nome FROM modelos";
$pega_modelos = mysql_query($sql_modelos);

//------- pesquisa ano
$sql_automoveis  = "SELECT * FROM automoveis";
$pega_automoveis = mysql_query($sql_automoveis);



$vazio = 0;

if(!empty($_POST['pesq_categoria']))
{
    $categoria  = (empty($_POST['codcategoria']))? 'null' : $_POST['codcategoria'];

    if ($categoria <> '')
    {
     $sql_veiculos = "SELECT automoveis.codigo, automoveis.descricao, automoveis.codcategoria, automoveis.codmodelo,
                      automoveis.ano, automoveis.cor, automoveis.placa, automoveis.localizacao,
                      automoveis.combustivel, automoveis.opcionais, automoveis.valor
                      FROM automoveis, categorias
                      WHERE automoveis.codcategoria = categorias.codigo and
                      automoveis.codcategoria ='$categoria'";

     $seleciona_veiculos = mysql_query($sql_veiculos);
     $vazio = 1;
     }
}

if(!empty($_POST['pesq_marca']))
{
    $marca = (empty($_POST['codmarca']))? 'null' : $_POST['codmarca'];

   if ($marca <> '')
   {
      $sql_veiculos = "SELECT automoveis.codigo, automoveis.descricao, automoveis.codcategoria, automoveis.codmodelo,
                      automoveis.ano, automoveis.cor, automoveis.placa, automoveis.localizacao,
                      automoveis.combustivel, automoveis.opcionais, automoveis.valor
                      FROM automoveis, modelos, marcas
                      WHERE automoveis.codmodelo = modelos.codigo and
                      modelos.codmarca = marcas.codigo and
                      modelos.codmarca = '$marca'";
                      
     $seleciona_veiculos = mysql_query($sql_veiculos);
     $vazio = 1;
   }
}

if(!empty($_POST['pesq_modelos']))
{
    $modelo = (empty($_POST['codmodelo']))? 'null' : $_POST['codmodelo'];

   if ($modelo <> '')
   {
      $sql_veiculos = "SELECT automoveis.codigo, automoveis.descricao, automoveis.codcategoria, automoveis.codmodelo,
                      automoveis.ano, automoveis.cor, automoveis.placa, automoveis.localizacao,
                      automoveis.combustivel, automoveis.opcionais, automoveis.valor
                      FROM automoveis
                      WHERE  automoveis.codmodelo = '$modelo'";
                      
     $seleciona_veiculos = mysql_query($sql_veiculos);
     $vazio = 1;
   }
}

if(!empty($_POST['pesq_automoveis']))
{
    $automovel = (empty($_POST['codautomovel']))? 'null' : $_POST['codautomovel'];

   if ($automovel <> '')
   {
      $sql_veiculos = "SELECT automoveis.codigo, automoveis.descricao, automoveis.codcategoria, automoveis.codmodelo,
                      automoveis.ano, automoveis.cor, automoveis.placa, automoveis.localizacao,
                      automoveis.combustivel, automoveis.opcionais, automoveis.valor
                      FROM automoveis
                      WHERE  automoveis.codigo = '$automovel'";
                      
     $seleciona_veiculos = mysql_query($sql_veiculos);
     $vazio = 1;
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Home Revenda</title>
</head>
<body>
    <div id="logo">
        <img src="logo2.1.jpg" class="imgLogo">
    </div>
    <div id="pesquisa">
        <div class="tituloPesquisa">
            Filtros de pesquisa:
        </div>
        <br><br>
        <form name="form_categorias" method="post" action="home.php">
            Categorias: <select name="codcategoria" id="codcategoria">
            <option value=0 selected="selected">Selecione categoria ...</option>
            <?php
                if(mysql_num_rows($pega_categorias) == 0)
                {
                    echo '<h1>Sua busca por categorias não retornou resultados ... </h1>';
                }
                else
                {
                    while($resultado = mysql_fetch_array($pega_categorias))
                    {
                        echo '<option value="'.$resultado['codigo'].'">'.
                                               $resultado['nome'].'</option>';
                    }
                }
            ?>
        </select>
        <input type="submit" name="pesq_categoria" id="pesq_categoria" value="Pesquisar">
        </form>

        <br>

        <form name="form_marcas" method="post" action="home.php">
            Marcas: <select name="codmarca" id="codmarca">
            <option value=0 selected="selected">Selecione marca ...</option>
            <?php
                if(mysql_num_rows($pega_marcas) == 0)
                {
                    echo '<h1>Sua busca por marcas não retornou resultados ... </h1>';
                }
                else
                {
                    while($resultado = mysql_fetch_array($pega_marcas))
                    {
                        echo '<option value="'.$resultado['codigo'].'">'.
                                               $resultado['nome'].'</option>';
                    }
                }
            ?>
        </select>
        <input type="submit" name="pesq_marca" id="pesq_marca" value="Pesquisar">
        </form>

        <br>

        <form name="form_modelos" method="post" action="home.php">
            Modelos: <select name="codmodelo" id="codmodelo">
            <option value=0 selected="selected">Selecione modelos ...</option>
            <?php
                if(mysql_num_rows($pega_modelos) == 0)
                {
                    echo '<h1>Sua busca por modelos não retornou resultados ... </h1>';
                }
                else
                {
                    while($resultado = mysql_fetch_array($pega_modelos))
                    {
                        echo '<option value="'.$resultado['codigo'].'">'.
                                               $resultado['nome'].'</option>';
                    }
                }
            ?>
        </select>
        <input type="submit" name="pesq_modelos" id="pesq_modelos" value="Pesquisar">
        </form>

        <br>

        <form name="form_ano" method="post" action="home.php">
            Ano: <select name="codautomovel" id="codautomovel">
            <option value=0 selected="selected">Selecione ano ...</option>
            <?php
                if(mysql_num_rows($pega_automoveis) == 0)
                {
                    echo '<h1>Sua busca por automoveis não retornou resultados ... </h1>';
                }
                else
                {
                    while($resultado = mysql_fetch_array($pega_automoveis))
                    {
                        echo '<option value="'.$resultado['codigo'].'">'.
                                               $resultado['ano'].'</option>';
                    }
                }
            ?>
        </select>
        <input type="submit" name="pesq_automoveis" id="pesq_automoveis" value="Pesquisar">
        </form>
        
    </div>

    <div id="carros">
        <div class="tituloResultado">
            Resultados da pesquisa: 
        </div>
        <?php

    if ($vazio == 0)
    {
     $sql_veiculos = "SELECT automoveis.codigo, automoveis.descricao,
                      automoveis.ano, automoveis.cor, automoveis.combustivel, automoveis.valor
                      FROM automoveis ORDER BY automoveis.codigo LIMIT 2";

     $seleciona_veiculos = mysql_query($sql_veiculos);
     
  	 echo "<b>Veiculos em Destaque: </b>"."<br><br>";
 	 while($res = mysql_fetch_array($seleciona_veiculos))
			{
			echo "Cod Automovel : ".$res['codigo'].
			     " Descrição    : ".$res['descricao'].
                 " Ano          : ".$res['ano']."<br>".
                 "Cor           : ".$res['cor'].
                 " Combustivel  : ".$res['combustivel'].
                 " Valor R$     : ".$res['valor']."<br><br><hr>";
			}
    }
    
    else
    {
  	 echo "<br>";
 	 while($automoveis = mysql_fetch_array($seleciona_veiculos))
			{
			echo "<b>Cod Automovel: </b>".$automoveis['codigo']."<br>".
			     "<b>Descrição    : </b>".utf8_encode($automoveis['descricao'])."<br>".
                 "<b>Categoria    : </b>".$automoveis['codcategoria']."<br>".
                 "<b>Modelo       : </b>".$automoveis['codmodelo']."<br>".
                 "<b>Ano          : </b>".$automoveis['ano']."<br>".
                 "<b>Cor          : </b>".$automoveis['cor']."<br>".
                 "<b>Placa        : </b>".$automoveis['placa']."<br>".
                 "<b>Localização  : </b>".utf8_encode($automoveis['localizacao'])."<br>".
                 "<b>Combustivel  : </b>".$automoveis['combustivel']."<br>".
                 "<b>Opcionais    : </b>".$automoveis['opcionais']."<br>".
                 "<b>Valor R$     : </b>".$automoveis['valor']."<br><br><hr>";
			}
    }
?>
    </div>
</body>
</html>