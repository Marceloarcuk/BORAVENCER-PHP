<?php
    ob_start();
?>
<?php
     //session_destroy();

    session_start();
	if ( !isset($_SESSION['emailuser'])) {
		session_destroy();
		unset($_SESSION['senhauser']);
		unset($_SESSION['emailuser']);
		unset($_SESSION['cpfuser']);
		unset($_SESSION["id_cri"]);
		unset($_SESSION["nome_cri"]);
		unset($_SESSION["sis_dt_insert_cri"]);
		unset($_SESSION["idfacebook"]);
		unset($_SESSION['facebook_access_token']);
		unset($_SESSION['cpf_cri']);
		header('location:form1.php');
	}		
	if ( !isset($_SESSION['id_cri'])) {
		$_SESSION["id_cri"]='0';
    }

    //Includes obrigatórios

    include('@main_scripts.php');
    include('lib/funcoes.php');
    include('conection.php');

	
	
//*************************************************************************	
//***** VISUALIZAR ANTES DE INSERIR E ALIMENTA CAMPOS NO FORMULÁRIO ****	
//*************************************************************************	
    if(!isset($_REQUEST['inscrever']) || $_REQUEST['inscrever']!=true )
    {
		$RegNovo=True;

		//------------------------------------------------
		//carrega campos tb_crianca
		$rs_access=$conection->prepare("SELECT * FROM tb_crianca where id_cri='" .$_SESSION["id_cri"] . "';");
		$registro_access = ($rs_access->execute()) ? $rs_access->fetchAll() : false;
		if ($registro_access){
			$RegNovo=False;
			$_SESSION["id_cri"]            = "";
			foreach ($registro_access as $tb_crianca);
			$_SESSION["id_cri"]            = $tb_crianca['id_cri'];
			$_SESSION["nome_cri"]          = $tb_crianca['nome_cri'];
			$_SESSION["cpf_cri"]           = $tb_crianca['cpf_cri'];
			$_SESSION["sis_dt_insert_cri"] = $tb_crianca['sis_dt_insert_cri'];
			$cpf_cri = $tb_crianca['cpf_cri'];;
			$rg_cri  = $tb_crianca['rg_cri'];;
			$_SESSION['novoReg']=false;
		}
		else
		{
			$_SESSION['novoReg']=true;
			$cpf_cri = "";
			$rg_cri = "";
		};
		//------------------------------------------------
		//carrega campos tb_crianca_escola
		$v_formacao_escola       = "";    $v_qd_series_pub_escola = "";    $v_nota_mat_escola        = "";    $v_univesidade_part_escola      = "";
		$v_instituicao_escola    = "";    $v_ano_formacao         = "";    $v_nota_port_escola       = "";    $v_nome_univesidade_part_escola = "";
		$v_rede_escola           = "";    $v_turno_escola	      = "";    $v_rede_comp_pub_escola   = "";    $v_nome_univesidade_pub_escola  = "";
		$v_qd_series_part_escola = "";    $v_serie_escola         = "";    $v_univesidade_pub_escola = "";
		$rs_access=$conection->prepare("SELECT * FROM tb_crianca_escola where id_cri='" . $_SESSION["id_cri"] . "';");
		if($rs_access->execute()){
			if($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
				$v_formacao_escola       = $registro_access->formacao_escola      ;    $v_nota_mat_escola              = $registro_access->nota_mat_escola              ;
				$v_instituicao_escola    = $registro_access->instituicao_escola   ;    $v_nota_port_escola             = $registro_access->nota_port_escola             ;
				$v_rede_escola           = $registro_access->rede_escola          ;    $v_rede_comp_pub_escola         = $registro_access->rede_comp_pub_escola         ;
				$v_qd_series_part_escola = $registro_access->qd_series_part_escola;    $v_univesidade_pub_escola       = $registro_access->univesidade_pub_escola       ;
				$v_qd_series_pub_escola  = $registro_access->qd_series_pub_escola ;    $v_univesidade_part_escola      = $registro_access->univesidade_part_escola      ;
				$v_ano_formacao          = $registro_access->ano_formacao         ;    $v_nome_univesidade_part_escola = $registro_access->nome_univesidade_part_escola ;
				$v_turno_escola			 = $registro_access->turno_escola		  ;    $v_nome_univesidade_pub_escola  = $registro_access->nome_univesidade_pub_escola	;
				$v_serie_escola          = $registro_access->serie_escola         ;
			}
		};

		//------------------------------------------------
		//carrega campos tb_crianca_projeto_quesito_resp
		$v_Q_1_1  = "";    $v_Q_4_1  = "";    $v_Q_7_1  = "";    $v_Q_9_2  = "";    $v_Q_12_2 = "";
		$v_Q_1_2  = "";    $v_Q_4_2  = "";    $v_Q_7_2  = "";    $v_Q_10_1 = "";    $v_Q_13_1 = "";
		$v_Q_2_1  = "";    $v_Q_5_1  = "";    $v_Q_8_1  = "";    $v_Q_10_2 = "";    $v_Q_13_2 = "";
		$v_Q_2_2  = "";    $v_Q_6_1  = "";    $v_Q_8_2  = "";    $v_Q_11_1 = "";    $v_Q_14_1 = "";
		$v_Q_3_1  = "";    $v_Q_6_2  = "";    $v_Q_9_1  = "";    $v_Q_12_1 = "";    $v_Q_14_2 = "";

		$rs_access=$conection->prepare("SELECT * FROM tb_crianca_projeto_quesito_resp where id_cri='" . $_SESSION["id_cri"] . "' order by id_quesito;");
		if($rs_access->execute()){
			while ($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
				$quesito = $registro_access->id_quesito;
				switch($quesito){
					case 1  : $v_Q_1_1       = $registro_access->desc_resposta;
							  $v_Q_1_2       = $registro_access->desc_resposta_01;
					case 2  : $v_Q_2_1       = $registro_access->desc_resposta;
							  $v_Q_2_2       = $registro_access->desc_resposta_02;
					case 3  : $v_Q_3_1       = $registro_access->desc_resposta;
					case 4  : $v_Q_4_1       = $registro_access->desc_resposta;
							  $v_Q_4_2       = $registro_access->desc_resposta_01;
					case 5  : $v_Q_5_1       = $registro_access->desc_resposta;
					case 6  : $v_Q_6_1       = $registro_access->desc_resposta;
							  $v_Q_6_2       = $registro_access->desc_resposta_01;
					case 7  : $v_Q_7_1       = $registro_access->desc_resposta;
							  $v_Q_7_2       = $registro_access->desc_resposta_01;
					case 8  : $v_Q_8_1       = $registro_access->desc_resposta;
							  $v_Q_8_2       = $registro_access->desc_resposta_01;
					case 9  : $v_Q_9_1       = $registro_access->desc_resposta;
							  $v_Q_9_2       = $registro_access->desc_resposta_01;
					case 10 : $v_Q_10_1      = $registro_access->desc_resposta;
							  $v_Q_10_2      = $registro_access->desc_resposta_01;
					case 11 : $v_Q_11_1      = $registro_access->desc_resposta;
					case 12 : $v_Q_12_1      = $registro_access->desc_resposta;
							  $v_Q_12_2      = $registro_access->desc_resposta_01;
					case 13 : $v_Q_13_1      = $registro_access->desc_resposta;
							  $v_Q_13_2      = $registro_access->desc_resposta_01;
					case 14 : $v_Q_14_1      = $registro_access->desc_resposta;
						   	  $v_Q_14_2      = $registro_access->desc_resposta_01;
				}
			}
		}
//---------------------------------------------------------------------------------------------------------------------------------------------------
	};
				
	
