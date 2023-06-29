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
	
	<script language="JavaScript" type="text/javascript" src="funcoesJS.js"></script> 

	
    <script src="https://maps.googleapis.com/maps/api/js?sensor=true"></script>

     <script>
      var map;
	  
      function updateMarkerPosition(latLng) {
        document.getElementById('MyLat').value = marker.position.lat();
        document.getElementById('MyLng').value = marker.position.lng();
       
      }	  
	  

      function initialize() {
        
        var mapOptions = {
          zoom: 11,
          center: new google.maps.LatLng(-15.7670, -47.9362),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById('map_canvas'),
            mapOptions);    
    

        var marker = new google.maps.Marker({ 
        position: map.position,  
        map: map 
        });

        google.maps.event.addListenerOnce(map, 'position_changed', function() {
          map.setCenter(this.getPosition());
          map.fitBounds(this.getBounds());
		      updateMarkerPosition(this.getPosition());
  		  });

        google.maps.event.addListener(map, "center_changed", function(){ 
          document.getElementById("MyLat").value = map.getCenter().lat(); 
          document.getElementById("MyLng").value = map.getCenter().lng(); 
          document.getElementById("lat_db").value = map.getCenter().lat(); 
          document.getElementById("lng_db").value = map.getCenter().lng(); 
          marker.setPosition(map.getCenter()); 
        }); 
      }

      google.maps.event.addDomListener(window, 'load', initialize);
      
	  var image = '../img/home.png';
      function addMarker(location) {
        marker = new google.maps.Marker({
            position: location,
            map: map,
			icon: image		
        });
      }
  
      function atualiza(vlat,vlng) {
         Origem = new google.maps.LatLng(vlat, vlng);
         addMarker(Origem);
      }	
	
    </script>
<?php
	$Labelusu = 'Formulário de Usuários';
	$Nuni='010000000000';
	if(isset($_REQUEST["uni"])){
				$Labeluni = 'Formulário de Unidade - N° ' . $_REQUEST["uni"];
				$Nuni=$_REQUEST["uni"];
	}
	else{
				$Labeluni = 'Formulário de Unidades';
	}		
	
?>	

<?php
	$id_unidade=0;
	$unidade='';
	$lat='';
	$lng='';			
	if ($Nuni>0){
		$sql = "SELECT * FROM db_atendimento.tb_unidade WHERE (id_unidade=". $Nuni.");";
		$rs_access=$connect->prepare($sql);
		if($rs_access->execute()){
			$resultados = $rs_access->rowCount();
			if($resultados>=1){
				if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
					$id_unidade=$registro_access->id_unidade;
					$unidade=$registro_access->id_unidade . ' - ' .$registro_access->unidade;
					$lat=$registro_access->latitude;
					$lng=$registro_access->longitude;
				}
			}
		}
	}	
				
?>	

</head>
<body onload="atualiza(<?php echo $lat;?>,<?php echo $lng;?>)" >

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
				<!-- *************************************************************************************************************** -->
				<!-- ***************************                 FORMULARIO                ***************************************** -->
				<!-- *************************************************************************************************************** -->
				
				<div class="col-lg-8">
				
					<!-- PANEL MAP -->				
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-edit fa-fw"></i> <?php echo $Labelusu;?>
                        </div>
                        <div class="panel-body">
							<div id="map_canvas" style="height:400px; margin:5px 0px;"></div><br>
							<table  style="width:100%">
								<tr>
									<td><label>Latitude: </label><input type="text" name="latitude" value="" id="MyLat" /></td>
									<td><label>Longitude: </label><input type="text" name="longitude" value="" id="MyLng" ></td> 
								</tr>
							</table>
                        </div>
                    </div>
                    <!-- PANEL DADOS -->

                    <div class="panel panel-default">
                        <div class="panel-body">
							<div class="form-group">
	
									
								<form name="fusu" method=post action="?SAVE= <? echo $Nuni; ?> ">
									<label>Unidade: </label> <?php echo $unidade;?>  <br>
									<br><label>Latitude:  </label><?php echo $lat;?> <br>
									<br><label>Longitude: </label><?php echo $lng;?> <br>
									<input type="hidden" name="unidade_db" value="<?php echo $id_unidade;?>" data-rule-integer="true" id="unidade_db" class="form-control"  />
									<input type="hidden" name="lat_db"     value="<?php echo $lat;?>"        data-rule-integer="true" id="lat_db" class="form-control"  />
									<input type="hidden" name="lng_db"     value="<?php echo $lng;?>"        data-rule-integer="true" id="lng_db" class="form-control"  />
									
                    				<br><button type="submit" class="btn btn-outline btn-primary">Salvar</button>			
								</form>				
							</div>
												
			
								<?php
								//---------------------------
								//SALVAR USUARIO EXISTENTE
									$v_unidade_db = '';
									$v_lat_db = '';
									$v_lng_db = '';
									if(isset($_REQUEST["SAVE"])){
										if(isset($_POST["unidade_db"])){$v_unidade_db =$_POST["unidade_db"];};
										if(isset($_POST["lat_db"]))    {$v_lat_db     =$_POST["lat_db"];};
										if(isset($_POST["lng_db"]))    {$v_lng_db     =$_POST["lng_db"];};
									
										$sql = "update db_atendimento.tb_unidade set latitude = '". $v_lat_db ."', 
																					 longitude  = '" .$v_lng_db . "',
																					 datahora_cadastro  = now() 
												where (id_unidade = " . $v_unidade_db . ")"; 
										$rs_access=$connect->prepare($sql);
										if($rs_access->execute()){
											echo 'Dados da Unidade alterado com sucesso.';	
											header('location: cad_unidade.php?uni='. $_REQUEST["SAVE"] );
										}												 
										else{
											echo 'Erro ao alterar dados da Unidade.';		
										    
										}												
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
                            <i class="fa fa-user fa-fw"></i> Unidades
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
								<?PHP
								$sql = "SELECT * FROM db_atendimento.tb_unidade;";
								$rs_access=$connect->prepare($sql);
								if($rs_access->execute()){
								$resultados = $rs_access->rowCount();
									if($resultados>=1){
										while($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){ 
										?>
											<a href=<? echo 'cad_unidade.php?uni=' . $registro_access->id_unidade; ?> class="list-group-item">
												<? echo $registro_access->id_unidade . ' - ' . $registro_access->unidade; ?>
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