<?php
  ob_start();
  
  $id_usu="";
  include 'conect.php';
?> 
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BORAVENCER</title>

    <!-- Bootstrap Core CSS  	- bootstrap.min.css
	     MetisMenu CSS			- metisMenu.min.css
	     Custom CSS				- sb-admin-2
	     Custom Fonts			- font-awesome.min.css
		 Morris Charts CSS 		- morris.css , example.css
	
		 jQuery					- jquery.min.js
		 Bootstrap Core			- bootstrap.min.js
		 Metis Menu Plugin		- metisMenu.min.js
		 Custom Theme			- sb-admin-2.js
		 Gráfico				- raphael-min.js, morris.js , example.js
	 -->
    <link href="../../@bts/fl/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../@bts/fl/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../../@bts/fl/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../@bts/fl/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../@bts/fl/bower_components/morrisjs/morris.css" rel="stylesheet">
    <link href="css_js/example.css" rel="stylesheet">

    <script src="../../@bts/fl/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../@bts/fl/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../@bts/fl/bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../../@bts/fl/dist/js/sb-admin-2.js"></script>
	<script src="../../@bts/fl/bower_components/raphael/raphael-min.js"></script>
	<script src="../../@bts/fl/bower_components/morrisjs/morris.js"></script>
	<script src="css_js/example.js"></script>	  	

	
	
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Logar no Sistema BORAVENCER ADM</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method=post action="?autenticar=true">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuário" name="username" size="18" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="passwd" size="18" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
								<button class="btn btn-lg btn-success btn-block" value="Login" name="entrar" type="submit">Entrar</button>
								<?php
									$Mensagem='';
									try{
											if(isset($_REQUEST["autenticar"])  &&  $_REQUEST["autenticar"]==true){
												$hashDaSenha=md5("uhofdjfoiahdfuHU".$_POST["passwd"]);
												$login=$_POST["username"];
												$Nome='';
												$rs_access=$connectCoorp->prepare("SELECT id_cpf,s_nome FROM tb_usuario where s_pass=? AND s_login=?");
												$rs_access->bindParam(1, $hashDaSenha);
												$rs_access->bindParam(2, $login);
												if($rs_access->execute()){
													if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
														session_start();
														$_SESSION["login"]=$login;
														$_SESSION["usu_cpf"]=$registro_access->id_cpf;
														$_SESSION["nome"]=$registro_access->s_nome;
														header('location: index.php');
													}
													else{
														$Mensagem = "<br><a class='ref3'> Usuário e/ou senha incorretos.</a>";
														echo $Mensagem;
													}
												}
											}
									}catch(Exception $e){
										echo $e->getMessage();
									}									
								?>								
								
								
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php
  ob_flush();
?> 