//*************************************************************************	
//***** INSERIR ****	
//*************************************************************************	
    if(isset($_REQUEST['inscrever']) && $_REQUEST['inscrever']==true )
    {
/*			echo "<br> id_cri: " . $_SESSION["id_cri"]      ;
			echo "<br> nome_cri: " . $_SESSION["nome_cri"]    ;
			echo "<br> cpf_cri: " . $_SESSION["cpf_cri"]     ;
			echo "<br> cpfuser: " . $_SESSION["cpfuser"]     ;
			echo "<br> senhauser: " . $_SESSION["senhauser"]   ;
			echo "<br> emailuser: " . $_SESSION["emailuser"]   ;
			echo "<br> nome: " . $_POST["nome"]   ;
			echo "<br> cpfcri: " . $_POST["cpfcri"]   ;
			echo "<br> emailform: " . $_POST["email"]   ;
			echo "<br> idfacebook : " . $_SESSION["idfacebook"] . "  -  " . $_SESSION["facebook_access_token"] ;
	*/
	
			$NovoReg = false;;
			if ($_SESSION["id_cri"]=="0") {$NovoReg = true;};
			
			$NCodCri = '0';
			$NCodCri_cpf = "";
		
			if (!isset($_SESSION['cpfuser']) || $_SESSION['cpfuser']=="")  {
				$_SESSION['cpfuser']=$_POST['cpfcri'];
			}; 
			if (isset($_SESSION['cpfuser'])) {$NCodCri_cpf = $_SESSION['cpfuser'];}; 

			$NCodCri_email = "";
			if (isset($_POST['email']))  {$NCodCri_email = $_POST['email'];};
			$NCodCri_face = "";
			if (isset($_SESSION["idfacebook"]))  {$NCodCri_face = $_SESSION["idfacebook"];};
			
			
			$rs_access=$conection->prepare("SELECT id_cri FROM tb_crianca where cpf_cri='" . $NCodCri_cpf . "';");
			if($rs_access->execute()){
				if ($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
					$NCodCri = $registro_access->id_cri; 
					
				}
			};
			
			//***********************************************************************
			// CONVERTER O CAMPO TURNO MAT VESP NOT PARA INSERIR NO DB TB_CRIANCA				
			//***********************************************************************
			$B_deseja_estudar_turno_cri1 = "";
			$B_deseja_estudar_turno_cri2 = "";
			
			if ($_POST['mat']  == "MAT")  {$B_deseja_estudar_turno_cri1 = "MAT";}
			if ($_POST['vesp'] == "VESP") {
				if ($B_deseja_estudar_turno_cri1 == "") {$B_deseja_estudar_turno_cri1 = "VESP";}
				else {$B_deseja_estudar_turno_cri2 = "VESP";}
			}
			if ($_POST['not'] == "NOT") {
				if ($B_deseja_estudar_turno_cri1 == "") {$B_deseja_estudar_turno_cri1 = "NOT";}
				else if ($B_deseja_estudar_turno_cri2 == "") {$B_deseja_estudar_turno_cri2 = "NOT";}
			}

			//***********************************************************************
			// INSERIR NO DB TB_CRIANCA				
			//***********************************************************************
			$PodegravarTabelas = false;
			$MensGravacao = 'err';
			if ($_SESSION['novoReg']){
					try{
                        //verifica cpf
						$rs_access=$conection->prepare("SELECT * FROM tb_crianca where cpf_cri='" . $NCodCri_cpf . "';");
						if($rs_access->execute()){
							if ($registro_access= $rs_access->fetch(PDO::FETCH_OBJ)){
								header('location:form3.php?mens=CPF já está cadastrado!'); 
								exit;
							}
						};
						//-------------------------------------
						//NOVO ID CRIANCA
						$rs_access_escola=$conection->prepare("SELECT max(id_cri) AS NOVOCOD FROM tb_crianca;");
						$NCodCri = '0';
						if($rs_access_escola->execute()){ 
							if ($registro_access_escola= $rs_access_escola->fetch(PDO::FETCH_OBJ)){ 
								$NCodCri = $registro_access_escola->NOVOCOD + 1;
							}
						}
						//-------------------------------------
						//INSERIR NOVA CRIANCA
						if($NCodCri_face != ''){
							$senhacri=md5($_SESSION['senhauser']);
						}
						else{
							$senhacri='';
						}
						
						$sql="INSERT INTO tb_crianca (id_cri, nome_cri, cpf_cri, rg_cri, rg_cri_ssp, titulo_eleitor_cri, nacionalidade_cri, naturalidade_cri, 
												end_cri, end_comp_cri, end_bairro_cri, end_uf_cri, end_cep_cri, fone_cel_cri, fone_cel_cri1, 
												whatsapp_cri, email_cri, dt_nasc_cri, id_raca, pass_cri, cidade_cri, id_facebook, estado_civil_cri, 
												beneficiario_cri, nome_p_beneficiario_cri, cadunico_cri, inscricao_enem_cri, deseja_estudar_turno_cri1, 
												deseja_estudar_turno_cri2, deseja_estudar_macroregio_cri1) 
												VALUES (
												'".$NCodCri."', '".strtoupper($_POST['nome'])."', '".$NCodCri_cpf ."', '".$_POST['rg']."', '".$_POST['orgao']."',
												'".$_POST['tituloe']."', '".$_POST['nacional']."', '".$_POST['natural']."', '".$_POST['end']."',
												'".$_POST['end_comp']."', '".$_POST['bairro']."', '".$_POST['uf']."', '".$_POST['cep']."', '".$_POST['cel']."', '".$_POST['cel1']."',
												'".$_POST['whats']."', '".$_SESSION['emailuser']."' , '".$_POST['nascimento']."', '".$_POST['raca']."', '".$senhacri."',
												'".$_POST['cidade']."', '".$_SESSION['idfacebook']."', '".$_POST['estadoCivil']."', '".$_POST['progGdf']."', '".$_POST['nomeProgGdf']."',
												'".$_POST['cadUnico']."' , '".$_POST['insc_enem']."', '".$B_deseja_estudar_turno_cri1."', '".$B_deseja_estudar_turno_cri2."', '".$_POST['macroreg']."' ) ;"; 
							$stmt = $conection->prepare($sql);
							if($stmt->execute()){ 
								$PodegravarTabelas = true; 
								$MensGravacao = 'Cadastro BORAVENCER completado com sucesso!';
							};
					}catch(Exception $e_i){
						$PodegravarTabelas = false;
					}	
			}
			//***********************************************************************
			// EDITAR NO DB	TB_CRIANCA				
			//***********************************************************************
			else{
					try{
						$sql	= " UPDATE tb_crianca SET
											nome_cri                        = '" . strtoupper($_POST['nome'])   ."',
											cpf_cri                         = '" . $NCodCri_cpf             ."',
											rg_cri                          = '" . $_POST['rg']                 ."',
											rg_cri_ssp                      = '" . $_POST['orgao']              ."',
											titulo_eleitor_cri              = '" . $_POST['tituloe']            ."',
											nacionalidade_cri               = '" . $_POST['nacional']           ."',
											naturalidade_cri                = '" . $_POST['natural']            ."',
											end_cri                         = '" . $_POST['end']                ."',
											end_comp_cri                    = '" . $_POST['end_comp']           ."',
											end_bairro_cri                  = '" . $_POST['bairro']             ."',
											end_uf_cri                      = '" . $_POST['uf']                 ."',
											end_cep_cri                     = '" . $_POST['cep']                ."',
											fone_cel_cri                    = '" . $_POST['cel']                ."',
											fone_cel_cri1                   = '" . $_POST['cel1']               ."',
											whatsapp_cri                    = '" . $_POST['whats']              ."',
											email_cri                       = '" . $_SESSION['emailuser']       ."',
											dt_nasc_cri                     = '" . $_POST['nascimento']         ."',
											id_raca                         = '" . $_POST['raca']               ."',
											cidade_cri                      = '" . $_POST['cidade']             ."',
											estado_civil_cri                = '" . $_POST['estadoCivil']        ."',
											beneficiario_cri                = '" . $_POST['progGdf']            ."',
											nome_p_beneficiario_cri         = '" . $_POST['nomeProgGdf']        ."',
											cadunico_cri                    = '" . $_POST['cadUnico']           ."',
											inscricao_enem_cri              = '" . $_POST['insc_enem']          ."',
											deseja_estudar_turno_cri1       = '" . $B_deseja_estudar_turno_cri1 ."',
											deseja_estudar_turno_cri2       = '" . $B_deseja_estudar_turno_cri2 ."',
											deseja_estudar_macroregio_cri1	= '" . $_POST['macroreg'] ."' WHERE id_cri='" . $NCodCri . "';";
//echo "<br> <br> sql : <br><br>" . $sql;
						$stmt = $conection->prepare($sql);
						if($stmt->execute()){
							$PodegravarTabelas = true;
							$MensGravacao = 'Alteração do cadastro BORAVENCER completado com sucesso!';
						}
					}catch(PDOException $e_i){
						$PodegravarTabelas = false;
					}	

			}
			//***********************************************************************
			// GRAVAR NO DB TB_CRIANCA_ESCOLA
			//***********************************************************************
			if ($PodegravarTabelas) {

					$GravouEscola = false;
					try{
						//-------------------------------------
						//NOVO ID ESCOLA
						$rs_access_escola=$conection->prepare("SELECT max(id_escola) AS NOVOCOD FROM tb_crianca_escola;");
						$NCodEscola = '0';
						if($rs_access_escola->execute()){ 
							if ($registro_access_escola= $rs_access_escola->fetch(PDO::FETCH_OBJ)){ 
								$NCodEscola = $registro_access_escola->NOVOCOD + 1;
							}
						}
						//-------------------------------------
						//EXCLUIR ESCOLA ATUAL
						$sql="DELETE FROM tb_crianca_escola WHERE id_cri = '".$NCodCri ."';"; 
						$stmt = $conection->prepare($sql);
						if($stmt->execute()){
						//-------------------------------------
						//INSERIR NOVA ESCOLA
							$sql="INSERT INTO db_boravencer.tb_crianca_escola (id_escola, id_cri, instituicao_escola,  serie_escola, 
										formacao_escola, rede_escola, rede_comp_pub_escola, nota_mat_escola, nota_port_escola, 
										univesidade_pub_escola, univesidade_part_escola, nome_univesidade_pub_escola, 
										nome_univesidade_part_escola, qd_series_pub_escola, qd_series_part_escola, ano_formacao, turno_escola) 
								VALUES ('".$NCodEscola ."', '".$NCodCri ."', '".$_POST[escola] ."', '". $_POST[serie] ."', '". $_POST[escolaridade] ."', 
										'". $_POST[rede] ."', '". $_POST[ensinoSup] ."', '". $_POST[matematica] ."', '". $_POST[portugues] ."', '". $_POST[redeUnip] ."', 
										'". $_POST[redeUnipar] ."', '". $_POST[universidadep] ."', '". $_POST[universidadepar] ."', '". $_POST[anosPuc] ."', 
										'". $_POST[anosPri] ."', '". $_POST[conclusaoMedio] ."', '". $_POST[turno] ."' ) ;"; 
	
							$stmt = $conection->prepare($sql);
							if($stmt->execute()){ $GravouEscola = true; };
						}
					}catch(Exception $e_i){
						$GravouEscola = false;
					}		
			//***********************************************************************
			// GRAVAR NO DB TB_CRIANCA_PROJETO_QUESITO_RESP
			//***********************************************************************
					
					$GravouQuestionario = true;
					try{
						//-------------------------------------
						//EXCLUIR ESCOLA ATUAL
						$sql="DELETE FROM tb_crianca_projeto_quesito_resp WHERE id_cri = '".$NCodCri ."';"; 
						$stmt = $conection->prepare($sql);
						if($stmt->execute()){
						//-------------------------------------
						//INSERIR NOVA ESCOLA
							$NCodProj = '10';
							$grv_insert = true;
							for ($NCodQuesito = 1; $NCodQuesito <= 14; $NCodQuesito++){
								$desc_resposta = "";
								$desc_resposta1 = "";
								$desc_resposta2 = "";
								switch($NCodQuesito){
									case 1  : $desc_resposta = $_POST['progv_Q_1_1'];   $desc_resposta1 = $_POST['v_Q_1_2'];    	break;			
									case 2  : $desc_resposta = $_POST['progv_Q_2_1'];   $desc_resposta2 = $_POST['progv_Q_2_2'];    break;				
									case 3  : $desc_resposta = $_POST['v_Q_3_1'];    	                                            break;
									case 4  : $desc_resposta = $_POST['progv_Q_4_1'];   $desc_resposta1 = $_POST['v_Q_4_2'];    	break;			
									case 5  : $desc_resposta = $_POST['v_Q_5_1'];    						                        break;
									case 6  : $desc_resposta = $_POST['progv_Q_6_1'];   $desc_resposta1 = $_POST['v_Q_6_2'];    	break;			
									case 7  : $desc_resposta = $_POST['progv_Q_7_1'];   $desc_resposta1 = $_POST['v_Q_7_2'];    	break;			
									case 8  : $desc_resposta = $_POST['progv_Q_8_1'];   $desc_resposta1 = $_POST['v_Q_8_2'];    	break;			
									case 9  : $desc_resposta = $_POST['progv_Q_9_1'];   $desc_resposta1 = $_POST['v_Q_9_2'];    	break;			
									case 10 : $desc_resposta = $_POST['progv_Q_10_1'];  $desc_resposta1 = $_POST['v_Q_10_2'];   	break;			
									case 11 : $desc_resposta = $_POST['progv_Q_11_1'];    						                    break;
									case 12 : $desc_resposta1 = $_POST['progv_Q_12_1']; $desc_resposta = $_POST['v_Q_12_2'];   		break;		
									case 13 : $desc_resposta = $_POST['progv_Q_13_1'];  $desc_resposta1 = $_POST['v_Q_13_2'];   	break;			
									case 14 : $desc_resposta = $_POST['progv_Q_14_1'];  $desc_resposta1 = $_POST['v_Q_14_2'];       break;
								}
     							$sql="INSERT INTO tb_crianca_projeto_quesito_resp (id_proj, id_quesito, id_cri, desc_resposta, desc_resposta_01, desc_resposta_02) 
								VALUES ('".$NCodProj ."', '".$NCodQuesito ."', '".$NCodCri ."', '". $desc_resposta ."', '". $desc_resposta1 ."', '". $desc_resposta2 ."' ) ;"; 
								$stmt = $conection->prepare($sql);
								if(!$stmt->execute()){$grv_insert = false;};
							};
							$GravouQuestionario = $grv_insert;
						};
					}catch(Exception $e_i){
						echo "Falha: " . $e_i->getMessage();
						$GravouQuestionario = false;
					}						
					
					if ($GravouEscola == false || $GravouQuestionario == false) {$MensGravacao = 'err';};

					
					
			} //if ($PodegravarTabelas) 
			$rs=$conection->prepare("SELECT * FROM tb_crianca where id_cri='" .$NCodCri . "';");
			$reg_access = ($rs->execute()) ? $rs->fetch(PDO::FETCH_OBJ) : false;
			if ($reg_access){	
				$_SESSION["id_cri"]=$reg_access->id_cri;
				$_SESSION["nome_cri"]=$reg_access->nome_cri;
				$_SESSION["cpf_cri"]=$reg_access->cpf_cri;
				$_SESSION["sis_dt_insert_cri"]=$reg_access->sis_dt_insert_cri;
				$_SESSION['emailuser']=$reg_access->email_cri;
			//if$_SESSION["sis_dt_insert_cri"] $MensGravacao <> 'Erro no seu cadastro!!!';
			}
			header('location:inside.php?mens='.$MensGravacao);	

		
	
    }	
	
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
     <title><?=$titulo?></title>
    <!-- include dos links e scripts (bootstrap e js) -->
</head>
<body>
<!-- inicio do cabeçalho -->
	<div id="container"> 
		<div class="row">
			<div class="col-lg-4 col-md-4 col-xs-12 col-lg-offset-0 col-md-offset-0 ">
				&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<img src="imagens/logo_gov_bsb.png" height="40" width="150"/>
			</div>
			<div class="col-lg-3 col-md-6 col-xs-12 text-center">
				<h6><b>&nbsp&nbsp&nbsp&nbsp&nbsp Secretaria de Estado de Políticas Públicas para Crianças, Adolescentes e Juventude</b></h6>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 col-xs-12  text-center ">
					<hr>
					<h4><b> Subsecretaria da Juventude  #BoraVencerIntensivão </b></h4>
					<h4><b>  Inscrição para o Intensivão </b></h4>
				</div>
			</div>
		</div>
	</div>
<!-- fim do cabeçalho -->
<!-- Inicio do conteúdo -->
<form role="form" method="post" name="form1" action="?inscrever=true">
<!-- ---------------------------------------------------------------------------------------------->
<!-- -----  DADOS PESSOAIS E ESCOLARES  ----------------------------------------------------------->
<!-- ---------------------------------------------------------------------------------------------->
    <div class="container">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <b>Formulário de inscrição</b>
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-12 text-center">
                            <div class="row">
                                <hr>
                                <h5><b>Dados pessoais</b></h5>
                                <hr>
                            </div>
                        </div>
						
