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

		<DIV style="text-align:center"><H5>COMPROVANTE DE ENTREGA DE EQUIPAMENTO</H5></div>
  
  
  
  
  <?PHP

	
	$NTKT='0';
	if(isset($_REQUEST["n"])){ $NTKT=$_REQUEST["n"]; };
						
			
			
	if ($NTKT>0){
		$sql = "SELECT tb_atendimento.status_atend, tb_atendimento.cod, tb_atendimento.tipo, tb_atendimento_tipo.desc_tipo, tb_atendimento.doc_1, tb_atendimento.doc_1_dt, tb_atendimento.descricao, tb_atendimento.usu, tb_atendimento.solicitante, tb_atendimento.computador, tb_atendimento.local, tb_unidade.unidade, tb_atendimento.id_comput
		        FROM (tb_atendimento LEFT JOIN tb_atendimento_tipo ON tb_atendimento.tipo = tb_atendimento_tipo.tipo) LEFT JOIN tb_unidade ON tb_atendimento.local = tb_unidade.id_unidade
		        WHERE (tb_atendimento.cod=". $NTKT.");";
		$rs_access=$connect->prepare($sql);
		if($rs_access->execute()){
			$resultados = $rs_access->rowCount();
			if($resultados>=1){
				if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
					
					$date=date_create($registro_access->doc_1_dt);
					echo '<div style="margin-left:100px;margin-top:30px;">';
					
						echo '<label>Chamado n°: </label>' . $registro_access->cod . '<br><br>';
						echo '<label>Data: </label>' . date_format($date,"d-m-Y") . '<br><br>';
						echo '<label>Problema relatado: </label>' . $registro_access->desc_tipo . ' (Tipo:' . $registro_access->tipo .') - ';
		    			echo $registro_access->descricao . '<br><br>';
        	            echo '<label>Solicitante:</label>' . $registro_access->solicitante .'<br>';                     
        	            echo '<label>Unidade:</label>' . $registro_access->local . ' - ' . $registro_access->unidade .'<br><br>';            
				
					echo '<br><br><br><br>';
					
					echo $registro_access->doc_1;
					
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
