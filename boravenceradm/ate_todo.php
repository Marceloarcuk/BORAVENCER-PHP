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

    <title>Sistema de Atendimento - DITI</title>

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
	$LabelTKT = 'Formulário de Atendimentos';
	$NTKT='0';
	$Mensagem='';

	if(isset($_REQUEST["tkt"])){
		$Mensagem='<div class="alert alert-danger"><label>Este Atendimento não existe.</label></div>';
		$sql = "SELECT cod FROM tb_atendimento where (cod=". $_REQUEST["tkt"].") and (status_atend=9);";
		$rs_access=$connect->prepare($sql);
		if($rs_access->execute()){
			$resultados = $rs_access->rowCount();
			if($resultados>=1){	
				$LabelTKT = 'Formulário de Atendimentos - Tkt n° ' . $_REQUEST["tkt"];
				$NTKT=$_REQUEST["tkt"];	
				$Mensagem='';				
			}
		}	
		$sql = "SELECT cod FROM tb_atendimento where (cod=". $_REQUEST["tkt"].") and (status_atend<>9);";
		$rs_access=$connect->prepare($sql);
		if($rs_access->execute()){
			$resultados = $rs_access->rowCount();
			if($resultados>=1){	
					header('location:ate_pend.php?tkt='.$_REQUEST["tkt"]);			
			}
		}	
	};
							
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
                            <i class="fa fa-edit fa-fw"></i> <?php echo $LabelTKT;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
						
				<?PHP
			
	if ($NTKT>0){
		$sql = "SELECT tb_atendimento.status_atend, tb_atendimento.cod, tb_atendimento.tipo, tb_atendimento_tipo.desc_tipo, tb_atendimento.descricao, 
		               tb_atendimento.usu, tb_atendimento.solicitante, tb_atendimento.computador, tb_atendimento.local, tb_unidade.unidade, 
					   tb_atendimento.id_comput,tb_atendimento.datahora,tb_atendimento.datahora_atend, tb_atendimento.descricao_atend, 
					   tb_atendimento.doc_1, tb_atendimento.doc_1_dt, tb_atendimento.doc_1_dt_fim
		        FROM (tb_atendimento LEFT JOIN tb_atendimento_tipo ON tb_atendimento.tipo = tb_atendimento_tipo.tipo) LEFT JOIN tb_unidade ON tb_atendimento.local = tb_unidade.id_unidade
		        WHERE (tb_atendimento.cod=". $NTKT.");";
		$rs_access=$connect->prepare($sql);
		if($rs_access->execute()){
			$resultados = $rs_access->rowCount();
			if($resultados>=1){
				if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
					echo '<div class="form-group">';
						echo '<label>' . $registro_access->desc_tipo . ' (Tipo:' . $registro_access->tipo .')</label><br>';
		    			echo '<label>Problema relatado: </label>' . $registro_access->descricao . '<br><br>';
						echo '<label>Descrição do Atendimento: </label>' . $registro_access->descricao_atend . '<br><br>';
        	            echo '<label>Usuário:</label>' . $registro_access->usu . '        <label>Computador:</label>' . $registro_access->computador . ' - ' . $registro_access->id_comput . '</label><br>';                     
        	            echo '<label>Solicitante:</label>' . $registro_access->solicitante .'<br>';                     
        	            echo '<label>Local:</label>' . $registro_access->local . ' - ' . $registro_access->unidade .'<br><br>';  


						$dateini=date_create($registro_access->datahora);						
						$datefim=date_create($registro_access->datahora_atend);						
						echo '<label>Data do Chamado: </label> ' . strftime("%H:%M:%S - %d de %B de %Y", strtotime( $registro_access->datahora )) .'<br>';       
						echo '<label>Data do Atendimento: </label> ' . strftime("%H:%M:%S - %d de %B de %Y", strtotime( $registro_access->datahora_atend )) .'<br>';    
						$diff = $dateini->diff($datefim);
						$resultado  = "<label>Tempo de atendimento: </label> ";        
						
						if ($diff->format('%d') <> '0') { $resultado .= "{$diff->format('%d dias')} ";};
						if ($diff->format('%h') <> '0') { $resultado .= "{$diff->format('%h horas')} ";};
						if ($diff->format('%i') <> '0') { $resultado .= "{$diff->format('%i minutos')} ";};
						if ($diff->format('%s') <> '0') { $resultado .= "{$diff->format('%s segundos')} ";};
						        

						echo $resultado;
						
						
						if (($registro_access->doc_1_dt <> '') OR ($registro_access->doc_1_dt <> NULL)){
							
							echo '<br><br><div class="form-group">';
							echo '    <label>Documentos</label><br>';
							echo '<a href=recibo1.php?n=' . $registro_access->cod . ' class="btn btn-outline btn-primary">Comprovente de Entrega de Equipamento</a>';	
								if (($registro_access->doc_1_dt_fim <> '') OR ($registro_access->doc_1_dt_fim <> NULL)){
									echo '<br><br><a href=recibo2.php?n=' . $registro_access->cod . ' class="btn btn-outline btn-primary">Comprovente de Devolução de Equipamento</a>';	
								}
							echo '</div>';					
						}
					
						
					echo '</div>';
				}
			}
		}
	}		
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
                            <i class="fa fa-bell fa-fw"></i> Atendimentos Concluídos
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
								$indice=0;
								if(isset($_REQUEST["desc"])){
									$sql = "SELECT tb_atendimento_tipo.desc_tipo, tb_atendimento.datahora, tb_atendimento.cod, tb_atendimento.status_atend, DATEDIFF(NOW(),tb_atendimento.datahora) as prioridade
											FROM tb_atendimento_tipo INNER JOIN tb_atendimento ON tb_atendimento_tipo.tipo = tb_atendimento.tipo
											WHERE (((tb_atendimento.status_atend)=9)) ORDER BY tb_atendimento.cod DESC;";
								}
								else{
									$sql = "SELECT tb_atendimento_tipo.desc_tipo, tb_atendimento.datahora, tb_atendimento.cod, tb_atendimento.status_atend, DATEDIFF(NOW(),tb_atendimento.datahora) as prioridade
											FROM tb_atendimento_tipo INNER JOIN tb_atendimento ON tb_atendimento_tipo.tipo = tb_atendimento.tipo
											WHERE (((tb_atendimento.status_atend)=9)) ORDER BY tb_atendimento.cod;";
								};
								$rs_access=$connect->prepare($sql);
								if($rs_access->execute()){
								$resultados = $rs_access->rowCount();
									if($resultados>=1){
										$indice=0;
								?>		
								<form method=get action='ate_todo.php'>
									<div class="input-group custom-search-form">
										<input name="tkt" type="text" class="form-control" placeholder="N° do atendimento...">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit">
												<i class="fa fa-search"></i>
											</button>
										</span>
									</div>		
								</form>
	
								<?PHP					

								
								echo $Mensagem;	
																
										while($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){ 
										?>
                               
											<a href=<? echo 'ate_todo.php?tkt=' . $registro_access->cod; ?> class="list-group-item">
												<? echo 'Tkt n° ' . $registro_access->cod . ' - ' . $registro_access->desc_tipo; ?>
												<span class="pull-right text-muted small"><em><? echo $registro_access->datahora; ?></em>
												</span>
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