<!-- ************************************************************************************************************************************************* -->
						<div>                                                    <!-- LAYOUT ETAPA 1 - DADOS PESSOAIS -->
                            <div class="row">
								<div class="col-lg-12">
                                    <div class="form-group">
										<div class="col-lg-4 col-md-4 col-xs-12">    <!-- Nome completo * -->
												<label>Nome completo *</label>
												<input class="form-control text-uppercase" name="nome" maxlength="200"
													<?php if (!$RegNovo){echo "value='" . $_SESSION["nome_cri"] . "'";} ?>
												>
										</div>
										<div class="col-lg-3 col-md-3 col-xs-12">    <!-- Data nascimento * -->
												<label>Data de nascimento*</label>
												<input type="date" class="form-control" name="nascimento"
													<?php if (!$RegNovo){echo "value='" . $tb_crianca['dt_nasc_cri'] . "'";} ?>
												>
										</div>
										<div class="col-lg-2 col-md-2 col-xs-12">    <!-- CPF * -->
												<label>CPF*</label>
												<input class="form-control" id="ex3" placeholder="Somente números..." name="cpfcri"
													maxlength="11" 
													<?php if (!$RegNovo){echo "value='" . $tb_crianca['cpf_cri'] . "'";} 
														  else {if(isset($_SESSION['cpfuser'])) {echo "value='" . $_SESSION['cpfuser'] . "'"; }}; ?>
													
													
												>
										</div>
										<div class="col-lg-3 col-md-2 col-xs-12">    <!-- CPF * -->
										<?php
											if (isset($_GET['mens']))
											{
												echo '<br><b><p class="text-danger">' . $_GET['mens'] . '</p></b>';
											}
										?>
										</div>
									</div>		
                                </div>
                            </div>
                            <br>
							<div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-3 col-xs-12 col-md-3">    <!-- Titulo de Eleitor -->
                                            <label>Titulo de Eleitor</label><br> 
                                            <input class="form-control" id="ex3" placeholder="Somente números..." maxlength="20" name="tituloe"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['titulo_eleitor_cri'] . "'";} ?>
                                            >
                                        </div>
                                        <div class="col-lg-3 col-xs-12 col-md-3">    <!-- RG* -->
                                            <div class="form-group">
                                                <label>RG*</label>
                                                <input class="form-control" id="ex3" placeholder="RG..." name="rg" maxlength="14"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['rg_cri'] . "'";} ?>
                                                >
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-xs-12 col-md-2">    <!-- Órgão expedidor* -->
                                            <div class="form-group">
                                                <label>Órgão expedidor*</label>
                                                <input class="form-control text-uppercase" id="ex3" placeholder="Ex: SSP-DF ..." name="orgao" maxlength="9"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['rg_cri_ssp'] . "'";} ?>
                                                >
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-xs-12 col-md-3">    <!-- Não possuo RG* -->
                                            <div class="checkbox">
                                                <label>
                                                    <br> 
													<input type="checkbox"  name="naorg" value="1"
														<?php if (!isset($rg_cri) || $rg_cri==""){echo checked( '1','1');} else {echo checked( '1','0');}; ?>
													>Não possuo RG*
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-5 col-md-4 col-xs-12">    <!-- Endereço* -->
                                            <label>Endereço*</label>
                                            <input type="text" class="form-control text-uppercase" name="end" maxlength="60"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['end_cri'] . "'";} ?>
                                            >
                                        </div>
                                        <div class="col-lg-3 col-md-2 col-xs-8">     <!-- complemento -->
                                            <label>Complemento</label>
                                            <input class="form-control text-uppercase" type="text" name="end_comp" maxlength="30"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['end_comp_cri'] . "'";} ?>
                                            >
                                        </div>
                                        <div class="col-lg-2 col-md-1 col-xs-5">     <!-- uf -->
                                            <label>UF*</label>
                                            <select class="form-control" name="uf" id="mySelect"  onchange="mudaBairro();">
												<?php if (!$RegNovo){ $uf= $tb_crianca['end_uf_cri'];} else { $uf= "DF";}?>
                                                <option value="0" <?php if(isset($uf)){echo selected( '0', $uf);} ?>></option>
                                                <option  value="DF" <?php if(isset($uf)){echo selected( 'DF', $uf);} ?>>DF</option>
                                                <option value="AC"  <?php if(isset($uf)){echo selected( 'AC', $uf); } ?>>AC</option>
                                                <option value="AL"  <?php if(isset($uf)){echo selected( 'AL', $uf); } ?>>AL</option>
                                                <option value="AM"  <?php if(isset($uf)){echo selected( 'AM', $uf); } ?>>AM</option>
                                                <option value="AP"  <?php if(isset($uf)){echo selected( 'AP', $uf); } ?>>AP</option>
                                                <option value="BA"  <?php if(isset($uf)){echo selected( 'BA', $uf); } ?>>BA</option>
                                                <option value="CE"  <?php if(isset($uf)){echo selected( 'CE', $uf); } ?>>CE</option>
                                                <option value="ES"  <?php if(isset($uf)){echo selected( 'ES', $uf); } ?>>ES</option>
                                                <option value="GO"  <?php if(isset($uf)){echo selected( 'GO', $uf); } ?>>GO</option>
                                                <option value="MA"  <?php if(isset($uf)){echo selected( 'MA', $uf); } ?>>MA</option>
                                                <option value="MG"  <?php if(isset($uf)){echo selected( 'MG', $uf); } ?>>MG</option>
                                                <option value="MS"  <?php if(isset($uf)){echo selected( 'MS', $uf); } ?>>MS</option>
                                                <option value="MT"  <?php if(isset($uf)){echo selected( 'MT', $uf); } ?>>MT</option>
                                                <option value="PA"  <?php if(isset($uf)){echo selected( 'PA', $uf); } ?>>PA</option>
                                                <option value="PB"  <?php if(isset($uf)){echo selected( 'PB', $uf); } ?>>PB</option>
                                                <option value="PE"  <?php if(isset($uf)){echo selected( 'PE', $uf); } ?>>PE</option>
                                                <option value="PI"  <?php if(isset($uf)){echo selected( 'PI', $uf); } ?>>PI</option>
                                                <option value="PR"  <?php if(isset($uf)){echo selected( 'PR', $uf); } ?>>PR</option>
                                                <option value="RJ"  <?php if(isset($uf)){echo selected( 'RJ', $uf); } ?>>RJ</option>
                                                <option value="RN"  <?php if(isset($uf)){echo selected( 'RN', $uf); } ?>>RN</option>
                                                <option value="RS"  <?php if(isset($uf)){echo selected( 'RS', $uf); } ?>>RS</option>
                                                <option value="RO"  <?php if(isset($uf)){echo selected( 'RO', $uf); } ?>>RO</option>
                                                <option value="RR"  <?php if(isset($uf)){echo selected( 'RR', $uf); } ?>>RR</option>
                                                <option value="SC"  <?php if(isset($uf)){echo selected( 'SC', $uf); } ?>>SC</option>
                                                <option value="SE"  <?php if(isset($uf)){echo selected( 'SE', $uf); } ?>>SE</option>
                                                <option value="SP"  <?php if(isset($uf)){echo selected( 'SP', $uf); } ?>>SP</option>
                                                <option value="TO"  <?php if(isset($uf)){echo selected( 'TO', $uf); }  ?>>TO</option>
                                            </select>
                                        </div>
										<div class='col-lg-2 col-md-2 col-xs-8'>	 <!-- bairro -->									
											<?php 
											if (!$RegNovo){$bairro = $tb_crianca['end_bairro_cri'];} 
											?>
											<div id='box-bairro'  style='display: block;'>
												<?php
													if(isset($uf) && $uf == 'DF'){
																echo "<div><label>Bairro*</label>";
																echo "<select name='bairro' class='form-control' >";
																	echo "<option value='' ></option>";
																	echo "<option value='BRASÍLIA'";
																			if(isset($bairro)){echo selected( 'BRASÍLIA', $bairro); }
																			echo ">Brasília</option>";
																	echo "<option value='GAMA'";
																			if(isset($bairro)){echo selected( 'GAMA', $bairro); }
																			echo ">Gama</option>";
																	echo "<option value='TAGUATINGA'";
																			if(isset($bairro)){echo selected( 'TAGUATINGA', $bairro); }
																			echo ">Taguatinga</option>";
																	echo "<option value='BRAZLÂNDIA'";
																			if(isset($bairro)){echo selected( 'BRAZLÂNDIA', $bairro); }
																			echo ">Brazlândia</option>";
																	echo "<option value='SOBRADINHO'";
																			if(isset($bairro)){echo selected( 'SOBRADINHO', $bairro); }
																			echo ">Sobradinho</option>";
																	echo "<option value='PLANALTINA'";
																			if(isset($bairro)){echo selected( 'PLANALTINA', $bairro); }
																			echo ">Planaltina</option>";
																	echo "<option value='PARANOÁ'";
																			if(isset($bairro)){echo selected( 'PARANOÁ', $bairro); }
																			echo ">Paranoá</option>";
																	echo "<option value='NÚCLEO BANDEIRANTE'";
																			if(isset($bairro)){echo selected( 'NÚCLEO BANDEIRANTE', $bairro); }
																			echo ">Núcleo Bandeirante</option>";
																	echo "<option value='CEILÂNDIA'";
																			if(isset($bairro)){echo selected( 'CEILÂNDIA', $bairro); }
																			echo ">Ceilândia</option>";
																	echo "<option value='GUARÁ'";
																			if(isset($bairro)){echo selected( 'GUARÁ', $bairro); }
																			echo ">Guará</option>";
																	echo "<option value='CRUZEIRO'";
																			if(isset($bairro)){echo selected( 'CRUZEIRO', $bairro); }
																			echo ">Cruzeiro</option>";
																	echo "<option value='SAMABAIA'";
																			if(isset($bairro)){echo selected( 'SAMABAIA', $bairro); }
																			echo ">Samambaia</option>";
																	echo "<option value='SANTA MARIA'";
																			if(isset($bairro)){echo selected( 'SANTA MARIA', $bairro); }
																			echo ">Santa Maria</option>";
																	echo "<option value='SÃO SEBASTIÃO'";
																			if(isset($bairro)){echo selected( 'SÃO SEBASTIÃO', $bairro); }
																			echo ">São Sebastião</option>";
																	echo "<option value='RECANTO DAS EMAS'";
																			if(isset($bairro)){echo selected( 'RECANTO DAS EMAS', $bairro); }
																			echo ">Recanto das Emas</option>";
																	echo "<option value='LAGO SUL'";
																			if(isset($bairro)){echo selected( 'LAGO SUL', $bairro); }
																			echo ">Lago Sul</option>";
																	echo "<option value='LAGO NORTE'";
																			if(isset($bairro)){echo selected( 'LAGO NORTE', $bairro); }
																			echo ">Lago Norte</option>";
																	echo "<option value='ÁGUAS CLARAS'";
																			if(isset($bairro)){echo selected( 'ÁGUAS CLARAS', $bairro); }
																			echo ">Águas Claras</option>";
																	echo"<option value='RIACHO FUNDO I'";
																			if(isset($bairro)){echo selected( 'RIACHO FUNDO I', $bairro); }
																			echo ">Riacho Fundo II</option>";
																	echo "<option value='SUDOESTE/OCTOGONAL'";
																			if(isset($bairro)){echo selected( 'SUDOESTE/OCTOGONAL', $bairro); }
																			echo ">Sudoeste/Octogonal</option>";
																	echo "<option value='VARJÃO'";
																			if(isset($bairro)){echo selected( 'VARJÃO', $bairro); }
																			echo ">Varjão</option>";
																	echo "<option value='PARKWAY'";
																			if(isset($bairro)){echo selected( 'PARKWAY', $bairro); }
																			echo ">ParkWay</option>";
																	echo "<option value='SCIA'";
																			if(isset($bairro)){echo selected( 'SCIA', $bairro); }
																			echo ">SCIA</option>";
																	echo "<option value='SOBRADINHO II'";
																			if(isset($bairro)){echo selected( 'SOBRADINHO II', $bairro); }
																			echo ">Sobradinho II</option>";
																	echo "<option value='JARDIM BOTÂNICO'";
																			if(isset($bairro)){echo selected( 'JARDIM BOTÂNICO', $bairro); }
																			echo ">Jardim Botânico</option>";
																	echo "<option value='ITAPOÃ'";
																			if(isset($bairro)){echo selected( 'ITAPOÃ', $bairro); }
																			echo ">Itapoã</option>";
																	echo "<option value='SIA'";
																			if(isset($bairro)){echo selected( 'SIA', $bairro); }
																			echo ">SIA</option>";
																	echo "<option value='VICENTE PIRES'";
																			if(isset($bairro)){echo selected( 'VICENTE PIRES', $bairro); }
																			echo ">Vicente Pires</option>";
																echo "</select></div>";
													}
												?>
											</div>
											<div id='box-bairro1'  style='display: block;'>
												<?php
													if(isset($uf) && $uf != 'DF'){
														echo    "<div><label>Bairro*</label>";
														echo    "<input class='form-control text-uppercase' type='text' name='bairro'></div>";
													}
												
												?>
											</div>
											<script>
											$("#box-bairro").css("display", "block");
											function mudaBairro() {
												var x = document.getElementById("mySelect").value;
												if(x=="DF"){
													$("#box-bairro").css("display", "block");
													document.getElementById("box-bairro").innerHTML =
														"<div>"+
														"	<label>Bairro*</label>" +
														"	<select name='bairro' class='form-control' >"+
														"		<option value='' ></option>"+
														"		<option value='BRASÍLIA'>Brasília</option>"+
														"		<option value='GAMA'>Gama</option>"+
														"	 	<option value='TAGUATINGA'>Taguatinga</option>"+
														"	 	<option value='BRAZLÂNDIA'>Brazlândia</option>"+
														"	 	<option value='SOBRADINHO'>Sobradinho</option>"+
														"		<option value='PLANALTINA'>Planaltina</option>"+
														"	 	<option value='PARANOÁ'>Paranoá</option>"+
														"		<option value='NÚCLEO BANDEIRANTE'>Núcleo Bandeirante</option>"+
														"	 	<option value='CEILÂNDIA'>Ceilândia</option>"+
														"	 	<option value='GUARÁ'>Guará</option>"+
														"		<option value='CRUZEIRO'>Cruzeiro</option>"+
														"		<option value='SAMABAIA'>Samambaia</option>"+
														"		<option value='SANTA MARIA'>Santa Maria</option>"+
														"	 	<option value='SÃO SEBASTIÃO'>São Sebastião</option>"+
														"		<option value='RECANTO DAS EMAS'>Recanto das Emas</option>"+
														"	 	<option value='LAGO SUL'>Lago Sul</option>"+
														"		<option value='RIACHO FUNDO I'>Riacho Fundo I</option>"+
														"		<option value='LAGO NORTE'>Lago Norte</option>"+
														"	 	<option value='CANDANGOLÂNDIA'>Candangolândia</option>"+
														"	 	<option value='ÁGUAS CLARAS'>Águas Claras</option>"+
														"		<option value='RIACHO FUNDO I'>Riacho Fundo II</option>"+
														"		<option value='SUDOESTE/OCTOGONAL'>Sudoeste/Octogonal</option>"+
														"		<option value='VARJÃO'>Varjão</option>"+
														"	 	<option value='PARKWAY'>ParkWay</option>"+
														"	 	<option value='SCIA'>SCIA</option>"+
														"	 	<option value='SOBRADINHO II'>Sobradinho II</option>"+
														"		<option value='JARDIM BOTÂNICO'>Jardim Botânico</option>"+
														"		<option value='ITAPOÃ'>Itapoã</option>"+
														"	   <option value='SIA'>SIA</option>"+
														"	   <option value='VICENTE PIRES'>Vicente Pires</option>"+
														"	</select>"+
														"</div>";
													$("#box-bairro1").css("display", "none");
												}
												else{
													$("#box-bairro1").css("display", "block");
													document.getElementById("box-bairro1").innerHTML =
														"<div>" +
														"<label>Bairro*</label>"+
														"<input class='form-control text-uppercase' type='text' name='bairro' >"+
														"</div>";
	            
													$("#box-bairro").css("display", "none");
												}
											}
											</script>
										</div>
                                    </div>
                                </div>
                            </div>
							<br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-3 col-md-2 col-xs-8">     <!-- cidade -->
                                            <label>Cidade*</label>
                                            <input class="form-control text-uppercase" type="text" name="cidade"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['cidade_cri'] . "'";} else {"value='BRASILIA'";} ?>
                                            >
                                        </div>
                                        <div class="col-lg-3 col-md-2 col-xs-8">     <!-- cep -->
                                            <label>CEP*</label>
                                            <input class="form-control" type="text" name="cep" maxlength="8"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['end_cep_cri'] . "'";} ?>
											>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-xs-8">     <!-- Naturalidade -->
											<label>Naturalidade:</label>
                                            <input type="text" class="form-control text-uppercase" name="natural"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['naturalidade_cri'] . "'";} else {"value='BRASILIA'";} ?>
											>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-xs-8">     <!-- Nacionalidade -->
                                            <label>Nacionalidade:</label>
                                            <input type="text" class="form-control text-uppercase" name="nacional"
  												<?php if (!$RegNovo){echo "value='" . $tb_crianca['nacionalidade_cri'] . "'";} else {"value='BRASIL'";} ?>
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>
							<br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-2 col-md-2 col-xs-8">     <!-- Telefone Celular* -->
                                            <label>Telefone Celular*</label>
                                            <input class="form-control" type="tel" name="cel"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['fone_cel_cri'] . "'";} ?>
                                            >
										</div>
                                        <div class="col-lg-2 col-md-2 col-xs-8">     <!-- Telefone Celular1* -->
                                            <label>Telefone Celular1</label>
                                            <input class="form-control" type="text" name="cel1"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['fone_cel_cri1'] . "'";} ?>
                                            >
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-xs-8">     <!-- Whatsapp -->
                                            <label>Whatsapp</label>
                                            <input class="form-control" type="text" name="whats"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['whatsapp_cri'] . "'";} ?>
                                            >
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-xs-8">     <!-- Raça:* -->
                                            <label> Raça:* </label>
                                            <select class="form-control text-uppercase" name="raca">
												<?php if (!$RegNovo){$raca=$tb_crianca['id_raca'];} else {$raca="false";}  ?>
                                                <option value="false" <?php if(isset($raca)){echo selected( 'false', $raca); }?> > </option>
                                                <option value=0 <?php if(isset($raca)){echo selected( '0', $raca); }?>>Branca</option>
                                                <option value=1 <?php if(isset($raca)){echo selected( '1', $raca); }?> >Preta</option>
                                                <option value=2 <?php if(isset($raca)){echo selected( '2', $raca); }?>> Amarela</option>
                                                <option value=3 <?php if(isset($raca)){echo selected( '3', $raca); }?>>Parda</option>
                                                <option value=4 <?php if(isset($raca)){echo selected( '4', $raca); }?>>Indígena</option>
                                                <option value=5 <?php if(isset($raca)){echo selected( '5', $raca); }?>>Outro</option>
                                            </select>
                                        </div>
										<div class="col-lg-4 col-md-2 col-xs-8">     <!-- E-mail* -->
											<label>E-mail*</label>
											<div class="form-group input-group">
												<span class="input-group-addon">@</span>
													<input type="text" name="email" class="form-control" placeholder="Insira seu e-mail..." maxlength="50"
													<?php if (!$RegNovo){echo "value='" . $tb_crianca['email_cri'] . "'";} 
														  else {if(isset($_SESSION['emailuser'])) {echo "value='" . $_SESSION['emailuser'] . "'"; }}; ?> >
											</div>
										</div>
                                    </div>
                                </div>
							</div>	
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-4 col-md-2 col-xs-8">     <!-- Qual seu estado civil?* -->
											<label> Qual seu estado civil?* </label>
											<select class="form-control text-uppercase" name="estadoCivil"  id="estcivilSelect"  onchange="mudaEstcivil();">
												<?php if (!$RegNovo){$estCivil=$tb_crianca['estado_civil_cri'];} else {$estCivil="false";}  ?>
												<option value="false" <?php if(isset($estCivil)){echo selected( 'false', $estCivil); }?> > </option>
												<option value="CASADO" <?php if(isset($estCivil)){echo selected( 'CASADO', $estCivil); }?>>Casado</option>
												<option value="SOLTEIRO" <?php if(isset($estCivil)){echo selected( 'SOLTEIRO', $estCivil); }?> >Solteiro</option>
												<option value="VIUVO" <?php if(isset($estCivil)){echo selected( 'VIUVO', $estCivil); }?>> Viúvo</option>
												<option value="SEPARADO/DIVORCIADO" <?php if(isset($estCivil)){echo selected( 'SEPARADO/DIVORCIADO', $estCivil); }?>>Separado/Divorciado</option>
												<option value="OUTRO" <?php if(isset($estCivil)){echo selected( 'OUTRO', $estCivil); }?>>Outro</option>
											</select>
										</div>	
                                        <div class="col-lg-4 col-md-2 col-xs-8">     <!-- Outro* -->
											<div id='box-estcivil'  style='display: none;'>
												<label>Outro</label><br>
												<input class='form-control text-uppercase' name='outroCivil' type="text" placeholder='Estado civil...' 
													<?php if (!$RegNovo){echo "value='" . $tb_crianca['outro_est_civil_cri'] . "'";} ?>
												>
											</div>
											<script>
												function mudaEstcivil() {
													var x = document.getElementById("estcivilSelect").value;
													if(x=="OUTRO"){
														$("#box-estcivil").css("display", "block");
													}
													else{
														$("#box-estcivil").css("display", "none");
													}
												}
											</script>
										</div>	
									</div>	
								</div>	
							</div>	
						</div>
						<hr>
