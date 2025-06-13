<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://kit.fontawesome.com/af6fbadd15.js" crossorigin="anonymous"></script>
    <title>Área de cadastro de aula </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include("../Classe/Conexao.php") ?>

<?php include("../Navbar/navbar.php"); ?>

<?php
// Consulta para obter os professores cadastrados
$queryProfessores = Db::conexao()->query("SELECT id, nome FROM funcionario ORDER BY nome");
$professores = $queryProfessores->fetchAll(PDO::FETCH_ASSOC);
?>


<section class="p-3">
    <h3>CADASTRO DE AULA</h3>

    <div class="text-end mb-2 conteudo-esconder-pdf">
        <button class="btn btn-success newUser " data-bs-toggle="modal" data-bs-target="#userForm">
            CADASTRO PARA AULA <i class="bi bi-people"></i>
        </button>
    </div>

    <form method="get" class="mb-2 conteudo-esconder-pdf">
        <div class="row">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Buscar por nome...">
                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                </div>
            </div>
        </div>
    </form>

    <div class="col-12 text-end conteudo-esconder-pdf">
        <div class="d-inline">
            <button class="btn btn-danger botao-gerar-pdf">
                <i class="bi bi-file-earmark-pdf"></i> GERAR PDF
            </button>
        </div>
        <div class="d-inline">
            <div class="dropdown d-inline">
                <button class="btn btn-warning dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">ORDENAR</button>
                <ul class="dropdown-menu filtro-opcoes" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="?ordenar=DESC">AULAS ATIVAS</a></li>
                    <li><a class="dropdown-item" href="?ordenar=ASC">AULAS INATIVAS</a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<style>
    .short-input {
        width: 800px !important;  /* Ajusta a largura da barra de busca */
        max-width: 100%;  /* Garante que não ultrapasse o limite da tela */
    }

    .input-group {
        max-width: 545px;  /* Limita a largura máxima do input-group */
    }

    .search-input {
        max-width: 545px;  /* Garante que o campo de busca ocupe toda a largura disponível */
    }
</style>

<section>
    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover mt-3 text-center table-bordered">
                <thead>
                    <tr>
                        <th>NOME DA AULA</th>
                        <th>DIA DA AULA</th>
                        <th>HORARIO DA AULA</th>
                        <th>PROFESSOR</th>
                        <th>AJUSTES</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Consulta diretamente a tabela criar_aula
                    $queryAulas = Db::conexao()->query("SELECT * FROM criar_aula ORDER BY nome_aula");
                    $aulas = $queryAulas->fetchAll(PDO::FETCH_ASSOC);

                    if (!empty($aulas)) {
                        foreach ($aulas as $aula) {
                            echo "<tr>";
                            echo "<td>{$aula['nome_aula']}</td>";
                            
                            // Formatando o dia da aula para exibição mais amigável
                            $diaFormatado = ucfirst($aula['dia_aula']); // Primeira letra maiúscula
                            $diaFormatado = str_replace(
                                ['Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                                ['Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
                                $diaFormatado
                            );
                            echo "<td>{$diaFormatado}</td>";
                            
                            // Formatando o horário (se necessário)
                            $horarioFormatado = date('H:i', strtotime($aula['horario_aula']));
                            echo "<td>{$horarioFormatado}</td>";
                            
                            echo "<td>{$aula['professor_aula']}</td>";
                            echo "<td>
                                <button 
                                    class='btn btn-primary btn-sm editar-btn'
                                    data-id='{$aula['id']}'
                                    data-nome='{$aula['nome_aula']}'
                                    data-dia='{$aula['dia_aula']}'
                                    data-horario='{$horarioFormatado}'
                                    data-professor='{$aula['professor_aula']}'
                                    data-bs-toggle='modal' 
                                    data-bs-target='#editar'>
                                    Editar
                                </button>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Nenhuma aula cadastrada ainda</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

    </div>
</section>

<!-- CADASTRO -->
<div class="modal fade" id="userForm">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form method="POST" id="formulario-cadastrar" action="cadastrar.php">
                <div class="modal-header">
                    <h4 class="modal-title">Cadastro de Aula</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="inputField">
                        <div class="mb-3">
                            <label class="form-label">Nome da Aula:</label>
                            <input type="text" name="nome_aula" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dia da Semana:</label>
                            <select name="dia_aula" class="form-select" required>
                                <option disabled selected>Selecione</option>
                                <option value="segunda">Segunda-feira</option>
                                <option value="terca">Terça-feira</option>
                                <option value="quarta">Quarta-feira</option>
                                <option value="quinta">Quinta-feira</option>
                                <option value="sexta">Sexta-feira</option>
                                <option value="sabado">Sábado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Horário da Aula:</label>
                            <input type="time" name="horario_aula" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Professor:</label>
                            <select name="professor_aula" class="form-select" required>
                                <option disabled selected>Selecione o professor</option>
                                <?php foreach($professores as $professor ): ?>
                                    <option value="<?= $professor['nome'] ?>"><?= $professor['nome'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- EDITAR -->
<form method="POST" id="formulario-editar" action="editar.php">
    <input type="hidden" name="id" id="editar-id">
    <div class="modal fade" id="editar" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Aula</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="inputField">
                        <div class="mb-3">
                            <label class="form-label">Nome da Aula:</label>
                            <input type="text" name="nome_aula" id="editar-nome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Dia da Semana:</label>
                            <select name="dia_aula" id="editar-dia" class="form-select" required>
                                <option disabled selected>Selecione</option>
                                <option value="segunda">Segunda-feira</option>
                                <option value="terca">Terça-feira</option>
                                <option value="quarta">Quarta-feira</option>
                                <option value="quinta">Quinta-feira</option>
                                <option value="sexta">Sexta-feira</option>
                                <option value="sabado">Sábado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Horário da Aula:</label>
                            <input type="time" name="horario_aula" id="editar-horario" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Professor:</label>
                            <select name="professor_aula" class="form-select" required>
                                <option disabled selected>Selecione o professor</option>
                                <?php foreach($professores as $professor ): ?>
                                    <option value="<?= $professor['nome'] ?>"><?= $professor['nome'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</form>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="app.js"></script>
</body>
</html>
