//formata de forma generica os campos
function formataCampo(campo, Mascara, evento) {
  var boleanoMascara;

  var Digitato = evento.keyCode;
  exp = /\-|\.|\/|\(|\)| /g;
  campoSoNumeros = campo.value.toString().replace( exp, "" );

  var posicaoCampo = 0;
  var NovoValorCampo="";
  var TamanhoMascara = campoSoNumeros.length;

  if (Digitato != 8) { // backspace
    for(i=0; i<= TamanhoMascara; i++) {
      boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
      || (Mascara.charAt(i) == "/"))
      boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(")
          || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " "))
      if (boleanoMascara) {
        NovoValorCampo += Mascara.charAt(i);
        TamanhoMascara++;
      }else {
        NovoValorCampo += campoSoNumeros.charAt(posicaoCampo);
        posicaoCampo++;
      }
    }
    campo.value = NovoValorCampo;
    return true;
  }else {
    return true;
  }
}

//valida numero inteiro com mascara
function mascaraInteiro(){
  if (event.keyCode < 48 || event.keyCode > 57){
    event.returnValue = false;
    return false;
  }
  return true;
}

//adiciona mascara ao telefone
function MascaraTelefone(tel){
  if(mascaraInteiro(tel)==false){
    event.returnValue = false;
  }
  return formataCampo(tel, '(00) 00000-0000', event);
}

//valida numero int
function MascaraNumeros(num){
  if(mascaraInteiro(num)==false){
    event.returnValue = false;
  }
  return true;
}
//mascara valor em modeda
function MascaraMoeda(valor){
  if(mascaraInteiro(valor)==false){
    event.returnValue = false;
  }
  return formataCampo(valor, '00,00', event);
}


//valida CEP
function ValidaCep(cep){
  exp = /\d{2}\.\d{3}\-\d{3}/
  if(!exp.test(cep.value))
    alert('Numero de Cep Invalido!');
}

//valida numero inteiro
function validaInteiro(){
  if (event.keyCode < 48 || event.keyCode > 57){
    event.returnValue = false;
    alert('Digite apenas valores numéricos!');
  }
  return true;
}