<!-- ************************************************************************************************************************************************* -->
						<div>                                                    <!-- LAYOUT ETAPA 2 - DADOS PARA O CURSO DO ENEM -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- NOT/VESP/MAT TURNO -->
											<?php 
											$t_vesp = "";
											$t_not  = ""; 
											$t_mat  = ""; 
											if (!$RegNovo){
												if ($tb_crianca['deseja_estudar_turno_cri1'] == "VESP") {$t_vesp = " checked";}
												if ($tb_crianca['deseja_estudar_turno_cri1'] == "NOT") {$t_not = " checked";}
												if ($tb_crianca['deseja_estudar_turno_cri1'] == "MAT") {$t_mat = " checked";};
												if ($tb_crianca['deseja_estudar_turno_cri2'] == "VESP") {$t_vesp = " checked";}
												if ($tb_crianca['deseja_estudar_turno_cri2'] == "NOT") {$t_not = " checked";}
												if ($tb_crianca['deseja_estudar_turno_cri2'] == "MAT") {$t_mat = " checked";};
											}
											?>
											<label> Qual turno você deseja estudar? (Você pode marcar até duas opções) </label><br><br>
											<label class="checkbox-inline"><input type="checkbox" name="mat" value="MAT"   <?php echo $t_mat; ?> >Matutino</label>
											<label class="checkbox-inline"><input type="checkbox" name="vesp" value="VESP" <?php echo $t_vesp;?> >Vespertino</label>
											<label class="checkbox-inline"><input type="checkbox" name="not" value="NOT"   <?php echo $t_not; ?> >Noturno</label>
										</div>	
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- MACROREGIAO -->
											<?php 
											$t_GAM = "";
											$t_TAG = "";
											$t_BRA = "";
											$t_SOB = "";
											$t_zer = "";
											if (!$RegNovo){
												if      ($tb_crianca['deseja_estudar_macroregio_cri1'] == "GAMA")       {$t_GAM = " selected";}
												else if ($tb_crianca['deseja_estudar_macroregio_cri1'] == "TAGUATINGA") {$t_TAG = " selected";}
												else if ($tb_crianca['deseja_estudar_macroregio_cri1'] == "BRASILIA")   {$t_BRA = " selected";}
												else if ($tb_crianca['deseja_estudar_macroregio_cri1'] == "SOBRADINHO") {$t_SOB = " selected";}
												else {$t_zer = " selected";};
											}
											else {$t_zer = " selected";};
											?>											
											<label> Caso haja disponibilidade, você desejaria estudar em qual macrorregião, como segunda opção? </label><br>
											<select class="form-control" name="macroreg" >
												<option value=""            <?php  echo $t_zer; ?> ></option>
												<option value="TAGUATINGA"  <?php  echo $t_TAG; ?> >Macrorregião Taguatinga</option>
												<option value="GAMA"        <?php  echo $t_GAM; ?> >Macrorregião Gama</option>
												<option value="SOBRADINHO"  <?php  echo $t_SOB; ?> >Macrorregião Sobradinho</option>
												<option value="BRASILIA"    <?php  echo $t_BRA; ?> >Macrorregião Brasília</option>
											</select>
										</div>											
									</div>	
								</div>	
							</div>	
							<br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
										<?php 
										$t_S = "";
										$t_N = "";
										//$t_block = "'display:none'";
										if (!$RegNovo){
											if ($tb_crianca['beneficiario_cri'] == "SIM") {$t_S = " checked";}
											else {$t_N = " checked";}
										}
										else {$t_N = " checked";};
										//if ($t_S == " checked"){$t_block = "'display:block'";};
										?>		
										<script>
											function mudaBene() {
												if (document.getElementById("sim_b").checked){
													$("#box-progGdf").css("display", "block");
												}else{
													$("#box-progGdf").css("display", "none");
												}
											};
										</script>										
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Beneficiário de programa social -->
											<label>Você é beneficiário de algum programa social do Governo Federal ou do Governo do Distrito Federal (exemplo: programa Bolsa Família)?*</label>
											<label class='radio-inline'>
												<input type='radio' name='progGdf' onclick="mudaBene();" id='sim_b' value='SIM' <?php echo $t_S; ?>> Sim
											</label>
											<label class='radio-inline'>
												<input type='radio' name='progGdf' onclick="mudaBene();" id='nao_b' value='NAO' <?php echo $t_N; ?>> Não
											</label>
										</div>	
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Beneficiário de programa social - Qual -->
											<div id='box-progGdf' style='display:none'> 
												<label>Qual?</label><br>
												<input class='form-control text-uppercase' name='nomeProgGdf' type="text" placeholder='Nome do programa...'   <?php if (!$RegNovo){echo "value='" . $tb_crianca['nome_p_beneficiario_cri'] . "'";} ?>>
											</div>										
										</div>	
									</div>	
								</div>	
							</div>	
							<br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- CadÚnico -->
											<label>NÚMERO DE CADASTRO ÚNICO PARA PROGRAMAS SOCIAIS (CadÚnico)
											</label><br>
											<input class='form-control text-uppercase' type="text" name='cadUnico' placeholder='CadÚnico' onKeyPress="MascaraNumeros(form1.cadUnico);"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['cadunico_cri'] . "'";} ?>
											>
										</div>	
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- ENEM * -->
											<label>Número de inscrição no ENEM *
											</label><br>
											<input class='form-control text-uppercase' type="text" name='insc_enem' placeholder='Somente números...' name='cadUnico' placeholder='CadÚnico' onKeyPress="MascaraNumeros(form1.insc_enem);"
												<?php if (!$RegNovo){echo "value='" . $tb_crianca['inscricao_enem_cri'] . "'";} ?>
											>
										</div>	
									</div>	
								</div>	
							</div>	
						</div>
						
