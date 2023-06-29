<?php
    ob_start();
?>
<?php
    session_start();
		
	if ( !isset($_SESSION['emailuser'])) {
		session_destroy();
		unset($_SESSION['senhauser']);
		unset($_SESSION['emailuser']);
		unset($_SESSION['cpfuser']);
		unset($_SESSION["id_cri"]);
		unset($_SESSION["nome_cri"]);
		unset($_SESSION["sis_dt_insert_cri"]);
		header('location:form1.php');
	}		
	if ( !isset($_SESSION['id_cri'])) {
		$_SESSION["id_cri"]='0';
	}		
		
    //Includes obrigatórios
    //include('lib/inserts.php');
    include('@main_scripts.php');
    include('lib/funcoes.php');
    include('conection.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $titulo; ?></title>

</head>
<body>
<div id="container">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-xs-12 col-lg-offset-0 col-md-offset-0 ">
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="imagens/logo_gov_bsb.png" height="40" width="150"/>
        </div>
        <div class="col-lg-3 col-md-6 col-xs-12 text-center">
            <h6><b>&nbsp&nbsp&nbsp&nbsp&nbsp Secretaria de Estado de Políticas Públicas para Crianças, Adolescentes e Juventude</b></h6>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12  text-center ">
                <hr>
                <h4><b> Subsecretaria da Juventude  #BoraVencerIntensivão </b></h4>
                <h4><b>  Inscrição para o Intensivão </b></h4>
            </div>
        </div>
    </div>
</div>
<!-- fim do cabeçalho -->
<!-- Inicio do conteúdo -->
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <b>Comprovante de inscrição</b>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <form method="post" action="form1.php">
                            <div class="col-lg-11 text-right" >
                                <br><button type="submit" class="btn btn-default">Sair</button>
                            </div>
                        </form>
                    </div>
                    <div class="form-group">
                        <form role="form" method="post" name="form1" action="comprovante.php" >
                            <div class="col-lg-10 col-xs-10 col-lg-offset-1 text-center">
                                <br> <h4><b>Olá, <?php echo $_SESSION["nome_cri"]?></b></h4>
                            </div>
                            <br><br>
                            <div class="col-lg-10 col-xs-10 col-lg-offset-1 text-center">
                                <br> <label>Imprima o comprovante de inscrição abaixo</label>
                            </div>
                            <hr>
                            <div class="col-lg-10 text-center col-lg-offset-1" >
                                <input type="hidden" value="comprovante" name="comprovante">
                                <br><a><button type="submit" class="btn btn-default">Imprimir</button></a><br><br><br>
                            </div>
                        </form>
                        <form role="form" method="post" name="form3" action="form3.php" >
                            <div class="col-lg-10 text-center col-lg-offset-1" >
                                <br><a><button type="submit" class="btn btn-default">Editar Dados</button></a><br><br><br>
								<?php if ( isset($_GET['mens'])) {echo '<b><p class="text-danger">' . $_GET['mens'] . '</p></b>';} ?>
								<br> 
                            </div>
                        </form>
						
						
						
						
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- fim do conteudo -->
<!--footer-starts-->
<hr>
<div class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="col-md-6 footer-left">
            </div>
            <div class="col-md-6 footer-right">
                <p>© 2016 DITI - Diretoria de Informática e Tecnologia da Informação. All Rights Reserved | Design by  <a href="http://www.crianca.df.gov.br/" target="_blank">DITI</a> </p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--footer-end-->
</body>
<?php
ob_flush();
?>