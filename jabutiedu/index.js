

var postou = false;

function checkForm(){
	
	
	
	return true;
}



$(document).ready( function(){

	//$.watermark.options.className = 'field_watermark';
		
	$("#login").watermark("usuário", {className: 'field_watermark'});
	$("#senha").watermark("senha", {className: 'field_watermark'});

	carrega_modulos();
	
	$("#btn_acessa").click(function(e){
		
		if( checkForm() ){
		
			if( !postou ){
				
				postou = true;
				
				$.ajax({
					async: true,
					type: "POST",
					url: "services/login.php",
					dataType: "json",
					data: $('#login_form').serialize(),
					error: function(result) {
						alert('ERRO DO SISTEMA: ' + e.responseText);
						postou = false;	
					},
					success: function(result) {
						
						if( parseInt( result[0].result ) == 1 ){
						
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