<!-- ---------------------------------------------------------------------------------------------->
<!-- -----escolaridade----------------------------------------------------------------------------->
<!-- ---------------------------------------------------------------------------------------------->
                        <br>
<!-- ************************************************************************************************************************************************* -->
						<div>                                                    <!-- LAYOUT ETAPA 3 - ESCOLARIDADE -->
							<div class="col-lg-12 text-center">
								<div class="row">
									<hr>
									<h5><b>Escolaridade*</b></h5>
									<hr>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
                                    <div class="text-center">
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3 ">
											<?php if (!$RegNovo){ $ensino= $v_formacao_escola;} else { $ensino= "";}?>
                                            <select class="form-control text-uppercase text-center " id="escoSelect" name='escolaridade' onchange="mudaEscolaridade();" >
                                                <option value="0"              <?php if(isset($ensino)){echo selected( '', $ensino); }?>></option>
                                                <option value="MÉDIO COMPLETO" <?php if(isset($ensino)){echo selected( 'MÉDIO COMPLETO', $ensino); }?>>ensino médio completo</option>
                                                <option value="MÉDIO CURSANDO" <?php if(isset($ensino)){echo selected( 'MÉDIO CURSANDO', $ensino); }?>>ensino médio - cursando</option>
                                                <option VALUE="EJA COMPLETO"   <?php if(isset($ensino)){echo selected( 'EJA COMPLETO', $ensino); }?>>educação de jovens e adultos completo</option>
                                                <option VALUE="EJA CURSANDO"   <?php if(isset($ensino)){echo selected( 'EJA CURSANDO', $ensino); }?>>educação de jovens e adultos - cursando</option>
                                            </select>
                                        </div>
                                    </div>
								</div>	
							</div>	
						</div>
<!-- ************************************************************************************************************************************************* -->
						<br>
						<div>                                                    <!-- LAYOUT ETAPA 3 - DADOS ESCOLARIDADE -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-5 col-md-2 col-xs-8">     <!-- Rede de ensino -->
										    
											<?php if (!$RegNovo){ $rede_escola= $v_rede_escola;} else { $rede_escola= "0";}?>			
											<label>Rede de ensino*</label><br>
											<select name='rede' class='form-control' >
												<option value="0" <?php if(isset($rede_escola)){echo selected( '0', $rede_escola);} ?>></option>
												<option value="PUBLICA" <?php if(isset($rede_escola)){echo selected( 'PUBLICA', $rede_escola);} ?>>Pública</option>
												<option value="PRIVADA" <?php if(isset($rede_escola)){echo selected( 'PRIVADA', $rede_escola);} ?>>Privada na condição de bolsista integral</option>
												<option value="ECCF" <?php if(isset($rede_escola)){echo selected( 'ECCF', $rede_escola);} ?>>Escolas confessionais, comunitárias e/ou filantrópicas 
												                                                                                             executoras de parceria com o poder público, ambas sem fins 
														  																				     lucrativos ou na forma da lei.</option>
											</select>
										</div>	
                                        <div class="col-lg-7 col-md-2 col-xs-8">     <!-- Nome da Escola -->
											<label>Nome da Escola*</label><br>
											<input type="text" class="form-control text-uppercase" name="escola" maxlength="60"
												<?php if (!$RegNovo){echo "value='" . $v_instituicao_escola . "'";} ?>>
										</div>											
									</div>	
								</div>	
							</div>	
							<br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-3 col-md-2 col-xs-8">     <!-- rede privada -->
											<?php if (!$RegNovo){ $qd_part = $v_qd_series_part_escola;} else { $qd_part= "0";}?>	
											<label>Quantas séries cursou na rede privada?*</label><br>
											<select class='form-control text-uppercase text-right' name='anosPri' >
												<option value="0" <?php if(isset($qd_part)){echo selected( '0', $qd_part);} ?>>0</option>
												<option value="1" <?php if(isset($qd_part)){echo selected( '1', $qd_part);} ?>>1</option>
												<option value="2" <?php if(isset($qd_part)){echo selected( '2', $qd_part);} ?>>2</option>
												<option value="3" <?php if(isset($qd_part)){echo selected( '3', $qd_part);} ?>>3</option>
											</select>
										</div>											
                                        <div class="col-lg-3 col-md-2 col-xs-8">     <!-- rede pública -->
											<?php if (!$RegNovo){ $qd_publ = $v_qd_series_pub_escola;} else { $qd_publ= "0";}?>
											<label>Quantas séries cursou na rede pública?*</label><br>
											<select class='form-control text-uppercase text-right' name='anosPuc' >
												<option value="0" <?php if(isset($qd_publ)){echo selected( '0', $qd_publ);} ?>>0</option>
												<option value="1" <?php if(isset($qd_publ)){echo selected( '1', $qd_publ);} ?>>1</option>
												<option value="2" <?php if(isset($qd_publ)){echo selected( '2', $qd_publ);} ?>>2</option>
												<option value="3" <?php if(isset($qd_publ)){echo selected( '3', $qd_publ);} ?>>3</option>
											</select>
										</div>		
										<script>
										$("#esc_comp").css("display", "none");
										$("#esc_comp1").css("display", "none");
										$("#esc_curs").css("display", "none");
										
										function mudaEscolaridade() {
											var x = document.getElementById("escoSelect").value;
											if((x=="MÉDIO COMPLETO") || (x=="EJA COMPLETO")){
												$("#esc_comp").css("display", "block");
												$("#esc_comp1").css("display", "block");
												$("#esc_curs").css("display", "none");
											}
											else if((x=="MÉDIO CURSANDO") || (x=="EJA CURSANDO")){
												$("#esc_comp").css("display", "none");
												$("#esc_comp1").css("display", "none");
												$("#esc_curs").css("display", "block");
											}
											else {
												$("#esc_comp").css("display", "none");
												$("#esc_comp1").css("display", "none");
												$("#esc_curs").css("display", "none");
											}
										}
										</script>
										<div id='esc_comp'  style='display: none;'>
											<div class="col-lg-4 col-md-2 col-xs-8">     <!-- Ano de conclusão do ensino médio* -->
												<br><label>Ano de conclusão do ensino médio*</label><br>
												<input type="text" class="form-control text-uppercase" name="conclusaoMedio" id="conclusaoMedio" maxlength="4"
													<?php if (!$RegNovo){echo "value='" . $v_ano_formacao . "'";} ?>>
											</div>	
										</div>					
										<div id='esc_curs'  style='display: none;'>
											<div class="col-lg-3 col-md-2 col-xs-8">     <!-- Turno que estuda* -->
												<?php if (!$RegNovo){ $turno_escola = $v_turno_escola;} else { $turno_escola= "0";}?>
												<br><label>Turno que estuda*</label><br>
												<select class='form-control text-uppercase text-right' name='turno' id='turno'  >
													<option value='0' <?php if(isset($turno_escola)){echo selected( '0', $turno_escola);} ?>>0</option>
													<option value='MATUTINO' <?php if(isset($turno_escola)){echo selected( 'MATUTINO', $turno_escola);} ?>>Matutino</option>
													<option value='VESPERTINO' <?php if(isset($turno_escola)){echo selected( 'VESPERTINO', $turno_escola);} ?>>Vespertino</option>
													<option value='NOTURNO' <?php if(isset($turno_escola)){echo selected( 'NOTURNO', $turno_escola);} ?>>Noturno</option>
													<option value='INTEGRAL' <?php if(isset($turno_escola)){echo selected( 'INTEGRAL', $turno_escola);} ?>>Integral</option>
												</select>						
											</div>	
											<div class="col-lg-3 col-md-2 col-xs-8">     <!-- Série* -->
												<?php if (!$RegNovo){ $serie_escola = $v_serie_escola;} else { $serie_escola= "0";}?>
												<br><label>Série*</label><br>
												<select class='form-control text-uppercase text-right' name='serie' id='serie'  >
													<option value='1' <?php if(isset($serie_escola)){echo selected( '1', $serie_escola);} ?>>1º ano</option>
													<option value='2' <?php if(isset($serie_escola)){echo selected( '2', $serie_escola);} ?>>2º ano</option>
													<option value='3' <?php if(isset($serie_escola)){echo selected( '3', $serie_escola);} ?>>3º ano</option>
												</select>						
											</div>											
										</div>					
									</div>	
								</div>	
							</div>	
						</div>
						
<!-- ************************************************************************************************************************************************* -->
						<br>
						<div>                                                    <!-- LAYOUT ETAPA 3 - Boletim escolar* --> 
							<div class="col-lg-12 text-center">
								<div class="row">
									<hr>
									<h5><b>Boletim de escolar*</b></h5>
									<hr>
								</div>
							</div>
							<div class="row"> <!-- Disciplinas -->
								<div class="col-lg-12">
                                    <div class="text-center">
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3 ">
											<label>  Disciplinas</label>
                                        </div>
                                    </div>
								</div>	
							</div>
							<div class="row">								
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-6 col-md-2 col-xs-8 text-center">     <!-- Matemática* -->
											<label>Matemática*</label><br>
											<div class="col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3">
												<input type="text" class="form-control text-uppercase" name="matematica" maxlength="3"
													<?php if (!$RegNovo){echo "value='" . $v_nota_mat_escola . "'";} ?>>
											</div>
										</div>											
                                        <div class="col-lg-6 col-md-2 col-xs-8 text-center">     <!-- Português* -->
											<label>Português*</label><br>
											<div class="col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3">
												<input type="text" class="form-control text-uppercase" name="portugues" maxlength="3"
													<?php if (!$RegNovo){echo "value='" . $v_nota_port_escola . "'";} ?>>
											</div>
										</div>											
									</div>	
								</div>	
							</div>	
						</div>
