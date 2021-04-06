# Sistema de Empréstimo de Datashows - CAE - IFMA
Sistema para auxiliar o CAE do IFMA no processo de emprestimo e devolução de datashow

# Requisitos do Sistema
## O Sistema deverá conter:

- A base de dados deve criptografar a senha do usuário.
- A interface deve ser web/mobile.
- Os funcionários do CAE irão cadastrar, editar, remover equipamentos.
- Os professores e alunos serão cadastrados no sistema pelo CAE.
- Os usuarios poderão visualizar/editar/cancelar as solicitações e reservas programadas.
- Deve incorporar um recurso de envio de e-mails aos participantes:
  - Lembrete de devolução de equipamentos;
- Devem existir 3 níveis de usuários: funcionarios, chefe do setor e administrador
- O sistema deve visualizar os emprestimos realizados com datas de devoluções virgentes e vencidas.
- O sistema deve possibilitar alocar um equipamento a um professor cadastrado

# Roles e Permissions
### Funcionário
- CRUD alunos/professores
- CRUD equipamentos;
- Execução do processo de empréstimos

### Chefe do Setor
- Permissoes de funcionários;
- Visualização de um relatório de uso

### Administrador
- Qualquer coisa


# Processos
## Descricao do Processo de Emprestimo
- O professor se dirige ao CAE e solicita um equipamento.
- O funcionario do CAE escolhe um equipamento e marca ele como emprestado informando o para quem foi emprestado (professor cadastrado).
- O sistema calcula quando o equipamento deve ser devolvido e mostra para o funcionário.
- O funcionario entrega o equipamento para o professor e informa a quando deve ser devolvido.

## Descricao do Processo de Devolução
- O professor se dirige ao CAE portando o equipamento que deseja devolver e o entraga a um funcionario.
- O funcionario recebe o equipamento, verifica o identificador e atualiza o status do equipamento no sistema para devolvido.

## Descricao do Processo de Monitoramento de Emprestimo
- O sitema deve monitoriar os equipamento emprestado.
- O sistema deve notificar por email os professores que estão com devolução atrazada.

# Entidades do Sistema
- User
- Role
- Permission
- Professor
- Aluno
- Equipamento
- Emprestimo (relacionamento entre professor e equipamento)

# Ferramentas de Desenvolvimento
- Framework: [Laravel 8](https://laravel.com/docs/8.x)
- Bibliotecas
  - [Jetsteam](https://jetstream.laravel.com/2.x/introduction.html)
  - [Livewire](https://laravel-livewire.com/)
  - [Laravel Sail](https://laravel.com/docs/8.x/sail)
  - [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
  - [Tucker-Eric/EloquentFilter](https://github.com/Tucker-Eric/EloquentFilter)
  - [GrafiteInc/Forms](https://github.com/GrafiteInc/Forms)
- Bibliotecas Dev
  - [nascent-africa/jetstrap](https://github.com/nascent-africa/jetstrap)
  - [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)
  - [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar)
- Template: [AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE)
- Containerização: [Docker](https://www.docker.com/)
- Banco de Dados: [mysql](https://www.mysql.com/)
