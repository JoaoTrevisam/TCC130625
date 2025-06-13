<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

    <title>FUNCIONÁRIOS</title>
    
</head>
<body>

<?php include("../Classe/Conexao.php") ?>

<?php include("../Navbar/navbar.php"); ?>

<?php $pesquisa = isset($_GET["pesquisa"]) ? $_GET["pesquisa"] : NULL; ?>
<?php $ordenar = isset($_GET["ordenar"]) ? $_GET["ordenar"] : "ASC"; ?>

<section class="p-3">
    
    <h3>FUNCIONÁRIOS</h3>

    <div class="text-end mb-2 conteudo-esconder-pdf">
     <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#cadastrar">
            CADASTRAR <i class="bi bi-people"></i>
        </button>
</div>

<form method="get" class="mb-2 conteudo-esconder-pdf">
    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <input type="hidden" name="ordenar" value="<?php echo $ordenar; ?>">
                <input name="pesquisa" value="<?php echo $pesquisa; ?>" type="text" class="form-control" placeholder="Buscar por nome...">
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
                <li><a class="dropdown-item" href="?pesquisa=<?php echo $pesquisa; ?>&ordenar=DESC">ÚLTIMOS FUNCIONÁRIOS</a></li>
                <li><a class="dropdown-item" href="?pesquisa=<?php echo $pesquisa; ?>&ordenar=ASC">PRIMEIROS FUNCIONÁRIOS</a></li>
            </ul>
        </div>
    </div>
</div>
    <table class="table table-striped table-hover mt-3 text-center table-bordered table-sm">
    <thead>
    <tr>
            <th style="width: 50px;">STATUS</th>
            <th style="width: 150px;">NOME</th>
            <th style="width: 120px;">DATA DE NASCIMENTO</th>
            <th style="width: 40px;">CPF</th>
            <th style="width: 80px;">TELEFONE</th>
            <th style="width: 140px;">ENDEREÇO</th>
            <th style="width: 40px;">TURNO DISPONÍVEL</th>
            <th style="width: 80px;">DATA DE INÍCIO</th>
            <th class="conteudo-esconder-pdf" style="width: 80px;">AJUSTES</th>
        </tr>
    </thead>
    <?php include("../Funcionario/cadastrarSql.php"); ?>
    </table>
        
   

</section>

<!-- CADASTRAR -->
<form method="POST" id="formulario-cadastrar" action="cadastrar.php">
    <div class="modal fade" id="cadastrar" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">CADASTRAR</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Nome Completo:</label>
                            <input type="text" name="nome" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Data Nascimento:</label>
                            <input type="date" name="data_nascimento" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">CPF:</label>
                            <input type="text" name="cpf" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Telefone:</label>
                            <input type="text" name="telefone" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Endereço:</label>
                            <input type="text" name="endereco" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Turno Disponível:</label>
                            <select name="turno" class="form-select" required>
                                <option disabled selected>Selecione</option>    
                                <option value="Manhã">Manhã</option>
                                <option value="Tarde">Tarde</option>
                                <option value="Noite">Noite</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Data de Início:</label>
                            <input type="date" name="data_matricula" required class="form-control">
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

<!-- EDITAR -->
<form method="POST" id="formulario-editar" action="editar.php">
    <input type="hidden" name="id" class="form-control">
    <div class="modal fade" id="editar" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">EDITAR</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label>Nome Completo:</label>
                            <input type="text" name="nome" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Data Nascimento:</label>
                            <input type="date" name="data_nascimento" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>CPF:</label>
                            <input type="text" name="cpf" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Telefone:</label>
                            <input type="text" name="telefone" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Endereço:</label>
                            <input type="text" name="endereco" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Turno Disponível:</label>
                            <select name="turno_disponivel" class="form-control" required>
                                <option value="Manhã">Manhã</option>
                                <option value="Tarde">Tarde</option>
                                <option value="Noite">Noite</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Data de Início:</label>
                            <input type="date" name="data_matricula" required class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Status:</label>
                            <select name="ativo" class="form-control" required>
                                <option value="1">ATIVO</option>
                                <option value="0">INATIVO</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">FECHAR</button>
                    <button type="submit" class="btn btn-success submit">SALVAR</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="app.js"></script>
</body>
</html>