<!-- ************************************************************************************************************************************************* -->
                        <div class="row"  id="esc_comp1" style="display: none;"> <!-- LAYOUT ETAPA 3 - Está cursando o ensino superior?* --> 
							<hr>
							<div class="col-lg-12 col-md-12 col-xs-12 text-center">    <!-- Está cursando o ensino superior?* -->
								<?php 
								$t_simss = "";
								$t_naoss = "";
								if (!$RegNovo){
									if ($v_rede_comp_pub_escola == "SIM") {$t_simss = " checked";}
									else {$t_naoss = " checked";}
								}
								else {$t_naoss = " checked";};
								?>		
								<script>
									function mudaEnsiSup() {
										if (document.getElementById("simss").checked){
											$("#box-ensinoSup").css("display", "block");
										}else{
											$("#box-ensinoSup").css("display", "none");
										}
									};
								</script>	
								<div class="form-group">
									<label>  Está cursando o ensino superior?*</label><br>
								</div>
								<div class="form-group">
									<label class='radio-inline'>
										<input type='radio' name='ensinoSup' id='simss' onclick="mudaEnsiSup();" value='SIM' <?php echo $t_simss; ?>>Sim</label>
									<label class='radio-inline'>
										<input type='radio' name='ensinoSup' id='naoss' onclick="mudaEnsiSup();" value='NAO' <?php echo $t_naoss; ?>>Não</label>
								</div>
							</div>
							<div class="row"  id='box-ensinoSup' style='display:none'>								
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Universidade Pública* -->
											<?php 
											$t_simpubs = "";
											$t_naopubs = "";
											if (!$RegNovo){
												if ($v_univesidade_pub_escola == "SIM") {$t_simpubs = " checked";}
												else {$t_naopubs = " checked";}
											}
											else {$t_naopubs = " checked";};
											?>		
											<script>
												function mudaEnsiSupPubl() {
													if (document.getElementById("simpubs").checked){
														$("#box-ensinoSupPubl").css("display", "block");
													}else{
														$("#box-ensinoSupPubl").css("display", "none");
													}
												};
											</script>	
											<div class="row text-center">
												<label>Universidade Pública*</label><br>
												<label class='radio-inline'>
													<input type='radio' name='redeUnip' id='simpubs' onclick="mudaEnsiSupPubl();" value='SIM' <?php echo $t_simpubs; ?>>Sim</label>
												<label class='radio-inline'>
													<input type='radio' name='redeUnip' id='naopubs' onclick="mudaEnsiSupPubl();" value='NAO' <?php echo $t_naopubs; ?>>Não</label>
											</div>
											<div class="row"  id='box-ensinoSupPubl' style='display:none'>								
												<div class="col-lg-10 col-md-6 col-xs-12 col-lg-offset-1 col-md-offset-1">
													<label>Qual?*</label>
													<input class="form-control" type="text" name="universidadep" maxlength="80"
														<?php if (!$RegNovo){echo "value='" . $v_nome_univesidade_pub_escola . "'";} ?>>
												</div>
											</div>
										</div>
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Universidade Particular* -->
											<?php 
											$t_simpars = "";
											$t_naopars = "";
											if (!$RegNovo){
												if ($v_univesidade_part_escola == "SIM") {$t_simpars = " checked";}
												else {$t_naopars = " checked";}
											}
											else {$t_naopars = " checked";};
											?>		
											<script>
												function mudaEnsiSupPart() {
													if (document.getElementById("simpars").checked){
														$("#box-ensinoSupPart").css("display", "block");
													}else{
														$("#box-ensinoSupPart").css("display", "none");
													}
												};
											</script>	
											<div class="row text-center">
												<label>Universidade Particular*</label><br>
												<label class='radio-inline'>
													<input type='radio' name='redeUnipar' id='simpars' onclick="mudaEnsiSupPart();" value='SIM' <?php echo $t_simpars; ?>>Sim</label>
												<label class='radio-inline'>
													<input type='radio' name='redeUnipar' id='naopars' onclick="mudaEnsiSupPart();" value='NAO' <?php echo $t_naopars; ?>>Não</label>
											</div>
											<div class="row"  id='box-ensinoSupPart' style='display:none'>								
												<div class="col-lg-10 col-md-6 col-xs-12 col-lg-offset-1 col-md-offset-1">
													<label>Qual?*</label>
													<input class="form-control" type="text" name="universidadepar" maxlength="80"
														<?php if (!$RegNovo){echo "value='" . $v_nome_univesidade_part_escola . "'";} ?>>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
	

                </div>
            </div>
		</div>
<!-- ---------------------------------------------------------------------------------------------->
<!-- -----  QUESTIONÁRIO  ------------------------------------------------------------------------->
<!-- ---------------------------------------------------------------------------------------------->
		<div class="container">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <b>Questionário</b>
                    </div>
                    <div class="panel-body">
<!-------------------------------------------->
<!----------------    1  					-->
<!-------------------------------------------->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
										<?php 
										$t_S1 = "";
										$t_N1 = "";
										if (!$RegNovo){
											if ($v_Q_1_1 == "SIM") {$t_S1 = " checked";}
											else {$t_N1 = " checked";}
										}
										else {$t_N1 = " checked";};
										?>		
										<script>
											function mudav_Q_1_1() {
												if (document.getElementById("sim_v_Q_1_1").checked){
													$("#box-v_Q_1_1").css("display", "block");
												}else{
													$("#box-v_Q_1_1").css("display", "none");
												}
											};
										</script>										
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Q 1 -->
											<label>1) Participa de projetos sociais de acesso ao ensino superior?*</label><br>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_1_1' onclick="mudav_Q_1_1();" id='sim_v_Q_1_1' value='SIM' <?php echo $t_S1; ?>> Sim
											</label>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_1_1' onclick="mudav_Q_1_1();" id='nao_v_Q_1_1' value='NAO' <?php echo $t_N1; ?>> Não
											</label>
										</div>	
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Q 1 - Qual -->
											<div id='box-v_Q_1_1' style='display:none'> 
												<label>Qual?</label><br>
												<input class='form-control text-uppercase' name='v_Q_1_2' type="text" <?php if (!$RegNovo){echo "value='" . $v_Q_1_2 . "'";} ?>>
											</div>										
										</div>	
									</div>	
								</div>	
							</div>	
<!-------------------------------------------->
<!----------------    2  					-->
<!-------------------------------------------->
							<HR>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
										<?php 
										$t_S1 = "";
										$t_N1 = "";
										if (!$RegNovo){
											if ($v_Q_2_1 == "SIM") {$t_S1 = " checked";}
											else {$t_N1 = " checked";}
										}
										else {$t_N1 = " checked";};
										?>		
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Q 1 -->
											<label>2) Atualmente você têm uma ocupação?*</label><br>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_2_1' id='sim_v_Q_2_1' value='SIM' <?php echo $t_S1; ?>> Sim
											</label>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_2_1' id='nao_v_Q_2_1' value='NAO' <?php echo $t_N1; ?>> Não
											</label>
										</div>	
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Q 4 -->
											<label>Qual?*</label><br>
											<?php if (!$RegNovo){ $sel_v_Q_2_2 = $v_Q_2_2;} else { $sel_v_Q_2_2= "";}?>
                                            <select class="form-control text-uppercase text-center " id="progv_Q_2_2" name='progv_Q_2_2' onchange="mudav_Q_2_2();" >
                                                <option value=""              <?php if(isset($sel_v_Q_2_2)){echo selected( '', $sel_v_Q_2_2); }?>></option>
                                                <option value="SIM-CARTEIRA" <?php if(isset($sel_v_Q_2_2)){echo selected( 'SIM-CARTEIRA', $sel_v_Q_2_2); }?>>Sim, com carteira assinada.</option>
                                                <option value="SIM-SEM CARTEIRA" <?php if(isset($sel_v_Q_2_2)){echo selected( 'SIM-SEM CARTEIRA', $sel_v_Q_2_2); }?>>Sim, sem carteira assinada.</option>
                                                <option value="SIM-FUNC-PUBLICO" <?php if(isset($sel_v_Q_2_2)){echo selected( 'SIM-FUNC-PUBLICO', $sel_v_Q_2_2); }?>>Sim, funcionário público.</option>
                                                <option value="NÃO-NÃO PROCURA" <?php if(isset($sel_v_Q_2_2)){echo selected( 'NÃO-NÃO PROCURA', $sel_v_Q_2_2); }?>>Não, e não estou procurando trabalho.</option>
                                                <option value="NÃO-PROCUROU-30-DIAS" <?php if(isset($sel_v_Q_2_2)){echo selected( 'NÃO-PROCUROU-30-DIAS', $sel_v_Q_2_2); }?>>Não, mas procurei trabalho nos últimos 30 dias.</option>
                                            </select>
										</div>	
									</div>	
								</div>	
							</div>				
<!-------------------------------------------->
<!----------------  3  4  					-->
<!-------------------------------------------->
							<HR>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-3 col-md-2 col-xs-8">     <!-- Q 3 -->
											<div id='box-v_Q_3_1'> 
												<label>3) Aproximadamente, qual é a sua renda mensal familiar?* </label><br>
												<input class='form-control text-uppercase' name='v_Q_3_1' type="text"  onchange="MascaraNumeros(form1.v_Q_3_1);" <?php if (!$RegNovo){echo "value='" . $v_Q_3_1 . "'";} ?>>
											</div>										
										</div>	
										<script>
											function mudav_Q_4_1() {
												var x = document.getElementById("progv_Q_4_1").value;
												if (x=="OUTROS"){
													$("#box-v_Q_4_1").css("display", "block");
												}else{
													$("#box-v_Q_4_1").css("display", "none");
												}
											};
										</script>										
                                        <div class="col-lg-4 col-md-2 col-xs-8">     <!-- Q 4 -->
											<label>4) Qual a sua contribuição para a renda familiar?*</label><br>
											<?php if (!$RegNovo){ $sel_v_Q_4_1 = $v_Q_4_1;} else { $sel_v_Q_4_1= "";}?>
                                            <select class="form-control text-uppercase text-center " id="progv_Q_4_1" name='progv_Q_4_1' onchange="mudav_Q_4_1();" >
                                                <option value=""              <?php if(isset($sel_v_Q_4_1)){echo selected( '', $sel_v_Q_4_1); }?>></option>
                                                <option value="SUSTENTA-FAMILIA" <?php if(isset($sel_v_Q_4_1)){echo selected( 'SUSTENTA-FAMILIA', $sel_v_Q_4_1); }?>>É o responsável pelo sustento da família.</option>
                                                <option value="SE SUSTENTA E AJUDA" <?php if(isset($sel_v_Q_4_1)){echo selected( 'SE SUSTENTA E AJUDA', $sel_v_Q_4_1); }?>>É o responsável pelo próprio sustento e contribui com a renda familiar.</option>
                                                <option VALUE="SUSTENTADO PELA FAMILIA"   <?php if(isset($sel_v_Q_4_1)){echo selected( 'SUSTENTADO PELA FAMILIA', $sel_v_Q_4_1); }?>>É sustentado pela família.</option>
                                                <option VALUE="SUSTENTADO POR TERCEIROS"   <?php if(isset($sel_v_Q_4_1)){echo selected( 'SUSTENTADO POR TERCEIROS', $sel_v_Q_4_1); }?>>É sustentado por terceiros.</option>
                                                <option VALUE="OUTROS"   <?php if(isset($sel_v_Q_4_1)){echo selected( 'OUTROS', $sel_v_Q_4_1); }?>>Outros</option>
                                            </select>
										</div>	
                                        <div class="col-lg-5 col-md-2 col-xs-8">     <!-- Q 4 - Outros -->
											<div id= "box-v_Q_4_1" style='display:none'> 
												<label>Outros</label><br>
												<input class='form-control text-uppercase' name='v_Q_4_2' type="text" placeholder="Outros..." <?php if (!$RegNovo){echo "value='" . $v_Q_4_2 . "'";} ?>>
											</div>										
										</div>	
									</div>	
								</div>	
							</div>	
<!-------------------------------------------->
<!----------------  5  6 					-->
<!-------------------------------------------->
							<HR>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="col-lg-3 col-md-2 col-xs-8">     <!-- Q 5 -->
											<div id='box-v_Q_5_1'> 
												<label>5) Quantas pessoas moram na sua casa, incluindo você?*</label><br>
												<input class='form-control text-uppercase' name='v_Q_5_1' type="number" <?php if (!$RegNovo){echo "value='" . $v_Q_5_1 . "'";} ?>>
											</div>										
										</div>	
									
										<script>
											function mudav_Q_6_1() {
												var x = document.getElementById("progv_Q_6_1").value;
												if (x=="OUTRO"){
													$("#box-v_Q_6_1").css("display", "block");
												}else{
													$("#box-v_Q_6_1").css("display", "none");
												}
											};
										</script>										
                                        <div class="col-lg-5 col-md-2 col-xs-8">     <!-- Q 6 -->
											<label>6) Você tem acesso a informação sobre direitos sexuais e reprodutivos? Indique a fonte de informação.*</label><br>
											<?php if (!$RegNovo){ $sel_v_Q_6_1 = $v_Q_6_1;} else { $sel_v_Q_6_1= "";}?>
                                            <select class="form-control text-uppercase text-center " id="progv_Q_6_1" name='progv_Q_6_1' onchange="mudav_Q_6_1();" >
                                                <option value="0"       <?php if(isset($sel_v_Q_6_1)){echo selected('0',       $sel_v_Q_6_1); }?>></option>
                                                <option value="PAIS"    <?php if(isset($sel_v_Q_6_1)){echo selected( 'PAIS',    $sel_v_Q_6_1); }?>>Pais.</option>
                                                <option value="OUTROS FAMILIARES"    <?php if(isset($sel_v_Q_6_1)){echo selected( 'OUTROS FAMILIARES',    $sel_v_Q_6_1); }?>>Outros familiares.</option>
                                                <option value="COLEGAS/AMIGOS"    <?php if(isset($sel_v_Q_6_1)){echo selected( 'COLEGAS/AMIGOS',    $sel_v_Q_6_1); }?>>Colegas/Amigos.</option>
                                                <option value="COMPANHEIRO/PARCEIRO"    <?php if(isset($sel_v_Q_6_1)){echo selected( 'COMPANHEIRO/PARCEIRO',    $sel_v_Q_6_1); }?>>Companheiro/parceiro sexual.</option>
                                                <option value="IMPRENSA/TELEVISAO"    <?php if(isset($sel_v_Q_6_1)){echo selected( 'IMPRENSA/TELEVISAO',    $sel_v_Q_6_1); }?>>Imprensa escrita/televisão.</option>
                                                <option value="INTERNET"    <?php if(isset($sel_v_Q_6_1)){echo selected( 'INTERNET',    $sel_v_Q_6_1); }?>>Internet.</option>
                                                <option value="PROFESSORES"    <?php if(isset($sel_v_Q_6_1)){echo selected( 'PROFESSORES',    $sel_v_Q_6_1); }?>>Professores.</option>
                                                <option value="SAÚDE"    <?php if(isset($sel_v_Q_6_1)){echo selected( 'SAÚDE',    $sel_v_Q_6_1); }?>>Profissionais de saúde.</option>
                                                <option value="RELIGIAO"    <?php if(isset($sel_v_Q_6_1)){echo selected( 'RELIGIAO',    $sel_v_Q_6_1); }?>>Grupos religiosos.</option>
                                                <option value="LIVROS"    <?php if(isset($sel_v_Q_6_1)){echo selected( 'LIVROS',    $sel_v_Q_6_1); }?>>Livros especializados.</option>
                                                <option value="SEM ACESSO"    <?php if(isset($sel_v_Q_6_1)){echo selected( 'SEM ACESSO',    $sel_v_Q_6_1); }?>>Não tenho acesso.</option>
                                                <option VALUE="OUTRO" <?php if(isset($sel_v_Q_6_1)){echo selected( 'OUTRO', $sel_v_Q_6_1); }?>>Outro</option>
                                            </select>
										</div>	
                                        <div class="col-lg-4 col-md-2 col-xs-8">     <!-- Q 6 - Outros -->
											<div id= "box-v_Q_6_1" style='display:none'> 
												<label>Outros</label><br>
												<input class='form-control text-uppercase' name='v_Q_6_2' type="text" placeholder="Outros..." <?php if (!$RegNovo){echo "value='" . $v_Q_6_2 . "'";} ?>>
											</div>										
										</div>	
									</div>	
								</div>	
							</div>	
