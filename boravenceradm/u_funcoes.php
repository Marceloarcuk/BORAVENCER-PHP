<?php

include '../conect.php';

setlocale(LC_ALL, "pt_BR", "pt_BR.iso-8859-1", "pt_BR.utf-8", "portuguese");
date_default_timezone_set('America/Sao_Paulo');


//-------------------------------------
//----- RETORNA DATA DO SERVIDOR DB
function fDataServer() {
	global $connect;	
	$RESULTSERV='';
	try {
		$RS_DTSRV=$connect->PREPARE('SELECT NOW() AS DTSERVER');
		IF($RS_DTSRV->EXECUTE()){
			IF($RS_DTSRV->ROWCOUNT()>=1){
				IF($REG_DTSRV= $RS_DTSRV->FETCH(PDO::FETCH_OBJ)){$RESULTSERV = $REG_DTSRV->DTSERVER;};};};
	} catch (Exception $e) {
		$RESULTSERV = date('Y-m-d H:i:s');
	} finally {
	    return $RESULTSERV;
	};
};

//-------------------------------------
//----- NOVO INDEX DA TABELA
function NovoIndexDB($fCampo,$fTabela, $fDBase) {
	global $connect;	
	if ($fDBase <> ""){$fDBaseponto = $fDBase . '.';};
	$novoCodigo = 0;
	try {
		$rs_ncod=$connect->prepare("SELECT max(" . $fCampo . ") as newcod FROM " . $fDBaseponto . $fTabela . ";");
		if($rs_ncod->execute()){
			if($rs_ncod->rowCount()>=1){
				if($reg_ncod = $rs_ncod->fetch(PDO::FETCH_OBJ)){$novoCodigo = $reg_ncod->newcod+1;};};};
	} catch (Exception $e) {
		$novoCodigo = 0;
	} finally {
	    return $novoCodigo;
	};	
};

//-------------------------------------
//----- NOVO INDEX DA TABELA
function AbreConsulta($SQLconsulta) {
	global $connect;	
	$resultadosAbreConsulta=0;
	try {

	} catch (Exception $e) {
    	$resultadoF=Null;
	} finally {
	    return $resultadoF;
	};	
};

										
										



	
//-------------------
//CALCULAR DATA
//-------------------
function DataChat($Dtini,$Dtfim) {
		$Dt_timeH = '0';
		$Dt_timeM = '0';
		$Dt_timeS = '0';
		$date_time  = new DateTime( $Dtfim );		
		$diff       = $date_time->diff( new DateTime( $Dtini ) );
		$Dt_time = $diff->format('%d');
		$Dt_timeH = $diff->format('%h');
		$Dt_timeM = $diff->format('%i');
		$Dt_timeS = $diff->format('%s');
		if       ($Dt_time == '1'){$Dt_time = '1 dia';}
		else if (($Dt_time == '0') and ($Dt_timeH > '0') and ($Dt_timeM > '0')){$Dt_time = $diff->format( '%h hora(s) e %i minuto(s)');}
		else if (($Dt_time == '0') and ($Dt_timeH > '0') and ($Dt_timeM == '0')){$Dt_time = $diff->format( '%h hora(s)');}
		else if (($Dt_time == '0') and ($Dt_timeH == '0') and ($Dt_timeM > '0') and ($Dt_timeS > '0')){$Dt_time = $diff->format( '%i minuto(s) e %s segundo(s)');}
		else if (($Dt_time == '0') and ($Dt_timeH == '0') and ($Dt_timeM > '0') and ($Dt_timeS == '0')){$Dt_time = $diff->format( '%i minuto(s) ');}
		else if (($Dt_time == '0') and ($Dt_timeH == '0') and ($Dt_timeM == '0') and ($Dt_timeS > '0')){$Dt_time = $diff->format( '%s segundo(s)');}
		else if (($Dt_time == '0') and ($Dt_timeH == '0') and ($Dt_timeM == '0') and ($Dt_timeS == '0')){$Dt_time = $diff->format( 'agora');}
		else{$Dt_time = date_format($date_time,"Y-m-d");};	
		
		return $Dt_time;
}


?>	
