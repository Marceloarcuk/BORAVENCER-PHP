<?php
$sql1="select id_cri, cpf_cri, nome_cri, email_cri, nome_cri, id_facebook ,sis_dt_insert_cri from tb_crianca
                       where email_cri='".$_SESSION['emailuser']."' ;";
$sql2="select id_cri, cpf_cri, nome_cri, email_cri, nome_cri, id_facebook ,sis_dt_insert_cri from tb_crianca
                       where email_cri='".$_POST['cpfcri']."' ;";


$sql3="insert into tb_crianca(
                              id_cri,	nome_cri, cpf_cri, rg_cri, titulo_eleitor_cri, nacionalidade_cri, 	naturalidade_cri,
                              end_cri, end_comp_cri, end_bairro_cri, end_uf_cri, end_cep_cri,	fone_cel_cri, fone_cel_cri1,
                              whatsapp_cri, facebook_cri,	email_cri, 	dt_nasc_cri, cidade_cri, id_facebook, id_raca, estado_civil_cri,
                              outro_est_civil_cri, pass_cri, beneficiario_cri, nome_p_beneficiario_cri, cadunico_cri, inscricao_enem_cri,
                              deseja_estudar_turno_cri1, deseja_estudar_turno_cri2, deseja_estudar_macroregio_cri1 )
                              values=(
                              '".$idc."', '".strtoupper($_POST['nome'])."', '".strtoupper($_POST['cpfcri'])."', '".$_POST['rg']."',
                              '".$_POST['titulo']."', '".$_POST['nacional']."', '".$_POST['natural']."', '".$_POST['end']."',
                              '".$_POST['end_comp']."', '".$_POST['bairro']."', '".$_POST['uf']."', '".$_POST['cep']."', '".$_POST['cel']."',
                              '".$_POST['cel1']."', '".$_POST['whatsapp']."', '".$_POST['facebook']."','".$_SESSION['emailuser']."' , '".$_SESSION['nascimento']."',
                              '".$_POST['raca']."',  '".$_POST['estadoCivil']."', '".$_POST['outroCivil']."', '".$_SESSION['senhauser']."','".$_POST['progGdf']."',
                              '".$_POST['nomeProgGdf']."','".$_POST['cadUnico']."' , '".$_POST['insc_enem']."', '".$_POST['mat']."', '".$_POST['vesp']."',
                              '".$_POST['not']."', '".$_POST['not']."' ) ;";