<?php 

include_once 'header.php'; 
include_once 'include/database.php';
include_once 'include/sessao.php';

sess_start();
checa_sessao_usuario_logado();
$nome_pessoa = $SES_VAR['nome_pessoa'];

//Desvia o tipo de usuario 3=usuario normal para a tela que representa o modulo que ele escolheu para trabalhar
if( $SES_VAR['id_pessoa_tipo'] == 3 ) {
	header('Location: modulo'.$SES_VAR['id_modulo'].'.php');
}

?>

<script type="text/javascript" src="principal.js"></script>

<div id="cabecalho">
	
	<div style="float: left; margin-right: 20px">
		<img src="imagens/logo_laboti_cabecalho.png">
	</div>
	
	<div style="float: left; text-align: left;">
		<h2>Projeto Jabuti Edu</h2>
		Versão 1.0
	</div>

	<div style="float: right; text-align: right:;">
		<img class="top_right_button" src="imagens/configuration.png"> <img
			class="top_right_button" src="imagens/power-button.png"
			id="btn_logout">
	</div>

	<div style="float: right; text-align: right:;">
		<span>Bem vindo <?=$nome_pessoa?>
		</span> <select id="id_modulo"></select>
	</div>

</div>

<div style="padding:6px; border-bottom: 1px solid #000000; text-align: center">
	<span class="label_button" id="btn_logados" style="margin-right: 30px;">Logados no Sistema</span>
	<span class="label_button" id="btn_cadastrados">Cadastrados</span>
</div>


<div id="corpo">

	<div id="logados">
		<div class="tabela_titulo">Pessoas Logadas no sistema</div>
		<table>
			<tr>
				<th>#</th>
				<th>Pessoa</th>
				<th>Equipe</th>
				<th>Código atual</th>
				<th>Estado</th>
				<th>Operações</th>
			</tr>
		</table>
	</div>


	<div id="cadastrados">
		<div class="tabela_titulo">Pessoas Cadastradas no Sistema</div>
		<table>
			<tr>
				<th>#</th>
				<th>Interativo</th>
				<th>Pessoa</th>
				<th>Login</th>
				<th>Instituição</th>
				<th>Equipe</th>
				<th>Data Nasc.</th>
				<th>Email</th>
				<th>Ação</th>	
			</tr>
		</table>
	</div>
</div>

<?php include_once 'footer.php'; ?>
