<?php
    ob_start();
	
?>
<?php
	//Includes obrigatórios
	include('@main_scripts.php');
	include('conection.php');
	include('lib/funcoes.php');
	include('facebook.php');
	
	if(isset($_REQUEST['enviar']) && $_REQUEST['enviar']==true){
		include('Mail.php');
        include('Mail/mime.php');

            $novasenha=mt_rand(100000, 999999);
            $text = '';
            $html = "Olá, sua nova senha do #BORAVENCER é: ".$novasenha." .\n Acesse o link : http://www2.crianca.df.gov.br/boravencer/ para entrar no sistema com a nova senha. ";
            $crlf = "\n";
            $mime = new Mail_mime($crlf);
            $mime->setTXTBody($text);
            $mime->setHTMLBody($html);
            $mime_params = array(
                'text_encoding' => '7bit',
                'text_charset'  => 'UTF-8',
                'html_charset'  => 'UTF-8',
                'head_charset'  => 'UTF-8'
            );
            $body = $mime->get($mime_params);
            $mail= array($_POST['email']);
            $recipients = $mail;
            $headers['To'] = $_POST['email'];
            //$headers['Cc'] = '<cópia>';
            //$headers['Bcc'] = '<cópia oculta>';
            $headers['From'] = 'sistemas.crianca@crianca.df.gov.br';
            $headers['Subject'] = 'Alteração de senha do #BORAVENCER ';
            $port='25';
            $host='10.230.80.51';
            $auth=FALSE;
            $username='sistemas.crianca@crianca.df.gov.br';
            $pass='@Crianca10';


            $headers = $mime->headers($headers);
            $params['host'] = $host;
            $params['port'] = $port;
            $params['auth'] = $auth;
            $params['username'] = $username;
            $params['password'] = $pass;
            $smtp_sub='smtp';

            $mail_object =& Mail::factory($smtp_sub, $params);
            $rs = $mail_object->send($recipients, $headers, $body);
            if (PEAR::isError($rs)) {
                echo $rs->getMEssage()."\n";
            }
            else {
				//$sql="select id_cri where email_cri='".$_POST['email']."'; ";
                //$consult=$conection->prepare($sql);
				//$dados1=($consult->execute()) ? $consult->fetch(PDO::FETCH_OBJ) : false;
				//if($dados1){
					
            	$rs_access=$conection->prepare("SELECT * FROM tb_crianca where email_cri='" .$_POST['email']. "';");
				$registro_access = ($rs_access->execute()) ? $rs_access->fetchAll() : false;
	            if ($registro_access){
					foreach ($registro_access as $tb_crianca);
					$_SESSION["id_cri"]            = $tb_crianca[id_cri];

					$rs_access1=$conection->prepare("update tb_crianca set pass_cri='". md5($novasenha)."' where id_cri = '" .$_SESSION["id_cri"]. "';");
					if($rs_access1->execute()){
                        $msg="<p class='alert alert-success'>SENHA ALTERADA COM SUCESSO!</p>";
						echo "<p>E-MAIL DE ALTERAÇÃO DA SENHA ENVIADO PARA: '".$_POST['email']."'. </p><br>";
						//header('location:login.php');
						
					}
					else {echo "<p>Error 1. </p><br>";}
						




//					$insert=$conection->prepare("update tb_crianca set pass_cri='".$novasenha."' where id_cri = '" .$_SESSION["id_cri"]. "';");
//					$alterSenha=($insert->execute()) ? $insert->fetch(PDO::FETCH_OBJ) : false;
//                  if($alterSenha){
//                        $msg="<p class='alert alert-success'>SENHA ALTERADA COM SUCESSO!</p>";
//						header('location:login.php');
//                    };
				}
				else {echo "<p>Error 2. </p><br>";}

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
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading ">
						<b>Recuperar a senha de acesso</b>
					</div>
                <form role="form" method="post" name="form1" action="?enviar=true">
					<div class="panel-body ">
						<div class="row ">
							<div class="col-lg-12 col-md-12 col-xs-12">
								<div class="text-center">
                                <label>Digite o e-mail para a alteração da senha </label><br><br>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12 col-lg-offset-4">
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" name="email" class="form-control" placeholder="Insira seu e-mail..."
                                    <?php if(isset($_SESSION["emailuser"])) {
                                        echo "value='" . $_SESSION["emailuser"] . "'"; }
                                    ?> >
                            </div>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <div class="text-center">
                                <label>Digite o seu CPF </label><br><br>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-xs-12 col-lg-offset-4">
                            <div class="form-group input-group">
                                <input type="text" name="cpf" class="form-control" placeholder="Insira seu CPF..."
                                    <?php if(isset($_SESSION["cpfuser"])) {
                                        echo "value='" . $_SESSION["cpfuser"] . "'"; }
                                    ?> >
                            </div>
                        </div>
                    </div>
                    <hr>
                        <div class="row">
                            <div class="col-lg-10 text-center col-lg-offset-1" >
                                <button type="button" id="btnform1" class="btn btn-primary" onclick="return enviardados();" >Enviar</button>
                            </div>
                       </div>
                </form>
                    </div>
                </div>
            </div>
			<?php if(isset($msg)){
				echo $msg;
			} ?>
			<?php if(isset($msg_er)){
				echo $msg_er;
			} ?>
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
			document.form1.email.focus();
			return false;
		}
		if ((document.form1.cpf.value==""))
		{
			alert( "Preencha as SENHAS corretamente!" );
			document.form1.cpf.focus();
			return false;
		}
		
		document.form1.submit();
	}
</script>	

</html>
<?php
ob_flush();
?>