<?PHP 
	ob_start();

	include '../conect.php';
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

<?php

	if (isset($_REQUEST["usu"])){
		$LabelTKT = 'Chat com ' . $_REQUEST["usu"];	
//		$URLTimer = 'chat_suporte.php';//,usu='. $_REQUEST["usu"] ;//';	
	}
	else{
		$LabelTKT = 'Chat';	
//		$URLTimer = 'chat_suporte.php';	
	};
//$URLTimer  = 'index.php';	
?>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="refresh" content="20; url="> 
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

        <div id="page-wrapper">
			<div class="row">
			<BR>
            </div>

<!-- *************************************************************************************************************** -->
<!-- ***************************                   LINHA 1                 ***************************************** -->
<!-- *************************************************************************************************************** -->
            <div class="row">
			
				<div class="col-lg-8">			

				
					<div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comment-o fa-fw"></i>
                            <?php echo $LabelTKT;?>
                            <div class="btn-group pull-right">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-chevron-down"></i>
                                </button>
                                <ul class="dropdown-menu slidedown">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-refresh fa-fw"></i> Refresh
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
						
			
<!-- *************************************************************************************************************** -->
<!-- ***************************                 FORMULARIO                ***************************************** -->
<!-- *************************************************************************************************************** -->
						
<?PHP				
								//---------------------------
								//ENVIA MENSAGENS
									if(isset($_REQUEST["envia"])){
										//novo cod
										if ((isset($_POST['btn-chat-mens'])) and ((Trim($_POST['btn-chat-mens']) <> ""))) {
											$nCodigo = 0;
											$nCodigo = NovoIndexDB('id_chat', 'tb_chat', 'db_atendimento');
											//insert
											
											$sql = "UPDATE db_atendimento.tb_chat SET usu_atend = '" . $_SESSION["usu_cpf"] . "' where ((usu ='" . $_SESSION["usu"] . "') and (i_destinatario=0) and (usu_atend='0'));";
											$rs_insert=$connect->prepare($sql);
											$rs_insert->execute();
											
											$sql = "INSERT INTO db_atendimento.tb_chat (id_chat, usu, id_comput, s_chat_mens, dt_chat_mens, i_destinatario, usu_atend)
													VALUES (" . $nCodigo . ",'" . $_SESSION["usu"] . "','" . $_SESSION["comput"] . "','" . $_POST['btn-chat-mens'] . "',now(),1," . $_SESSION["usu_cpf"] . ");";
											$rs_insert=$connect->prepare($sql);
											$rs_insert->execute();
											
											header('location:chat_suporte.php?usu=' . $_SESSION["usu"] . '');
											
										};	
									};
									?>	
                        <div class="panel-body">
                            <ul class="chat">
								<?PHP
								$id_usu = '';
								if ((isset($_REQUEST["usu"])) and (trim($_REQUEST["usu"])<>"")){
									$_SESSION["usu"]=$_REQUEST["usu"];
									$id_usu = $_REQUEST["usu"];
									$sql = "SELECT * FROM db_atendimento.tb_chat where usu = '" . $id_usu . "' order by id_chat desc;";
									$rs_pesq=$connect->prepare($sql);
									if($rs_pesq->execute()){
										$result_pesq = $rs_pesq->rowCount();
										if($result_pesq>=1){
										//-------------------
										//DATA SERVIDOR
											$DataServ = fDataServer();
										//-------------------
               								$_SESSION["comput"]='';			
											while($reg_pesq= $rs_pesq->fetch(PDO::FETCH_OBJ)){
											    //DATA CHAT
               									if ($_SESSION["comput"]=='') {$_SESSION["comput"]=$reg_pesq->id_comput;};
												$DataChat = $reg_pesq->dt_chat_mens;
												$usuMens = $reg_pesq->s_chat_mens;
												if (trim($usuMens) == '') {$usuMens = '_';};												
												$chat_a1 = 'left';
												if ($reg_pesq->i_destinatario==0){
													$chat_img_avatar        = '../img/usu.png';
													$chat_usu = $reg_pesq->usu;
												} 
												else {
													$chat_img_avatar        = '../img/suporte.png';
													$chat_usu = trim($reg_pesq->usu_atend);
														if (($chat_usu == '') or ($chat_usu == NULL)){$chat_usu = 'Suporte';}
														else{$chat_usu = 'Suporte - ' . $chat_usu;};
												};
													$chat_usu_time = '<strong class="primary-font">' . $chat_usu . '</strong>
																	  <small class="pull-right text-muted">
																	  <i class="fa fa-clock-o fa-fw"></i>' . DataChat($DataChat,$DataServ) . '</small>';
												?>
                                <li class="<? echo $chat_a1; ?> clearfix">
                                    <span class="chat-img pull-<? echo $chat_a1; ?>">
                                        <img src="<? echo $chat_img_avatar; ?>" alt="User Avatar" class="img-circle" />
                                    </span>
                                    <div class="chat-body clearfix">
                                        <div class="header"><? echo $chat_usu_time; ?></div><p><? echo $usuMens; ?></p>
                                    </div>
                                </li>
												<?PHP 												
											};//while
										};//if($result_pesq>=1){
									};//if($rs_pesq->execute()){
								};//if ((isset($_REQUEST["usu"]))
								?>							
                            </ul>
                        </div>
                        <!-- /.panel-body -->
						<form method=post action="?envia">
                        <div class="panel-footer">
                            <div class="input-group"> 
                                <input id="btn-chat-mens" name="btn-chat-mens" type="text" class="form-control input-sm" placeholder="Type your message here..."/>
                                <span class="input-group-btn">
                                    <button class="btn btn-warning btn-sm" id="btn-chat" name="btn-chat"  type="submit">
                                        Send
                                    </button>
                                </span>
                            </div>
                        </div>
						</form>
                        <!-- /.panel-footer -->
                    </div>			
                </div>
                <!-- /.col-lg-8 -->
