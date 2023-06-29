<?PHP 
	ob_start();

	include 'conect.php';
	include 'u_funcoes.php';

	session_start();
 
	if ( !isset($_SESSION['login'])) {
		session_destroy();
		unset ($_SESSION['login']);
		unset ($_SESSION['nome']);
		unset ($_SESSION["usu_cpf"]);
		header('location:login.php');
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BORAVENCER</title>

<!-- *************************************************************************************************************** -->
<!-- ***************************                   SCRIPTS                 ***************************************** -->
<!-- *************************************************************************************************************** -->
<?PHP include '@main_scripts.php';?>	


</head>

<body>

    <div id="wrapper">

<!-- *************************************************************************************************************** -->
<!-- ***************************                    MENUS                  ***************************************** -->
<!-- *************************************************************************************************************** -->
<?PHP include '@main_bar_nav.php';?>

<!-- *************************************************************************************************************** -->
<!-- ***************************                  CONTEUDO                 ***************************************** -->
<!-- *************************************************************************************************************** -->
<?php
	$Labelusu = 'Formulário de Usuários';
	$Nusu='0';
	if(isset($_REQUEST["usu"])){
				$Labelusu = 'Formulário de Usuários - N° ' . $_REQUEST["usu"];
				$Nusu=$_REQUEST["usu"];
	}
//	else if(isset($_REQUEST["SAVE"])){
//				$Labelusu = 'Formulário de Usuários - N° ' . $_REQUEST["SAVE"];
//				$Nusu=$_REQUEST["SAVE"];
//	}
	else{
				$Labelusu = 'Formulário de Usuários';
	}		
?>
        <div id="page-wrapper">
			<div class="row">
			<BR>
            </div>

			<!-- *************************************************************************************************************** -->
			<!-- ***************************                   LINHA 1                 ***************************************** -->
			<!-- *************************************************************************************************************** -->
            <div class="row">
				<!-- *************************************************************************************************************** -->
				<!-- ***************************                 FORMULARIO                ***************************************** -->
				<!-- *************************************************************************************************************** -->
				<div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-edit fa-fw"></i> <?php echo $Labelusu;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
						
						
					
				<?PHP
				
	if ($Nusu>0){
		$sql = "SELECT * FROM db_atendimento.tb_usuario WHERE (id_cpf=". $Nusu.");";
		$rs_access=$connectCoorp->prepare($sql);
		if($rs_access->execute()){
			$resultados = $rs_access->rowCount();
			if($resultados>=1){
				if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
					echo '<div class="form-group">';
						echo '<form name="fusu" method=post action="?SAVE='.$Nusu.'">';
							echo '<label>CPF: </label><input class="form-control" type="text" name="cpf" maxlength="11" value="' . $registro_access->id_cpf . '" disabled><br>';
							echo '<label>Nome:</label><input class="form-control" type="text" name="Nome" value="' . $registro_access->s_nome . '" ><br>';
							echo '<label>Login:</label><input class="form-control" type="text" name="login" value="' . $registro_access->s_login . '" ><br>';
							echo '<label>Senha:</label>' . '<input class="form-control" placeholder="Digite a nova Senha" name="passwd" size="18" type="password" value="">' .'<br>'
														 . '<input class="form-control" placeholder="Repita a Senha" name="passwd1" size="18" type="password" value="">' .'<br>';							
								echo '	<button type="submit" class="btn btn-outline btn-primary">Salvar</button>'; 
						echo '</form><BR>';	
						echo '<form name="fusudel" method=post action="?DEL='.$Nusu.'">';
								echo '	<button type="submit" class="btn btn-outline btn-primary">Excluir</button>'; 
						echo '</form>';	
						
						
						
						
					echo '</div>';
				}
			}
		}
	}		
				?>		
			
				<!-- ********************************************************* -->
				<!-- *****  CAIXA DE CONFIRMAÇÃO DE FINALIZAR   ************** -->
				<!-- ********************************************************* -->

                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Novo Usuário</h4>
                                        </div>
									    <?PHP echo '<form method=post action="?NEW='.$Nusu.'">';
										 echo '   <div class="modal-body">';
                                         echo '       <div class="form-group">';
							echo '<label>CPF: </label><input class="form-control" placeholder="Digite o CPF" type="text" name="cpfn" maxlength="11"><br>';
							echo '<label>Nome:</label><input class="form-control" placeholder="Digite o nome do usuário" type="text" name="Nomen"><br>';
							echo '<label>Login:</label><input class="form-control" placeholder="Digite o login do usuário" type="text" name="loginn"><br>';
							echo '<label>Senha:</label>' . '<input class="form-control" placeholder="Digite a nova Senha" name="passwdn" size="18" type="password" value="">' .'<br>'
														 . '<input class="form-control" placeholder="Repita a Senha" name="passwd1n" size="18" type="password" value="">' .'<br>		
																			
												</div>		
                                                
                                            </div>';
											
											?>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Ok</button>
                                            </div>
										</form>
                                    </div>
                                </div>
                            </div>


			

								<?php
								//---------------------------
								//SALVAR USUARIO EXISTENTE
									if(isset($_REQUEST["SAVE"])){
										
										$cpf = '';
										$nome = '';
										$Login = '';
										$senha1 = '';
										$senha2 = '';
										$cpf = $_REQUEST["SAVE"];
										if (isset($_POST['Nome'])) { $nome = $_POST['Nome'];};
										if (isset($_POST['login'])) { $Login = $_POST['login'];};
										if (isset($_POST['passwd'])) { $senha1 = $_POST['passwd'];};
										if (isset($_POST['passwd1'])) { $senha2 = $_POST['passwd1'];};
											
										$Salvar = True;	
										$SalvarMens = '';
										//VALIDA NOME
										if (strlen(trim($nome)) < 1	){
											$Salvar=False;
											$SalvarMens = $SalvarMens . 'Nome inválido<br>';
										};
										//VALIDA LOGIN
										if (strlen(trim($Login)) < 1){
											$Salvar=False;
											$SalvarMens = $SalvarMens . 'Login inválido<br>';
										}
										else{
											$sql = "select s_login from db_atendimento.tb_usuario  
													where (id_cpf <> '" . $cpf . "') and (s_login = '" . $Login . "')"; 
											$rs_access=$connectCoorp->prepare($sql);
											if($rs_access->execute()){
												$resultados = $rs_access->rowCount();
												if($resultados>=1){	
													$Salvar=False;
													$SalvarMens = $SalvarMens . 'Login já existe<br>';													
												}
											}												 
										};
										//VALIDA SENHA
										if ((strlen(trim($senha1)) < 1) or (strlen(trim($senha2)) <1) or ($senha1 <> $senha2)){
											$Salvar=False;
											$SalvarMens = $SalvarMens . 'Senha inválida<br>';
										};
										
										//---------------------------
										//SALVAR
										if ($Salvar){
											$hashDaSenha=md5("uhofdjfoiahdfuHU".$senha1);
											$sql = "update db_atendimento.tb_usuario set s_login = '". $Login ."', 
																						 s_nome  = '" .$nome . "',
																						 s_sys = '2',
																						 s_pass  = '" .$hashDaSenha . "'  
																						 where (id_cpf = " . $cpf . ")"; 
											$rs_access=$connectCoorp->prepare($sql);
											if($rs_access->execute()){
												echo 'Dados do Usuário alterado com sucesso.';	
											}												 
											else{
												echo 'Erro ao alterar dados do Usuário.';		
											//header('location: cad_usu.php?usu='. $_REQUEST["SAVE"] );
											
											}												
										}
										else {
											$SalvarMens = 'Não foi possível salvar dados.<br><br>'.$SalvarMens;
											echo $SalvarMens;
										};
								//---------------------------
								//SALVAR NOVO USUÁRIO
									}
									else if(isset($_REQUEST["NEW"])){
										
										
										$cpf = '';
										$nome = '';
										$Login = '';
										$senha1 = '';
										$senha2 = '';
										if (isset($_POST['cpfn'])) { $cpf = $_POST['cpfn'];};
										if (isset($_POST['Nomen'])) { $nome = $_POST['Nomen'];};
										if (isset($_POST['loginn'])) { $Login = $_POST['loginn'];};
										if (isset($_POST['passwdn'])) { $senha1 = $_POST['passwdn'];};
										if (isset($_POST['passwd1n'])) { $senha2 = $_POST['passwd1n'];};
											
										$Salvar = True;	
										$SalvarMens = '';
										
										//VALIDA CPF
										if (strlen(trim($cpf)) <> 11){
											$Salvar=False;
											$SalvarMens = $SalvarMens . 'CPF inválido<br>';
										}
										else{
											$sql = "select s_login from db_atendimento.tb_usuario  
													where (id_cpf = '" . $cpf . "')"; 
											$rs_access=$connectCoorp->prepare($sql);
											if($rs_access->execute()){
												$resultados = $rs_access->rowCount();
												if($resultados>=1){	
													$Salvar=False;
													$SalvarMens = $SalvarMens . 'CPF já existe<br>';													
												}
											}												 
										};										
										//VALIDA NOME
										if (strlen(trim($nome)) < 1	){
											$Salvar=False;
											$SalvarMens = $SalvarMens . 'Nome inválido<br>';
										};
										//VALIDA LOGIN
										if (strlen(trim($Login)) < 1){
											$Salvar=False;
											$SalvarMens = $SalvarMens . 'Login inválido<br>';
										}
										else{
											$sql = "select s_login from db_atendimento.tb_usuario  
													where (s_login = '" . $Login . "')"; 
											$rs_access=$connectCoorp->prepare($sql);
											if($rs_access->execute()){
												$resultados = $rs_access->rowCount();
												if($resultados>=1){	
													$Salvar=False;
													$SalvarMens = $SalvarMens . 'Login já existe<br>';													
												}
											}												 
										};
										//VALIDA SENHA
										if ((strlen(trim($senha1)) < 1) or (strlen(trim($senha2)) <1) or ($senha1 <> $senha2)){
											$Salvar=False;
											$SalvarMens = $SalvarMens . 'Senha inválida<br>';
										};
										
										//---------------------------
										//SALVAR
										if ($Salvar){
											$hashDaSenha=md5("uhofdjfoiahdfuHU".$senha1);
											$sql = "INSERT INTO db_atendimento.tb_usuario(id_cpf,s_login,s_nome,s_sys,s_pass) 
																				VALUES('". $cpf ."','". $Login ."','". $nome ."','2','". $hashDaSenha ."');";
											$rs_access=$connectCoorp->prepare($sql);
											if($rs_access->execute()){
												echo 'Usuário cadastrado com sucesso.';	
											}												 
											else{
												echo 'Erro ao cadastrar Usuário.';		
											}												
										}
										else {
											$SalvarMens = 'Não foi possível salvar dados.<br><br>'.$SalvarMens;
											echo $SalvarMens;
										};								
									}
									else if(isset($_REQUEST["DEL"])){
										//---------------------------
										//EXCLUIR
											$sql = "DELETE FROM db_atendimento.tb_usuario WHERE id_cpf = '" . $_REQUEST["DEL"] . "';";
											$rs_access=$connectCoorp->prepare($sql);
											if($rs_access->execute()){
												echo 'Usuário excluido com sucesso.';	
											}												 
											else{
												echo 'Erro ao excluir Usuário.';		
											}												;
									};									
									
								?>								
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
<!-- *************************************************************************************************************** -->
<!-- ***************************            ATENDIMENTO PENDENTE           ***************************************** -->
<!-- *************************************************************************************************************** -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i> Usuários
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">Ordenação<span class="caret"></span></button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="?desc">Decendente</a></li>
                                        <li><a href="?ascend">Ascendente</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
								<?PHP
								if(isset($_REQUEST["desc"])){
									$sql = "SELECT * FROM db_atendimento.tb_usuario where s_sys = '2' ORDER BY s_login DESC;";
								}
								else{
									$sql = "SELECT * FROM db_atendimento.tb_usuario where s_sys = '2';";
								};
								$rs_access=$connectCoorp->prepare($sql);
								echo '  <button class="list-group-item" data-toggle="modal" data-target="#myModal">Novo Usuário</button>';
								if($rs_access->execute()){
								$resultados = $rs_access->rowCount();
									if($resultados>=1){
										while($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){ 
										?>
											<a href=<?PHP echo 'cad_usu.php?usu=' . $registro_access->id_cpf; ?> class="list-group-item">
												<?PHP echo $registro_access->s_login . ' - ' . $registro_access->s_nome; ?>
											</a>
								<?PHP                            						
										}
									}
								}	
								?>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
				</div>
                <!-- /.col-lg-4 -->
<!-- *************************************************************************************************************** -->
				
            </div>
            <!-- /.row -->			
			
			
			
			
			
			
			
			
        </div>

		
		
<!-- *************************************************************************************************************** -->
<!-- ***************************                    JAVA                   ***************************************** -->
<!-- *************************************************************************************************************** -->		
    </div>
    <!-- /#wrapper -->


</body>

</html>
<?PHP
  ob_flush();
?> 