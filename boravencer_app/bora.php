<?php

if(isset($tpl['dadosCri'])){

    foreach ($tpl['dadosCri'] as $info) {



    }

}

?>
<form role="form" method="post" action="">
    <div class="container">



        <div class="row">

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



                        <div class="col-lg-12">



                            <div class="row">

                                <div class="col-lg-4 col-md-4 col-xs-12">



                                    <div class="form-group">

                                        <label>Nome completo *</label>

                                        <input class="form-control text-uppercase" name="nome"

                                            <?php
                                            if(isset($_POST['nome'])){ echo "value='" . $_POST["nome"] . "'";}


                                            if(isset($tpl['nomeface'])) { echo "value='" . $tpl['nomeface'] . "'"; }

                                            if(isset($info["nome_cri"])) { echo "value='" . $info["nome_cri"] . "'"; }

                                            ?>

                                        >

                                        <p class="help-block">Preencha o seu nome e sobrenome.</p>

                                    </div>

                                </div>

                                <div class="col-lg-3 col-md-3 col-xs-12">

                                    <div class="form-group">

                                        <label>Data de nascimento*</label>



                                        <input type="date" class="form-control" name="nascimento"

                                            <?php

                                            if(isset($_POST['nascimento']))
                                            { echo "value='" . $_POST["nascimento"] . "'";}
                                            else { echo "value='" . $info["dt_nasc_cri"] . "'"; }  ?>

                                        >



                                    </div>

                                </div>

                                <div class="form-group">

                                    <div class="col-lg-2 col-xs-12 col-md-2 ">



                                        <div class="form-group">



                                            <label>CPF*</label>





                                            <input class="form-control" id="ex3" placeholder="Somente números..." name="cpfcri"
                                                   maxlength="11" <?php


                                            if(isset($_SESSION["cpfuser"])) {

                                                echo "value='" . $_SESSION["cpfuser"] . "'"; }
                                            else{
                                                echo "value='" . $_POST["cpfcri"] . "'";
                                            }			?>  >



                                        </div>

                                    </div>

                                    <div class="col-lg-3 col-xs-12 col-md-3" >

                                        <div class="checkbox">

                                            <label>

                                                <br> <input type="checkbox" value="1" name="semcpf">Não possuo CPF*



                                            </label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-12">



                                <div class="form-group">

                                    <div class="col-xs-12 col-md-3 col-lg-3">

                                        <label>Titulo de Eleitor</label><br>



                                        <input class="form-control" id="ex3" placeholder="Somente números..."
                                               maxlength="20" name="tituloe"

                                            <?php
                                            if(isset($_POST['titulo'])){ echo "value='" . $_POST["titulo"] . "'";}
                                            ?>

                                        >

                                    </div>

                                    <div class="col-lg-3 col-xs-12 col-md-3">



                                        <div class="form-group">

                                            <label>RG*</label>





                                            <input class="form-control" id="ex3" placeholder="RG..." name="rg"
                                                   maxlength="14"

                                                <?php

                                                if(isset($_POST['rg'])){ echo "value='" . $_POST["rg"] . "'";}
                                                if(isset($info["rg_cri"])) { echo "value='" . $info["rg_cri"] . "'"; }  ?>

                                            >



                                        </div>

                                    </div>

                                    <div class="col-lg-2 col-xs-12 col-md-2">



                                        <div class="form-group">

                                            <label>Órgão expedidor*</label>



                                            <input class="form-control text-uppercase" id="ex3" placeholder="Ex: SSP-DF ..." name="orgao" maxlength="9"
                                                <?php
                                                if(isset($_POST['orgao'])){ echo "value='" . $_POST["orgao"] . "'";}

                                                ?>


                                            >



                                        </div>

                                    </div>

                                    <div class="col-lg-3 col-xs-12 col-md-3">

                                        <div class="checkbox">

                                            <label>

                                                <br> <input type="checkbox" value="1" name="naorg">Não possuo RG*

                                            </label>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>





                        <div class="row">

                            <div class="col-lg-12">



                                <div class="form-group">

                                    <div class="col-lg-5 col-md-4 col-xs-12">





                                        <label>Endereço*</label>

                                        <input type="text" class="form-control text-uppercase" name="end" maxlength="60"

                                            <?php

                                            if(isset($_POST['end'])){ echo "value='" . $_POST["end"] . "'";}
                                            else{ echo "value='" . $info["end_cri"] . "'"; }  ?>

                                        >

                                        <p class="help-block">Preencha seu endereço...</p>

                                    </div>







                                    <div class="col-lg-3 col-md-2 col-xs-8">





                                        <label>Complemento</label>

                                        <input class="form-control text-uppercase" type="text" name="end_comp"
                                               maxlength="30"

                                            <?php
                                            if(isset($_POST['end_comp'])){ echo "value='" . $_POST["end_comp"] . "'";}
                                            else { echo "value='" . $info["end_comp_cri"] . "'"; }  ?>

                                        >



                                        <p class="help-block">Complemento...</p>

                                    </div>
                                    <?php
                                    if(isset($info['end_bairro_cri'])){
                                        $bairro=$info['end_bairro_cri'];
                                    }
                                    ?>
                                    <script>
                                        function mudaBairro() {
                                            var x = document.getElementById("mySelect").value;
                                            if(x=="DF"){
                                                $("#box-bairro2").css("display", "block");
                                                document.getElementById("box-bairro2").innerHTML =
                                                    "<div class='col-lg-2 col-md-2 col-xs-8'>"+
                                                    "<label>Bairro*</label>" +
                                                    "<select name='bairro' class='form-control' >"+
                                                    "<option value='0' ></option>"+
                                                    "<option value='BRASÍLIA'>Brasília</option>"+
                                                    "<option value='GAMA'>Gama</option>"+
                                                    " <option value='TAGUATINGA'>Taguatinga</option>"+
                                                    " <option value='BRAZLÂNDIA'>Brazlândia</option>"+
                                                    " <option value='SOBRADINHO'>Sobradinho</option>"+
                                                    "<option value='PLANALTINA'>Planaltina</option>"+
                                                    " <option value='PARANOÁ'>Paranoá</option>"+
                                                    "<option value='NÚCLEO BANDEIRANTE'>Núcleo Bandeirante</option>"+
                                                    " <option value='CEILÂNDIA'>Ceilândia</option>"+
                                                    " <option value='GUARÁ'>Guará</option>"+
                                                    "<option value='CRUZEIRO'>Cruzeiro</option>"+
                                                    "<option value='SAMABAIA'>Samambaia</option>"+
                                                    "<option value='SANTA MARIA'>Santa Maria</option>"+
                                                    " <option value='SÃO SEBASTIÃO'>São Sebastião</option>"+
                                                    "<option value='RECANTO DAS EMAS'>Recanto das Emas</option>"+
                                                    " <option value='LAGO SUL'>Lago Sul</option>"+
                                                    "<option value='RIACHO FUNDO I'>Riacho Fundo I</option>"+
                                                    "<option value='LAGO NORTE'>Lago Norte</option>"+
                                                    " <option value='CANDANGOLÂNDIA'>Candangolândia</option>"+
                                                    " <option value='ÁGUAS CLARAS'>Águas Claras</option>"+
                                                    "<option value='RIACHO FUNDO I'>Riacho Fundo II</option>"+
                                                    "<option value='SUDOESTE/OCTOGONAL'>Sudoeste/Octogonal</option>"+
                                                    "<option value='VARJÃO'>Varjão</option>"+
                                                    " <option value='PARKWAY'>ParkWay</option>"+
                                                    " <option value='SCIA'>SCIA</option>"+
                                                    " <option value='SOBRADINHO II'>Sobradinho II</option>"+
                                                    "<option value='JARDIM BOTÂNICO'>Jardim Botânico</option>"
                                                    +"<option value='ITAPOÃ'>Itapoã</option>"
                                                    +" <option value='SIA'>SIA</option>"+
                                                    "<option value='VICENTE PIRES'>Vicente Pires</option>"+
                                                    " </select>"+
                                                    " </div>";
                                                $("#box-bairro").css("display", "none");


                                            }
                                            else{
                                                $("#box-bairro").css("display", "block");
                                                document.getElementById("box-bairro").innerHTML =
                                                    "<div class='col-lg-2 col-md-2 col-xs-8'>" +
                                                    "<label>Bairro*</label>"+
                                                    "<input class='form-control text-uppercase' type='text' name='bairro' >"+
                                                    " <p class='help-block'></p>"+"</div>";

                                                $("#box-bairro2").css("display", "none");

                                            }


                                        }


                                    </script>



                                    <div class="form-group">

                                        <div class="col-lg-2 col-md-1 col-xs-5">





                                            <label>UF*</label>

                                            <select class="form-control" name="uf" id="mySelect"  onchange="mudaBairro();">
                                                <?php
                                                if(isset($_POST['uf'])){$uf=$_POST['uf'];}
                                                if(isset($info['end_uf_cri'])){$uf=$info['end_uf_cri'] ;}

                                                ?>

                                                <option value="0" <?php if(isset($uf)){echo selected( '', $uf);} ?>></option>
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



                                        <?php
                                        if(isset($_POST['bairro'])){
                                            $bairro=$_POST['bairro'];

                                        }
                                        if(isset($uf) && $uf == 'DF'){

                                            echo " <div id='box-bairro2'  style='display: block;'>";
                                            echo    "<div class='col-lg-2 col-md-2 col-xs-8'>";
                                            echo    "<label>Bairro*</label>";
                                            echo        "<select name='bairro' class='form-control' >";
                                            echo        "<option value='0' ></option>";
                                            echo    "<option value='BRASÍLIA'";
                                            if(isset($bairro)){echo selected( 'BRASÍLIA', $bairro); }
                                            echo ">Brasília</option>";
                                            echo        "<option value='GAMA'";
                                            if(isset($bairro)){echo selected( 'GAMA', $bairro); }
                                            echo ">Gama</option>";
                                            echo        " <option value='TAGUATINGA'";
                                            if(isset($bairro)){echo selected( 'TAGUATINGA', $bairro); }
                                            echo ">Taguatinga</option>";
                                            echo " <option value='BRAZLÂNDIA'";
                                            if(isset($bairro)){echo selected( 'BRAZLÂNDIA', $bairro); }
                                            echo ">Brazlândia</option>";
                                            echo " <option value='SOBRADINHO'";
                                            if(isset($bairro)){echo selected( 'SOBRADINHO', $bairro); }
                                            echo ">Sobradinho</option>";
                                            echo "<option value='PLANALTINA'";
                                            if(isset($bairro)){echo selected( 'PLANALTINA', $bairro); }
                                            echo ">Planaltina</option>";
                                            echo " <option value='PARANOÁ'";
                                            if(isset($bairro)){echo selected( 'PARANOÁ', $bairro); }
                                            echo ">Paranoá</option>";
                                            echo "<option value='NÚCLEO BANDEIRANTE'";
                                            if(isset($bairro)){echo selected( 'NÚCLEO BANDEIRANTE', $bairro); }
                                            echo ">Núcleo Bandeirante</option>";
                                            echo " <option value='CEILÂNDIA'";
                                            if(isset($bairro)){echo selected( 'CEILÂNDIA', $bairro); }
                                            echo ">Ceilândia</option>";
                                            echo " <option value='GUARÁ'";
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
                                            echo " <option value='SÃO SEBASTIÃO'";
                                            if(isset($bairro)){echo selected( 'SÃO SEBASTIÃO', $bairro); }
                                            echo ">São Sebastião</option>";
                                            echo "<option value='RECANTO DAS EMAS'";
                                            if(isset($bairro)){echo selected( 'RECANTO DAS EMAS', $bairro); }
                                            echo ">Recanto das Emas</option>";
                                            echo " <option value='LAGO SUL'";
                                            if(isset($bairro)){echo selected( 'LAGO SUL', $bairro); }
                                            echo ">Lago Sul</option>";
                                            echo "<option value='LAGO NORTE'";
                                            if(isset($bairro)){echo selected( 'LAGO NORTE', $bairro); }
                                            echo ">Lago Norte</option>";
                                            echo" <option value='ÁGUAS CLARAS'";
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
                                            echo " <option value='PARKWAY'";
                                            if(isset($bairro)){echo selected( 'PARKWAY', $bairro); }
                                            echo ">ParkWay</option>";
                                            echo " <option value='SCIA'";
                                            if(isset($bairro)){echo selected( 'SCIA', $bairro); }
                                            echo ">SCIA</option>";
                                            echo " <option value='SOBRADINHO II'";
                                            if(isset($bairro)){echo selected( 'SOBRADINHO II', $bairro); }
                                            echo ">Sobradinho II</option>";
                                            echo "<option value='JARDIM BOTÂNICO'";
                                            if(isset($bairro)){echo selected( 'JARDIM BOTÂNICO', $bairro); }
                                            echo ">Jardim Botânico</option>";
                                            echo "<option value='ITAPOÃ'";
                                            if(isset($bairro)){echo selected( 'ITAPOÃ', $bairro); }
                                            echo ">Itapoã</option>";
                                            echo " <option value='SIA'";
                                            if(isset($bairro)){echo selected( 'SIA', $bairro); }
                                            echo ">SIA</option>";
                                            echo  "<option value='VICENTE PIRES'";
                                            if(isset($bairro)){echo selected( 'VICENTE PIRES', $bairro); }
                                            echo ">Vicente Pires</option>";
                                            echo  " </select>";
                                            echo " </div>";
                                        }
                                        else{
                                            echo "<div id='box-bairro'  style='display: block;'>";
                                            echo    "<div class='col-lg-2 col-md-2 col-xs-8'>";
                                            echo    "<label>Bairro*</label>";
                                            echo    "<input class='form-control text-uppercase' type='text' name='bairro' >";
                                            echo    " <p class='help-block'></p>";
                                            echo    "</div>";
                                            echo    "</div>";

                                        }

                                        ?>
                                        <div id='box-bairro'  style='display: block;'></div>
                                        <div id='box-bairro2'  style='display: none;'></div>





                                    </div>

                                </div>

                            </div>





                            <div class="col-lg-12">

                                <div class="form-group">

                                    <div class="col-lg-3 col-md-2 col-xs-8">





                                        <label>Cidade*</label>

                                        <input class="form-control text-uppercase" type="text" name="cidade"

                                            <?php
                                            if(isset($_POST['cidade'])){ echo "value='" . $_POST["cidade"] . "'";}
                                            if(isset($info["cidade_cri"])) { echo "value='" . $info["cidade_cri"] . "'"; }  ?>

                                        >

                                        <p class="help-block">...</p>

                                    </div>



                                    <div class="form-group">

                                        <div class="col-lg-3 col-md-2 col-xs-8">





                                            <label>CEP*</label>

                                            <input class="form-control" type="text" name="cep" maxlength="8"

                                                <?php
                                                if(isset($_POST['cep'])){

                                                    echo "value='" . $_POST["cep"] . "'";}
                                                if(isset($info["end_cep_cri"])) {

                                                    echo "value='" . $info["end_cep_cri"] . "'"; }  ?>

                                            >

                                            <p class="help-block">...</p>

                                        </div>





                                        <div class="form-group">

                                            <div class="col-lg-2 col-md-2 col-xs-8">





                                                <label>Naturalidade:</label>

                                                <input type="text" class="form-control text-uppercase" name="natural"
                                                       value="Brasília">




                                            </div>



                                        </div>

                                        <div class="col-lg-2 col-md-2 col-xs-8">





                                            <label>Nacionalidade:</label>

                                            <input class="form-control text-uppercase" value="BRASIL" name="nacional"

                                                <?php
                                                if(isset($_POST['nacional'])){ echo "value='" . $_POST["nacional"] . "'";}
                                                else{ echo "value='" . $info["nacionalidade_cri"] . "'"; }  ?>

                                            >





                                        </div>



                                    </div>
                                </div>



                                <div class="col-lg-12">

                                    <div class="col-lg-2 col-md-2 col-xs-8">



                                        <label>Telefone Celular*</label>

                                        <input class="form-control" type="tel" name="cel"

                                            <?php
                                            if(isset($_POST['cel'])){ echo "value='" . $_POST["cel"] . "'";}
                                            else { echo "value='" . $info["fone_cel_cri"] . "'"; }  ?>

                                        >

                                        <p class="help-block">...</p>

                                    </div>

                                    <div class="col-lg-2 col-md-2 col-xs-8">





                                        <label>Telefone Celular1</label>

                                        <input class="form-control" type="text" name="cel1"

                                            <?php
                                            if(isset($_POST['cel1'])){ echo "value='" . $_POST["cel1"] . "'";}
                                            else { echo "value='" . $info["fone_cel_cri1"] . "'"; }  ?>

                                        >

                                        <p class="help-block">...</p>

                                    </div>

                                    <div class="col-lg-2 col-md-2 col-xs-8">





                                        <label>Whatsapp</label>

                                        <input class="form-control" type="text" name="whats"

                                            <?php
                                            if(isset($_POST['whats'])){ echo "value='" . $_POST["whats"] . "'";}
                                            else { echo "value='" . $info["whatsapp_cri"] . "'"; }  ?>

                                        >

                                        <p class="help-block">...</p>

                                    </div>

                                    <div class="col-lg-4 col-md-4 col-xs-8">
                                        <input class="form-control" type="hidden" name="face"

                                            <?php
                                            if(isset($_POST['face'])){ echo "value='" . $_POST["face"] . "'";}
                                            if(isset($info["facebook_cri"])) { echo "value='" . $info["facebook_cri"] . "'"; }

                                            if(isset($tpl["idface"])) { echo "value='www.facebook.com/" . $tpl["idface"] . "'"; }

                                            ?>

                                        >

                                        <p class="help-block">...</p>

                                    </div>

                                    <div class="col-lg-2 col-md-2 col-xs-8">
                                        <label> Raça:* </label>
                                        <select class="form-control text-uppercase" name="raca">
                                            <?php
                                            if(isset($info['id_raca'])){
                                                $raca=$info['id_raca'];
                                            }
                                            if(isset($_POST['raca'])){
                                                $raca=$_POST['raca'];
                                            }

                                            ?>

                                            <option value="false" <?php if(isset($raca)){echo selected( 'false', $raca); }?> > </option>
                                            <option value=0 <?php if(isset($raca)){echo selected( '0', $raca); }?>>Branca</option>
                                            <option value=1 <?php if(isset($raca)){echo selected( '1', $raca); }?> >Preta</option>
                                            <option value=2 <?php if(isset($raca)){echo selected( '2', $raca); }?>> Amarela</option>
                                            <option value=3 <?php if(isset($raca)){echo selected( '3', $raca); }?>>Parda</option>
                                            <option value=4 <?php if(isset($raca)){echo selected( '4', $raca); }?>>Indígena</option>
                                            <option value=5 <?php if(isset($raca)){echo selected( '5', $raca); }?>>Outro</option>


                                        </select>
                                    </div>
                                </div>
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



                            <div class="col-lg-12 col-md-12 col-xs-12">

                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <label> Qual seu estado civil?* </label>
                                    <select class="form-control text-uppercase" name="estadoCivil"  id="estcivilSelect"  onchange="mudaEstcivil();">
                                        <?php
                                        if(isset($_POST['estadoCivil']) && $_POST['estadoCivil'] != "false"){
                                            $estCivil=$_POST['estadoCivil'];
                                        }


                                        ?>

                                        <option value="false" <?php if(isset($estCivil)){echo selected( 'false', $estCivil); }?> > </option>

                                        <option value="CASADO" <?php if(isset($estCivil)){echo selected( 'CASADO', $estCivil); }?>>Casado</option>

                                        <option value="SOLTEIRO" <?php if(isset($estCivil)){echo selected( 'SOLTEIRO', $estCivil); }?> >Solteiro</option>
                                        <option value="VIUVO" <?php if(isset($estCivil)){echo selected( 'VIUVO', $estCivil); }?>> Viúvo</option>

                                        <option value="SEPARADO/DIVORCIADO" <?php if(isset($estCivil)){echo selected( 'SEPARADO/DIVORCIADO', $estCivil); }?>>Separado/Divorciado</option>

                                        <option value="OUTRO" <?php if(isset($estCivil)){echo selected( 'OUTRO', $estCivil); }?>>Outro</option>


                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <div id='box-estcivil'  style='display: none;'>
                                        <label>Outro</label><br>
                                        <input class='form-control text-uppercase' name='outroCivil' type="text" placeholder='Estado civil...' <?php  if(isset($_POST['outroCivil'])){ echo "value='" . $_POST["outroCivil"] . "'";}?>
                                        >

                                    </div>

                                </div>

                            </div>

                            <hr>
                            <script>

                                $(document).ready(function(){
                                    $("#sim_b").click(function(evento){
                                        if ($("#sim_b").attr("checked")){
                                            $("#box-progGdf").css("display", "block");

                                        }else{
                                            $("#box-progGdf").css("display", "none");

                                        }
                                    });
                                });
                                $(document).ready(function(){
                                    $("#nao_b").click(function(evento){
                                        if ($("#nao_b").attr("checked")){
                                            $("#box-progGdf").css("display", "none");

                                        }else{
                                            $("#box-progGdf").css("display", "block");

                                        }
                                    });
                                });




                            </script>
                            <div class="col-lg-5 col-md-5 col-lg-offset-1 col-lg-offset-1 col-xs-12">
                                <br><label> Qual turno você deseja estudar? (Você pode marcar até duas opções) </label><br><br>

                                <label class="checkbox-inline"><input type="checkbox" name="mat" value="MAT"
                                        <?php if(isset($_POST['mat'])){echo checked( 'MAT', $_POST['mat']); } ?> >Matutino</label>
                                <label class="checkbox-inline"><input type="checkbox" name="vesp" value="VESP"
                                        <?php if(isset($_POST['vesp'])){echo checked( 'VESP', $_POST['vesp']); } ?>
                                    >Vespertino</label>
                                <label class="checkbox-inline"><input type="checkbox" name="not" value="NOT"
                                        <?php if(isset($_POST['not'])){echo checked( 'NOT', $_POST['not']); } ?>
                                    >Noturno</label>
                            </div>
                            <hr>

                            <div class="col-lg-5 col-md-5 col-lg-offset-1 col-lg-offset-1 col-xs-12">
                                <br><label> Caso haja disponibilidade, você desejaria estudar em qual macrorregião, como segunda opção? </label><br><br>
                                <select class="form-control" name="macroreg" >
                                    <option value="0"
                                        <?php if(isset($_POST['macroreg'])){echo selected( '0', $_POST['macroreg']); }?>
                                    ></option>
                                    <option value="TAGUATINGA"
                                        <?php if(isset($_POST['macroreg'])){echo selected( 'TAGUATINGA', $_POST['macroreg']); }?>
                                    >Macrorregião Taguatinga</option>
                                    <option value="GAMA"
                                        <?php if(isset($_POST['macroreg'])){echo selected( 'GAMA', $_POST['macroreg']); }?>
                                    >Macrorregião Gama</option>
                                    <option value="SOBRADINHO"
                                        <?php if(isset($_POST['macroreg'])){echo selected( 'SOBRADINHO', $_POST['macroreg']); }?>
                                    >Macrorregião Sobradinho</option>
                                    <option value="BRASILIA"
                                        <?php if(isset($_POST['macroreg'])){echo selected( 'BRASILIA', $_POST['macroreg']); }?>
                                    >Macrorregião Brasília</option>
                                </select>
                            </div>
                            <hr>


                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-lg-offset-1 col-lg-offset-1 col-xs-12">
                                    <br><label>Você é beneficiário de algum programa social do Governo Federal ou do Governo do Distrito Federal (exemplo: programa Bolsa Família)?*
                                    </label>
                                    <label class='radio-inline'>
                                        <input type='radio' name='progGdf' id='sim_b' value='SIM'
                                            <?php if(isset($_POST['progGdf'])){echo checked( 'SIM', $_POST['progGdf']); } ?>
                                        > Sim
                                    </label>
                                    <label class='radio-inline'>
                                        <input type='radio' name='progGdf' id='nao_b' value='NAO'
                                            <?php    if(isset($_POST['progGdf'])){echo checked( 'NAO', $_POST['progGdf']); } ?>
                                        > Não
                                    </label>


                                </div>
                                <div class="col-lg-5 col-md-5 col-xs-12">
                                    <div id='box-progGdf'  style='display: none;'>
                                        <br> <label>Qual?</label><br>
                                        <input class='form-control text-uppercase' name='nomeProgGdf' type="text" placeholder='Nome do programa...'   <?php  if(isset($_POST['nomeProgGdf'])){ echo "value='" . $_POST["nomeProgGdf"] . "'";}?>
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="col-lg-4 col-md-4 col-xs-12 col-lg-offset-1 col-lg-offset-1">
                                        <br> <label>NÚMERO DE CADASTRO ÚNICO PARA PROGRAMAS SOCIAIS (CadÚnico)
                                        </label><br>
                                        <input class='form-control text-uppercase' type="text" name='cadUnico' placeholder='CadÚnico' onKeyPress="MascaraNumeros(form.cadUnico);"
                                            <?php
                                            if(isset($_POST['cadUnico']) ){ echo "value='".$_POST["cadUnico"]."'";}
                                            ?>
                                        >
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-xs-12 col-lg-offset-1 col-lg-offset-1">
                                        <br> <label>Número de inscrição no ENEM *
                                        </label><br><br>
                                        <input class='form-control text-uppercase' type="text" name='insc_enem' placeholder='Somente números...' name='cadUnico' placeholder='CadÚnico' onKeyPress="MascaraNumeros(form.insc_enem);"
                                            <?php
                                            if(isset($_POST['insc_enem']) ){ echo "value='".$_POST["insc_enem"]."'";}
                                            ?>

                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>



                            function mudaEsc() {
                                var x = document.getElementById("escoSelect").value;
                                switch(x){
                                    case "MÉDIO COMPLETO" :
                                        $("#box-mc").css("display", "block");
                                        document.getElementById("box-mc").innerHTML =
                                            "<div class='form-group'>"+
                                            "<div class='col-lg-3 col-md-3 col-xs-12'>"+
                                            "<label>Rede de ensino*</label><br>"+
                                            "<select name='rede' class='form-control' >"+
                                            " <option value='0'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( '0', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            "></option>"+
                                            "<option value='PUBLICA'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( 'PUBLICA', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            " >Pública </option>"+
                                            " <option value='PRIVADA'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( 'PRIVADA', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            " >Privada na condição de bolsista integral</option>"+
                                            " <option value='ECCF'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( 'ECCF', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">Escolas confessionais, comunitárias e/ou filantrópicas executoras de parceria com o poder público, ambas sem fins lucrativos ou na forma da lei.</option>"+
                                            " </select>"+
                                            "</div>"+
                                            "<div class='col-lg-3 col-md-3 col-xs-12'>"+
                                            "<label>Nome da Escola*</label>"+
                                            " <input class='form-control text-uppercase' name='escola'"+
                                            <?php if(isset($_POST['escola'])){
                                                $val="value='".$_POST['escola']."' ";
                                                echo '"'.$val.'"+';
                                            } ?>
                                            ">"+
                                            "</div>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12'>"+
                                            "<label>  Quantas séries cursou na rede privada?*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<select class='form-control text-uppercase text-right' name='anosPuc' >"+
                                            "<option value='0'"+
                                            <?php if(isset($_POST['anosPri'])){
                                                $resul= selectedj( '0', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">0</option>"+
                                            " <option value='1'"+
                                            <?php if(isset($_POST['anosPri'])){
                                                $resul= selectedj( '1', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            } ?>
                                            ">1</option>"+
                                            " <option value='2'"+
                                            <?php if(isset($_POST['anosPri'])){
                                                $resul= selectedj( '2', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }

                                            ?>
                                            " >2</option>"+
                                            "<option value='3'"+
                                            <?php if(isset($_POST['anosPri'])){
                                                $resul= selectedj( '3', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }

                                            ?>
                                            " >3</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='row'>"+
                                            "<div class='col-lg-12'>"+
                                            "<div class='form-group'>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12'>"+
                                            "<br><label>    Quantas séries cursou na rede pública?*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<select class='form-control text-uppercase text-right' name='anosPuc' >"+
                                            "<option value='0'"+
                                            <?php if(isset($_POST['anosPuc'])){
                                                $resul= selectedj( '0', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }

                                            ?>
                                            " >0</option>"+
                                            " <option value='1'"+
                                            <?php if(isset($_POST['anosPuc'])) {
                                                $resul= selectedj( '1', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }

                                            ?>
                                            ">1</option>"+
                                            "<option value='2'"+
                                            <?php if(isset($_POST['anosPuc'])) {
                                                $resul= selectedj( '2', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }

                                            ?>
                                            ">2</option>"+
                                            "<option value='3'"+
                                            <?php if(isset($_POST['anosPuc']))
                                            {
                                                $resul= selectedj( '3', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">3</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12 '>"+
                                            "<br><label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  Ano de conclusão do ensino médio*</label><br>"+
                                            "<div class='col-lg-7 col-md-7 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<input type='text' class='form-control' name='conclusaoMedio'"+
                                            <?php if(isset($_POST['conclusaoMedio'])){
                                                $val="value='".$_POST['conclusaoMedio']."' ";
                                                echo '"'.$val.'"+';
                                            }

                                            ?>
                                            ">"+
                                            "</div>"+
                                            "</div>"+
                                            "<hr>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>"+
                                            "<hr>"+
                                            "<br><label>  Boletim de desempenho*</label><br>"+
                                            "<hr>"+
                                            "</div>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>"+
                                            "<br><label>  Disciplinas</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12'>"+
                                            "<br><label> Matemática*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<input type='text' name='matematica' class='form-control' maxlength='3'"+
                                            <?php if(isset($_POST['matematica'])){
                                                $val="value='".$_POST['matematica']."' ";
                                                echo '"'.$val.'"+';
                                            }

                                            ?>
                                            ">"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12'>"+
                                            "<br><label> Português*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<input type='text' name='portugues' class='form-control' maxlength='3'"+
                                            <?php if(isset($_POST['portugues'])){
                                                $val="value='".$_POST['portugues']."' ";
                                                echo '"'.$val.'"+';
                                            }

                                            ?>
                                            ">"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>"+
                                            "<hr>"+
                                            "<br><label>  Está cursando o ensino superior?*</label><br>"+
                                            "<label class='radio-inline'>"+
                                            "<input type='radio' name='ensinoSup' id='simss' value='SIM'"+
                                            <?php if(isset($_POST['ensinoSup'])){
                                                $resul= checkedj( 'SIM', $_POST['ensinoSup']);
                                                echo "'".$resul."'";
                                            } ?>
                                            " > Sim"+
                                            "</label>"+
                                            "<label class='radio-inline'>"+
                                            "<input type='radio' name='ensinoSup' id='naoss' value='NAO'"+
                                            <?php if(isset($_POST['ensinoSup'])){
                                                $resul= checkedj( 'NAO', $_POST['ensinoSup']);
                                                echo "'".$resul."'";
                                            } ?>
                                            "> Não"+
                                            "</label>"+
                                            "<hr>"+
                                            "</div>"+
                                            "<hr>"+
                                            "<div id='box-enSups' style='display: none'>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12 col-lg-offset-1 col-md-offset-1'>"+
                                            "<label>Universidade Pública*</label><br>"+
                                            "<label class='radio-inline'>"+
                                            "<input type='radio' name='redeUnip' id='simpubs' value='SIM'"+
                                            <?php if(isset($_POST['redeUnip'])){
                                                $resul= checkedj( 'SIM', $_POST['redeUnip']);
                                                echo "'".$resul."'";
                                            } ?>
                                            " > Sim"+
                                            "</label>"+
                                            "<label class='radio-inline'>"+
                                            "<input type='radio' name='redeUnip' id='naopubs' value='NAO'"+
                                            <?php if(isset($_POST['redeUnip'])){
                                                $resul= checkedj( 'SIM', $_POST['redeUnip']);
                                                echo "'".$resul."'";
                                            } ?>
                                            "> Não"+
                                            "</label>"+
                                            "<div id='box-nomeUniPubs' style='display: none'>"+
                                            "<br><label> Qual?*</label><br>"+
                                            "<input type='text' class='form-control' name='universidadep'"+
                                            <?php if(isset($_POST['universidadep'])){
                                                $val="value='".$_POST['universidadep']."' ";
                                                echo '"'.$val.'"+';
                                            }  ?>
                                            " >"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12 '>"+
                                            "<label>Universidade Particular*</label><br>"+
                                            "<label class='radio-inline'>"+
                                            "<input type='radio' name='redeUnipar' id='simpars' value='SIM'"+
                                            <?php if(isset($_POST['redeUnipar'])){
                                                $resul= checkedj( 'SIM', $_POST['redeUnipar']);
                                                echo "'".$resul."'";
                                            } ?>
                                            "> Sim"+
                                            "</label>"+
                                            "<label class='radio-inline'>"+
                                            "<input type='radio' name='redeUnipar' id='naopars' value='NAO'"+
                                            <?php if(isset($_POST['redeUnipar'])){
                                                $resul= checkedj( 'SIM', $_POST['redeUnipar']);
                                                echo "'".$resul."'";
                                            } ?>
                                            "> Não"+
                                            "</label>"+
                                            " <div id='box-nomeUniPars' style='display: none'>"+
                                            "<br><label> Qual?*</label><br>"+
                                            "<input type='text' name='universidadepar' class='form-control'"+
                                            <?php if(isset($_POST['universidadepar'])) {
                                                $val = "value='" . $_POST['universidadepar'] . "' ";
                                                echo '"' . $val . '"+';
                                            }
                                            ?>
                                            " >"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+


                                            $("#box-mcur").css("display", "none");
                                        $("#box-ejac").css("display", "none");
                                        $("#box-ejacur").css("display", "none");


                                        break;
                                    case "MÉDIO CURSANDO" :

                                        $("#box-mcur").css("display", "block");
                                        document.getElementById("box-mcur").innerHTML =
                                            "<div class='form-group'>"+
                                            "<div class='col-lg-3 col-md-3 col-xs-6'>"+
                                            " <label>Rede de ensino*</label><br>"+
                                            "<select name='rede' class='form-control'  >"+
                                            "<option value='0'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( '0', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            "></option>"+
                                            "<option value='PUBLICA'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( 'PUBLICA', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">Pública </option>"+
                                            "<option value='PRIVADA'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( 'PRIVADA', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            " >Privada na condição de bolsista integral</option>"+
                                            "<option value='ECCF'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( 'ECCF', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">Escolas confessionais, comunitárias e/ou filantrópicas executoras de parceria com o poder público, ambas sem fins lucrativos ou na forma da lei.</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "<div class='col-lg-3 col-md-3 col-xs-6'>"+
                                            "<label>Nome da Escola*</label>"+
                                            "<input class='form-control text-uppercase' name='escola'"+
                                            <?php if(isset($_POST['escola'])){
                                                $val="value='".$_POST['escola']."' ";
                                                echo '"'.$val.'"+';
                                            } ?>
                                            ">"+
                                            "</div>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12'>"+
                                            " <label>  Quantas séries cursou na rede privada?*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<select class='form-control text-uppercase text-right' name='anosPuc' >"+
                                            " <option value='0'"+
                                            <?php if(isset($_POST['anosPri']))
                                            {
                                                $resul= selectedj( '0', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">0</option>"+
                                            "<option value='1'"+
                                            <?php if(isset($_POST['anosPri']))
                                            {
                                                $resul= selectedj( '1', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">1</option>"+
                                            "<option value='2'"+
                                            <?php if(isset($_POST['anosPri']))
                                            {
                                                $resul= selectedj( '2', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">2</option>"+
                                            "<option value='3'"+
                                            <?php if(isset($_POST['anosPri']))
                                            {
                                                $resul= selectedj( '3', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">3</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12'>"+
                                            "<br><label>  Quantas séries cursou na rede pública?*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<select class='form-control text-uppercase text-right' name='anosPuc' >"+
                                            "<option value='0'"+
                                            <?php if(isset($_POST['anospuc'])){
                                                $resul= selectedj( '0', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">0</option>"+
                                            "<option value='1'"+
                                            <?php if(isset($_POST['anospuc'])){
                                                $resul= selectedj( '1', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">1</option>"+
                                            "<option value='2'"+
                                            <?php if(isset($_POST['anospuc'])){
                                                $resul= selectedj( '2', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            } ?>
                                            ">2</option>"+
                                            "<option value='3'"+
                                            <?php if(isset($_POST['anosPuc']))
                                            {
                                                $resul= selectedj( '3', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">3</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='row'>"+
                                            "<div class='col-lg-4 col-md-4 col-xs-12 '>"+
                                            "<br><label>Turno que estuda*</label><br>"+
                                            "<select class='form-control text-uppercase text-right' name='turno'  >"+
                                            "<option value=''"+
                                            <?php if(isset($_POST['turno'])){
                                                $resul= selectedj( '0', $_POST['turno']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            "></option>"+
                                            " <option value='MATUTINO'"+
                                            <?php if(isset($_POST['turno'])){
                                                $resul= selectedj( 'MATUTINO', $_POST['turno']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">Matutino</option>"+
                                            "<option value='VESPERTINO'"+
                                            <?php if(isset($_POST['turno'])){
                                                $resul= selectedj( 'VESPERTINO', $_POST['turno']);
                                                echo "'".$resul."'";
                                            } ?>
                                            ">vespertino</option>"+
                                            "<option value='NOTURNO'"+
                                            <?php if(isset($_POST['turno'])){
                                                $resul= selectedj( 'NOTURNO', $_POST['turno']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">Noturno</option>"+
                                            "<option value='INTEGRAL'"+
                                            <?php if(isset($_POST['turno'])){
                                                $resul= selectedj( 'INTEGRAL', $_POST['turno']);
                                                echo "'".$resul."'";
                                            } ?>

                                            ">Integral</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "<div class='row'>"+
                                            "<div class='col-lg-12'>"+
                                            "<div class='form-group'>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>"+
                                            "<br><label>   Série*</label><br>"+
                                            "<div class='col-lg-4 col-md-4 col-xs-12 col-lg-offset-4 col-md-offset-4 text-center'>"+
                                            "<select class='form-control text-uppercase text-right' name='serie'  >"+
                                            "<option value='1'"+
                                            <?php if(isset($_POST['serie'])){
                                                $resul= selectedj( '1', $_POST['serie']);
                                                echo "'".$resul."'";
                                            } ?>
                                            ">1º ano</option>"+
                                            " <option value='2'"+
                                            <?php if(isset($_POST['serie'])){
                                                $resul= selectedj( '2', $_POST['serie']);
                                                echo "'".$resul."'";
                                            } ?>
                                            ">2º ano</option>"+
                                            "<option value='3'"+
                                            <?php if(isset($_POST['serie'])){
                                                $resul= selectedj( '3', $_POST['serie']);
                                                echo "'".$resul."'";
                                            }

                                            ?>
                                            ">3º ano</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "</div>"+
                                            "<hr>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>"+
                                            "<hr>"+
                                            "<br><label>  Boletim de desempenho*</label><br>"+
                                            "<hr>"+
                                            "</div>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>"+
                                            "<br><label>  Disciplinas</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12'>"+
                                            "<br><label> Matemática*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<input type='text' name='matematica' class='form-control' maxlength='3'"+
                                            <?php if(isset($_POST['matematica'])){
                                                $val="value='".$_POST['matematica']."' ";
                                                echo '"'.$val.'"+';
                                            }

                                            ?>
                                            ">"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12'>"+
                                            "<br><label> Português*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<input type='text' name='portugues' class='form-control' maxlength='3'"+
                                            <?php if(isset($_POST['portugues'])){
                                                $val="value='".$_POST['portugues']."' ";
                                                echo '"'.$val.'"+';
                                            }

                                            ?>
                                            " >"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-8 text-center'>"+
                                            "</div>"+
                                            "<hr>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            $("#box-ejac").css("display", "none");
                                        $("#box-mc").css("display", "none");
                                        $("#box-ejacur").css("display", "none");



                                        break;

                                    case "EJA COMPLETO" :
                                        $("#box-ejac").css("display", "block");

                                        document.getElementById("box-ejac").innerHTML =
                                            "<div class='form-group'>"+
                                            "<div class='col-lg-3 col-md-3 col-xs-12'>"+
                                            "<label>Rede de ensino*</label><br>"+
                                            "<select name='rede' class='form-control' >"+
                                            " <option value='0'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( '0', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            "></option>"+
                                            "<option value='PUBLICA'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( 'PUBLICA', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            " >Pública </option>"+
                                            " <option value='PRIVADA'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( 'PRIVADA', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            " >Privada na condição de bolsista integral</option>"+
                                            " <option value='ECCF'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( 'ECCF', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">Escolas confessionais, comunitárias e/ou filantrópicas executoras de parceria com o poder público, ambas sem fins lucrativos ou na forma da lei.</option>"+
                                            " </select>"+
                                            "</div>"+
                                            "<div class='col-lg-3 col-md-3 col-xs-12'>"+
                                            "<label>Nome da Escola*</label>"+
                                            " <input class='form-control text-uppercase' name='escola'"+
                                            <?php if(isset($_POST['escola'])){
                                                $val="value='".$_POST['escola']."' ";
                                                echo '"'.$val.'"+';
                                            } ?>
                                            ">"+
                                            "</div>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12'>"+
                                            "<label>  Quantas séries cursou na rede privada?*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<select class='form-control text-uppercase text-right' name='anosPuc' >"+
                                            "<option value='0'"+
                                            <?php if(isset($_POST['anosPri'])){
                                                $resul= selectedj( '0', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">0</option>"+
                                            " <option value='1'"+
                                            <?php if(isset($_POST['anosPri'])){
                                                $resul= selectedj( '1', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            } ?>
                                            ">1</option>"+
                                            " <option value='2'"+
                                            <?php if(isset($_POST['anosPri'])){
                                                $resul= selectedj( '2', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }

                                            ?>
                                            " >2</option>"+
                                            "<option value='3'"+
                                            <?php if(isset($_POST['anosPri'])){
                                                $resul= selectedj( '3', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }

                                            ?>
                                            " >3</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='row'>"+
                                            "<div class='col-lg-12'>"+
                                            "<div class='form-group'>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12'>"+
                                            "<br><label>    Quantas séries cursou na rede pública?*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<select class='form-control text-uppercase text-right' name='anosPuc' >"+
                                            "<option value='0'"+
                                            <?php if(isset($_POST['anosPuc'])){
                                                $resul= selectedj( '0', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }

                                            ?>
                                            " >0</option>"+
                                            " <option value='1'"+
                                            <?php if(isset($_POST['anosPuc'])) {
                                                $resul= selectedj( '1', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }

                                            ?>
                                            ">1</option>"+
                                            "<option value='2'"+
                                            <?php if(isset($_POST['anosPuc'])) {
                                                $resul= selectedj( '2', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }

                                            ?>
                                            ">2</option>"+
                                            "<option value='3'"+
                                            <?php if(isset($_POST['anosPuc']))
                                            {
                                                $resul= selectedj( '3', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">3</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12 '>"+
                                            "<br><label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  Ano de conclusão do ensino médio*</label><br>"+
                                            "<div class='col-lg-7 col-md-7 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<input type='text' class='form-control' name='conclusaoMedio'"+
                                            <?php if(isset($_POST['conclusaoMedio'])){
                                                $val="value='".$_POST['conclusaoMedio']."' ";
                                                echo '"'.$val.'"+';
                                            }

                                            ?>
                                            ">"+
                                            "</div>"+
                                            "</div>"+
                                            "<hr>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>"+
                                            "<hr>"+
                                            "<br><label>  Boletim de desempenho*</label><br>"+
                                            "<hr>"+
                                            "</div>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>"+
                                            "<br><label>  Disciplinas</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12'>"+
                                            "<br><label> Matemática*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<input type='text' name='matematica' class='form-control' maxlength='3'"+
                                            <?php if(isset($_POST['matematica'])){
                                                $val="value='".$_POST['matematica']."' ";
                                                echo '"'.$val.'"+';
                                            }

                                            ?>
                                            ">"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12'>"+
                                            "<br><label> Português*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<input type='text' name='portugues' class='form-control' maxlength='3'"+
                                            <?php if(isset($_POST['portugues'])){
                                                $val="value='".$_POST['portugues']."' ";
                                                echo '"'.$val.'"+';
                                            }

                                            ?>
                                            ">"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>"+
                                            "<hr>"+
                                            "<br><label>  Está cursando o ensino superior?*</label><br>"+
                                            "<label class='radio-inline'>"+
                                            "<input type='radio' name='ensinoSup' id='simss' value='SIM'"+
                                            <?php if(isset($_POST['ensinoSup'])){
                                                $resul= checkedj( 'SIM', $_POST['ensinoSup']);
                                                echo "'".$resul."'";
                                            } ?>
                                            " > Sim"+
                                            "</label>"+
                                            "<label class='radio-inline'>"+
                                            "<input type='radio' name='ensinoSup' id='naoss' value='NAO'"+
                                            <?php if(isset($_POST['ensinoSup'])){
                                                $resul= checkedj( 'NAO', $_POST['ensinoSup']);
                                                echo "'".$resul."'";
                                            } ?>
                                            "> Não"+
                                            "</label>"+
                                            "<hr>"+
                                            "</div>"+
                                            "<hr>"+
                                            "<div id='box-enSups' style='display: none'>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12 col-lg-offset-1 col-md-offset-1'>"+
                                            "<label>Universidade Pública*</label><br>"+
                                            "<label class='radio-inline'>"+
                                            "<input type='radio' name='redeUnip' id='simpubs' value='SIM'"+
                                            <?php if(isset($_POST['redeUnip'])){
                                                $resul= checkedj( 'SIM', $_POST['redeUnip']);
                                                echo "'".$resul."'";
                                            } ?>
                                            " > Sim"+
                                            "</label>"+
                                            "<label class='radio-inline'>"+
                                            "<input type='radio' name='redeUnip' id='naopubs' value='NAO'"+
                                            <?php if(isset($_POST['redeUnip'])){
                                                $resul= checkedj( 'SIM', $_POST['redeUnip']);
                                                echo "'".$resul."'";
                                            } ?>
                                            "> Não"+
                                            "</label>"+
                                            "<div id='box-nomeUniPubs' style='display: none'>"+
                                            "<br><label> Qual?*</label><br>"+
                                            "<input type='text' class='form-control' name='universidadep'"+
                                            <?php if(isset($_POST['universidadep'])){
                                                $val="value='".$_POST['universidadep']."' ";
                                                echo '"'.$val.'"+';
                                            }  ?>
                                            " >"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12 '>"+
                                            "<label>Universidade Particular*</label><br>"+
                                            "<label class='radio-inline'>"+
                                            "<input type='radio' name='redeUnipar' id='simpars' value='SIM'"+
                                            <?php if(isset($_POST['redeUnipar'])){
                                                $resul= checkedj( 'SIM', $_POST['redeUnipar']);
                                                echo "'".$resul."'";
                                            } ?>
                                            "> Sim"+
                                            "</label>"+
                                            "<label class='radio-inline'>"+
                                            "<input type='radio' name='redeUnipar' id='naopars' value='NAO'"+
                                            <?php if(isset($_POST['redeUnipar'])){
                                                $resul= checkedj( 'SIM', $_POST['redeUnipar']);
                                                echo "'".$resul."'";
                                            } ?>
                                            "> Não"+
                                            "</label>"+
                                            " <div id='box-nomeUniPars' style='display: none'>"+
                                            "<br><label> Qual?*</label><br>"+
                                            "<input type='text' name='universidadepar' class='form-control'"+
                                            <?php if(isset($_POST['universidadepar'])) {
                                                $val = "value='" . $_POST['universidadepar'] . "' ";
                                                echo '"' . $val . '"+';
                                            }
                                            ?>
                                            " >"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+


                                            $("#box-mcur").css("display", "none");
                                        $("#box-mc").css("display", "none");
                                        $("#box-ejacur").css("display", "none");


                                        break;
                                    case "EJA CURSANDO" :
                                        $("#box-ejacur").css("display", "block");
                                        document.getElementById("box-ejacur").innerHTML =
                                            "<div class='form-group'>"+
                                            "<div class='col-lg-3 col-md-3 col-xs-6'>"+
                                            " <label>Rede de ensino*</label><br>"+
                                            "<select name='rede' class='form-control'  >"+
                                            "<option value='0'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( '0', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            "></option>"+
                                            "<option value='PUBLICA'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( 'PUBLICA', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">Pública </option>"+
                                            "<option value='PRIVADA'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( 'PRIVADA', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            " >Privada na condição de bolsista integral</option>"+
                                            "<option value='ECCF'"+
                                            <?php if(isset($_POST['rede'])){
                                                $resul= selectedj( 'ECCF', $_POST['rede']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">Escolas confessionais, comunitárias e/ou filantrópicas executoras de parceria com o poder público, ambas sem fins lucrativos ou na forma da lei.</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "<div class='col-lg-3 col-md-3 col-xs-6'>"+
                                            "<label>Nome da Escola*</label>"+
                                            "<input class='form-control text-uppercase' name='escola'"+
                                            <?php if(isset($_POST['escola'])){
                                                $val="value='".$_POST['escola']."' ";
                                                echo '"'.$val.'"+';
                                            } ?>
                                            ">"+
                                            "</div>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12'>"+
                                            " <label>  Quantas séries cursou na rede privada?*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<select class='form-control text-uppercase text-right' name='anosPuc' >"+
                                            " <option value='0'"+
                                            <?php if(isset($_POST['anosPri']))
                                            {
                                                $resul= selectedj( '0', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">0</option>"+
                                            "<option value='1'"+
                                            <?php if(isset($_POST['anosPri']))
                                            {
                                                $resul= selectedj( '1', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">1</option>"+
                                            "<option value='2'"+
                                            <?php if(isset($_POST['anosPri']))
                                            {
                                                $resul= selectedj( '2', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">2</option>"+
                                            "<option value='3'"+
                                            <?php if(isset($_POST['anosPri']))
                                            {
                                                $resul= selectedj( '3', $_POST['anosPri']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">3</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-5 col-md-5 col-xs-12'>"+
                                            "<br><label>  Quantas séries cursou na rede pública?*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<select class='form-control text-uppercase text-right' name='anosPuc' >"+
                                            "<option value='0'"+
                                            <?php if(isset($_POST['anospuc'])){
                                                $resul= selectedj( '0', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">0</option>"+
                                            "<option value='1'"+
                                            <?php if(isset($_POST['anospuc'])){
                                                $resul= selectedj( '1', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">1</option>"+
                                            "<option value='2'"+
                                            <?php if(isset($_POST['anospuc'])){
                                                $resul= selectedj( '2', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            } ?>
                                            ">2</option>"+
                                            "<option value='3'"+
                                            <?php if(isset($_POST['anosPuc']))
                                            {
                                                $resul= selectedj( '3', $_POST['anosPuc']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">3</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='row'>"+
                                            "<div class='col-lg-4 col-md-4 col-xs-12 '>"+
                                            "<br><label>Turno que estuda*</label><br>"+
                                            "<select class='form-control text-uppercase text-right' name='turno'  >"+
                                            "<option value='0'"+
                                            <?php if(isset($_POST['turno'])){
                                                $resul= selectedj( '0', $_POST['turno']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            "></option>"+
                                            " <option value='MATUTINO'"+
                                            <?php if(isset($_POST['turno'])){
                                                $resul= selectedj( 'MATUTINO', $_POST['turno']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">Matutino</option>"+
                                            "<option value='VESPERTINO'"+
                                            <?php if(isset($_POST['turno'])){
                                                $resul= selectedj( 'VESPERTINO', $_POST['turno']);
                                                echo "'".$resul."'";
                                            } ?>
                                            ">vespertino</option>"+
                                            "<option value='NOTURNO'"+
                                            <?php if(isset($_POST['turno'])){
                                                $resul= selectedj( 'NOTURNO', $_POST['turno']);
                                                echo "'".$resul."'";
                                            }
                                            ?>
                                            ">Noturno</option>"+
                                            "<option value='INTEGRAL'"+
                                            <?php if(isset($_POST['turno'])){
                                                $resul= selectedj( 'INTEGRAL', $_POST['turno']);
                                                echo "'".$resul."'";
                                            } ?>

                                            ">Integral</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "<div class='row'>"+
                                            "<div class='col-lg-12'>"+
                                            "<div class='form-group'>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>"+
                                            "<br><label>   Série*</label><br>"+
                                            "<div class='col-lg-4 col-md-4 col-xs-12 col-lg-offset-4 col-md-offset-4 text-center'>"+
                                            "<select class='form-control text-uppercase text-right' name='serie'  >"+
                                            "<option value='1'"+
                                            <?php if(isset($_POST['serie'])){
                                                $resul= selectedj( '1', $_POST['serie']);
                                                echo "'".$resul."'";
                                            } ?>
                                            ">1º ano</option>"+
                                            " <option value='2'"+
                                            <?php if(isset($_POST['serie'])){
                                                $resul= selectedj( '2', $_POST['serie']);
                                                echo "'".$resul."'";
                                            } ?>
                                            ">2º ano</option>"+
                                            "<option value='3'"+
                                            <?php if(isset($_POST['serie'])){
                                                $resul= selectedj( '3', $_POST['serie']);
                                                echo "'".$resul."'";
                                            }

                                            ?>
                                            ">3º ano</option>"+
                                            "</select>"+
                                            "</div>"+
                                            "</div>"+
                                            "<hr>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>"+
                                            "<hr>"+
                                            "<br><label>  Boletim de desempenho*</label><br>"+
                                            "<hr>"+
                                            "</div>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>"+
                                            "<br><label>  Disciplinas</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12'>"+
                                            "<br><label> Matemática*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+
                                            "<input type='text' name='matematica' class='form-control' maxlength='3'"+

                                            ">"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12'>"+
                                            "<br><label> Português*</label><br>"+
                                            "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>"+

                                            " >"+
                                            "</div>"+
                                            "</div>"+
                                            "<div class='col-lg-12 col-md-12 col-xs-8 text-center'>"+
                                            "</div>"+
                                            "<hr>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+
                                            "</div>"+

                                            $("#box-mcur").css("display", "none");
                                        $("#box-mc").css("display", "none");
                                        $("#box-ejac").css("display", "none");
                                        break;


                                    default:
                                        $("#box-mcur").css("display", "none");
                                        $("#box-mc").css("display", "none");
                                        $("#box-ejac").css("display", "none");
                                        $("#box-ejacur").css("display", "none");

                                        break;
                                }


                            }


                        </script>








                        <div class="row">

                            <div class="col-lg-12 text-center">

                                <div class="text-center">

                                    <hr>

                                    <b>Escolaridade*</b>

                                    <hr>

                                </div>





                                <div class="form-group">
                                    <div class="text-center">
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3 ">
                                            <select class="form-control text-uppercase text-center " id="escoSelect" name='escolaridade' onchange="mudaEsc();" >
                                                <?php if(isset($_POST['escolaridade'])){
                                                    $ensino=$_POST['escolaridade'];
                                                }  ?>

                                                <option value="0"  <?php if(isset($ensino)){echo selected( '', $ensino); }?>></option>
                                                <option value="MÉDIO COMPLETO"  <?php if(isset($ensino)){echo selected( 'MÉDIO COMPLETO', $ensino); }?>>ensino médio completo</option>
                                                <option value="MÉDIO CURSANDO" <?php if(isset($ensino)){echo selected( 'MÉDIO CURSANDO', $ensino); }?>>ensino médio - cursando</option>
                                                <option VALUE="EJA COMPLETO" <?php if(isset($ensino)){echo selected( 'EJA COMPLETO', $ensino); }?>>educação de jovens e adultos completo</option>
                                                <option VALUE="EJA CURSANDO" <?php if(isset($ensino)){echo selected( 'EJA CURSANDO', $ensino); }?>>educação de jovens e adultos - cursando</option>
                                            </select>



                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <script>
                                $(document).ready(function(){
                                    $("#simpars").click(function(evento){
                                        if ($("#simpars").attr("checked")){
                                            $("#box-nomeUniPars").css("display", "block");

                                        }else{
                                            $("#box-nomeUniPars").css("display", "none");

                                        }
                                    });
                                });
                                $(document).ready(function(){
                                    $("#naopars").click(function(evento){
                                        if ($("#naopars").attr("checked")){
                                            $("#box-nomeUniPars").css("display", "none");

                                        }else{
                                            $("#box-nomeUniPars").css("display", "block");

                                        }
                                    });
                                });



                                $(document).ready(function(){
                                    $("#simpubs").click(function(evento){
                                        if ($("#simpubs").attr("checked")){
                                            $("#box-nomeUniPubs").css("display", "block");

                                        }else{
                                            $("#box-nomeUniPubs").css("display", "none");

                                        }
                                    });
                                });
                                $(document).ready(function(){
                                    $("#naopubs").click(function(evento){
                                        if ($("#naopubs").attr("checked")){
                                            $("#box-nomeUniPubs").css("display", "none");

                                        }else{
                                            $("#box-nomeUniPubs").css("display", "block");

                                        }
                                    });
                                });



                                $(document).ready(function(){
                                    $("#simpar").click(function(evento){
                                        if ($("#simpar").attr("checked")){
                                            $("#box-nomeUniPar").css("display", "block");

                                        }else{
                                            $("#box-nomeUniPar").css("display", "none");

                                        }
                                    });
                                });
                                $(document).ready(function(){
                                    $("#naopar").click(function(evento){
                                        if ($("#naopar").attr("checked")){
                                            $("#box-nomeUniPar").css("display", "none");

                                        }else{
                                            $("#box-nomeUniPar").css("display", "block");

                                        }
                                    });
                                });



                                $(document).ready(function(){
                                    $("#simpub").click(function(evento){
                                        if ($("#simpub").attr("checked")){
                                            $("#box-nomeUniPub").css("display", "block");

                                        }else{
                                            $("#box-nomeUniPub").css("display", "none");

                                        }
                                    });
                                });
                                $(document).ready(function(){
                                    $("#naopub").click(function(evento){
                                        if ($("#naopub").attr("checked")){
                                            $("#box-nomeUniPub").css("display", "none");

                                        }else{
                                            $("#box-nomeUniPub").css("display", "block");

                                        }
                                    });
                                });

                                $(document).ready(function(){
                                    $("#sims").click(function(evento){
                                        if ($("#sims").attr("checked")){
                                            $("#box-enSup").css("display", "block");

                                        }else{
                                            $("#box-enSup").css("display", "none");

                                        }
                                    });
                                });
                                $(document).ready(function(){
                                    $("#naos").click(function(evento){
                                        if ($("#naos").attr("checked")){
                                            $("#box-enSup").css("display", "none");

                                        }else{
                                            $("#box-enSup").css("display", "block");

                                        }
                                    });
                                });

                                $(document).ready(function(){
                                    $("#simss").click(function(evento){
                                        if ($("#simss").attr("checked")){
                                            $("#box-enSups").css("display", "block");

                                        }else{
                                            $("#box-enSups").css("display", "none");

                                        }
                                    });
                                });
                                $(document).ready(function(){
                                    $("#naoss").click(function(evento){
                                        if ($("#naoss").attr("checked")){
                                            $("#box-enSups").css("display", "none");

                                        }else{
                                            $("#box-enSups").css("display", "block");

                                        }
                                    });
                                });

                            </script>
                            <div class="col-lg-12 col-md-12">
                                <div id="box-mc" style="display: none"></div>
                                <div id="box-mcur" style="display: none"></div>
                                <div id="box-ejac" style="display: none"></div>
                                <div id="box-ejacur" style="display: none"></div>
                                <?php
                                if(isset($ensino)) {
                                    switch($ensino){
                                        case "MÉDIO COMPLETO" :
                                            echo "<div id='box-mc' style='display: block' >";
                                            echo "<div class='form-group'>";
                                            echo "<div class='col-lg-3 col-md-3 col-xs-12'>";
                                            echo "<label>Rede de ensino*</label><br>";
                                            echo "<select name='rede' class='form-control' >";
                                            echo " <option value='0'";
                                            if(isset($_POST['rede'])){ echo selected( '0', $_POST['rede']);}
                                            echo "></option>";
                                            echo "<option value='PUBLICA'";
                                            if(isset($_POST['rede'])){echo selected( 'PUBLICA', $_POST['rede']);}
                                            echo " >Pública </option>";
                                            echo " <option value='PRIVADA'";
                                            if(isset($_POST['rede'])){echo selected( 'PRIVADA', $_POST['rede']);}
                                            echo " >Privada na condição de bolsista integral</option>";
                                            echo " <option value='ECCF'";
                                            if(isset($_POST['rede'])){echo selected( 'ECCF', $_POST['rede']);}
                                            echo ">Escolas confessionais, comunitárias e/ou filantrópicas executoras de parceria com o poder público, ambas sem fins lucrativos ou na forma da lei.</option>";
                                            echo " </select>";
                                            echo "</div>";
                                            echo "<div class='col-lg-3 col-md-3 col-xs-12'>";
                                            echo "<label>Nome da Escola*</label>";
                                            echo " <input class='form-control text-uppercase' name='escola'";
                                            if(isset($_POST['escola'])){echo "value='".$_POST['escola']."' "; }
                                            echo ">";
                                            echo "</div>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12'>";
                                            echo "<label>  Quantas séries cursou na rede privada?*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<select class='form-control text-uppercase text-right' name='anosPuc' >";
                                            echo "<option value='0'";
                                            if(isset($_POST['anosPri'])) echo selected( '0', $_POST['anosPri']);
                                            echo ">0</option>";
                                            echo " <option value='1'";
                                            if(isset($_POST['anosPri'])) echo selected( '1', $_POST['anosPri']);
                                            echo ">1</option>";
                                            echo " <option value='2'";
                                            if(isset($_POST['anosPri'])) echo selected( '2', $_POST['anosPri']);
                                            echo " >2</option>";
                                            echo "<option value='3'";
                                            if(isset($_POST['anosPri'])) echo selected( '3', $_POST['anosPri']);
                                            echo " >3</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='row'>";
                                            echo "<div class='col-lg-12'>";
                                            echo "<div class='form-group'>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12'>";
                                            echo "<br><label>    Quantas séries cursou na rede pública?*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<select class='form-control text-uppercase text-right' name='anosPuc' >";
                                            echo "<option value='0'";
                                            if(isset($_POST['anosPuc'])) echo selected( '0', $_POST['anosPuc']);
                                            echo " >0</option>";
                                            echo " <option value='1'";
                                            if(isset($_POST['anosPuc'])) echo selected( '1', $_POST['anosPuc']);
                                            echo ">1</option>";
                                            echo "<option value='2'";
                                            if(isset($_POST['anosPuc'])) echo selected( '2', $_POST['anosPuc']);
                                            echo ">2</option>";
                                            echo "<option value='3'";
                                            if(isset($_POST['anosPuc'])) echo selected( '3', $_POST['anosPuc']);
                                            echo ">3</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12 '>";
                                            echo "<br><label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  Ano de conclusão do ensino médio*</label><br>";
                                            echo "<div class='col-lg-7 col-md-7 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<input type='text' class='form-control' name='conclusaoMedio'";
                                            if(isset($_POST['conclusaoMedio'])) echo "value='".$_POST['conclusaoMedio']."' ";
                                            echo ">";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<hr>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>";
                                            echo "<hr>";
                                            echo "<br><label>  Boletim de desempenho*</label><br>";
                                            echo "<hr>";
                                            echo "</div>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>";
                                            echo "<br><label>  Disciplinas</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12'>";
                                            echo "<br><label> Matemática*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<input type='text' name='matematica' class='form-control' maxlength='3'";
                                            if(isset($_POST['matematica'])) echo "value='".$_POST['matematica']."' ";
                                            echo ">";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12'>";
                                            echo "<br><label> Português*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<input type='text' name='portugues' class='form-control' maxlength='3'";
                                            if(isset($_POST['portugues'])) echo "value='".$_POST['portugues']."' ";
                                            echo ">";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>";
                                            echo "<hr>";
                                            echo "<br><label>  Está cursando o ensino superior?*</label><br>";
                                            echo "<label class='radio-inline'>";
                                            echo "<input type='radio' name='ensinoSup' id='simss' value='SIM' ";
                                            if(isset($_POST['ensinoSup'])){echo checked( 'SIM', $_POST['ensinoSup']); }
                                            echo "> Sim";
                                            echo "</label>";
                                            echo "<label class='radio-inline'>";
                                            echo "<input type='radio' name='ensinoSup' id='naoss' value='NAO'";
                                            if(isset($_POST['ensinoSup'])){echo checked( 'NAO', $_POST['ensinoSup']); }
                                            echo "> Não";
                                            echo "</label>";
                                            echo "<hr>";
                                            echo "</div>";
                                            echo "<hr>";
                                            echo "<div id='box-enSups' style='display: none'>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12 col-lg-offset-1 col-md-offset-1'>";
                                            echo "<label>Universidade Pública*</label><br>";
                                            echo "<label class='radio-inline'>";
                                            echo "<input type='radio' name='redeUnip' id='simpubs' value='SIM'";
                                            if(isset($_POST['redeUnip'])){echo checked( 'SIM', $_POST['redeUnip']); }
                                            echo " > Sim";
                                            echo "</label>";
                                            echo "<label class='radio-inline'>";
                                            echo "<input type='radio' name='redeUnip' id='naopubs' value='NAO'";
                                            if(isset($_POST['redeUnip'])){echo checked( 'NAO', $_POST['redeUnip']); }
                                            echo "> Não";
                                            echo "</label>";
                                            echo "<div id='box-nomeUniPubs' style='display: none'>";
                                            echo "<br><label> Qual?*</label><br>";
                                            echo "<input type='text' class='form-control' name='universidadep'";
                                            if(isset($_POST['universidadep'])) echo "value='".$_POST['universidadep']."' ";
                                            echo " >";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12 '>";
                                            echo "<label>Universidade Particular*</label><br>";
                                            echo "<label class='radio-inline'>";
                                            echo "<input type='radio' name='redeUnipar' id='simpars' value='SIM'";
                                            if(isset($_POST['redeUnipar'])){echo checked( 'SIM', $_POST['redeUnipar']); }
                                            echo "> Sim";
                                            echo "</label>";
                                            echo "<label class='radio-inline'>";
                                            echo "<input type='radio' name='redeUnipar' id='naopars' value='NAO'";
                                            if(isset($_POST['redeUnipar'])){echo checked( 'NAO', $_POST['redeUnipar']); }
                                            echo "> Não";
                                            echo "</label>";
                                            echo " <div id='box-nomeUniPars' style='display: none'>";
                                            echo "<br><label> Qual?*</label><br>";
                                            echo "<input type='text' name='universidadepar' class='form-control'";
                                            if(isset($_POST['universidadepar'])) echo "value='".$_POST['universidadepar']."' ";
                                            echo " >";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";

                                            break;

                                        case "MÉDIO CURSANDO" :

                                            echo "<div id='box-mcur' style='display: block' >";
                                            echo "<div class='form-group'>";
                                            echo "<div class='col-lg-3 col-md-3 col-xs-6'>";
                                            echo " <label>Rede de ensino*</label><br>";
                                            echo "<select name='rede' class='form-control'  >";
                                            echo "<option value='0'";
                                            if(isset($_POST['rede'])){ echo selected( '0', $_POST['rede']);}
                                            echo "></option>";
                                            echo "<option value='PUBLICA'";
                                            if(isset($_POST['rede'])){echo selected( 'PUBLICA', $_POST['rede']);}
                                            echo ">Pública </option>";
                                            echo "<option value='PRIVADA'";
                                            if(isset($_POST['rede'])){echo selected( 'PRIVADA', $_POST['rede']);}
                                            echo " >Privada na condição de bolsista integral</option>";
                                            echo "<option value='ECCF'";
                                            if(isset($_POST['rede'])){echo selected( 'ECCF', $_POST['rede']);}
                                            echo ">Escolas confessionais, comunitárias e/ou filantrópicas executoras de parceria com o poder público, ambas sem fins lucrativos ou na forma da lei.</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "<div class='col-lg-3 col-md-3 col-xs-6'>";
                                            echo "<label>Nome da Escola*</label>";
                                            echo "<input class='form-control text-uppercase' name='escola'";
                                            if(isset($_POST['escola'])){echo "value='".$_POST['escola']."' "; }
                                            echo ">";
                                            echo "</div>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12'>";
                                            echo " <label>  Quantas séries cursou na rede privada?*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<select class='form-control text-uppercase text-right' name='anosPuc' >";
                                            echo " <option value='0'";
                                            if(isset($_POST['anosPri'])) echo selected( '0', $_POST['anosPri']);
                                            echo ">0</option>";
                                            echo "<option value='1'";
                                            if(isset($_POST['anosPri'])) echo selected( '1', $_POST['anosPri']);
                                            echo ">1</option>";
                                            echo "<option value='2'";
                                            if(isset($_POST['anosPri'])) echo selected( '2', $_POST['anosPri']);
                                            echo ">2</option>";
                                            echo "<option value='3'";
                                            if(isset($_POST['anosPri'])) echo selected( '3', $_POST['anosPri']);
                                            echo ">3</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12'>";
                                            echo "<br><label>  Quantas séries cursou na rede pública?*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<select class='form-control text-uppercase text-right' name='anosPuc' >";
                                            echo "<option value='0'";
                                            if(isset($_POST['anospuc'])) echo selected( '0', $_POST['anospuc']);
                                            echo ">0</option>";
                                            echo "<option value='1'";
                                            if(isset($_POST['anospuc'])) echo selected( '1', $_POST['anospuc']);
                                            echo ">1</option>";
                                            echo "<option value='2'";
                                            if(isset($_POST['anospuc'])) echo selected( '2', $_POST['anospuc']);
                                            echo ">2</option>";
                                            echo "<option value='3'";
                                            if(isset($_POST['anospuc'])) echo selected( '3', $_POST['anospuc']);
                                            echo ">3</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='row'>";
                                            echo "<div class='col-lg-4 col-md-4 col-xs-12 '>";
                                            echo "<br><label>Turno que estuda*</label><br>";
                                            echo "<select class='form-control text-uppercase text-right' name='turno'  >";
                                            echo "<option value='0'";
                                            if(isset($_POST['turno'])) echo selected( '0', $_POST['turno']);
                                            echo "></option>";
                                            echo " <option value='MATUTINO'";
                                            if(isset($_POST['turno'])) echo selected( 'MATUTINO', $_POST['turno']);
                                            echo ">Matutino</option>";
                                            echo "<option value='VESPERTINO'";
                                            if(isset($_POST['turno'])) echo selected( 'VESPERTINO', $_POST['turno']);
                                            echo ">vespertino</option>";
                                            echo "<option value='NOTURNO'";
                                            if(isset($_POST['turno'])) echo selected( 'NOTURNO', $_POST['turno']);
                                            echo ">Noturno</option>";
                                            echo "<option value='INTEGRAL'";
                                            if(isset($_POST['turno'])) echo selected( 'INTEGRAL', $_POST['turno']);
                                            echo ">Integral</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "<div class='row'>";
                                            echo "<div class='col-lg-12'>";
                                            echo "<div class='form-group'>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>";
                                            echo "<br><label>   Série*</label><br>";
                                            echo "<div class='col-lg-4 col-md-4 col-xs-12 col-lg-offset-4 col-md-offset-4 text-center'>";
                                            echo "<select class='form-control text-uppercase text-right' name='serie'  >";
                                            echo "<option value='1'";
                                            if(isset($_POST['serie'])) echo selected( '1', $_POST['serie']);
                                            echo ">1º ano</option>";
                                            echo " <option value='2'";
                                            if(isset($_POST['serie'])) echo selected( '2', $_POST['serie']);
                                            echo ">2º ano</option>";
                                            echo "<option value='3'";
                                            if(isset($_POST['serie'])) echo selected( '3', $_POST['serie']);
                                            echo ">3º ano</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<hr>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>";
                                            echo "<hr>";
                                            echo "<br><label>  Boletim de desempenho*</label><br>";
                                            echo "<hr>";
                                            echo "</div>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>";
                                            echo "<br><label>  Disciplinas</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12'>";
                                            echo "<br><label> Matemática*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<input type='text' name='matematica' class='form-control' maxlength='3'";
                                            if(isset($_POST['matematica'])) echo "value='".$_POST['matematica']."' ";
                                            echo ">";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12'>";
                                            echo "<br><label> Português*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<input type='text' name='portugues' class='form-control' maxlength='3'";
                                            if(isset($_POST['portugues'])) echo "value='".$_POST['portugues']."' ";
                                            echo " >";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-8 text-center'>";
                                            echo "</div>";
                                            echo "<hr>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";

                                            break;

                                        case "EJA COMPLETO" :

                                            echo "<div id='box-ejac' style='display: block' >";
                                            echo "<div class='form-group'>";
                                            echo "<div class='col-lg-3 col-md-3 col-xs-12'>";
                                            echo "<label>Rede de ensino*</label><br>";
                                            echo "<select name='rede' class='form-control' >";
                                            echo " <option value='0'";
                                            if(isset($_POST['rede'])){ echo selected( '0', $_POST['rede']);}
                                            echo "></option>";
                                            echo "<option value='PUBLICA'";
                                            if(isset($_POST['rede'])){echo selected( 'PUBLICA', $_POST['rede']);}
                                            echo " >Pública </option>";
                                            echo " <option value='PRIVADA'";
                                            if(isset($_POST['rede'])){echo selected( 'PRIVADA', $_POST['rede']);}
                                            echo " >Privada na condição de bolsista integral</option>";
                                            echo " <option value='ECCF'";
                                            if(isset($_POST['rede'])){echo selected( 'ECCF', $_POST['rede']);}
                                            echo ">Escolas confessionais, comunitárias e/ou filantrópicas executoras de parceria com o poder público, ambas sem fins lucrativos ou na forma da lei.</option>";
                                            echo " </select>";
                                            echo "</div>";
                                            echo "<div class='col-lg-3 col-md-3 col-xs-12'>";
                                            echo "<label>Nome da Escola*</label>";
                                            echo " <input class='form-control text-uppercase' name='escola'";
                                            if(isset($_POST['escola'])){echo "value='".$_POST['escola']."' "; }
                                            echo ">";
                                            echo "</div>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12'>";
                                            echo "<label>  Quantas séries cursou na rede privada?*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<select class='form-control text-uppercase text-right' name='anosPuc' >";
                                            echo "<option value='0'";
                                            if(isset($_POST['anosPri'])) echo selected( '0', $_POST['anosPri']);
                                            echo ">0</option>";
                                            echo " <option value='1'";
                                            if(isset($_POST['anosPri'])) echo selected( '1', $_POST['anosPri']);
                                            echo ">1</option>";
                                            echo " <option value='2'";
                                            if(isset($_POST['anosPri'])) echo selected( '2', $_POST['anosPri']);
                                            echo " >2</option>";
                                            echo "<option value='3'";
                                            if(isset($_POST['anosPri'])) echo selected( '3', $_POST['anosPri']);
                                            echo " >3</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='row'>";
                                            echo "<div class='col-lg-12'>";
                                            echo "<div class='form-group'>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12'>";
                                            echo "<br><label>    Quantas séries cursou na rede pública?*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<select class='form-control text-uppercase text-right' name='anosPuc' >";
                                            echo "<option value='0'";
                                            if(isset($_POST['anosPuc'])) echo selected( '0', $_POST['anosPuc']);
                                            echo " >0</option>";
                                            echo " <option value='1'";
                                            if(isset($_POST['anosPuc'])) echo selected( '1', $_POST['anosPuc']);
                                            echo ">1</option>";
                                            echo "<option value='2'";
                                            if(isset($_POST['anosPuc'])) echo selected( '2', $_POST['anosPuc']);
                                            echo ">2</option>";
                                            echo "<option value='3'";
                                            if(isset($_POST['anosPuc'])) echo selected( '3', $_POST['anosPuc']);
                                            echo ">3</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12 '>";
                                            echo "<br><label> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  Ano de conclusão do ensino médio*</label><br>";
                                            echo "<div class='col-lg-7 col-md-7 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<input type='text' class='form-control' name='conclusaoMedio'";
                                            if(isset($_POST['conclusaoMedio'])) echo "value='".$_POST['conclusaoMedio']."' ";
                                            echo ">";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<hr>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>";
                                            echo "<hr>";
                                            echo "<br><label>  Boletim de desempenho*</label><br>";
                                            echo "<hr>";
                                            echo "</div>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>";
                                            echo "<br><label>  Disciplinas</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12'>";
                                            echo "<br><label> Matemática*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<input type='text' name='matematica' class='form-control' maxlength='3'";
                                            if(isset($_POST['matematica'])) echo "value='".$_POST['matematica']."' ";
                                            echo ">";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12'>";
                                            echo "<br><label> Português*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<input type='text' name='portugues' class='form-control' maxlength='3'";
                                            if(isset($_POST['portugues'])) echo "value='".$_POST['portugues']."' ";
                                            echo ">";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>";
                                            echo "<hr>";
                                            echo "<br><label>  Está cursando o ensino superior?*</label><br>";
                                            echo "<label class='radio-inline'>";
                                            echo "<input type='radio' name='ensinoSup' id='simss' value='SIM' ";
                                            if(isset($_POST['ensinoSup'])){echo checked( 'SIM', $_POST['ensinoSup']); }
                                            echo "> Sim";
                                            echo "</label>";
                                            echo "<label class='radio-inline'>";
                                            echo "<input type='radio' name='ensinoSup' id='naoss' value='NAO'";
                                            if(isset($_POST['ensinoSup'])){echo checked( 'NAO', $_POST['ensinoSup']); }
                                            echo "> Não";
                                            echo "</label>";
                                            echo "<hr>";
                                            echo "</div>";
                                            echo "<hr>";
                                            echo "<div id='box-enSups' style='display: none'>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12 col-lg-offset-1 col-md-offset-1'>";
                                            echo "<label>Universidade Pública*</label><br>";
                                            echo "<label class='radio-inline'>";
                                            echo "<input type='radio' name='redeUnip' id='simpubs' value='SIM'";
                                            if(isset($_POST['redeUnip'])){echo checked( 'SIM', $_POST['redeUnip']); }
                                            echo " > Sim";
                                            echo "</label>";
                                            echo "<label class='radio-inline'>";
                                            echo "<input type='radio' name='redeUnip' id='naopubs' value='NAO'";
                                            if(isset($_POST['redeUnip'])){echo checked( 'NAO', $_POST['redeUnip']); }
                                            echo "> Não";
                                            echo "</label>";
                                            echo "<div id='box-nomeUniPubs' style='display: none'>";
                                            echo "<br><label> Qual?*</label><br>";
                                            echo "<input type='text' class='form-control' name='universidadep'";
                                            if(isset($_POST['universidadep'])) echo "value='".$_POST['universidadep']."' ";
                                            echo " >";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12 '>";
                                            echo "<label>Universidade Particular*</label><br>";
                                            echo "<label class='radio-inline'>";
                                            echo "<input type='radio' name='redeUnipar' id='simpars' value='SIM'";
                                            if(isset($_POST['redeUnipar'])){echo checked( 'SIM', $_POST['redeUnipar']); }
                                            echo "> Sim";
                                            echo "</label>";
                                            echo "<label class='radio-inline'>";
                                            echo "<input type='radio' name='redeUnipar' id='naopars' value='NAO'";
                                            if(isset($_POST['redeUnipar'])){echo checked( 'NAO', $_POST['redeUnipar']); }
                                            echo "> Não";
                                            echo "</label>";
                                            echo " <div id='box-nomeUniPars' style='display: none'>";
                                            echo "<br><label> Qual?*</label><br>";
                                            echo "<input type='text' name='universidadepar' class='form-control'";
                                            if(isset($_POST['universidadepar'])) echo "value='".$_POST['universidadepar']."' ";
                                            echo " >";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";

                                            break;

                                        case "EJA CURSANDO" :

                                            echo "<div id='box-ejacur' style='display: block' >";
                                            echo "<div class='form-group'>";
                                            echo "<div class='col-lg-3 col-md-3 col-xs-6'>";
                                            echo " <label>Rede de ensino*</label><br>";
                                            echo "<select name='rede' class='form-control'  >";
                                            echo "<option value='0'";
                                            if(isset($_POST['rede'])){ echo selected( '0', $_POST['rede']);}
                                            echo "></option>";
                                            echo "<option value='PUBLICA'";
                                            if(isset($_POST['rede'])){echo selected( 'PUBLICA', $_POST['rede']);}
                                            echo ">Pública </option>";
                                            echo "<option value='PRIVADA'";
                                            if(isset($_POST['rede'])){echo selected( 'PRIVADA', $_POST['rede']);}
                                            echo " >Privada na condição de bolsista integral</option>";
                                            echo "<option value='ECCF'";
                                            if(isset($_POST['rede'])){echo selected( 'ECCF', $_POST['rede']);}
                                            echo ">Escolas confessionais, comunitárias e/ou filantrópicas executoras de parceria com o poder público, ambas sem fins lucrativos ou na forma da lei.</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "<div class='col-lg-3 col-md-3 col-xs-6'>";
                                            echo "<label>Nome da Escola*</label>";
                                            echo "<input class='form-control text-uppercase' name='escola'";
                                            if(isset($_POST['escola'])){echo "value='".$_POST['escola']."' "; }
                                            echo ">";
                                            echo "</div>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12'>";
                                            echo " <label>  Quantas séries cursou na rede privada?*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<select class='form-control text-uppercase text-right' name='anosPuc' >";
                                            echo " <option value='0'";
                                            if(isset($_POST['anosPri'])) echo selected( '0', $_POST['anosPri']);
                                            echo ">0</option>";
                                            echo "<option value='1'";
                                            if(isset($_POST['anosPri'])) echo selected( '1', $_POST['anosPri']);
                                            echo ">1</option>";
                                            echo "<option value='2'";
                                            if(isset($_POST['anosPri'])) echo selected( '2', $_POST['anosPri']);
                                            echo ">2</option>";
                                            echo "<option value='3'";
                                            if(isset($_POST['anosPri'])) echo selected( '3', $_POST['anosPri']);
                                            echo ">3</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-5 col-md-5 col-xs-12'>";
                                            echo "<br><label>  Quantas séries cursou na rede pública?*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<select class='form-control text-uppercase text-right' name='anosPuc' >";
                                            echo "<option value='0'";
                                            if(isset($_POST['anospuc'])) echo selected( '0', $_POST['anospuc']);
                                            echo ">0</option>";
                                            echo "<option value='1'";
                                            if(isset($_POST['anospuc'])) echo selected( '1', $_POST['anospuc']);
                                            echo ">1</option>";
                                            echo "<option value='2'";
                                            if(isset($_POST['anospuc'])) echo selected( '2', $_POST['anospuc']);
                                            echo ">2</option>";
                                            echo "<option value='3'";
                                            if(isset($_POST['anospuc'])) echo selected( '3', $_POST['anospuc']);
                                            echo ">3</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='row'>";
                                            echo "<div class='col-lg-4 col-md-4 col-xs-12 '>";
                                            echo "<br><label>Turno que estuda*</label><br>";
                                            echo "<select class='form-control text-uppercase text-right' name='turno'  >";
                                            echo "<option value='0'";
                                            if(isset($_POST['turno'])) echo selected( '0', $_POST['turno']);
                                            echo "></option>";
                                            echo " <option value='MATUTINO'";
                                            if(isset($_POST['turno'])) echo selected( 'MATUTINO', $_POST['turno']);
                                            echo ">Matutino</option>";
                                            echo "<option value='VESPERTINO'";
                                            if(isset($_POST['turno'])) echo selected( 'VESPERTINO', $_POST['turno']);
                                            echo ">vespertino</option>";
                                            echo "<option value='NOTURNO'";
                                            if(isset($_POST['turno'])) echo selected( 'NOTURNO', $_POST['turno']);
                                            echo ">Noturno</option>";
                                            echo "<option value='INTEGRAL'";
                                            if(isset($_POST['turno'])) echo selected( 'INTEGRAL', $_POST['turno']);
                                            echo ">Integral</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "<div class='row'>";
                                            echo "<div class='col-lg-12'>";
                                            echo "<div class='form-group'>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>";
                                            echo "<br><label>   Série*</label><br>";
                                            echo "<div class='col-lg-4 col-md-4 col-xs-12 col-lg-offset-4 col-md-offset-4 text-center'>";
                                            echo "<select class='form-control text-uppercase text-right' name='serie'  >";
                                            echo "<option value='1'";
                                            if(isset($_POST['serie'])) echo selected( '1', $_POST['serie']);
                                            echo ">1º ano</option>";
                                            echo " <option value='2'";
                                            if(isset($_POST['serie'])) echo selected( '2', $_POST['serie']);
                                            echo ">2º ano</option>";
                                            echo "<option value='3'";
                                            if(isset($_POST['serie'])) echo selected( '3', $_POST['serie']);
                                            echo ">3º ano</option>";
                                            echo "</select>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<hr>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>";
                                            echo "<hr>";
                                            echo "<br><label>  Boletim de desempenho*</label><br>";
                                            echo "<hr>";
                                            echo "</div>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-12 text-center'>";
                                            echo "<br><label>  Disciplinas</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12'>";
                                            echo "<br><label> Matemática*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<input type='text' name='matematica' class='form-control' maxlength='3'";
                                            if(isset($_POST['matematica'])) echo "value='".$_POST['matematica']."' ";
                                            echo ">";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12'>";
                                            echo "<br><label> Português*</label><br>";
                                            echo "<div class='col-lg-6 col-md-6 col-xs-12 col-lg-offset-3 col-md-offset-3'>";
                                            echo "<input type='text' name='portugues' class='form-control' maxlength='3'";
                                            if(isset($_POST['portugues'])) echo "value='".$_POST['portugues']."' ";
                                            echo " >";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='col-lg-12 col-md-12 col-xs-8 text-center'>";
                                            echo "</div>";
                                            echo "<hr>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";

                                            break;

                                        default:
                                            echo "<div id='box-mc' style='display: none' ></div>";
                                            echo "<div id='box-mcur' style='display: none' ></div>";
                                            echo "<div id='box-ejac' style='display: none' ></div>";
                                            echo "<div id='box-ejacur' style='display: none' ></div>";

                                            break;
                                    }

                                }
                                ?>




                            </div>
                        </div>


                        <hr>




                    </div>

                </div>

            </div>

        </div>

    </div>

    </div>
    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-heading text-center">

                        <b>Questionário</b>

                    </div>


                    <div class="panel-body">

                        <div class="form-group">

                            <script>
                                $(document).ready(function(){
                                    $("#sim").click(function(evento){
                                        if ($("#sim").attr("checked")){
                                            $("#box-projsoc").css("display", "block");

                                        }else{
                                            $("#box-projsoc").css("display", "none");

                                        }
                                    });
                                });
                                $(document).ready(function(){
                                    $("#nao").click(function(evento){
                                        if ($("#nao").attr("checked")){
                                            $("#box-projsoc").css("display", "none");

                                        }else{
                                            $("#box-projsoc").css("display", "block");

                                        }
                                    });
                                });
                            </script>

                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 ">
                                    <div class="col-lg-6 col-md-6 col-xs-12">
                                        <label>1) Participa de projetos sociais de acesso ao ensino superior?*</label><br>
                                        <label class="radio-inline">

                                            <input type="radio" name="que1" id="sim" value="SIM"
                                                <?php  if(isset($_POST['que1'])){echo checked( 'SIM', $_POST['que1']); } ?>
                                            >Sim

                                        </label>

                                        <label class="radio-inline">

                                            <input type="radio" name="que1" id="nao" value="NAO"
                                                <?php  if(isset($_POST['que1'])){echo checked( 'NAO', $_POST['que1']); } ?>
                                            > Não

                                        </label>

                                    </div>
                                    <div id='box-projsoc' style='display: none'>
                                        <div class="col-lg-5 col-md-5 col-xs-12 ">

                                            <label>Qual?*</label><br>

                                            <input class="form-control" name="que12" type="text"
                                                <?php if(isset($_POST['que12'])) echo "value='".$_POST['que12']."' "; ?>
                                            >


                                        </div>
                                    </div>

                                </div>
                            </div>


                            <hr>

                            <div class="row">

                                <div class="col-lg-5 col-md-5 col-xs-6">

                                    <label>2) Atualmente você têm uma ocupação?*</label><br>

                                    <label class="radio-inline">

                                        <input type="radio" name="que2" id="optionsRadiosInline1" value="SIM"
                                            <?php  if(isset($_POST['que2'])){echo checked( 'SIM', $_POST['que2']); } ?>
                                        >Sim

                                    </label>

                                    <label class="radio-inline">

                                        <input type="radio" name="que2" id="optionsRadiosInline2" value="NAO"
                                            <?php  if(isset($_POST['que2'])){echo checked( 'NAO', $_POST['que2']); } ?>
                                        > Não

                                    </label>

                                </div>
                                <script>
                                    function mudaTrab() {
                                        var x = document.getElementById("trabSelect").value;
                                        if(x=="NÃO-PROCUROU-30"){
                                            $("#box-proc").css("display", "block");
                                            document.getElementById("box-proc").innerHTML =
                                                "<div class='row'>"+
                                                "<div class='col-lg-5 col-md-5 col-xs-6'>"+
                                                "<label>2.1) Onde você procurou trabalho nos últimos 30 dias?*</label><br>"+
                                                "<select class='form-control' name='que21' >"+
                                                "<option  value='AGENCIA-TRAB'"+
                                                <?php if(isset($_POST['que21'])){
                                                    $resul= selectedj( 'AGENCIA-TRAB', $_POST['que21']);
                                                    echo "'".$resul."'";
                                                }
                                                ?>

                                                ">Agência do Trabalhador.</option>"+
                                                "<option  value='AGENCIAS'"+
                                                <?php if(isset($_POST['que21'])){
                                                    $resul= selectedj( 'AGENCIAS', $_POST['que21']);
                                                    echo "'".$resul."'";
                                                }
                                                ?>
                                                ">Consultou agências de emprego ou nelas se cadastrou.</option>"+
                                                "<option  value='PARENTES-AMIGOS'"+
                                                <?php if(isset($_POST['que21'])){
                                                    $resul= selectedj( 'PARENTES-AMIGOS', $_POST['que21']);
                                                    echo "'".$resul."'";
                                                }
                                                ?>
                                                ">Consultou parentes e amigos.</option>"+
                                                "<option  value='CONCURSO'"+
                                                <?php if(isset($_POST['que21'])){
                                                    $resul= selectedj( 'CONCURSO', $_POST['que21']);
                                                    echo "'".$resul."'";
                                                }
                                                ?>
                                                ">Fez concurso.</option>"+
                                                "<option  value='NEGOCIO'"+
                                                <?php if(isset($_POST['que21'])){
                                                    $resul= selectedj( 'NEGOCIO', $_POST['que21']);
                                                    echo "'".$resul."'";
                                                }
                                                ?>
                                                ">Abriu o próprio negócio.</option>"+
                                                "<option  value='OUTRO'"+
                                                <?php if(isset($_POST['que21'])){
                                                    $resul= selectedj( 'OUTRO', $_POST['que21']);
                                                    echo "'".$resul."'";
                                                }
                                                ?>
                                                ">Outro.</option>"+
                                                " </select>"+
                                                "</div>"+
                                                "<div class='col-lg-4 col-md-3 col-xs-6'>"+
                                                "<label>Outro</label>"+
                                                "<input class='form-control text-uppercase' name='que22' placeholder='Onde procurou trabalho...'"+
                                                <?php if(isset($_POST['que22'])){
                                                    $val="value='".$_POST['que22']."' ";
                                                    echo '"'.$val.'"+';
                                                }

                                                ?>
                                                ">"+
                                                "</div>";
                                        }
                                        else{
                                            $("#box-proc").css("display", "none");

                                        }


                                    }


                                </script>


                                <div class="col-lg-7 col-md-7 col-xs-6">

                                    <label>Qual?*</label>

                                    <select class="form-control" id="trabSelect" name="que22" onchange="mudaTrab();">
                                        <option  value=""
                                            <?php  if(isset($_POST['que22'])) echo selected( '', $_POST['que22']); ?>
                                        ></option>
                                        <option  value="SIM-CARTEIRA"
                                            <?php if(isset($_POST['que22'])) echo selected( 'SIM-CARTEIRA', $_POST['que22']); ?>
                                        >Sim, com carteira assinada.</option>
                                        <option  value="SIM-SEM CARTEIRA"
                                            <?php if(isset($_POST['que22'])) echo selected( 'SIM-SEM CARTEIRA', $_POST['que22']); ?>
                                        >Sim, sem carteira assinada.</option>
                                        <option  value="SIM-FUNC-PUBLICO"
                                            <?php if(isset($_POST['que22'])) echo selected( 'SIM-FUNC-PUBLICO', $_POST['que22']); ?>
                                        >Sim, funcionário público.</option>
                                        <option  value="NÃO-NÃO PROCURA"
                                            <?php if(isset($_POST['que22'])) echo selected( 'NÃO-NÃO PROCURA', $_POST['que22']); ?>
                                        >Não, e não estou procurando trabalho.</option>
                                        <option  value="NÃO-PROCUROU-30-DIAS"
                                            <?php if(isset($_POST['que22'])) echo selected( 'NÃO-PROCUROU-30-DIAS', $_POST['que22']); ?>
                                        >Não, mas procurei trabalho nos últimos 30 dias.</option>
                                    </select>

                                </div>

                            </div>

                            <hr>

                            <div id="box-proc" style="display: none"></div>



                        </div>

                        <hr>




                        <div class="row">

                            <div class="col-lg-4 col-md-4 col-xs-12 ">

                                <label>3) Aproximadamente, qual é a sua renda mensal familiar?*</label><br>
                                <div class="col-lg-8 col-md-8 col-xs-10 ">
                                    <input class="form-control" type="text" name="que3" onchange="MascaraNumeros(form.que3);
                                    <?php if(isset($_POST['que3'])) echo "value='".$_POST["que3"]."' "; ?>
                                        ">
                                </div>

                            </div>
                            <script>
                                function mudaSust() {
                                    var x = document.getElementById("sustSelect").value;
                                    if(x=="OUTROS"){
                                        $("#box-sust").css("display", "block");
                                        document.getElementById("box-sust").innerHTML =
                                            " <div class='col-lg-4 col-md-4 col-xs-10 '>"+
                                            "<label>Outros</label><br><br>"+"<div class='col-lg-9 col-md-9 col-xs-12 '>"+
                                            "<input class='form-control' type='text' name='que41' placeholder='Outros...'"+
                                            <?php if(isset($_POST['que41'])){
                                                $val="value='".$_POST['que41']."' ";
                                                echo '"'.$val.'"+';
                                            }

                                            ?>
                                            ">";
                                    }
                                    else{
                                        $("#box-sust").css("display", "none");

                                    }


                                }
                            </script>



                            <div class="col-lg-3 col-md-3 col-xs-12 ">

                                <label>4) Qual a sua contribuição para a renda familiar?*</label><br>

                                <select class="form-control" name="que4"  id="sustSelect"  onchange="mudaSust();" >

                                    <option value=""
                                        <?php if(isset($_POST['que4'])) echo selected( '', $_POST['que4']); ?>
                                    ></option>
                                    <option value="SUSTENTA-FAMILIA"
                                        <?php if(isset($_POST['que4'])) echo selected( 'SUSTENTA-FAMILIA', $_POST['que4']); ?>
                                    >É o responsável pelo sustento da família.</option>

                                    <option value="SE SUSTENTA E AJUDA"
                                        <?php if(isset($_POST['que4'])) echo selected( 'SE SUSTENTA E AJUDA', $_POST['que4']); ?>
                                    >É o responsável pelo próprio sustento e contribui com a renda familiar.</option>

                                    <option value="SUSTENTADO PELA FAMILIA"
                                        <?php if(isset($_POST['que4'])) echo selected( 'SUSTENTADO PELA FAMILIA', $_POST['que4']); ?>
                                    >É sustentado pela família.</option>

                                    <option value="SUSTENTADO POR TERCEIROS"
                                        <?php if(isset($_POST['que4'])) echo selected( 'SUSTENTADO POR TERCEIROS', $_POST['que4']); ?>
                                    >É sustentado por terceiros.</option>

                                    <option value="OUTROS"
                                        <?php if(isset($_POST['que4'])) echo selected( 'OUTROS', $_POST['que4']); ?>
                                    >Outros</option>

                                </select>
                            </div>
                            <div id="box-sust" style="display: none"></div>



                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <hr>
                                <div class="col-lg-3 col-md-3 col-xs-12 ">
                                    <br><label>5) Quantas pessoas moram na sua casa, incluindo você?*</label><br>
                                    <div class="col-lg-5 col-md-5 col-xs-12">
                                        <input class="form-control" name="que5" type="number"
                                            <?php if(isset($_POST['que5'])) echo "value='".$_POST['que5']."' "; ?>
                                        >
                                    </div>
                                </div>
                                <hr>
                                <script>
                                    function mudaSex() {
                                        var x = document.getElementById("sexSelect").value;
                                        if(x=="OUTRO"){
                                            $("#box-sex").css("display", "block");
                                            document.getElementById("box-sex").innerHTML =
                                                " <div class='col-lg-4 col-md-4 col-xs-10 '>"+
                                                "<label>Outro*</label><br><br>"+"<div class='col-lg-6 col-md-6 col-xs-12 '>"+
                                                "<input class='form-control' name='que61' type='text' placeholder='Outros...'"+
                                                <?php if(isset($_POST['que61'])){
                                                    $val="value='".$_POST['que61']."' ";
                                                    echo '"'.$val.'"+';
                                                }

                                                ?>
                                                ">";
                                        }
                                        else{
                                            $("#box-sex").css("display", "none");

                                        }


                                    }
                                </script>

                                <div class="col-lg-5 col-md-5 col-xs-12 ">
                                    <label>6) Você tem acesso a informação sobre direitos sexuais e reprodutivos? Indique a fonte de informação.*</label>
                                    <div class="col-lg-8 col-md-8 col-xs-12">
                                        <select class="form-control" name="que6" id="sexSelect"  onchange="mudaSex();" >

                                            <option value="0"
                                                <?php if(isset($_POST['que6'])) echo selected( '0', $_POST['que6']); ?>
                                            ></option>
                                            <option value="PAIS"
                                                <?php if(isset($_POST['que6'])) echo selected( 'PAIS', $_POST['que6']); ?>
                                            >Pais.</option>

                                            <option value="OUTROS FAMILIARES"
                                                <?php if(isset($_POST['que6'])) echo selected( 'OUTROS FAMILIARES', $_POST['que6']); ?>
                                            >Outros familiares.</option>

                                            <option value="COLEGAS/AMIGOS"
                                                <?php if(isset($_POST['que6'])) echo selected( 'COLEGAS/AMIGOS', $_POST['que6']); ?>
                                            >Colegas/Amigos.</option>

                                            <option value="COMPANHEIRO/PARCEIRO"
                                                <?php if(isset($_POST['que6'])) echo selected( 'COMPANHEIRO/PARCEIRO', $_POST['que6']); ?>
                                            >Companheiro/parceiro sexual.</option>

                                            <option value="IMPRENSA/TELEVISAO"
                                                <?php if(isset($_POST['que6'])) echo selected( 'IMPRENSA/TELEVISAO', $_POST['que6']); ?>
                                            >Imprensa escrita/televisão.</option>
                                            <option value="INTERNET"
                                                <?php if(isset($_POST['que6'])) echo selected( 'INTERNET', $_POST['que6']); ?>
                                            >Internet</option>
                                            <option value="PROFESSORES"
                                                <?php if(isset($_POST['que6'])) echo selected( 'PROFESSORES', $_POST['que6']); ?>
                                            >Professores</option>
                                            <option value="SAÚDE"
                                                <?php if(isset($_POST['que6'])) echo selected( 'SAÚDE', $_POST['que6']); ?>
                                            >Profissionais de saúde</option>
                                            <option value="RELIGIAO"
                                                <?php if(isset($_POST['que6'])) echo selected( 'RELIGIAO', $_POST['que6']); ?>
                                            >Grupos religiosos</option>
                                            <option value="LIVROS"
                                                <?php if(isset($_POST['que6'])) echo selected( 'LIVROS', $_POST['que6']); ?>
                                            >Livros especializados</option>
                                            <option value="SEM ACESSO"
                                                <?php if(isset($_POST['que6'])) echo selected( 'SEM ACESSO', $_POST['que6']); ?>
                                            >Não tenho acesso</option>
                                            <option value="OUTRO"
                                                <?php if(isset($_POST['que6'])) echo selected( 'OUTRO', $_POST['que6']); ?>
                                            >Outro</option>

                                        </select>

                                    </div>
                                </div>
                                <div id="box-sex" style="display: none"></div>
                                <hr>
                            </div>
                        </div>
                        <hr>


                        <script>
                            $(document).ready(function(){
                                $("#simc").click(function(evento){
                                    if ($("#simc").attr("checked")){
                                        $("#box-cursop").css("display", "block");

                                    }else{
                                        $("#box-cursop").css("display", "none");

                                    }
                                });
                            });
                            $(document).ready(function(){
                                $("#naoc").click(function(evento){
                                    if ($("#naoc").attr("checked")){
                                        $("#box-cursop").css("display", "none");

                                    }else{
                                        $("#box-cursop").css("display", "block");

                                    }
                                });
                            });
                        </script>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12 ">
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <label>7) Já fez curso preparatório?*</label><br>
                                    <label class="radio-inline">

                                        <input type="radio" name="que7" id="simc" value="SIM"
                                            <?php  if(isset($_POST['que7'])){echo checked( 'SIM', $_POST['que7']); } ?>
                                        >Sim

                                    </label>

                                    <label class="radio-inline">

                                        <input type="radio" name="que7" id="naoc" value="NAO"
                                            <?php  if(isset($_POST['que7'])){echo checked( 'NAO', $_POST['que7']); } ?>
                                        > Não

                                    </label>

                                </div>
                                <div id='box-cursop' style='display: none'>
                                    <div class="col-lg-5 col-md-5 col-xs-12 ">

                                        <label>Qual?*</label><br>

                                        <input class="form-control" name="que71" type="text"
                                            <?php if(isset($_POST['que71'])) echo "value='".$_POST['que71']."' "; ?>
                                        >


                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr>

                        <script>
                            $(document).ready(function(){
                                $("#simf").click(function(evento){
                                    if ($("#simf").attr("checked")){
                                        $("#box-filhos").css("display", "block");

                                    }else{
                                        $("#box-filhos").css("display", "none");

                                    }
                                });
                            });
                            $(document).ready(function(){
                                $("#naof").click(function(evento){
                                    if ($("#naof").attr("checked")){
                                        $("#box-filhos").css("display", "none");

                                    }else{
                                        $("#box-filhos").css("display", "block");

                                    }
                                });
                            });
                        </script>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12 ">
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <label>8) Você tem filhos?*</label><br>
                                    <label class="radio-inline">

                                        <input type="radio" name="que8" id="simf" value="SIM"
                                            <?php  if(isset($_POST['que8'])){echo checked( 'SIM', $_POST['que8']); } ?>
                                        >Sim

                                    </label>

                                    <label class="radio-inline">

                                        <input type="radio" name="que8" id="naof" value="NAO"
                                            <?php  if(isset($_POST['que8'])){echo checked( 'NAO', $_POST['que8']); } ?>
                                        > Não

                                    </label>

                                </div>
                                <div id='box-filhos' style='display: none'>
                                    <div class="col-lg-5 col-md-5 col-xs-12 ">

                                        <label>Quantos?*</label><br>
                                        <div class="col-lg-4 col-md-4 col-xs-10 ">
                                            <input class="form-control" name="que81" type="number"
                                                <?php if(isset($_POST['que81'])) echo "value='".$_POST['que81']."' "; ?>
                                            >
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr>
                        <script>
                            function mudaMov() {
                                var x = document.getElementById("movSelect").value;
                                if(x=="OUTRO"){
                                    $("#box-mov").css("display", "block");
                                    document.getElementById("box-mov").innerHTML =
                                        "<div class='col-lg-4 col-md-4 col-xs-12'>"+
                                        "<label>Outro</label><br><br>"+
                                        "<div class='col-lg-10 col-md-10 col-xs-10 '>"+
                                        "<input class='form-control' name='que91' type='text'"+
                                        <?php if(isset($_POST['que91'])){
                                            $val="value='".$_POST['que91']."' ";
                                            echo '"'.$val.'"+';
                                        } ?>

                                        " >"+
                                        "</div>"+
                                        "</div>";
                                }
                                else{
                                    $("#box-mov").css("display", "none");

                                }


                            }
                        </script>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 ">
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <label>9) Você participa de algum movimento social, esportivo, artístico e/ou cultural?*</label><br>
                                    <select class="form-control" name="que9" id="movSelect"  onchange="mudaMov();">
                                        <option value='0'
                                            <?php if(isset($_POST['que9'])) echo selected( '0', $_POST['que9']); ?>
                                        ></option>
                                        <option value='GRUPO ESPORTIVO'
                                            <?php if(isset($_POST['que9'])) echo selected( 'GRUPO ESPORTIVO', $_POST['que9']); ?>
                                        >Grupo esportivo (time de futebol, torcida organizada)</option>
                                        <option value='GRUPO RELIGIOSO'
                                            <?php if(isset($_POST['que9'])) echo selected( 'GRUPO RELIGIOSO', $_POST['que9']); ?>
                                        >Grupo religioso</option>
                                        <option value='CULTURA'
                                            <?php if(isset($_POST['que9'])) echo selected( 'CULTURA', $_POST['que9']); ?>
                                        >Cultura (capoeira, dança)</option>
                                        <option value='GRÊMIO'
                                            <?php if(isset($_POST['que9'])) echo selected( 'GRÊMIO', $_POST['que9']); ?>
                                        >Grêmio estudantil</option>
                                        <option value='POLÍTICO'
                                            <?php if(isset($_POST['que9'])) echo selected( 'POLÍTICO', $_POST['que9']); ?>
                                        >Político partidário</option>
                                        <option value='ORG MULHERES'
                                            <?php if(isset($_POST['que9'])) echo selected( 'ORG MULHERES', $_POST['que9']); ?>
                                        >Organização de mulheres</option>
                                        <option value='LGBT'
                                            <?php if(isset($_POST['que9'])) echo selected( 'LGBT', $_POST['que9']); ?>
                                        >Organização LGBT</option>
                                        <option value='ÉTINICO/RACIAL'
                                            <?php if(isset($_POST['que9'])) echo selected( 'ÉTINICO/RACIAL', $_POST['que9']); ?>
                                        >Movimento étnico racial</option>
                                        <option value='SINDICAL'
                                            <?php if(isset($_POST['que9'])) echo selected( 'SINDICAL', $_POST['que9']); ?>
                                        >Movimento sindical</option>
                                        <option value='NENHUM'
                                            <?php if(isset($_POST['que9'])) echo selected( 'NENHUM', $_POST['que9']); ?>
                                        >Não participo de nenhum.</option>
                                        <option value='OUTRO'
                                            <?php if(isset($_POST['que9'])) echo selected( 'OUTRO', $_POST['que9']); ?>
                                        >Outro</option>
                                    </select>
                                </div>
                                <div id='box-mov' style='display: none'></div>

                            </div>
                        </div>
                        <hr>

                        <script>
                            $(document).ready(function(){
                                $("#simd").click(function(evento){
                                    if ($("#simd").attr("checked")){
                                        $("#box-pcd").css("display", "block");

                                    }else{
                                        $("#box-pcd").css("display", "none");

                                    }
                                });
                            });
                            $(document).ready(function(){
                                $("#naod").click(function(evento){
                                    if ($("#naod").attr("checked")){
                                        $("#box-pcd").css("display", "none");

                                    }else{
                                        $("#box-pcd").css("display", "block");

                                    }
                                });
                            });
                        </script>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 ">
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <label>10) Possui alguma deficiência ou necessita de atendimento especial?*</label><br>
                                    <label class="radio-inline">

                                        <input type="radio" name="que10" id="simd" value="SIM"
                                            <?php  if(isset($_POST['que10'])){echo checked( 'SIM', $_POST['que10']); } ?>
                                        >Sim

                                    </label>

                                    <label class="radio-inline">

                                        <input type="radio" name="que10" id="naod" value="NAO"
                                            <?php  if(isset($_POST['que10'])){echo checked( 'NAO', $_POST['que10']); } ?>
                                        > Não

                                    </label>

                                </div>
                                <div id='box-pcd' style='display: none'>
                                    <div class="col-lg-5 col-md-5 col-xs-12 ">

                                        <label>Qual?</label><br>

                                        <input class="form-control" name="que101" type="text"
                                            <?php if(isset($_POST['que101'])) echo "value='".$_POST['que101']."' "; ?>
                                        >


                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 ">
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <label>11) Participou do Projeto BoravencerAulão 1º /2016?*</label><br>
                                    <label class="radio-inline">

                                        <input type="radio" name="que11" id="sim" value="SIM"
                                            <?php  if(isset($_POST['que11'])){echo checked( 'SIM', $_POST['que11']); } ?>
                                        >Sim

                                    </label>

                                    <label class="radio-inline">

                                        <input type="radio" name="que11" id="nao" value="NAO"
                                            <?php  if(isset($_POST['que11'])){echo checked( 'NAO', $_POST['que11']); } ?>
                                        > Não

                                    </label>

                                </div>
                                <script>
                                    $(document).ready(function(){
                                        $("#simo").click(function(evento){
                                            if ($("#simo").attr("checked")){
                                                $("#box-proo").css("display", "block");

                                            }else{
                                                $("#box-proo").css("display", "none");

                                            }
                                        });
                                    });
                                    $(document).ready(function(){
                                        $("#naoo").click(function(evento){
                                            if ($("#naoo").attr("checked")){
                                                $("#box-proo").css("display", "none");

                                            }else{
                                                $("#box-proo").css("display", "block");

                                            }
                                        });
                                    });
                                </script>
                                <div class="col-lg-6 col-md-6 col-xs-12">
                                    <label>12) Você conhece outros projetos na sua região administrativa voltados para o jovem?*</label><br>
                                    <label class="radio-inline">

                                        <input type="radio" name="que12" id="simo" value="SIM"
                                            <?php  if(isset($_POST['que12'])){echo checked( 'SIM', $_POST['que12']); } ?>
                                        >Sim

                                    </label>

                                    <label class="radio-inline">

                                        <input type="radio" name="que12" id="naoo" value="NAO"
                                            <?php  if(isset($_POST['que12'])){echo checked( 'NAO', $_POST['que12']); } ?>
                                        > Não

                                    </label>

                                </div>
                                <div id='box-proo' style='display: none'>
                                    <div class="col-lg-3 col-md-3 col-xs-12 ">

                                        <br><br><label>Quais?*</label><br>

                                        <input class="form-control" name="que121" type="text"
                                            <?php if(isset($_POST['que121'])) echo "value='".$_POST['que121']."' "; ?>
                                        >


                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <script>
                            function mudaQuali() {
                                var x = document.getElementById("qualiSelect").value;
                                if(x=="OUTRO"){
                                    $("#box-quali").css("display", "block");
                                    document.getElementById("box-quali").innerHTML =
                                        "<div class='col-lg-4 col-md-4 col-xs-12'>"+
                                        "<br><label>Outro*</label><br>"+
                                        "<div class='col-lg-10 col-md-10 col-xs-10 '>"+
                                        "<input class='form-control' type='text' placeholder='Outra área...'  name='que141'"+
                                        <?php if(isset($_POST['que141'])){
                                            $val="value='".$_POST['que141']."' ";
                                            echo '"'.$val.'"+';
                                        } ?>
                                        ">"+
                                        "</div>"+
                                        "</div>";
                                }
                                else{
                                    $("#box-quali").css("display", "none");

                                }


                            }
                            function mudaBora() {
                                var x = document.getElementById("boraSelect").value;
                                if(x=="OUTRO"){
                                    $("#box-bora").css("display", "block");
                                    document.getElementById("box-bora").innerHTML =
                                        "<div class='col-lg-4 col-md-4 col-xs-12'>"+
                                        "<br><label>Outro*</label><br>"+
                                        "<div class='col-lg-10 col-md-10 col-xs-10 '>"+
                                        "<input class='form-control' type='text' placeholder='Outro...'  name='que131'"+
                                        <?php if(isset($_POST['que131'])){
                                            $val="value='".$_POST['que131']."' ";
                                            echo '"'.$val.'"+';
                                        } ?>
                                        ">"+
                                        "</div>"+
                                        "</div>";
                                }
                                else{
                                    $("#box-bora").css("display", "none");

                                }


                            }
                        </script>

                        <div class="row">
                            <div class="col-lg-12 col-md-12 ">
                                <div class="col-lg-5 col-md-5 col-xs-12">
                                    <br> <label>13) Como soube do Projeto BoravencerIntensivão?*</label><br>
                                    <select class="form-control" name="que13"  id="boraSelect" onchange="mudaBora();" >
                                        <option value=''
                                            <?php if(isset($_POST['que13'])) echo selected( '', $_POST['que13']); ?>
                                        ></option>
                                        <option value='INTERNET'
                                            <?php if(isset($_POST['que13'])) echo selected( 'INTERNET', $_POST['que13']); ?>
                                        >Internet</option>
                                        <option value='TV/RADIO'
                                            <?php if(isset($_POST['que13'])) echo selected( 'TV/RADIO', $_POST['que13']); ?>
                                        >TV/Rádio</option>
                                        <option value='ESCOLA'
                                            <?php if(isset($_POST['que13'])) echo selected( 'ESCOLA', $_POST['que13']); ?>
                                        >Escola</option>
                                        <option value='CURSINHO'
                                            <?php if(isset($_POST['que13'])) echo selected( 'CURSINHO', $_POST['que13']); ?>
                                        >Cursinho</option>
                                        <option value='SITE-SECRIA/FACE-SECRIA'
                                            <?php if(isset($_POST['que13'])) echo selected( 'SITE-SECRIA/FACE-SECRIA', $_POST['que13']); ?>
                                        >Site da SECRIA/Facebook SECRIA</option>
                                        <option value='AMIGOS'
                                            <?php if(isset($_POST['que13'])) echo selected( 'AMIGOS', $_POST['que13']); ?>
                                        >Amigos</option>
                                        <option value='OUTRO'
                                            <?php if(isset($_POST['que13'])) echo selected( 'OUTRO', $_POST['que13']); ?>
                                        >Outro</option>

                                    </select>
                                </div>
                                <div id="box-bora" style="display: none"></div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 ">
                                <div class="col-lg-7 col-md-7 col-xs-12">
                                    <label>14) Você tem interesse de se qualificar para o mercado de trabalho? Se sim, em quais áreas de interesse gostaria de se qualificar/melhorar sua qualificação profissional?*</label><br>
                                    <select class="form-control" id="qualiSelect" name="que14" onchange="mudaQuali();" >
                                        <option value=''
                                            <?php if(isset($_POST['que14'])) echo selected( '', $_POST['que14']); ?>
                                        ></option>
                                        <option value='ADMINISTRAÇÃO/GESTÃO'
                                            <?php if(isset($_POST['que14'])) echo selected( 'ADMINISTRAÇÃO/GESTÃO', $_POST['que14']); ?>
                                        >Administração/gestão</option>
                                        <option value='ARTES/CULTURA'
                                            <?php if(isset($_POST['que14'])) echo selected( 'ARTES/CULTURA', $_POST['que14']); ?>
                                        >Artes/cultura</option>
                                        <option value='BELEZA'
                                            <?php if(isset($_POST['que14'])) echo selected( 'BELEZA', $_POST['que14']); ?>
                                        >Beleza</option>
                                        <option value='COMÉRCIO'
                                            <?php if(isset($_POST['que14'])) echo selected( 'COMÉRCIO', $_POST['que14']); ?>
                                        >Comércio</option>
                                        <option value='CONSERVAÇÃO/ZELADORIA'
                                            <?php if(isset($_POST['que14'])) echo selected( 'CONSERVAÇÃO/ZELADORIA', $_POST['que14']); ?>
                                        >Conservação/Zeladoria</option>
                                        <option value='COMUNICAÇÃO/EVENTOS/ATENDIMENTO'
                                            <?php if(isset($_POST['que14'])) echo selected( 'COMUNICAÇÃO/EVENTOS/ATENDIMENTO', $_POST['que14']); ?>
                                        >Comunicação/Eventos/Atendimento ao Público</option>
                                        <option value='EDUCACIONAL'
                                            <?php if(isset($_POST['que14'])) echo selected( 'EDUCACIONAL', $_POST['que14']); ?>
                                        >Educacional</option>
                                        <option value='IDIOMAS'
                                            <?php if(isset($_POST['que14'])) echo selected( 'IDIOMAS', $_POST['que14']); ?>
                                        >Idiomas</option>
                                        <option value='INDÚSTRIA'
                                            <?php if(isset($_POST['que14'])) echo selected( 'INDÚSTRIA', $_POST['que14']); ?>
                                        >Indústria</option>
                                        <option value='INFORMÁTICA'
                                            <?php if(isset($_POST['que14'])) echo selected( 'INFORMÁTICA', $_POST['que14']); ?>
                                        >Informática</option>
                                        <option value='LAZER/ESPORTES'
                                            <?php if(isset($_POST['que14'])) echo selected( 'LAZER/ESPORTES', $_POST['que14']); ?>
                                        >Lazer/Esportes</option>
                                        <option value='MODA'
                                            <?php if(isset($_POST['que14'])) echo selected( 'MODA', $_POST['que14']); ?>
                                        >Moda</option>
                                        <option value='SEGURANÇA'
                                            <?php if(isset($_POST['que14'])) echo selected( 'SEGURANÇA', $_POST['que14']); ?>
                                        >Segurança</option>
                                        <option value='SOCIAL'
                                            <?php if(isset($_POST['que14'])) echo selected( 'SOCIAL', $_POST['que14']); ?>
                                        >Social</option>
                                        <option value='NAO SE INTERESSA'
                                            <?php if(isset($_POST['que14'])) echo selected( 'NAO SE INTERESSA', $_POST['que14']); ?>
                                        >Não tenho interesse em nenhuma área.</option>
                                        <option value='OUTRO'
                                            <?php if(isset($_POST['que14'])) echo selected( 'OUTRO', $_POST['que14']); ?>
                                        >Outro</option>

                                    </select>
                                </div>
                                <div id="box-quali" style="display: none"></div>


                            </div>
                        </div>
                        <hr>





                        <div class="row">

                            <div class="col-lg-12 text-center">

                                <br><br><label>Clique no botão abaixo para finalizar a inscrição!</label>

                            </div>

                            <hr>


                            <div class="col-lg-10 text-center col-lg-offset-1" >

                                <br><button type="submit" class="btn btn-default" >Concluir</button><br>

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
</form>





