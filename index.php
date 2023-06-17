<?php
    include('config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/estilo.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/contatoestilo.css">
    <title>Home</title>
</head>
<body>
    <header>
        <div class="container">
            <div class="header">  
                <div class="title">
                    <h2>Sistema Estoque</h2>
                </div>
                <ul class="ul">
                    <li><img class="menu-click" src="images/menu.png"></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>painel"><button class="login">Login</button></a></li>   
                    <li><a href="<?php echo INCLUDE_PATH; ?>contato ">Contato</a></li>
                    <li class="home"><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                </ul>
                <div class="clear"></div>
                <div class="menu">
                    <ul>
                    <li class="home"><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>contato ">Contato</a></li>
                    <li><a href="<?php echo INCLUDE_PATH; ?>painel">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    <?php
    if(isset($_GET['url'])){
        $url = $_GET['url'];
    }else{
        $url = 'home';
    }

    if(file_exists('pages/'.$url.'.php')){
        include('pages/'.$url.'.php');
    }else{
        include('pages/error404.php');
    }
    ?>
<section class="equipe">
        <div class="container">
            <div class="empresa">
                <div class="information">
                    <div class="img-border">
                        <img src="images/empresa.jpg">
                    </div>
                    <h3>EMPRESA</h3>
                </div>
                <div class="texto">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nec purus ex. Aenean pretium condimentum dolor, sit amet dictum nunc scelerisque ornare. Morbi accumsan urna pretium erat pharetra sagittis. Sed bibendum eget urna in consectetur. Pellentesque tempor ipsum sed tristique tempus. Vivamus interdum consectetur leo, maximus volutpat diam viverra sit amet. Cras fermentum erat quis nibh placerat viverra.</p>
                </div>
                <div class="dados">
                    <p>Nullam a ligula aliquet, dictum augue nec, rutrum lorem. Vivamus ut libero lorem. Vestibulum a lobortis leo. Quisque varius tincidunt nibh quis tincidunt. Nunc gravida dui in porttitor tristique. Curabitur fringilla malesuada tortor at scelerisque. Mauris a leo quis nunc venenatis tempus. Nam viverra mauris eget risus rhoncus pulvinar. Phasellus euismod arcu vel bibendum pharetra. Vestibulum auctor arcu a accumsan dignissim. Mauris orci tellus, tristique a lorem viverra, ullamcorper malesuada</p>
                </div>
            </div>
        </div>
    </section>
    <script>

var aberto = false;

$('.menu-click').click(()=>{
    if(aberto == false){
    $('.menu').slideDown('fast');
    $('.menu').css('display','block');
    aberto = true;
}else{
    $('.menu').slideUp('fast');
    aberto = false;
}})

</script>
</body>
</html>