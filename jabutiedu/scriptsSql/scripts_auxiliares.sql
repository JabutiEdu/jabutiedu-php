

# 	Interativo 	Pessoa 	Login 	Instituição 	Equipe 	Data Nasc. 	Email 	Ação


select
interativo
id_pessoa,
p.nome,
login,
i.nome,
e.nome,
p.data_nascimento,
p.email



from pessoa p
left join equipe e on e.id_equipe=p.id_equipe
left join instituicao i on i.id_instituicao = e.id_instituicao
where p.id_pessoa_tipo > 1
