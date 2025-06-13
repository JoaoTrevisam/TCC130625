<?php include("../Classe/Conexao.php") ?>

<?php

// Dados de exemplo para o gráfico de barras de matrículas
$labelsBar = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'];

$dataBar = [];
for ($i = 1; $i <= 12 ; $i++) { 
    $mes = $i;
    if($i <= 9){
      $mes = "0$mes";
    }
    $dataInicial = "2025-$mes-01";
    $dataFinal = "2025-$mes-31";

     $alunos = Db::conexao()->query("SELECT COUNT(*) AS TOTAL FROM `aluno` WHERE `data_matricula` BETWEEN '$dataInicial' AND '$dataFinal' LIMIT 1")->fetch(PDO::FETCH_OBJ);
     
     $total = 0;
     
     if($alunos){
       if($alunos->TOTAL){
         $total = $alunos->TOTAL;
        }
      }
      
      $dataBar[] = $total;
    }
    
    // Dados de exemplo para o gráfico de pizza
  $alunosAtivos = Db::conexao()->query("SELECT COUNT(*) AS TOTAL FROM `aluno` WHERE `ativo` = 1 LIMIT 1")->fetch(PDO::FETCH_OBJ);
  $alunosInativos = Db::conexao()->query("SELECT COUNT(*) AS TOTAL FROM `aluno` WHERE `ativo` = 0 LIMIT 1")->fetch(PDO::FETCH_OBJ);
$labelsPie = ['ATIVOS', 'INATIVOS'];
$dataPie = [$alunosAtivos->TOTAL, $alunosInativos->TOTAL]; // Exemplo de porcentagens
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gráficos</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <style>
    body {
      background: #f4f6f9;
      padding: 20px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    .card-body {
      height: 250px;
    }
    .btn-tool {
      background: transparent;
      border: none;
      color: #6c757d;
      font-size: 1.1rem;
      cursor: pointer;
      outline: none;
    }
    .btn-tool:hover {
      color: #343a40;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row">
    <!-- Gráfico de Matrículas -->
    <div class="col-md-6">
      <div class="card card-primary card-outline">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title mb-0">
            Gráfico de Matrículas
          </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" id="btn-collapse-bar" aria-label="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="bar-chart"></canvas>
        </div>
      </div>
    </div>

    <!-- Gráfico de Pizza -->
    <div class="col-md-6">
      <div class="card card-primary card-outline">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h3 class="card-title mb-0">
            Gráfico de Alunos Ativos e Inativos
          </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" id="btn-collapse-pie" aria-label="Collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <canvas id="pie-chart"></canvas>
        </div>
      </div>
    </div>
  </div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const btnCollapseBar = document.getElementById('btn-collapse-bar');
const cardBodyBar = btnCollapseBar.closest('.card').querySelector('.card-body');

btnCollapseBar.addEventListener('click', () => {
  cardBodyBar.style.display = cardBodyBar.style.display === 'none' ? 'block' : 'none';
  btnCollapseBar.innerHTML = cardBodyBar.style.display === 'none' ? '<i class="fas fa-plus"></i>' : '<i class="fas fa-minus"></i>';
});

const labelsBar = <?php echo json_encode($labelsBar); ?>;
const dataBar = <?php echo json_encode($dataBar); ?>;

const ctxBar = document.getElementById('bar-chart').getContext('2d');
const barChart = new Chart(ctxBar, {
    type: 'bar',
    data: {
        labels: labelsBar,
        datasets: [{
            label: 'Quantidade',
            backgroundColor: '#ff8c00',
            borderColor: 'rgb(0, 0, 0)',
            borderWidth: 1,
            data: dataBar,
            barThickness: 85,
            maxBarThickness: 18
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true,
                min: 0,
                max: 30,
                ticks: {
                    stepSize: 1
                }
            }
        },
        datasets: {
            bar: {
                barPercentage: 0.5,
                categoryPercentage: 0.6
            }
        }
    }
});


// Configuração do botão de colapsar para o gráfico de pizza
const btnCollapsePie = document.getElementById('btn-collapse-pie');
const cardBodyPie = btnCollapsePie.closest('.card').querySelector('.card-body');

btnCollapsePie.addEventListener('click', () => {
  cardBodyPie.style.display = cardBodyPie.style.display === 'none' ? 'block' : 'none';
  btnCollapsePie.innerHTML = cardBodyPie.style.display === 'none' ? '<i class="fas fa-plus"></i>' : '<i class="fas fa-minus"></i>';
});

const labelsPie = <?php echo json_encode($labelsPie); ?>;
const dataPie = <?php echo json_encode($dataPie); ?>;

const ctxPie = document.getElementById('pie-chart').getContext('2d');
const pieChart = new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: labelsPie,
        datasets: [{
            label: 'Distribuição',
            backgroundColor: ['#198754', '#dc3545'],
            borderColor: 'rgb(0, 0, 0)',
            borderWidth: 1,
            data: dataPie
        }]
    },
    options: { responsive: true, maintainAspectRatio: false }
});
</script>

</body>
</html>