<!-------------------------------------------->
<!----------------    7  					-->
<!-------------------------------------------->
							<HR>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
										<?php 
										$t_S = "";
										$t_N = "";
										if (!$RegNovo){
											if ($v_Q_7_1 == "SIM") {$t_S = " checked";}
											else {$t_N = " checked";}
										}
										else {$t_N = " checked";};
										?>		
										<script>
											function mudav_Q_7_1() {
												if (document.getElementById("sim_v_Q_7_1").checked){
													$("#box-v_Q_7_1").css("display", "block");
												}else{
													$("#box-v_Q_7_1").css("display", "none");
												}
											};
										</script>										
                                        <div class="col-lg-4 col-md-2 col-xs-8">     <!-- Q 7 -->
											<label>7) Já fez curso preparatório?*</label><br>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_7_1' onclick="mudav_Q_7_1();" id='sim_v_Q_7_1' value='SIM' <?php echo $t_S; ?>> Sim
											</label>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_7_1' onclick="mudav_Q_7_1();" id='nao_v_Q_7_1' value='NAO' <?php echo $t_N; ?>> Não
											</label>
										</div>	
                                        <div class="col-lg-8 col-md-2 col-xs-8">     <!-- Q 7 - Qual -->
											<div id='box-v_Q_7_1' style='display:none'> 
												<label>Qual?</label><br>
												<input class='form-control text-uppercase' name='v_Q_7_2' type="text" <?php if (!$RegNovo){echo "value='" . $v_Q_7_2 . "'";} ?>>
											</div>										
										</div>	
									</div>	
								</div>	
							</div>	
<!-------------------------------------------->
<!----------------    8  					-->
<!-------------------------------------------->
							<HR>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
										<?php 
										$t_S = "";
										$t_N = "";
										if (!$RegNovo){
											if ($v_Q_8_1 == "SIM") {$t_S = " checked";}
											else {$t_N = " checked";}
										}
										else {$t_N = " checked";};
										?>		
										<script>
											function mudav_Q_8_1() {
												if (document.getElementById("sim_v_Q_8_1").checked){
													$("#box-v_Q_8_1").css("display", "block");
												}else{
													$("#box-v_Q_8_1").css("display", "none");
												}
											};
										</script>										
                                        <div class="col-lg-4 col-md-2 col-xs-8">     <!-- Q 8 -->
											<label>8) Você tem filhos?*</label><br>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_8_1' onclick="mudav_Q_8_1();" id='sim_v_Q_8_1' value='SIM' <?php echo $t_S; ?>> Sim
											</label>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_8_1' onclick="mudav_Q_8_1();" id='nao_v_Q_8_1' value='NAO' <?php echo $t_N; ?>> Não
											</label>
										</div>	
                                        <div class="col-lg-8 col-md-2 col-xs-8">     <!-- Q 8- Qual -->
											<div id='box-v_Q_8_1' style='display:none'> 
												<label>Quantos?</label><br>
												<input class='form-control text-uppercase' name='v_Q_8_2' type="number" <?php if (!$RegNovo){echo "value='" . $v_Q_8_2 . "'";} ?>>
											</div>										
										</div>	
									</div>	
								</div>	
							</div>	
<!-------------------------------------------->
<!----------------    9  					-->
<!-------------------------------------------->
							<HR>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
										<script>
											function mudav_Q_9_1() {
												var x = document.getElementById("progv_Q_9_1").value;
												if (x=="OUTRO"){
													$("#box-v_Q_9_1").css("display", "block");
												}else{
													$("#box-v_Q_9_1").css("display", "none");
												}
											};
										</script>										
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Q 7 -->
											<label>9) Você participa de algum movimento social, esportivo, artístico e/ou cultural?*</label><br>
											<?php if (!$RegNovo){ $sel_v_Q_9_1 = $v_Q_9_1;} else { $sel_v_Q_9_1= "";}?>
                                            <select class="form-control text-uppercase text-center " id="progv_Q_9_1" name='progv_Q_9_1' onchange="mudav_Q_9_1();" >
                                                <option value=""       <?php if(isset($sel_v_Q_9_1)){echo selected( '',       $sel_v_Q_9_1); }?>></option>
							                    <option value="GRUPO ESPORTIVO" <?php if(isset($sel_v_Q_9_1)){echo selected( 'GRUPO ESPORTIVO',  $sel_v_Q_9_1); }?>>Grupo esportivo (time de futebol, torcida organizada).</option>
                                                <option value="GRUPO RELIGIOSO" <?php if(isset($sel_v_Q_9_1)){echo selected( 'GRUPO RELIGIOSO',  $sel_v_Q_9_1); }?>>Grupo religioso.</option>
                                                <option value="CULTURA"         <?php if(isset($sel_v_Q_9_1)){echo selected( 'CULTURA',          $sel_v_Q_9_1); }?>>Cultura (capoeira, dança).</option>
                                                <option value="GRÊMIO"          <?php if(isset($sel_v_Q_9_1)){echo selected( 'GRÊMIO',           $sel_v_Q_9_1); }?>>Grêmio estudantil.</option>
                                                <option value="POLÍTICO"        <?php if(isset($sel_v_Q_9_1)){echo selected( 'POLÍTICO',         $sel_v_Q_9_1); }?>>Político partidário.</option>
                                                <option value="ORG MULHERES"    <?php if(isset($sel_v_Q_9_1)){echo selected( 'ORG MULHERES',     $sel_v_Q_9_1); }?>>Organização de mulheres.</option>
                                                <option value="LGBT"            <?php if(isset($sel_v_Q_9_1)){echo selected( 'LGBT',             $sel_v_Q_9_1); }?>>Organização LGBT.</option>
                                                <option value="ÉTINICO/RACIAL"  <?php if(isset($sel_v_Q_9_1)){echo selected( 'ÉTINICO/RACIAL',   $sel_v_Q_9_1); }?>>Movimento étnico racial.</option>
                                                <option value="SINDICAL"        <?php if(isset($sel_v_Q_9_1)){echo selected( 'SINDICAL',         $sel_v_Q_9_1); }?>>Movimento sindical.</option>
                                                <option value="NENHUM"          <?php if(isset($sel_v_Q_9_1)){echo selected( 'NENHUM',           $sel_v_Q_9_1); }?>>Não participo de nenhum.</option>
                                                <option VALUE="OUTRO" <?php if(isset($sel_v_Q_9_1)){echo selected( 'OUTRO', $sel_v_Q_9_1); }?>>Outro</option>
                                            </select>
										</div>	
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Q 7 - Outros -->
											<div id= "box-v_Q_9_1" style='display:none'> 
												<label>Outro</label><br>
												<input class='form-control text-uppercase' name='v_Q_9_2' type="text" placeholder="Outro..." <?php if (!$RegNovo){echo "value='" . $v_Q_9_2 . "'";} ?>>
											</div>										
										</div>	
									</div>	
								</div>	
							</div>	
<!-------------------------------------------->
<!----------------    10  					-->
<!-------------------------------------------->
							<HR>
							<div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
										<?php 
										$t_S = "";
										$t_N = "";
										if (!$RegNovo){
											if ($v_Q_10_1 == "SIM") {$t_S = " checked";}
											else {$t_N = " checked";}
										}
										else {$t_N = " checked";};
										?>		
										<script>
											function mudav_Q_10_1() {
												if (document.getElementById("sim_v_Q_10_1").checked){
													$("#box-v_Q_10_1").css("display", "block");
												}else{
													$("#box-v_Q_10_1").css("display", "none");
												}
											};
										</script>										
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Q 10 -->
											<label>10) Possui alguma deficiência ou necessita de atendimento especial?*</label>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_10_1' onclick="mudav_Q_10_1();" id='sim_v_Q_10_1' value='SIM' <?php echo $t_S; ?>> Sim
											</label>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_10_1' onclick="mudav_Q_10_1();" id='nao_v_Q_10_1' value='NAO' <?php echo $t_N; ?>> Não
											</label>
										</div>	
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Q 10 - Qual -->
											<div id='box-v_Q_10_1' style='display:none'> 
												<label>Qual?</label><br>
												<input class='form-control text-uppercase' name='v_Q_10_2' type="text" <?php if (!$RegNovo){echo "value='" . $v_Q_10_2 . "'";} ?>>
											</div>										
										</div>	
									</div>	
								</div>	
							</div>	
<!-------------------------------------------->
<!----------------  11  12  				-->
<!-------------------------------------------->
							<HR>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
										<?php 
										$t_S = "";
										$t_N = "";
										if (!$RegNovo){
											if ($v_Q_12_1 == "SIM") {$t_S = " checked";}
											else {$t_N = " checked";}
										}
										else {$t_N = " checked";};

										$t_S1 = "";
										$t_N1 = "";
										if (!$RegNovo){
											if ($v_Q_11_1 == "SIM") {$t_S1 = " checked";}
											else {$t_N1 = " checked";}
										}
										else {$t_N1 = " checked";};
										?>		
										<script>
											function mudav_Q_12_1() {
												if (document.getElementById("sim_v_Q_12_1").checked){
													$("#box-v_Q_12_1").css("display", "block");
												}else{
													$("#box-v_Q_12_1").css("display", "none");
												}
											};
										</script>			
                                        <div class="col-lg-3 col-md-2 col-xs-8">     <!-- Q 11 -->
											<label>11) Participou do Projeto BoravencerAulão 1º /2016?*</label><br>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_11_1' id='sim_v_Q_11_1' value='SIM' <?php echo $t_S1; ?>> Sim
											</label>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_11_1' id='nao_v_Q_11_1' value='NAO' <?php echo $t_N1; ?>> Não
											</label>
										</div>	
                                        <div class="col-lg-5 col-md-2 col-xs-8">     <!-- Q 12 -->
											<label>12) Você conhece outros projetos na sua região administrativa voltados para o jovem?*</label>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_12_1' onclick="mudav_Q_12_1();" id='sim_v_Q_12_1' value='SIM' <?php echo $t_S; ?>> Sim
											</label>
											<label class='radio-inline'>
												<input type='radio' name='progv_Q_12_1' onclick="mudav_Q_12_1();" id='nao_v_Q_12_1' value='NAO' <?php echo $t_N; ?>> Não
											</label>
										</div>	
                                        <div class="col-lg-4 col-md-2 col-xs-8">     <!-- Q 12 - Qual -->
											<div id='box-v_Q_12_1' style='display:none'> 
												<label>Qual?</label><br>
												<input class='form-control text-uppercase' name='v_Q_12_2' type="text" <?php if (!$RegNovo){echo "value='" . $v_Q_12_2 . "'";} ?>>
											</div>										
										</div>	
									</div>	
								</div>	
							</div>	
