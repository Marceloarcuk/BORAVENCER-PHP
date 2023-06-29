<?php
    ob_start();
	
	
    session_start();
	
	unset($_SESSION['senhauser']);
	unset($_SESSION['emailuser']);
	unset($_SESSION['cpfuser']);
	unset($_SESSION["id_cri"]);
	unset($_SESSION["nome_cri"]);
	unset($_SESSION["sis_dt_insert_cri"]);	
?>
<?php
//Includes obrigatórios
include('@main_scripts.php');
include('conection.php');
include('lib/funcoes.php');

//<!-- validação usando o arquivo de CPF email e id facebook -->

if(isset($_REQUEST['validar']) && $_REQUEST['validar']==true){
    if (isset($_POST['cpf'])){ $_SESSION['cpfuser']=$_POST['cpf'];}
    
	if (isset($_POST['email'])){
		$_SESSION['emailuser']=$_POST['email'];

     	$sql1=" select id_facebook, id_cri, email_cri, nome_cri, cpf_cri from tb_crianca  where email_cri='".tStr($_POST['email'])."';";
        $consulta1=$conection->prepare($sql1);
        $dados1=($consulta1->execute()) ? $consulta1->fetch(PDO::FETCH_OBJ) : false;
        if($dados1 != false){
            $idface1=$dados1->id_facebook;
            if(isset($idface1) && $idface1 != '0'){
                echo "<script>alert('Usuário cadastrado com o Facebook. Clique em login com o Facebook!'); </script>";
			}
			else{
				header('location:login.php');
			}
        }
        else{
            header('location:form2.php');
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
    <div id="form1">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center">
                            <b>Formulário de inscrição</b>
                        </div>
                        <div class="panel-body">
                            <div class="col-lg-12 text-center">
                                <div class="row">
                                    <hr>
                                    <h6><b>Insira os seus dados</b></h6>
                                    <hr>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <form role="form" method="post" name="form1" action="form1.php?validar=true">    
                                        <div class="form-group">
                                            <div class="col-lg-4 col-md-4 col-xs-12 ">
                                                <label>E-mail*</label>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">@</span>
                                                    <input type="email" class="form-control" placeholder="Insira seu e-mail..." name="email"
                                                           maxlength="50">
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-xs-8 col-md-2 ">
                                                <label>CPF*</label>
                                                <input class="form-control" id="ex3" placeholder="CPF..." name="cpf"  maxlength="12">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-xs-8 col-md-12 col-lg-offset-5">
                                            <div class="form-group">
                                                <button type="button" id="btnform1" class="btn btn-primary" onclick="return enviardados();" >Enviar</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row text-center">
                                        <form action="?facebook=true" method="post" >
                                            <br> <a href="<?php if(isset($tpl['loginf'])){ echo $tpl['loginf'] ; }  ?>"><img src="imagens/facebook-login-button.png" > </a>
                                            <!--										<button   class="btn btn-default" data-toggle="modal" data-target="#myModal">Enviar</button>       -->
                                        </form>
                                    </div>
                                </div>
                            </div>
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

<script language="JavaScript" >
	function enviardados(){
		if( document.form1.email.value=="" || document.form1.email.value.indexOf('@')==-1 || document.form1.email.value.indexOf('.')==-1 )
		{
			alert( "Preencha campo E-MAIL corretamente!" );
			document.dados.tx_email.focus();
			return false;
		}
		document.form1.submit();
	}
</script>	

</html>
<?php
ob_flush();
?>