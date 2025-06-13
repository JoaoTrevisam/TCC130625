<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <title>ÁREA DE CADASTRO DE FICHA</title>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include("../Classe/Conexao.php") ?>

    <?php include("../Navbar/navbar.php"); ?>

    <div class="container">
        <?php $nome_aulas = Db::conexao()->query("SELECT * FROM `criar_aula` ORDER BY `nome_aula` ASC")->fetchAll(PDO::FETCH_OBJ);?>
        <?php $alunos = Db::conexao()->query("SELECT * FROM `aluno` ORDER BY `nome` ASC")->fetchAll(PDO::FETCH_OBJ);?>
        <?php $exercicios = Db::conexao()->query("SELECT * FROM `exercicio` ORDER BY `nome` ASC")->fetchAll(PDO::FETCH_OBJ);?>
        <?php $fichas = Db::conexao()->query("SELECT `ficha`.*, `aluno`.`nome` AS aluno_nome FROM `ficha` INNER JOIN `aluno` ON `aluno`.`id` = `ficha`.`aluno_id`")->fetchAll(PDO::FETCH_OBJ); ?>

        <br>
        <div class="text-end conteudo-esconder-pdf">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cadastrar">
            CADASTRAR <i class="bi bi-people"></i>
        </button>
        </div>   
        <br>
        
        <div class="col-12 text-end conteudo-esconder-pdf">
            <div class="d-inline">
                <button class="btn btn-danger botao-gerar-pdf">
                    <i class="bi bi-file-earmark-pdf"></i> GERAR PDF
                </button>
            </div>
        </div>

        <table class="table table-striped table-hover mt-3 text-center table-bordered">
            <thead>
                <tr>
                    <th style="width: 80px;">NOME DA AULA</th>
                    <th style="width: 110px;">ALUNOS</th>
                    <th style="width: 90px;">DIA DA AULA</th>
                    <th style="width: 20px;">HORÁRIO DA AULA</th>
                    <th style="width: 100px;">PROFESSOR</th>
                    <th style="width: 100px;">AJUSTES</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($fichas as $ficha) { ?>
                    <?php $exerciciosFicha = Db::conexao()->query("SELECT `exercicio`.`nome` AS exercicio_nome FROM `ficha_exercicio` INNER JOIN `exercicio` ON `exercicio`.`id` = `ficha_exercicio`.`exercicio_id` WHERE `ficha_exercicio`.`ficha_id` = {$ficha->id} ORDER BY `exercicio`.`nome` ASC")->fetchAll(PDO::FETCH_OBJ);?>
                    <tr>
                        <td><?php echo $ficha->aluno_nome; ?></td>
                        <td><?php echo $ficha->nome; ?></td>
                        <td><?php echo $ficha->dia_treino; ?></td>
                        <td>
                            <ol>
                                <?php foreach ($exerciciosFicha as $exercicioFicha) { ?>
                                    <li><?php echo $exercicioFicha->exercicio_nome; ?></li>
                                <?php } ?>
                            </ol>
                        </td>
                        <td><?php echo $ficha->professor ?? ''; ?></td>
                        <td class="conteudo-esconder-pdf">
                            <button 
                                class="conteudo-esconder-pdf btn btn-primary btn-sm p-0 ps-2 pe-2 botao-selecionar-ficha"
                                data-id="<?php echo $ficha->id; ?>"
                                data-nome="<?php echo $ficha->nome; ?>"
                                data-dia_treino="<?php echo $ficha->dia_treino; ?>"
                                data-horario_aula="<?php echo $ficha->horario_aula ?? ''; ?>"
                                data-professor="<?php echo $ficha->professor ?? ''; ?>"
                                >
                                EDITAR
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <form method="POST" id="formulario-cadastrar-ficha">
            <div class="modal fade" id="cadastrar" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">MATRICULA PARA AULA</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label>AULA</label>
                                    <select name="aula_id" class="form-control" required>
                                        <option value="">SELECIONE...</option>
                                        <?php foreach($nome_aulas as $nome_aula) { ?>
                                            <option value="<?php echo $nome_aula->id; ?>"><?php echo $nome_aula->nome_aula; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>          
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label>ALUNO</label>
                                    <div class="input-group">
                                        <select name="aluno_id" class="form-control" required>
                                            <option value="">SELECIONE...</option>
                                            <?php foreach($alunos as $aluno) { ?>
                                                <option value="<?php echo $aluno->id; ?>"><?php echo $aluno->nome; ?></option>
                                            <?php } ?>
                                        </select>
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary botao-cadastro-ficha-lista-exercicios">ADICIONAR EXERCÍCIO</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="dia_treino">DIA DA AULA</label>
                                    <select class="form-control" name="dia_treino" id="dia_treino" required>
                                        <option value="">SELECIONE...</option>
                                        <option value="SEGUNDA">Segunda</option>
                                        <option value="TERCA">Terça</option>
                                        <option value="QUARTA">Quarta</option>
                                        <option value="QUINTA">Quinta</option>
                                        <option value="SEXTA">Sexta</option>
                                        <option value="SABADO">Sábado</option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="horario_aula">HORÁRIO DA AULA</label>
                                    <input type="time" class="form-control" name="horario_aula" id="horario_aula" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="professor">PROFESSOR</label>
                                    <input type="text" class="form-control" name="professor" id="professor" placeholder="Nome do professor" required>
                                </div>
                            </div>

                            <div class="row mt-2 bg-light pt-2 pb-2">
                                <div class="col-md-12">
                                    <table class="table table-sm table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>EXERCÍCIO</th>
                                                <th>Nº SÉRIES</th>
                                                <th>Nº REPETIÇÕES</th>
                                                <th>TEMPO DESCANSO</th>
                                            </tr>
                                        </thead>
                                        <tbody id="cadastro-ficha-lista-exercicios"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FECHAR</button>
                            <button type="submit" class="btn btn-success submit">CADASTRAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form method="POST" id="formulario-editar-ficha">
            <input type="hidden" name="id">
            <div class="modal fade" id="editar" data-bs-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">FICHA DE TREINO</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">            
                                <div class="col-md-6">
                                    <label>NOME DA FICHA</label>
                                    <input type="text" name="nome" class="form-control" required>
                                </div>
            
                                <div class="col-md-6">
                                    <label>DIA DO TREINO</label>
                                    <select class="form-control" name="dia_treino" required>
                                        <option value="">SELECIONE...</option>
                                        <option value="SEGUNDA">Segunda</option>
                                        <option value="TERCA">Terça</option>
                                        <option value="QUARTA">Quarta</option>
                                        <option value="QUINTA">Quinta</option>
                                        <option value="SEXTA">Sexta</option>
                                        <option value="SABADO">Sábado</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-2 bg-light pt-2 pb-2">
                                <div class="col-md-12">
                                    <label>EXERCÍCIO</label>
                                    <select name="exercicio_id" class="form-control">
                                        <option data-nome="" value="">SELECIONE...</option>
                                        <?php foreach($exercicios as $exercicio) { ?>
                                            <option data-nome="<?php echo $exercicio->nome; ?>" value="<?php echo $exercicio->id ?>"><?php echo $exercicio->nome; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
            
                                <div class="col-md-6">
                                    <label>Nº SÉRIES</label>
                                    <input type="number" name="num_series" class="form-control">
                                </div>
            
                                <div class="col-md-6">
                                    <label>Nº REPETIÇÕES</label>
                                    <input type="number" name="num_repeticoes" class="form-control">
                                </div>
            
                                <div class="col-md-12">
                                    <label>TEMPO DESCANSO</label>
                                    <div class="input-group">
                                        <input type="number" name="tempo_descanso" class="form-control">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-primary botao-editar-ficha-lista-exercicios">ADICIONAR EXERCÍCIO</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <table class="table table-sm table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>EXERCÍCIO</th>
                                                <th>Nº SÉRIES</th>
                                                <th>Nº REPETIÇÕES</th>
                                                <th>TEMPO DESCANSO</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="editar-ficha-lista-exercicios"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FECHAR</button>
                            <button type="submit" class="btn btn-success">EDITAR</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="app.js"></script>

<script>
$(document).ready(function() {
    // Botão CADASTRAR abre modal já feito pelo data-bs-toggle/data-bs-target

    // Botão GERAR PDF - mantenha sua funcionalidade original
    $('.botao-gerar-pdf').click(function() {
        // Implemente a funcionalidade desejada de gerar PDF aqui
        alert('Gerar PDF acionado!');
    });

    // Botão EDITAR - Preenche o modal de edição com dados da linha clicada
    $('.botao-selecionar-ficha').click(function() {
        const id = $(this).data('id');
        const nome = $(this).data('nome');
        const dia_treino = $(this).data('dia_treino');
        const horario_aula = $(this).data('horario_aula');
        const professor = $(this).data('professor');

        // Preencher o formulário editar com os dados
        const modal = $('#editar');
        modal.find('input[name="id"]').val(id);
        modal.find('input[name="nome"]').val(nome);
        modal.find('select[name="dia_treino"]').val(dia_treino);
        // Abrir o modal de edição
        modal.modal('show');
    });

    // Botões ADICIONAR EXERCÍCIO - mantenha sua funcionalidade original
    $('.botao-cadastro-ficha-lista-exercicios').click(function() {
        // Script para adicionar exercício na lista no form de cadastro
        alert('Adicionar exercício no cadastro acionado!');
    });

    $('.botao-editar-ficha-lista-exercicios').click(function() {
        // Script para adicionar exercício na lista no form de edição
        alert('Adicionar exercício na edição acionado!');
    });
});
</script>

</body>
</html>

