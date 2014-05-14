

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


$(document).ready( function(){
	
	
	carrega_modulos();

	//$.watermark.options.className = 'field_watermark';
		
	$("#cadastrados").hide();
	$("#logados").show();

	
	//------------ LISTENERS ---------------
	
	$("#btn_logados").click(function(e){
		$("#cadastrados").hide();
		$("#logados").fadeIn(200);
	});
	
	$("#btn_cadastrados").click(function(e){
		$("#logados").hide();
		$("#cadastrados").fadeIn(200);

	});
	
	
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