

var postou = false;

function checkForm(){
	
	
	
	return true;
}


function carrega_equipes(){
	
	var id = $("#instituicao").val();
	
	if( id > 0){

	
		$.ajax({
			async: false,
			type: "POST",
			url: "services/getEquipes.php",
			dataType: "json",
			data: "id_instituicao="+id,
			error: function(e) {alert('ERRO DO SISTEMA: ' + e.responseText); },
			success: function(result) {
				if(result[0]){
					var html = "";
					for(i=0;i<result.length;i++){
						html += '<option value="' + result[i].id_equipe + '">' + result[i].nome + '</option>'; 
					}
					$("#id_equipe").html(html);
					lastResult = result;
				} else {
					var html = "";
					html += '<option value="0">Selecione outra instituição</option>';
					$("#id_equipe").html(html);
					lastResult = result;
					
				}
			},
			error: function(result){
				alert("Erro de comunicação com o servidor. Clique OK para tentar novamente.");
				window.location.href = currentPage + ".php";
			}
		});
		
	}
}



function salvar_cadastro(){
	
	var id = $("#instituicao").val();
	
	if( id > 0){

	
		$.ajax({
			async: false,
			type: "POST",
			url: "services/getEquipes.php",
			dataType: "json",
			data: "id_instituicao="+id,
			error: function(e) {alert('ERRO DO SISTEMA: ' + e.responseText); },
			success: function(result) {
				if(result[0]){
					var html = "";
					for(i=0;i<result.length;i++){
						html += '<option value="' + result[i].id_equipe + '">' + result[i].nome + '</option>'; 
					}
					$("#id_equipe").html(html);
					lastResult = result;
				} else {
					var html = "";
					html += '<option value="0">Selecione outra instituição</option>';
					$("#id_equipe").html(html);
					lastResult = result;
					
				}
			},
			error: function(result){
				alert("Erro de comunicação com o servidor. Clique OK para tentar novamente.");
				window.location.href = currentPage + ".php";
			}
		});
		
	}
}



function volta_inicio(){
	
	window.location= "index.php";
	
}


$(document).ready( function(){

	//$.watermark.options.className = 'field_watermark';
		
	$("#nome").watermark("Informe seu nome", {className: 'field_watermark'});
	$("#data_nascimento").watermark("Informe sua data de nascimento", {className: 'field_watermark'});
	$("#email").watermark("Informe seu email", {className: 'field_watermark'});
	
	$("#login").watermark("usuário", {className: 'field_watermark'});
	$("#senha").watermark("senha", {className: 'field_watermark'});
	$("#senha_2").watermark("confirme a sua senha", {className: 'field_watermark'});
	
	
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