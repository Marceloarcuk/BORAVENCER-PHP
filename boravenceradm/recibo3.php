<?
ob_start();

	include '../conect.php';


?>
<html lang="en">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
		<link rel="stylesheet" type="text/css" href="comprova.css" />
		<title>Sistema de Atendimento DITI</title>
	</head>
	<body>
  
	<header>
		<br>  <br>  <br>  <br>  
		<table border=0 width=100%>
			<tr>
				<td width=5%><br><img  src="../img/brasao.png" alt=""  height="85" width="70"></td>
				<td width=90% >
					<DIV style="text-align:center" >	 
						<strong><font size="2">GOVERNO DO DISTRITO FEDERAL</font></strong><br>
						<font size="2">Secretaria de Estado de Políticas para Crianças Adolescentes e Juventude do Distrito Federal</font><br>
						<font size="2">Subsecretaria de Administração Geral</font><br>
						<font size="2">Coordenação Administrativa</font><br>
						<font size="2">Diretoria de Informática e Tecnologia da Informação</font><br>
					</div>
				</td>

			</tr>  
		</table>
	</header>

	<body>
		<BR><BR>
		  <?PHP
			$NTKT='0';
			if(isset($_REQUEST["n"])){ $NTKT=$_REQUEST["n"]; };
			if ($NTKT>0){
				$sql = "SELECT cod_visit, datahora_visit, local_visit, doc_visit, doc_visit_dt, unidade
						FROM tb_visita LEFT JOIN tb_unidade ON tb_visita.local_visit = tb_unidade.id_unidade
						WHERE (tb_visita.cod_visit=". $NTKT.");";
				$rs_access=$connect->prepare($sql);
				if($rs_access->execute()){
					$resultados = $rs_access->rowCount();
					if($resultados>=1){
				if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
							echo '<DIV style="text-align:center"><H5>Relatório de Visita n°' . $registro_access->cod_visit . '</H5></div>';
							$date=date_create($registro_access->datahora_visit);
							echo '<div style="margin-left:100px;margin-top:30px;">';
		        	            echo '<label>Unidade:</label>' . $registro_access->local_visit . ' - ' . $registro_access->unidade .'<br>';            
								echo '<label>Data: </label>' . date_format($date,"d-m-Y");
							echo '<br><br><br><br>';
							echo html_entity_decode($registro_access->doc_visit);
							echo '</div>';
						}
					}
				}
			}		
						?>	
    
		<DIV style="text-align:center">
					<br><br><br><br><br>
			<H6>ASSINATURA<br><br>MATRICULA: </H6>
		</div>    

    
		<SCRIPT LANGUAGE="JavaScript">
			window.print();
			//window.history.back();
		</SCRIPT>   
	</body>
</html>
<?
  ob_flush();
?>
