
<?php 

include_once 'header.php'; 
include_once 'include/database.php';
include_once 'include/sessao.php';

sess_start();
checa_sessao_usuario_logado();

$nome_pessoa = $SES_VAR['nome_pessoa'];


?>


<script type="text/javascript" src="modulo1.js"></script>

<script type="text/javascript">
<!--
//-->
</script>


<style>


	
</style>

<div id="cabecalho">
		<div style="float:left; margin-right: 20px"> <img src="imagens/logo_laboti_cabecalho.png"> </div>	
		<div style="float:left; text-align: left;">
				 <h2>Projeto Jabuti Edu</h2> 
				 Versão 1.0 
	    </div>
	 
	 	        <div style="float:right; text-align: right: ;">
	 				
	 				<!-- 
	 					<img class="top_right_button" src="imagens/configuration.png">
	 				 -->
	 				 
	 				<img class="top_right_button" src="imagens/power-button.png" id="btn_logout">  
	        </div>
	        
	 		<div style="float:right; text-align: right: ;">
	 				<span>Bem vindo <?=$nome_pessoa?></span>
	 				<select id="id_modulo"></select>
	        </div>
	        

	 
</div>

<style>


#corpo {

	width: 100%;


}


.btn {
	cursor: pointer;
	padding: 6px;
	
}

#painel_esquerdo {

	border: 1px dotted #cccccc;
	
	float:left;
	width: 50%;
	height: 400px;

}

#pe_esquerdo {
	border: 1px dotted #cccccc;
	text-align: right;
	float:left;
	width: 33%;
	height: 100%;
}

#pe_centro {
	border: 1px dotted #cccccc;
	
	height: 100%;
	text-align: center;
	float: left;
	width: 33%;
	height: 100%;
}

#grau_giro {
	width: 100px;
	margin-top: 30px;
	font-size: 14pt;

}

#pe_direito {
	border: 1px dotted #cccccc;
	
	text-align: left;
		float:right;
	width: 33%;
	height: 100%;
}


/*   ---------------------------  */

#painel_direito {
	
	border: 1px dotted #cccccc;
	
	float:right;
	width: 49%;
	height: 400px;

}

#pd_cima {
	border: 1px dotted #cccccc;
	
	height: 33%;
	text-align: center;
	height: 33%;
}

#pd_centro {
	border: 1px dotted #cccccc;
	
	text-align: center;
	width: 100%;
	height: 30%;
}

#quanto_andar {
	width: 100px;
	margin-top: 30px;
	height: 33%;
		font-size: 14pt;
	
}

#pd_baixo {
	border: 1px dotted #cccccc;

	text-align: center;
	height: 33%;
}
	
</style>


<div id="corpo">

	<div id="painel_esquerdo">
	
		<div>	
			<div id="pe_esquerdo">
				<img class="btn" id="btn_seta_esquerda" src="imagens/seta_esquerda.png">
			</div>
		
			<div id="pe_centro">
				<select id="grau_giro">
						<option value="10">10º</option>
						<option value="27">45º</option>
						<option value="54">90º</option>
						<option value="108">180º</option>
						<option value="225">360º</option>
						
				</select>
			</div>
		
			<div id="pe_direito">
				<img class="btn" id="btn_seta_direita" src="imagens/seta_direita.png">
			</div>
		</div>
		
		<div style="clear: both;"></div>
		
		<div style="text-align: center;">
			<img  class="btn" id="btn_buzina" src="imagens/botao_buzina.png">
			<img  class="btn" id="btn_le" src="imagens/botao_le.png">
			<img  class="btn" id="btn_ld" src="imagens/botao_ld.png">
		</div>
	
		<div style="text-align: center; width: 100%; height: 64px;">
			<div style="float: right;"><img class="btn" src="imagens/speaker.png" width="86" height="66" id="btn_fala"></div>
			<div style="float: right; margin-top: 24px;"><input type="text" value="" id="texto_fala" name="texto_fala" style="font-size: 14pt"></div>
			   

		</div>
	
	</div>

	
	<div id="painel_direito">
		<div id="pd_cima">
			<img class="btn" id="btn_seta_frente" src="imagens/seta_frente.png">
		</div>
	
		<div id="pd_centro">
			<select id="quanto_andar">
				<option value="1">1 passo</option>
				<option value="2">2 passos</option>
				<option value="3">3 passos</option>
				<option value="4">4 passos</option>
				<option value="5">5 passos</option>
			</select>
		</div>
	
		<div id="pd_baixo">
			<img class="btn" id="btn_seta_tras" src="imagens/seta_tras.png">
		</div>
	
	</div>
	
</div>


<?php include_once 'footer.php'; ?>
