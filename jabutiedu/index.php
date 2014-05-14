<?php 
	include_once 'header.php'; 
	include_once 'include/sessao.php';

	sess_start();

	$logout = getFieldFromPage("logout");
	if( $logout != "")
		sess_reset();

?>


<script type="text/javascript" src="index.js"></script>

<div>

	<div class="login-painel">
	
		<div style="width: 100%; height: 120px;">
		</div>

		<div style="width: 100%; height: 100px; text-align: center">
			<p class="main-logo">Jabuti Edu</p>
			<p style="padding:0; margin:0;">Versão 1.0</p>
		</div>
			
		
		<div style="width: 100%; height: 90px; text-align: center" >
			<form id="login_form">
					<div style="margin:10px;">
						<input class="login_field" type="text" name="login" id="login" size="20" maxlength="20" value="">
					</div>	

					<div style="margin:10px;">
						<input class="login_field" type="password" name="senha" id="senha" size="20" maxlength="20">
					</div>

					<div style="margin:10px;">
						<select class="modulo_login_field" name="id_modulo" id="id_modulo"></select>
					</div>
					
					<div style="margin:10px;">
						<input class="login_botao" type="button" id="btn_acessa" value="Entrar no sistema"><br>
						<span style="font-size: 7pt;">não é cadastrado? <a href="cadastro.php">cadastrar-se aqui</a></span><br>
					</div>
					

			</form>
		
		</div>

	</div>
	
</div>

<?php include_once 'footer.php'; ?>
