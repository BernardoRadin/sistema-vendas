<?php

if(!isset($_SESSION['login'])){
  header('Location'.INCLUDE_PATH_PAINEL);
}

  $query1 = "SELECT `nomeproduto`,`valorcompra`,`empresaproduto`,`quantidadecomprada`,`datacompra` FROM produtos";
  $query2 = "SELECT `nomeproduto`,`empresaproduto`,`valorcompra`, `data`, `quantidadenova` FROM `reporestoque` INNER JOIN `produtos` on `id_produto` = produtos.id";

if(!isset($_POST['enviadata']) && !isset($_POST['datainicial'])){
    $sql = MySQL::conectar()->query("$query1");
    $result = $sql->fetchAll();

    $sql_novoestoque = MySQL::conectar()->query("$query2");
    $result_novoestoque = $sql_novoestoque->fetchAll();
  }else{

    $datainicial = $_POST['datainicial'];
    $datafinal = $_POST['datafinal'];

    $query1 .= " WHERE `datacompra` >= (?) AND `datacompra` <= (?)";

    $sql = MySQL::conectar()->prepare("$query1");
    $sql->execute(array($datainicial,$datafinal));
    $result = $sql->fetchAll();

    $query2 .= " WHERE `id_produto` = produtos.id AND `data` >= (?) AND `data` <= (?)";

    $sql_novoestoque = MySQL::conectar()->prepare("$query2");
    $sql_novoestoque->execute(array($datainicial,$datafinal));
    $result_novoestoque = $sql_novoestoque->fetchAll();
}

?>
<head><link rel="stylesheet" href="<?php INCLUDE_PATH_PAINEL ?>css/relatorio.css"/></head>
<div class="container">
    <form method="POST" action="">
      <label><b>Filtrar por data da compra: </b></label><br/><br/>
        <input type="date" name="datainicial">
        <label><b> até </b></label>
        <input type="date" name="datafinal">
        <input class="enviar" type="submit" name="enviadata">
    </form>
<table class="table">
  <tr>
    <th>Nome Produto</th>
    <th>Empresa Oficial</th>
    <th>Quantidade</th>
    <th>Data da Compra</th>
    <th>Valor pago UN</th>
  </tr>

  <tr>
    <?php
    foreach($result as $value){
        echo "<tr>";
        echo "<td>".$value['nomeproduto']."</td>";
        echo "<td>".$value['empresaproduto']."</td>";
        echo "<td>".$value['quantidadecomprada']."</td>";
        echo "<td>".$value['datacompra']."</td>";
        echo "<td class='valorcompra'> R$ ".$value['valorcompra']."</td>";
        echo "</tr>";
    }
    foreach($result_novoestoque as $value){
      echo "<tr>";
      echo "<td>".$value['nomeproduto']."</td>";
      echo "<td>".$value['empresaproduto']."</td>";
      echo "<td>".$value['quantidadenova']."</td>";
      echo "<td>".$value['data']."</td>";
      echo "<td class='valorcompra'> R$ ".$value['valorcompra']."</td>";
      echo "</tr>";
  }
    ?>
  </tr>
</table>

</div>