<head>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/contatoestilo.css">
</head>
<body>
    <section class="main">
        <div class="overlay"></div>
        <div class="container">
            <div class="text">
                <h2>Contato</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur nisi diam, cursus vel finibus eget, posuere eu orci. Phasellus maximus lacinia eros, non sagittis sem laoreet at. Vestibulum ullamcorper odio et leo auctor, sit amet aliquam enim varius. Etiam sit amet lobortis nibh, sed maximus tellus. Vivamus nisl ante, pulvinar et est vel, posuere elementum enim. Vivamus vitae dui ac magna lacinia iaculis eu ut odio. Vestibulum eros mi, rhoncus nec imperdiet non, consectetur varius sem. Aenean porttitor vel tortor non commodo. Nulla facilisi. Nulla feugiat, lorem ac laoreet convallis, enim magna ullamcorper arcu, eu eleifend libero ligula sit amet sem. Nunc imperdiet metus vel mollis porta.</p>
            </div>
        </div>
    </section>
    <section class="main-form">
        <div class="container">
            <div class="form">
                <div class="mensagem-contato">
                    <p>Entre em contato respondendo o formulário abaixo.</p>
                </div>
                <form method="POST" action="">
                    <label><b>Nome</b></label>
                    <input type="text" name="name">
                    <label><b>Email</b></label>
                    <input type="text" name="email">
                    <label><b>Mensagem</b></label>
                    <input type="text" name="message">
                    <?php
                        if(isset($_GET['send'])){
                            echo "<p style='color: darkgreen; font-size: 17px; text-align: center'>Mensagem enviada com sucesso!</p>";
                        }
                    ?>
                    
                    <button type="submit" class="cadastrar">Enviar</button>
                </form>
            </div>
            <div class="contato-telefone">
                <h2>Contato </h2>
                <div class="box1"><p>(54) 98418-7913</p></div>
                <div class="box2"><p>bernardoradin2004@gmail.com</p></div>
                <div class="box3"><p>bernardoradin</p></div>
            </div>
        </div>
    </section>
</body>
</html>