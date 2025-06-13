$(document).ready(function () {
    $(".botao-selecionar-aula").on("click", function () {
        const id           = $(this).data("id");
        const nomeAluno    = $(this).data("nome_aula");
        const diaSemana    = $(this).data("dia_aula");
        const horarioInicio= $(this).data("horario_aula");
        const professor    = $(this).data("professor_aula");

        // Abre o modal de edição das aulas
        $("#editarAulaModal").modal("show");

        // Preenche os campos do formulário de edição
        $("#formulario-editar input[name='id']").val(id);
        $("#formulario-editar input[name='nome_aluno']").val(nomeAluno);
        $("#formulario-editar select[name='dia_semana']").val(diaSemana);
        $("#formulario-editar input[name='horario_inicio']").val(horarioInicio);
        $("#formulario-editar input[name='professor']").val(professor);
    });

    $(".botao-gerar-pdf").on("click", function () {
        window.print();
    });
});