<!-------------------------------------------->
<!----------------    13 					-->
<!-------------------------------------------->
							<HR>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
										<script>
											function mudav_Q_13_1() {
												var x = document.getElementById("progv_Q_13_1").value;
												if (x=="OUTRO"){
													$("#box-v_Q_13_1").css("display", "block");
												}else{
													$("#box-v_Q_13_1").css("display", "none");
												}
											};
										</script>										
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Q 13 -->
											<label>13) Como soube do Projeto BoravencerIntensivão?*</label><br>
											<?php if (!$RegNovo){ $sel_v_Q_13_1 = $v_Q_13_1;} else { $sel_v_Q_13_1= "";}?>
                                            <select class="form-control text-uppercase text-center " id="progv_Q_13_1" name='progv_Q_13_1' onchange="mudav_Q_13_1();" >
                                                <option value=""       <?php if(isset($sel_v_Q_13_1)){echo selected( '',       $sel_v_Q_13_1); }?>></option>
                                                <option value="INTERNET"    <?php if(isset($sel_v_Q_13_1)){echo selected( 'INTERNET',    $sel_v_Q_13_1); }?>>Internet.</option>
                                                <option value="TV/RADIO"    <?php if(isset($sel_v_Q_13_1)){echo selected( 'TV/RADIO',    $sel_v_Q_13_1); }?>>TV/Rádio.</option>
                                                <option value="ESCOLA"    <?php if(isset($sel_v_Q_13_1)){echo selected( 'ESCOLA',    $sel_v_Q_13_1); }?>>Escola.</option>
                                                <option value="CURSINHO"    <?php if(isset($sel_v_Q_13_1)){echo selected( 'CURSINHO',    $sel_v_Q_13_1); }?>>Cursinho.</option>
                                                <option value="SITE-SECRIA/FACE-SECRIA"    <?php if(isset($sel_v_Q_13_1)){echo selected( 'SITE-SECRIA/FACE-SECRIA',    $sel_v_Q_13_1); }?>>Site da SECRIA/Facebook SECRIA.</option>
                                                <option value="AMIGOS"    <?php if(isset($sel_v_Q_13_1)){echo selected( 'AMIGOS',    $sel_v_Q_13_1); }?>>Amigos.</option>
                                                <option VALUE="OUTRO" <?php if(isset($sel_v_Q_13_1)){echo selected( 'OUTRO', $sel_v_Q_13_1); }?>>Outro</option>
                                            </select>
										</div>	
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Q 13 - Outros -->
											<div id= "box-v_Q_13_1" style='display:none'> 
												<label>Outro</label><br>
												<input class='form-control text-uppercase' name='v_Q_13_2' type="text" placeholder="Outros..." <?php if (!$RegNovo){echo "value='" . $v_Q_13_2 . "'";} ?>>
											</div>										
										</div>	
									</div>	
								</div>	
							</div>	
<!-------------------------------------------->
<!----------------    14 					-->
<!-------------------------------------------->
							<HR>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
										<script>
											function mudav_Q_14_1() {
												var x = document.getElementById("progv_Q_14_1").value;
												if (x=="OUTRO"){
													$("#box-v_Q_14_1").css("display", "block");
												}else{
													$("#box-v_Q_14_1").css("display", "none");
												}
											};
										</script>										
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Q 14 -->
											<label>14) Você tem interesse de se qualificar para o mercado de trabalho? Se sim, em quais áreas de interesse gostaria de se qualificar/melhorar sua qualificação profissional?*</label><br>
											<?php if (!$RegNovo){ $sel_v_Q_14_1 = $v_Q_14_1;} else { $sel_v_Q_14_1= "";}?>
                                            <select class="form-control text-uppercase text-center " id="progv_Q_14_1" name='progv_Q_14_1' onchange="mudav_Q_14_1();" >
                                                <option value=""       <?php if(isset($sel_v_Q_14_1)){echo selected( '',       $sel_v_Q_14_1); }?>></option>
                                                <option value="ADMINISTRAÇÃO/GESTÃO"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'ADMINISTRAÇÃO/GESTÃO',    $sel_v_Q_14_1); }?>>Administração/gestão.</option>
                                                <option value="ARTES/CULTURA"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'ARTES/CULTURA',    $sel_v_Q_14_1); }?>>Artes/cultura.</option>
                                                <option value="BELEZA"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'BELEZA',    $sel_v_Q_14_1); }?>>Beleza.</option>
                                                <option value="COMÉRCIO"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'COMÉRCIO',    $sel_v_Q_14_1); }?>>Comércio.</option>
                                                <option value="CONSERVAÇÃO/ZELADORIA"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'CONSERVAÇÃO/ZELADORIA',    $sel_v_Q_14_1); }?>>Conservação/Zeladoria.</option>
                                                <option value="COMUNICAÇÃO/EVENTOS/ATENDIMENTO"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'COMUNICAÇÃO/EVENTOS/ATENDIMENTO',    $sel_v_Q_14_1); }?>>Comunicação/Eventos/Atendimento ao Público.</option>
                                                <option value="EDUCACIONAL"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'EDUCACIONAL',    $sel_v_Q_14_1); }?>>Educacional.</option>
                                                <option value="IDIOMAS"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'IDIOMAS',    $sel_v_Q_14_1); }?>>Idiomas.</option>
                                                <option value="INDÚSTRIA"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'INDÚSTRIA',    $sel_v_Q_14_1); }?>>Indústria.</option>
                                                <option value="INFORMÁTICA"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'INFORMÁTICA',    $sel_v_Q_14_1); }?>>Informática.</option>
                                                <option value="LAZER/ESPORTES"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'LAZER/ESPORTES',    $sel_v_Q_14_1); }?>>Lazer/Esportes.</option>
                                                <option value="MODA"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'MODA',    $sel_v_Q_14_1); }?>>Moda.</option>
                                                <option value="SEGURANÇA"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'SEGURANÇA',    $sel_v_Q_14_1); }?>>Segurança.</option>
                                                <option value="SOCIAL"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'SOCIAL',    $sel_v_Q_14_1); }?>>Social.</option>
                                                <option value="NAO SE INTERESSA"    <?php if(isset($sel_v_Q_14_1)){echo selected( 'NAO SE INTERESSA',    $sel_v_Q_14_1); }?>>Não tenho interesse em nenhuma área.</option>
                                                <option VALUE="OUTRO" <?php if(isset($sel_v_Q_14_1)){echo selected( 'OUTRO', $sel_v_Q_14_1); }?>>Outro</option>
                                            </select>
										</div>	
                                        <div class="col-lg-6 col-md-2 col-xs-8">     <!-- Q 14 - Outros -->
											<div id= "box-v_Q_14_1" style='display:none'> 
												<label>Outro</label><br>
												<input class='form-control text-uppercase' name='v_Q_14_2' type="text" placeholder="Outros..." <?php if (!$RegNovo){echo "value='" . $v_Q_14_2 . "'";} ?>>
											</div>										
										</div>	
									</div>	
								</div>	
							</div>	
							
						<!-- BOTÃO FINALIZR -->	
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <br><br><label>Clique no botão abaixo para finalizar a inscrição!</label>
                            </div>
                            <hr>
                            <div class="col-lg-10 text-center col-lg-offset-1" >
                                <br><button type="button" id="btnform1" class="btn btn-default" onclick="return enviardados();" >Concluir</button><br>
                            </div>
                        </div>
							
                    </div>
                </div>
            </div>
		</div>
<!-- ---------------------------------------------------------------------------------------------->
<!-- -----  FIM  QUESTIONÁRIO  -------------------------------------------------------------------->
<!-- ---------------------------------------------------------------------------------------------->

</form>

<!-- fim do conteudo -->
<!--footer-starts-->
<div class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="col-md-6 footer-left">
            </div>
            <div class="col-md-6 footer-right">
                <p>© 2016 DITI - Diretoria de Informática e Tecnologia da Informação. All Rights Reserved | Design by  <a href="http://www.crianca.df.gov.br/" target="_blank">DITI</a> </p>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!--footer-end-->
<script language="JavaScript" >
//EXECUTAR SCRIPTS
//mudaBairro();
mudaEstcivil();
mudaBene();
mudaEscolaridade();
mudaEnsiSup();
mudaEnsiSupPubl();
mudaEnsiSupPart();

mudav_Q_1_1() ;
mudav_Q_4_1() ;
mudav_Q_6_1() ;
mudav_Q_7_1() ;
mudav_Q_8_1() ;
mudav_Q_9_1() ;
mudav_Q_10_1();
mudav_Q_12_1();
mudav_Q_13_1();
mudav_Q_14_1();


	function enviardados(){
					
		v_err = "";
    //*****************
	// CRIANCA
	
		if (document.form1.cpfcri.value==""){ 
			alert( "Preencha o seu cpf!" );
			document.form1.cpfcri.focus();
			return false;
		}


		if      (document.form1.nome.value=="")            { v_err = "Preencha o seu nome!";           document.form1.nome.focus();       }		
		else if (document.form1.nascimento.value=="")      { v_err = "Preencha a data de nascimento!"; document.form1.nascimento.focus(); }		
		else if (document.form1.cpfcri.value=="")          { v_err = "Preencha o seu cpf!";           document.form1.cpfcri.focus();      }		
		else if (document.form1.end.value=="")             { v_err = "Preencha o endereço!";           document.form1.end.focus();        }		
		else if (document.form1.end.value=="")             { v_err = "Preencha o endereço!";           document.form1.end.focus();        }		
		else if (document.form1.uf.value=="")              { v_err = "Preencha a UF!";                  document.form1.uf.focus();        }		
		else if (document.form1.bairro.value=="")          { v_err = "Preencha o bairro!";             document.form1.bairro.focus();     }		
		else if (document.form1.cidade.value=="")          { v_err = "Preencha o cidade!";              document.form1.cidade.focus();    }		
		else if (document.form1.cep.value=="")             { v_err = "Preencha o CEP!";                document.form1.cep.focus();        }		
                                                                                                                
		else if (document.form1.natural.value=="")         { v_err = "Preencha a sua Naturalidade!";   document.form1.natural.focus();    }		
		else if (document.form1.nacional.value=="")        { v_err = "Preencha a sua Nacionalidade!";  document.form1.nacional.focus();   }
		else if ((document.form1.cel.value=="") &&                                                              
		         (document.form1.cel1.value==""))          { v_err = "Preencha o celular!";            document.form1.cel.focus();        }
		else if (document.form1.raca.value=="false")       { v_err = "Preencha a raça!";               document.form1.raca.focus();       }
		else if (document.form1.estadoCivil.value=="false"){ v_err = "Preencha o estado civil!";       document.form1.estadoCivil.focus();}
		else if (document.form1.macroreg.value=="")        { v_err = "Preencha a Macroregião!";        document.form1.macroreg.focus();   }
		else if (document.form1.insc_enem.value=="")       { v_err = "Preencha a inscrição do ENEM!";  document.form1.insc_enem.focus();  }
		else if ((document.form1.mat.checked == false) && 
		         (document.form1.not.checked == false) && 
		         (document.form1.vesp.checked == false))   { v_err = "Selecione o turno!";             document.form1.insc_enem.focus();  }
		else if ((document.form1.progGdf.checked == false) && 
		         (document.form1.progGdf.checked == false))   { v_err = "Selecione se você é beneficiário de algum programa social!"; 
				                                                                                       document.form1.progGdf.focus();  }
    //*****************
	// ESCOLARIDADE
		else if (document.form1.escolaridade.value=="0"){ v_err = "Preencha a escolaridade!";       document.form1.escolaridade.focus();}
		else if (document.form1.rede.value=="")         { v_err = "Preencha a rede de ensino";      document.form1.rede.focus();}
		else if (document.form1.escola.value=="")       { v_err = "Preencha o nome da escola!";     document.form1.escola.focus();}
		else if (document.form1.matematica.value=="")   { v_err = "Preencha a nota de matemática!"; document.form1.matematica.focus();}
		else if (document.form1.portugues.value=="")    { v_err = "Preencha a nota de português!";  document.form1.portugues.focus();}
    //*****************
	// QUESTIONARIO
		else if (document.form1.progv_Q_2_2.value=="")  { v_err = "Preencha todo o questionário!";  document.form1.progv_Q_2_2.focus();  }
		else if (document.form1.v_Q_3_1.value=="")      { v_err = "Preencha todo o questionário!";  document.form1.v_Q_3_1.focus();      }
		else if (document.form1.progv_Q_4_1.value=="")  { v_err = "Preencha todo o questionário!";  document.form1.progv_Q_4_1.focus();  }
		else if (document.form1.v_Q_5_1.value=="")      { v_err = "Preencha todo o questionário!";  document.form1.v_Q_5_1.focus();      }
		else if (document.form1.progv_Q_6_1.value=="0") { v_err = "Preencha todo o questionário!";  document.form1.progv_Q_6_1.focus();  }
		else if (document.form1.progv_Q_9_1. value=="") { v_err = "Preencha todo o questionário!";  document.form1.progv_Q_9_1.focus();  }
		else if (document.form1.progv_Q_13_1.value=="") { v_err = "Preencha todo o questionário!";  document.form1.progv_Q_13_1.focus(); }
		else if (document.form1.progv_Q_14_1.value=="") { v_err = "Preencha todo o questionário!";  document.form1.progv_Q_14_1.focus(); };

		if (v_err != "") {
			alert( v_err );
			return false;
		}
		
		document.form1.submit();
	}
</script>		
</body>
</html>
<?PHP
ob_flush();
?>
