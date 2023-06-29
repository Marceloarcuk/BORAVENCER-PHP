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
    $_SESSION['senhauser']=$_POST['senha'];
    $_SESSION['emailuser']=$_POST['email'];
	$_SESSION["id_cri"]='0';
    header('location:form3.php');
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
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading ">
                        <b>Iniciar inscrição</b>
                    </div>
                    <form role="form" method="post" name="form1" action="?cadastrar=true" >
                        <div class="panel-body ">
                            <div class="row ">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="text-center">
                                        <label>Confirmação de e-mail - <small> o seu usuário será o seu email </small></label>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12 col-lg-offset-4">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">@</span>
                                          <input type="text" name="email" class="form-control" placeholder="Insira seu e-mail..." maxlength="50"
                                            <?php if(isset($_SESSION['emailuser'])) { echo "value='" . $_SESSION['emailuser'] . "'"; }?> >
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row ">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-lg-offset-4 ">
                                    <label>Senha  <small>  </small></label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12 col-lg-offset-4">
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control" placeholder="Insira sua senha..." name="senha"  maxlength="12"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-lg-offset-4 ">
                                    <label>Confirmação de senha  <small>  </small></label>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12 col-lg-offset-4">
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control" name="senhaconf" placeholder="Digite novamente..." name="confirm"  maxlength="12" >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-10 text-center col-lg-offset-1" >
										<button type="button" id="btnform1" class="btn btn-primary" onclick="return enviardados();" >Enviar</button>
                                    </div>
								</div>
							</div>
						</div>
                    </form>
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
	
	
<script language="JavaScript" >
	function enviardados(){
		if( document.form1.email.value=="" || document.form1.email.value.indexOf('@')==-1 || document.form1.email.value.indexOf('.')==-1 )
		{
			alert( "Preencha campo E-MAIL corretamente!" );
			document.dados.tx_email.focus();
			return false;
		}
		if ((document.form1.senha.value=="") || (document.form1.senhaconf.value=="") || (document.form1.senha.value != document.form1.senhaconf.value))
		{
			alert( "Preencha as SENHAS corretamente!" );
			document.form1.senha.focus();
			return false;
		}
		var senhav=document.form1.senha,value;
		var senhaconfv=document.form1.senhaconf.value;
		if ((senhav.lenght < 6) || (senhaconfv < 6 ) )
		{
			alert( "As senhas devem ter entre 6 e 12 caracteres!" );
			document.form1.senha.focus();
			return false;
		}
		document.form1.submit();
	}
</script>		
</body>	
</html>
<?php
ob_flush();
?>