<!-- *************************************************************************************************************** -->
<!-- *******************************            LISTA DE CHAT'S           ****************************************** -->
<!-- *************************************************************************************************************** -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comment-o fa-fw"></i> Chat's
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
								<form method=get action='chat_suporte.php'>
									<div class="input-group custom-search-form">
										<input name="nome" type="text" class="form-control" placeholder="Digite o nome do usuário...">
										<span class="input-group-btn">
											<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
										</span>
									</div>		
								</form>
								<?PHP
								if ((isset($_REQUEST["nome"])) and (trim($_REQUEST["nome"])<>"")){
									$sql = "SELECT tb_chat.id_chat, tb_chat.usu, tb_chat.dt_chat_mens, tb_chat.i_destinatario
											FROM db_atendimento.tb_chat , (SELECT usu, max(dt_chat_mens) as DT, max(id_chat) as id FROM db_atendimento.tb_chat group by usu) AS conZ
											WHERE  (db_atendimento.tb_chat.id_chat = conZ.id)  and (db_atendimento.tb_chat.usu like '%".$_REQUEST["nome"]."%')
											order by tb_chat.i_destinatario, tb_chat.id_chat desc;";
								}
								else{
									$sql = "SELECT tb_chat.id_chat, tb_chat.usu, tb_chat.dt_chat_mens, tb_chat.i_destinatario
											FROM db_atendimento.tb_chat , (SELECT usu, max(dt_chat_mens) as DT, max(id_chat) as id FROM db_atendimento.tb_chat group by usu) AS conZ
											WHERE  (db_atendimento.tb_chat.id_chat = conZ.id)
											order by tb_chat.i_destinatario, tb_chat.id_chat desc;";
								};
								$rs_access=$connect->prepare($sql);
								if($rs_access->execute()){
								$resultados = $rs_access->rowCount();
									if($resultados>=1){
										$usuMens = '';
										//-------------------
										//DATA SERVIDOR
											$DataServ = fDataServer();
										//-------------------
										while($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){ 
											//-------------------
											//DATA CHAT
											$DataChat = $registro_access->dt_chat_mens;
											$usuMens = $registro_access->usu;
											if (trim($usuMens) == '') {$usuMens = '_';};
											$cortxt = '';
											if ($registro_access->i_destinatario == 1)  {$cortxt='';}
											else {$cortxt='style="color: #CC0000"';};              //Vermelho
												?>
												<a href=<? echo 'chat_suporte.php?usu=' . $registro_access->usu; ?> class="list-group-item" <? echo $cortxt; ?> >
													<? echo $usuMens; ?> <span class="pull-right text-muted small"><em><? echo DataChat($DataChat,$DataServ);?></em></span>
												</a>
												<?PHP                            						
										}
									}
								};	

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
<?
  ob_flush();
?> 
