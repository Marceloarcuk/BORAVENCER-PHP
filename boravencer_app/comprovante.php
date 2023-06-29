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
		unset($_SESSION["idfacebook"]);
		unset($_SESSION['facebook_access_token']);
		header('location:form1.php');
	}		

//Includes obrigatórios
include('lib/inserts.php');
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
    <title><?=$titulo?></title>
</head>
<body>
<!-- conteudo -->
<br><br><br><br><br>
<div class="container table-bordered ">
    <hr>
    <div class="row ">
        <div class="col-md-12 col-lg-12 col-xs-12 text-center">
            <img src="imagens/boravencer.png" width="25%" height="20%" >
        </div>
        <div class="col-md-12 col-lg-12 col-xs-12 text-center">
            <br><br><h5><B>COMPROVANTE DE INSCRIÇÃO</B></h5>
        </div>
        <div class="col-md-8 col-lg-8 col-xs-8 col-md-offset-2 col-lg-offset-2 col-xs-offset-2">
            <br><br> <h5><b>Nº de inscrição: <input type="text" style="border:none" disabled="disabled"
                        <?php
                        if(isset($_SESSION["id_cri"])) {
                            echo "value='" . converte_inscricao($_SESSION["id_cri"]) . "'"; }
                        ?> > </b></h5>
        </div>
        <div class="col-md-8 col-lg-8 col-xs-8 col-md-offset-2 col-lg-offset-2 col-xs-offset-2">
            <h5><b>Nome:   <input type="text" size="50" style="border:none" disabled="disabled"
                        <?php
                        if(isset($_SESSION["nome_cri"])) { echo "value='" . $_SESSION["nome_cri"] . "'"; }
                        ?> >  </b></h5>
        </div>
        <div class="col-md-8 col-lg-8 col-xs-8 col-md-offset-2 col-lg-offset-2 col-xs-offset-2">
            <h5><b>CPF: <input type="text" name="cpf" style="border:none" disabled="disabled"
                         <?php
                        if(isset($_SESSION["cpfuser"])) {
                            echo "value='" . mascaraCpf($_SESSION["cpfuser"]) . "'"; }
                        ?> >  </b></h5>
        </div>
        <hr>
        <hr>
        <div class="col-md-12 col-lg-12 col-xs-12 text-center">
            <br><br><br><br><label><b>Inscrição realizada:</b></label>
            <br><br><br> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="datetime" name="datains" disabled="disabled" style="border:none"
                <?php
                if(isset($_SESSION["sis_dt_insert_cri"])) {

                    echo "value='" . $_SESSION["sis_dt_insert_cri"] . "'"; }
                ?>
            >  <br><br><br><br><br><br><br><br><br><br><br></div>
        <hr>
    </div>
</div>
<SCRIPT LANGUAGE="JavaScript">
    window.print();
</SCRIPT>
</body>
</html>

