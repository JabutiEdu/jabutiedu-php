
<?php 

include_once 'header.php'; 
include_once 'include/database.php';
include_once 'include/sessao.php';

?>


<script type="text/javascript" src="cadastro.js"></script>

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
				 <h3>Cadastro de novo usuário.</h3>
	 </div>
</div>


<div id="corpo">

	<p> Utilize este formulário para realizar o seu cadastro no sistema. O professor irá assignar um nível de trabalho. 
	
	</p>
        
    <form action="services/cadastro_incluir.php">
    	<table>
			<tr>
					<td>Nome: </td>
					<td><input type="text" size="30" name="nome" id="nome"/></td>
			</tr>    	

			<tr>
					<td>Data de nascimento: </td>
					<td><input type="text" size="30" name="data_nascimento" id="data_nascimento"/></td>
			</tr>    	
			
			<tr>
					<td>Email: </td>
					<td> 
							<input type="text" size="30" name="email" id="email"/>
					</td>
			</tr>   
			
			<tr>
					<td>Instituição: </td>
					<td>
							<select name="id_instituicao" id="id_instituicao" onchange="carrega_equipes();">
								<option>Selecione uma instituição...</option>
							</select>
					</td>
			</tr>    	
			
			<tr>
					<td>Equipe: </td>
					<td><select name="equipe" id="id_equipe">
								<option>Selecione um equipe...</option>
								
							</select>
					</td>
			</tr>    	
			
			<tr>
					<td>Digite uma senha: </td>
					<td><input type="password" size="30" name="senha" id="senha"/></td>
			</tr>    	
			
			<tr>
					<td>Repita a senha: </td>
					<td><input type="password" size="30" name="senha_2" id="senha_2"/></td>
			</tr>    	
    	</table>
    	
    	<br>
    	
    	<input class="btn_verde" type="button" value="Salvar cadastro" onclick="salvar_cadastro();"> </td>
		<input class="btn_cinza" type="button" value="Voltar para a tela de login" onclick="volta_inicio();"> </td>
		    	
    	
    	
    </form>



</div>


<?php include_once 'footer.php'; ?>
