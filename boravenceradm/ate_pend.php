<?PHP 
	ob_start();

	include 'conect.php';
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
	$LabelTKT = 'Formulário de Inscritos';
	$NTKT='0';
	$Mensagem='';
	if(isset($_REQUEST["tkt"])){
		$Mensagem='<div class="alert alert-danger"><label>Este nome não existe.</label></div>';
		$sql = "SELECT * FROM db_boravencer.tb_crianca where (id_cri=". $_REQUEST["tkt"].");";
		$rs_access=$connect->prepare($sql);
		if($rs_access->execute()){
			$resultados = $rs_access->rowCount();
			if($resultados>=1){	
				$LabelTKT = 'Formulário do Incrito n° ' . $_REQUEST["tkt"];
				$NTKT=$_REQUEST["tkt"];	
				$Mensagem='';				
			}
		}	
/*		$sql = "SELECT cod FROM tb_atendimento where (cod=". $_REQUEST["tkt"].") and (status_atend=9);";
		$rs_access=$connect->prepare($sql);
		if($rs_access->execute()){
			$resultados = $rs_access->rowCount();
			if($resultados>=1){	
					header('location:ate_todo.php?tkt='.$_REQUEST["tkt"]);
			}
		}	*/
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
		$sql = "SELECT * FROM db_boravencer.tb_crianca where (id_cri=".$NTKT .");";
		$rs_access=$connect->prepare($sql);
		if($rs_access->execute()){
			$resultados = $rs_access->rowCount();
			if($resultados>=1){
				if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
					echo '<div class="form-group">';
						echo '<label>' . $registro_access->nome_cri . ' (CPF:' . $registro_access->cpf_cri .')</label><br>';
		    			echo '<label>Fone Residencial: </label>' . $registro_access->fone_res_cri . '  -  ' . $registro_access->fone_res_cri1 . '<br>';
		    			echo '<label>Fone Celular: </label>' . $registro_access->fone_cel_cri . '  -  ' . $registro_access->fone_cel_cri1 . '<br>';
		    			echo '<label>WhatsApp: </label>' . $registro_access->whatsapp_cri . '<br>';
        	            echo '<label>Email:</label>' . $registro_access->email_cri .'<br>';                     
        	            echo '<label>Bairro:</label>' . $registro_access->end_bairro_cri . '<br>';                     
        	            echo '<label>Data da Inscrição:</label>' . $registro_access->sis_dt_insert_cri . '<br>';            
						
		    		/*							
		$sql = "SELECT * FROM db_boravencer.tb_crianca where (id_cri=".$NTKT .");";
		$sql = "SELECT * FROM db_boravencer.tb_crianca where (id_cri=". $_REQUEST["tkt"].");";
id_cri, nome_cri, cpf_cri, rg_cri, titulo_eleitor_cri, NIS, nacionalidade_cri, naturalidade_cri, end_cri, end_comp_cri, end_bairro_cri, end_uf_cri, end_cep_cri, end_ra_cri, fone_res_cri, fone_res_cri1, fone_cel_cri, fone_cel_cri1, whatsapp_cri, facebook_cri, instagram_cri, twitter_cri, email_cri, dt_nasc_cri, id_raca, sis_dt_insert_cri, sis_dt_alter_cri, sis_cpf_insert_cri, sis_cpf_alter_cri, pass_cri, cidade_cri, id_facebook, estado_civil_cri, beneficiario_cri, nome_p_beneficiario_cri, cadunico_cri, inscricao_enem_cri, outro_est_civil_cri, deseja_estudar_turno_cri1, deseja_estudar_turno_cri2, deseja_estudar_macroregio_cri1

					
						echo '<div class="form-group">';
							echo '    <label>Procedimentos a adotar</label><br>';
						    if ($registro_access->status_atend ==0) {
								echo '<form method=post action="?abrir='.$NTKT.'">';
								echo '	<button type="submit" class="btn btn-outline btn-primary">Abrir Atendimento</button>'; 
								echo '</form>';								
							}
							else if ($registro_access->status_atend ==1) {
								//Aguardando solicitante buscar equipamento
								echo '<button class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal">Finalizar Atendimento</button>';
							}
							else if ($registro_access->status_atend ==2) {
								//Aguardando chegada do equipamento.';
								//echo '<form method=post action="?receber='.$NTKT.'">';
								//echo '	<button type="submit" class="btn btn-outline btn-primary">Receber Equipamento</button><br><br>'; //Abrir Atendimento 
								//echo '</form>';
								echo '<button class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModalRECIB1">Receber Equipamento</button><br><br>';

								echo '<button class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal">Finalizar Atendimento</button>';
								}					
							else if ($registro_access->status_atend ==3) {
								echo '<form method=post action="?solicitar='.$NTKT.'">';
								echo '	<button type="submit" class="btn btn-outline btn-primary">Solicitar Equipamento</button><br><br>'; 
								echo '</form>';
								echo '<button class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal">Finalizar Atendimento</button>';
							}					
							else if ($registro_access->status_atend ==4) {
								echo '<form method=post action="?avisarbusca='.$NTKT.'">';
								echo '	<button type="submit" class="btn btn-outline btn-primary">Avisar - Equipamento Pronto</button><br><br>'; 
								echo '</form>';
								echo '<button class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModal">Finalizar Atendimento</button>';
							};					
							echo '<BR><button class="btn btn-outline btn-primary" data-toggle="modal" data-target="#myModalMens">Mensagem ao Usuário</button>';
							
							
							//--------------------------------
							//  RECIBO DE ENTREGA		
							$ReciboEnt='0';
							$ReciboNew=true;		
							$textoReciboEnt = 'Entreguei na Diretoria de Tecnologia da Informação, 01 CPU MARCA ___________  serial: ____________ .';
							$sql = "SELECT doc_1 FROM tb_atendimento where (doc_1) <> '' and (doc_1_dt) <> '' and (cod=". $NTKT.");";
							$rs_recib=$connect->prepare($sql);
							if($rs_recib->execute()){
								$resultadosRecib = $rs_recib->rowCount();
								if($resultadosRecib>=1){
									$ReciboEnt='<li><button class="btn btn-outline btn-primary " data-toggle="modal" data-target="#myModalRECIB1"  >Recibo de entrega de equipamento</button><li>';
									if($registro_recib= $rs_recib->fetch(PDO::FETCH_OBJ)){	
										$textoReciboEnt = $registro_recib->doc_1;
										$ReciboNew=False;
									};
								}
							};
							if ($ReciboEnt<>'0'){
								echo '<br><br>';
								echo '<div class="pull-right">';
								echo '     <div class="btn-group">';
								echo '         <button type="button" class="btn btn-outline btn-primary dropdown-toggle" data-toggle="dropdown">Documentos<span class="caret"></span></button>';
								echo '         <ul class="dropdown-menu pull-right" role="menu">';
								echo $ReciboEnt; 
								echo '         </ul>';
								echo '     </div>';
								echo ' </div>	';
							}								
							//--------------------------------
						   
							
							
							
                        echo '</div>';
						*/
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
                                            <h4 class="modal-title" id="myModalLabel">Finalizar Atendimento</h4>
                                        </div>
									    <?PHP echo '<form method=post action="?finalizar='.$NTKT.'">';?>
										    <div class="modal-body">
                                                <div class="form-group">
												<label>Descreva o procedimento adotado</label>
												<textarea class="form-control" rows="3" name="txt" ></textarea><br><br>
													<label>Resolvido</label>
													<label class="radio-inline">
														<input type="radio" name="optRad" id="optRad0" value="1" checked>Sim
													</label>
													<label class="radio-inline">
														<input type="radio" name="optRad" id="optRad1" value="0">Não
													</label>
												</div>		
                                                
												<?PHP echo '<input type="hidden" name="f_StatusNum" id="f_StatusNum" value="'.$StatusNum.'">';?>												
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Ok</button>
                                            </div>
										</form>
                                    </div>
                                </div>
                            </div>
				<!-- ********************************************************* -->
				<!-- *****  CAIXA DE RECEBIMENTO DE EQUIPAMENTO  ************* -->
				<!-- ********************************************************* -->
                            <div class="modal fade" id="myModalRECIB1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">
												<?PHP 
													if ($ReciboNew){echo 'Receber Equipamento';} else {echo 'Imprimir Recibo de Equipamento';};
												?>											
											</h4>
                                        </div>
										<?PHP 
										if ($ReciboNew){echo '<form method=post action="?receber='.$NTKT.'">';}
										else {echo '<form method=post action="?receberDoc='.$NTKT.'">';};
										?>
										    <div class="modal-body">
                                                <div class="form-group">
												<label>Texto do Recibo</label>
												<textarea class="form-control" rows="5" name="txtRecibo1" maxlength="200"><?PHP echo $textoReciboEnt;?></textarea><br><br>
												</div>		
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Ok</button>
                                            </div>
										</form>
                                    </div>
                                </div>
                            </div>	
				<!-- ********************************************************* -->
				<!-- *****************  CAIXA DE MENSAGEM   ****************** -->
				<!-- ********************************************************* -->
                            <div class="modal fade" id="myModalMens" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Mensagem ao Usuário</h4>
                                        </div>
									    <?PHP echo '<form method=post action="?mensusu='.$NTKT.'">';?>
										    <div class="modal-body">
                                                <div class="form-group">
													<label>Escreva mensagem para o Usuário</label>
													<textarea class="form-control" rows="3" name="txt" ></textarea><br><br>
												</div>		
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Ok</button>
                                            </div>
										</form>
                                    </div>
                                </div>
                            </div>
				<!-- ********************************************************* -->

							<?php
								//---------------------------
								//SOLICITAR EQUIPAMENTO
									if(isset($_REQUEST["solicitar"])){
										
										$sql = "update db_atendimento.tb_atendimento set status_atend = '2', 
																						 usu_atend = '" .$_SESSION["usu_cpf"] . "',
																						 datahora_atend = now()  
												where (cod = " . $_REQUEST["solicitar"] . ")"; 
										$rs_access=$connect->prepare($sql);
										if($rs_access->execute()){
											echo 'Tkt n° ' . $_REQUEST["solicitar"] . ' - Solicitação de equipamento efetuada.';	
										}												 
										else{
											echo 'Falha na solicitação de equipamento efetuada.';
										}												 
								//---------------------------
								//RECEBER EQUIPAMENTO
									}
									else if(isset($_REQUEST["receber"])){
										$descProb='';
//										if (isset($_POST['txtRecibo1'])) { $descProb = htmlentities($_POST['txtRecibo1']); };
										if (isset($_POST['txtRecibo1'])) { $descProb = $_POST['txtRecibo1']; };
										$sql = "update db_atendimento.tb_atendimento set status_atend = '4', 
																						 usu_atend = '" .$_SESSION["usu_cpf"] . "',
																						 doc_1 = '" . $descProb . "',
																						 doc_1_dt = now(),
																						 datahora_atend = now()   
												where (cod = " . $_REQUEST["receber"] . ")"; 
										$rs_access=$connect->prepare($sql);
										if($rs_access->execute()){
											echo 'Tkt n° ' . $_REQUEST["receber"] . ' - Equipamento recebido.';	
											header('location:recibo1.php?n='.$_REQUEST["receber"], true, 301);
										}												 
										else{
											echo 'Falha no recebimento do equipamento efetuada.';
										}			
									}
									else if(isset($_REQUEST["receberDoc"])){
										$descProb='';
//										if (isset($_POST['txtRecibo1'])) { $descProb = htmlentities($_POST['txtRecibo1']); };
										if (isset($_POST['txtRecibo1'])) { $descProb = $_POST['txtRecibo1']; };
										$sql = "update db_atendimento.tb_atendimento set doc_1 = '" . $descProb . "'
												where (cod = " . $_REQUEST["receberDoc"] . ")"; 
										$rs_access=$connect->prepare($sql);
										header('location:recibo1.php?n='.$_REQUEST["receberDoc"], true, 301);
									}
								//---------------------------
								//AVISAR QUE ESTA OK - PARA BUSCAR
									else if(isset($_REQUEST["avisarbusca"])){
										$sql = "update db_atendimento.tb_atendimento set status_atend = '1', 
																						 usu_atend = '" .$_SESSION["usu_cpf"] . "',
																						 datahora_atend = now()   
												where (cod = " . $_REQUEST["avisarbusca"] . ")"; 
										$rs_access=$connect->prepare($sql);
										if($rs_access->execute()){
											echo 'Tkt n° ' . $_REQUEST["avisarbusca"] . ' - Equipamento pronto para entrega.';	
										}												 
										else{
											echo 'Falha no aviso de busca do equipamento pronto.';
										}										
									}
								//---------------------------
								//ABRIR TKT
									else if(isset($_REQUEST["abrir"])){
										$sql = "update db_atendimento.tb_atendimento set status_atend = '3', 
																						 usu_atend = '" .$_SESSION["usu_cpf"] . "',
																						 datahora_atend = now()   
												where (cod = " . $_REQUEST["abrir"] . ")"; 
										$rs_access=$connect->prepare($sql);
										if($rs_access->execute()){
											echo 'Tkt n° ' . $_REQUEST["abrir"] . ' - Em atendimento.';	
										}												 
										else{
											echo 'Falha na abertura do atendimento.';
										}										
									}									
								//---------------------------
								//FECHAR TKT
									else if(isset($_REQUEST["finalizar"])){
										
										$descProb='';
//										if (isset($_POST['txt'])) { $descProb = htmlentities($_POST['txt']); };
										if (isset($_POST['txt'])) { $descProb = $_POST['txt']; };

										
										$StatusNum='0';
										if (isset($_POST['f_StatusNum'])) {$StatusNum=$_POST['f_StatusNum'];};
										
										$resolvido = '0';
										if ($_POST['optRad'] == 1) {$resolvido = '1';};

										if (($StatusNum == '4') or ($StatusNum == '1')) {										
											$sql = "update db_atendimento.tb_atendimento set status_atend = '9', 
																							usu_atend = '" .$_SESSION["usu_cpf"] . "',
																							descricao_atend = '" . $descProb . "',
																							resolvido_atend = '" . $resolvido . "',
																							doc_1_dt_fim = now(),																						 
																							datahora_atend = now()   
													where (cod = " . $_REQUEST["finalizar"] . ")";
										}													
										else {										
											$sql = "update db_atendimento.tb_atendimento set status_atend = '9', 
																							usu_atend = '" .$_SESSION["usu_cpf"] . "',
																							descricao_atend = '" . $descProb . "',
																							resolvido_atend = '" . $resolvido . "',
																							datahora_atend = now()   
													where (cod = " . $_REQUEST["finalizar"] . ")";
										}													
													
										$rs_access=$connect->prepare($sql);
										if($rs_access->execute()){
			//xxxx Emitir recibo se $StatusNum = 1 ou 4							
											if (($StatusNum == '4') or ($StatusNum == '1')) {
													header('location:recibo2.php?n='. $_REQUEST["finalizar"]);
											}
											else {
												echo 'Tkt n° ' . $_REQUEST["finalizar"] . ' - Foi concluido.';	
			//xxxx Emitir MENSAGEM PARA O USUÁRIO
												//$dataPOST = trim(file_get_contents('php://input'));
												$newCod=0;
												$newCod = NovoIndexDB('COD', 'tb_atendimento_mens', 'db_atendimento');
												if($newCod>=1){
													$sql = "SELECT usu FROM tb_atendimento where (cod=". $_REQUEST["finalizar"].");";
													$rs_access=$connect->prepare($sql);
													if($rs_access->execute()){
														$resultados = $rs_access->rowCount();
														if($resultados>=1){	
															if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
																$sql = "INSERT INTO tb_atendimento_mens (`cod`, `usu`, `mens`, `status`) 
																		VALUES ('". $newCod."', '". $registro_access->usu."',
																				'Tkt n° " . $_REQUEST["finalizar"] . " foi finalizado.', '0');";																	
																$rs_access=$connect->prepare($sql);
																$rs_access->execute();
															}
														}
													}	
												};
			//---FIM --- xxxx Emitir MENSAGEM PARA O USUÁRIO
											};
										}												 
										else{
											echo 'Falha na conclusão do atendimento.';
										};										
									}
									
								//---------------------------
								//ENVIAR MENSAGEM
									else if(isset($_REQUEST["mensusu"])){
										
										$descProb='';
//										if (isset($_POST['txt'])) { $descProb = htmlentities($_POST['txt']); };
										if (isset($_POST['txt'])) { $descProb = $_POST['txt']; };
			//xxxx Emitir MENSAGEM PARA O USUÁRIO
										$newCod=0;
										$newCod = NovoIndexDB('COD', 'tb_atendimento_mens', 'db_atendimento');
										if($newCod>=1){
											$sql = "SELECT usu FROM tb_atendimento where (cod=". $_REQUEST["mensusu"].");";
											$rs_access=$connect->prepare($sql);
											if($rs_access->execute()){
												$resultados = $rs_access->rowCount();
												if($resultados>=1){	
													if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
														$sql = "INSERT INTO tb_atendimento_mens (`cod`, `usu`, `mens`, `status`) 
																VALUES ('". $newCod."', '". $registro_access->usu."','"
																		. $descProb . "', '0');";																	
														$rs_access=$connect->prepare($sql);
														$rs_access->execute();
														echo "Mensagem enviada.";
													}
												}
											}	
										};
			//---FIM --- xxxx Emitir MENSAGEM PARA O USUÁRIO
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
                            <i class="fa fa-user fa-fw"></i> Inscritos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                             <div class="list-group">
								<?PHP
    							$Mensagem='';
								if(isset($_REQUEST["tkt"])){
									$Mensagem='<div class="alert alert-danger"><label>Este nome não existe.</label></div>';
									$sql = "SELECT cod FROM tb_atendimento where (cod=". $_REQUEST["tkt"].") and (status_atend=9);";
									$rs_access=$connect->prepare($sql);
									if($rs_access->execute()){
										$resultados = $rs_access->rowCount();
										if($resultados>=1){	
											$Mensagem='';					
											header('location:ate_todo.php?tkt='.$_REQUEST["tkt"]);
										}
									}	
									$sql = "SELECT cod FROM tb_atendimento where (cod=". $_REQUEST["tkt"].") and (status_atend<>9);";
									$rs_access=$connect->prepare($sql);
									if($rs_access->execute()){
										$resultados = $rs_access->rowCount();
										if($resultados>=1){	
											$Mensagem='';					
											header('location:ate_pend.php?tkt='.$_REQUEST["tkt"]);	
										}
									}	
								};										
								?>		
								<form method=get action="ate_pend.php">
									<div class="input-group custom-search-form">
										<input name="localiza" type="text" class="form-control" placeholder="Localizar...">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit">
												<i class="fa fa-search"></i>
											</button>
										</span>
									</div>		
								</form>
	
								<?PHP					
						
								echo $Mensagem;											
										
								//---------------------------------------		
								//pendentes		
								$indice=0;
								$sql = "SELECT * FROM db_boravencer.tb_crianca where nome_cri <> '0' order by nome_cri;";
								if(isset($_REQUEST["localiza"])){
    								$sql = "SELECT * FROM db_boravencer.tb_crianca where (nome_cri <> '0') and ((nome_cri like '%". $_REQUEST["localiza"] ."%') or (cpf_cri like '%". $_REQUEST["localiza"] ."%')) order by nome_cri;";
								}
//id_cri, nome_cri, cpf_cri, rg_cri, titulo_eleitor_cri, NIS, nacionalidade_cri, naturalidade_cri, end_cri, end_comp_cri, end_bairro_cri, end_uf_cri, end_cep_cri, end_ra_cri, fone_res_cri, fone_res_cri1, fone_cel_cri, fone_cel_cri1, whatsapp_cri, facebook_cri, instagram_cri, twitter_cri, email_cri, dt_nasc_cri, id_raca, sis_dt_insert_cri, sis_dt_alter_cri, sis_cpf_insert_cri, sis_cpf_alter_cri, pass_cri, cidade_cri, id_facebook, estado_civil_cri, beneficiario_cri, nome_p_beneficiario_cri, cadunico_cri, inscricao_enem_cri, outro_est_civil_cri, deseja_estudar_turno_cri1, deseja_estudar_turno_cri2, deseja_estudar_macroregio_cri1
								$rs_access=$connect->prepare($sql);
								if($rs_access->execute()){
								$resultados = $rs_access->rowCount();
									if($resultados>=1){
										while($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){ 
								?>
											<a href=<?PHP echo 'ate_pend.php?tkt=' . $registro_access->id_cri; ?> class="list-group-item">
												<?PHP echo $registro_access->nome_cri; ?>
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