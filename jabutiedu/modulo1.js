

var postou = false;

function checkForm(){
	
	
	
	return true;
}


function carrega_modulos(){
	
	$.ajax({
		async: false,
		type: "POST",
		url: "services/getModulos.php",
		dataType: "json",
		data: "timestamp=0",
		error: function(e) {alert('ERRO DO SISTEMA: ' + e.responseText); },
		success: function(result) {
			if(result[0]){
				var html = "";
				for(i=0;i<result.length;i++){
					html += '<option value="' + result[i].id_modulo + '">' + result[i].descricao + '</option>'; 
				}
				$("#id_modulo").html(html);
				lastResult = result;
			} else {
									
			}
		},
		error: function(result){
			alert("Erro de comunicação com o servidor. Clique OK para tentar novamente.");
			window.location.href = currentPage + ".php";
		}
	});

}

function logout(){
	
	window.location= "index.php?logout=true";
	
}


function executa_instrucao( comando ){
	
	//alert( comando );
	
	$.ajax({
		async: true,
		type: "POST",
		url: "services/piProxy.php",
		dataType: "json",
		data: {"comando":comando },
		error: function(result) {
			alert('ERRO DO SISTEMA: ' + e.responseText);
			postou = false;	
		},
		success: function(result) {
			
			//alert( result );
			postou = false;
		}
	});
	
}


$(document).ready( function(){
	
	
	carrega_modulos();

	$("#texto_fala").watermark("Digite o que a Jabuti deve falar", {className: 'field_watermark'});
	
	
	//------------ LISTENERS TECLADO ----------------
	
/*


    37 - left

    38 - up

    39 - right

    40 - down

*/

	//refazer essa parada
	$(document).keypress(function(e) {
		var keyCode= e.keyCode;
		var charCode= e.charCode;

	  if(keyCode == 37) {
		var giro = $("#grau_giro").val();
		executa_instrucao("pe "+ giro);
	  } else if(keyCode == 38) {
		var quanto = $("#quanto_andar").val();
		executa_instrucao("pf "+ quanto);
	  } else if(keyCode == 39) {
		var giro = $("#grau_giro").val();
		executa_instrucao("pd "+ giro);
	  } else if(keyCode == 40) {
		var quanto = $("#quanto_andar").val();
		executa_instrucao("pt "+ quanto);
	  } else if(charCode == 122) {
		executa_instrucao("le 1");
	  } else if(charCode == 120) {
		executa_instrucao("ld 1");
	  } 
	});
	
	//------------ LISTENERS BOTOES ----------------
	
//	$("#btn_seta_esquerda").click(function(e){
//		var giro = $("#grau_giro").val();
//		executa_instrucao("pe "+ giro);
//	});

	$("#btn_seta_direita").click(function(e){
		var giro = $("#grau_giro").val();
		executa_instrucao("pd "+ giro);
	});
	
	$("#btn_buzina").click(function(e){
		executa_instrucao("bu 1");
	});
	
	$("#btn_le").click(function(e){
		executa_instrucao("le 1");
	});
	
	$("#btn_ld").click(function(e){
		executa_instrucao("ld 1");
	});
	
	$("#btn_seta_frente").click(function(e){
		var quanto = $("#quanto_andar").val();
		executa_instrucao("pf "+ quanto);
		
	});
	
	$("#btn_seta_tras").click(function(e){
		var quanto = $("#quanto_andar").val();
		executa_instrucao("pt "+ quanto);
	});

	$("#btn_seta_tras").click(function(e){
		var quanto = $("#quanto_andar").val();
		executa_instrucao("pt "+ quanto);
	});
	
	
	$("#btn_fala").click(function(e){
		var texto = $("#texto_fala").val();
		executa_instrucao("som "+ texto);
	});

	
	//------------ LISTENERS GERAIS ----------------
	
	
	
	$("#btn_logout").click(function(e){
		if( confirm("Deseja encerrar o sistema e voltar para tela de inicio? ") )
			logout();
	});
	
	
	
	
	$("#btn_acessa").click(function(e){
		
		if( checkForm() ){
		
			if( !postou ){
				
				postou = true;
				
				$.ajax({
					async: false,
					type: "POST",
					url: "services/login.php",
					dataType: "json",
					data: $('#login_form').serialize(),
					error: function(result) {
						alert('ERRO DO SISTEMA: ' + e.responseText);
						postou = false;	
					},
					success: function(result) {
						
						if( result[0].result == 1 ){
							
							//$.cookie('email', $("#email").val() , { expires: 7 });
							
							window.location.href = 'principal.php';	
							
						} else {
							
							alert( result[0].result );
						}
						
						postou = false;
					}
				});
			}
			
		}
		
	});

	
});
