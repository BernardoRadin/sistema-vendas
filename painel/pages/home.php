<?php

if(!isset($_SESSION['login'])){
    header('Location'.INCLUDE_PATH_PAINEL);
}

$sql = MySQL::conectar()->query('SELECT `dinheiro` FROM `dinheiro`');
$result = $sql->fetchAll();
$total = 0;
foreach($result as $value){
    intval($value['dinheiro']);
    $total += $value['dinheiro'];
}

$sql_qunatidade = MySQL::conectar()->query('SELECT `quantidadecomprada` FROM `produtos`');
$result_quantidade = $sql_qunatidade->fetchAll();
$total_quantidade = 0;
foreach($result_quantidade as $value){
    intval($value['quantidadecomprada']);
    $total_quantidade += $value['quantidadecomprada'];
}

$sql_vendas = MySQL::conectar()->query("SELECT `id`,`data`,`quantidade` FROM `vendas` ORDER BY `data` ASC");
$numerovendas = $sql_vendas->rowCount();
$gvendas = $sql_vendas->fetchAll();

?>
<head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Ano', 'Quantidade Vendida'],

        <?php
            foreach($gvendas as $value){ 
                $vendas = $value['quantidade'];   
                $gdata = strtotime($value['data']);
                $gdata = date('d/m/Y H:i', $gdata);       
        ?>
        ['<?php echo $gdata ?>', <?php echo $vendas?>],
        <?php } ?>
        ]);

        var options = {
          title: 'Performance',
          hAxis: {title: 'Ano',  titleTextStyle: {color: '#ffff'}},
          vAxis: {minValue: 0},
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <link rel="stylesheet" href="<?php INCLUDE_PATH_PAINEL ?>css/home.css">
</head>
<div class="container">
    <div class="load1">
    <p><b>Dinheiro da empresa</b></p>
        <h1>R$: <?php echo $total?></h1>
    </div>
    <div class="load2">
        <p><b>Vendas realizadas no mês</b></p>
        <h1><?php echo $numerovendas?> Vendas</h1>
    </div>
    <div class="load3">
    <p><b>Quantidade de compras no mês</b></p>
        <h1><?php echo $total_quantidade?> UN</h1>
    </div>
    <div class="clear"></div> 
    <hr>
</div>
<div id="chart_div" style="width: 100%; height: 500px"></div>
