<?PHP 
	ob_start();

	include '../conect.php';
	include 'u_funcoes.php';
	
	setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
	date_default_timezone_set('America/Sao_Paulo');

	session_start();
 
	if ( !isset($_SESSION['login'])) {
		session_destroy();
		unset ($_SESSION['login']);
		unset ($_SESSION['nome']);
		unset ($_SESSION["vis_cpf"]);
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

    <title>Sistema de Atendimento - DITI</title>

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
<!-- *************************************************************************************************************** -->
<!-- ***************************                   SCRIPTS                 ***************************************** -->
<!-- *************************************************************************************************************** -->
<?PHP include '@main_scripts.php';?>	
  	
	<script language="JavaScript" type="text/javascript" src="funcoesJS.js"></script> 
	<script type="text/javascript" src="../../@lib/ckeditor/ckeditor.js"></script>
	<script type="text/javascript">
      window.onload = function()  {
		CKEDITOR.replace( 'zzznew' );
        CKEDITOR.replace( 'zzz' );
      };
    </script>    

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
	$Labelvis = 'Formulário de Visitas';
	$Nvis='0';
	if(isset($_REQUEST["vis"])){
				$Labelvis = 'Formulário de Visitas - N° ' . $_REQUEST["vis"];
				$Nvis=$_REQUEST["vis"];
	}
//	else if(isset($_REQUEST["SAVE"])){
//				$Labelvis = 'Formulário de Visitas - N° ' . $_REQUEST["SAVE"];
//				$Nvis=$_REQUEST["SAVE"];
//	}
	else{
				$Labelvis = 'Formulário de Visitas';
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
                            <i class="fa fa-edit fa-fw"></i> <?php echo $Labelvis;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
						
						
					
				<?PHP
	if ($Nvis>0){
		$sql = "SELECT cod_visit, datahora_visit, local_visit, doc_visit, doc_visit_dt FROM db_atendimento.tb_visita WHERE (cod_visit=". $Nvis.");";
		$rs_access=$connect->prepare($sql);
		if($rs_access->execute()){
			$resultados = $rs_access->rowCount();
			if($resultados>=1){
				if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
					echo '<div class="form-group">';
						echo '<form name="fvis" method=post action="?SAVE='.$Nvis.'">';
							echo '<label>N° da Visita: </label><input class="form-control" type="text" name="codvisit" maxlength="11" value="' . $registro_access->cod_visit . '" disabled><br>';
?>	
<label>Relatório:</label><textarea class="form-control" rows="5" name="zzz" maxlength="200" ><?PHP echo $registro_access->doc_visit ?></textarea><br>

<?PHP
							echo '<label>Data da Visita: </label> ' . strftime("%H:%M:%S - %d de %B de %Y", strtotime( $registro_access->datahora_visit )) .'<br>';       
							echo '<label>Local:</label>';
							echo '<select name="unidadesel" class="form-control">';
							
							
		$sql = "SELECT id_unidade, unidade FROM db_atendimento.tb_unidade;";
		$rs_pesq=$connect->prepare($sql);
		if($rs_pesq->execute()){
			$result_pesq = $rs_pesq->rowCount();
			if($result_pesq>=1){
				while($reg_pesq= $rs_pesq->fetch(PDO::FETCH_OBJ)){
					if ($registro_access->local_visit == $reg_pesq->id_unidade){ echo '<option selected>';} else { echo '<option>';}; 
					echo $reg_pesq->id_unidade . ' - ' . $reg_pesq->unidade . '</option>';	
				}
			}
		}
							echo '</select><br>';		
							echo '	<button type="submit" class="btn btn-outline btn-primary">Salvar</button>'; 
						echo '</form>';	
						




							echo '<br><br><div class="form-group">';
							echo '    <label>Documentos</label><br>';
							echo '    <a href=recibo3.php?n=' . $registro_access->cod_visit . ' class="btn btn-outline btn-primary">Relatório de Visitas</a>';	
							echo '</div>';	
						
				
												
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
                                            <h4 class="modal-title" id="myModalLabel">Nova Visita</h4>
                                        </div>
									    <?PHP

										 echo '<form method=post action="?NEW='.$Nvis.'">';
										 echo '   <div class="modal-body">';
                                         echo '       <div class="form-group">';
										 	?>	
										 
										 
						<label>Relatório:</label><textarea class="form-control" rows="7" name="zzznew" placeholder="Digite os dados técnicos da visita"></textarea> <br>';
 <?PHP
							echo '<label>Local:</label>';
							echo '<select name="unidadeselnew" class="form-control">';
							$sql = "SELECT id_unidade, unidade FROM db_atendimento.tb_unidade;";
							$rs_pesq=$connect->prepare($sql);
							if($rs_pesq->execute()){
								$result_pesq = $rs_pesq->rowCount();
								if($result_pesq>=1){
									while($reg_pesq= $rs_pesq->fetch(PDO::FETCH_OBJ)){
										echo '<option>' . $reg_pesq->id_unidade . ' - ' . $reg_pesq->unidade . '</option>';	
									}
								}
							}
							echo '</select><br>	
																			
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


			

								<?PHP
								//---------------------------
								//SALVAR VISITA EXISTENTE
									if(isset($_REQUEST["SAVE"])){
										$local_visit='';
										if (isset($_POST['unidadesel'])) { $local_visit = substr($_POST['unidadesel'], 0, 12);};	
										$descRel = '';
//										if (isset($_POST['zzz'])) {$descRel = htmlentities($_POST['zzz']);};											
										if (isset($_POST['zzz'])) {$descRel = $_POST['zzz'];};											
										$sql = "update db_atendimento.tb_visita set local_visit = '" . $local_visit . "',
																						 doc_visit = '" .$descRel . "'
												where (cod_visit = " . $_REQUEST["SAVE"] . ")"; 
										$rs_access=$connect->prepare($sql);
										if($rs_access->execute()){
											echo 'Visita n° ' . $_REQUEST["SAVE"] . ' foi efetuada.';	
											//header('location:recibo1.php?n='.$_REQUEST["receber"], true, 301);
										}												 
										else{
											echo 'Falha no registro da visita.';
										}			
												
											

								//---------------------------
								//SALVAR NOVO Visita
									}
									else if(isset($_REQUEST["NEW"])){
										
										$local_visit='';
										if (isset($_POST['unidadeselnew'])) { $local_visit = substr($_POST['unidadeselnew'], 0, 12);};	
										$descRel = '';
//										if (isset($_POST['zzznew'])) {$descRel = htmlentities($_POST['zzznew']);};											
										if (isset($_POST['zzznew'])) {$descRel = $_POST['zzznew'];};											
										try{
											$NCod = NovoIndexDB('cod_visit', 'tb_visita', 'db_atendimento');
										    $sql =  "INSERT INTO tb_visita (cod_visit, datahora_visit, local_visit, doc_visit, doc_visit_dt) 
										             VALUES (" . $NCod . ",now(),'" . $local_visit . "','"  . $descRel . "',NOW())" ;
										    $stmt = $connect->prepare($sql);
											if($stmt->execute()){
												echo 'Visita n° ' . $NCod . ' foi efetuada.';	
												//header('location:recibo1.php?n='.$_REQUEST["receber"], true, 301);
											}												 
											else{
												echo 'Falha no registro da Visita.';
											}		
										
										}catch(PDOException $e_i){
											echo "Falha no registro da Visita. Err: " . $e_i->getMessage();
										    
										}	;									
									};
								?>								
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
<!-- *************************************************************************************************************** -->
<!-- ***************************            LISTAGEM DE VISITAS            ***************************************** -->
<!-- *************************************************************************************************************** -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bell fa-fw"></i> Visitas
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">Ordenação<span class="caret"></span></button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="?">Decendente</a></li>
                                        <li><a href="?ascend">Ascendente</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
								<?PHP
								if(isset($_REQUEST["ascend"])){
									$sql = "SELECT * FROM db_atendimento.tb_visita ORDER BY cod_visit;";
								}
								else{
									$sql = "SELECT * FROM db_atendimento.tb_visita  ORDER BY cod_visit desc";
								};
								$rs_access=$connect->prepare($sql);
								if($rs_access->execute()){
								$resultados = $rs_access->rowCount();
									if($resultados>=1){
									echo '  <button class="list-group-item" data-toggle="modal" data-target="#myModal">Nova Visita</button>';
										
										while($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){ 
										?>
											<a href=<? echo 'ate_visit.php?vis=' . $registro_access->cod_visit; ?> class="list-group-item">
												<? echo 'Visita n° ' . $registro_access->cod_visit; ?>
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
<?
  ob_flush();
?> 