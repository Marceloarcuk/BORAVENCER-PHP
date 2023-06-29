<?php
ob_start();


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
		unset($_SESSION['cpf_cri']);
		header('location:form1.php');
	}
?>
<?php
//Includes obrigatórios
include('@main_scripts.php');
include('conection.php');
include('lib/funcoes.php');

if(isset($_REQUEST['cadastrar']) && $_REQUEST['cadastrar']==true)
{

	
	$login=$_POST["email"];	
	$hashDaSenha=md5($_POST["passwd"]);
	$rs_access=$conection->prepare("SELECT * FROM tb_crianca where pass_cri=? AND email_cri=? ;");
	$rs_access->bindParam(1, $hashDaSenha);
	$rs_access->bindParam(2, $login);

	if($rs_access->execute()){
		if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
			$_SESSION["id_cri"]=$registro_access->id_cri;
			$_SESSION["nome_cri"]=$registro_access->nome_cri;
			$_SESSION["cpf_cri"]=$registro_access->cpf_cri;
			$_SESSION["sis_dt_insert_cri"]=$registro_access->sis_dt_insert_cri;
			$_SESSION['emailuser']=$registro_access->email_cri;
			header('location: inside.php');
		}
		else{
			echo "<script> alert ('Usuário e/ou senha incorretos.'); </script>";
		}
	}
}
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
    <!-- include dos links e scripts (bootstrap e js) -->
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
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sistema - SUBJUV</h3>
                    </div>
                    <div class="panel-body">
						<form role="form" method="post" name="form1" action="?cadastrar=true" >
							<fieldset>                            
								<div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Insira seu e-mail..." maxlength="50"
                                            <?php if(isset($_SESSION['emailuser'])) { echo "value='" . $_SESSION['emailuser'] . "'"; }?> >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="passwd" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember">Lembrar-me
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <a href="enviaemail.php">Esqueci a senha</a>
                                    </label>
                                </div>
								<button type="button" id="btnform1" class="btn btn-lg btn-success btn-block" onclick="return enviardados();" >Entrar</button>
							</fieldset>
                        </form>
						
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
<script language="JavaScript" >
	function enviardados(){
		if( document.form1.email.value=="" || document.form1.email.value.indexOf('@')==-1 || document.form1.email.value.indexOf('.')==-1 )
		{
			alert( "Preencha campo E-MAIL corretamente!" );
			document.dados.tx_email.focus();
			return false;
		}
		if (document.form1.passwd.value=="") 
		{
			alert( "Preencha a SENHA corretamente!" );
			document.form1.passwd.focus();
			return false;
		}
		document.form1.submit();
	}
</script>		
</html>
<?php
ob_flush();
?>