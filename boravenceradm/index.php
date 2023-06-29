<?PHP 
	ob_start();

	include 'conect.php';

	session_start();
 
	if ( !isset($_SESSION['login'])) {
		session_destroy();
		unset ($_SESSION['login']);
		unset ($_SESSION['nome']);
		header('location:login.php');
	}
?>

<!DOCTYPE html>
<html>

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
        <div id="page-wrapper">

			<div class="row">
			<BR>
            </div>
			<!-- *************************************************************************************************************** -->
			<!-- ***************************                   LINHA 1                 ***************************************** -->
			<!-- *************************************************************************************************************** -->
            <div class="row">
                <div class="col-lg-8">
					<!-- *************************************************************************************************************** -->
					<!-- ***************************                   GRAFICO                 ***************************************** -->
					<!-- *************************************************************************************************************** -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Inscritos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

							<div id="graph"></div>
							<?PHP
								$_SESSION['x0'] = '3000';
			
								$indice=0;
								$rs_access=$connect->prepare("SELECT count(id_cri) as totinsc FROM db_boravencer.tb_crianca;");
								if($rs_access->execute()){
									$resultados = $rs_access->rowCount();
									if($resultados>=1){
										while($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
											$_SESSION['x0'] = $registro_access->totinsc;
										}
									}
								}	
							?>
							<script>
							// Use Morris.Bar
								Morris.Bar({
									element: 'graph',
									data: [
											{x: 'Vagas: 1700', c: '1700'},
											{x: 'Inscritos: <?PHP echo $_SESSION['x0']; ?>', c: '<?PHP echo $_SESSION['x0']; ?>'}
										  ],
									xkey: 'x',
									ykeys: ['c'],
									labels: ['Total'],
									stacked: true
								});
							</script>							
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
											header('location:cad_insc.php?tkt='.$_REQUEST["tkt"]);	
										}
									}	
								};										
								?>		
								<form method=get action="index.php">
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
											<a href=<?PHP echo 'cad_insc.php?tkt=' . $registro_access->id_cri; ?> class="list-group-item">
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
    </div>
    <!-- /#wrapper -->
	

</body>

</html>
<?PHP
  ob_flush();
?> 