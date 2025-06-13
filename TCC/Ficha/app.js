$(document).ready(function() {
    $(".botao-cadastrar").on("click", function(){
        localStorage.setItem("exercicios", JSON.stringify([]));
    });

    $(".botao-cadastro-ficha-lista-exercicios").on("click", function(){

        let exercicio_id = $("#formulario-cadastrar-ficha select[name='exercicio_id']").val();
        let num_series = $("#formulario-cadastrar-ficha input[name='num_series']").val();
        let num_repeticoes = $("#formulario-cadastrar-ficha input[name='num_repeticoes']").val();
        let tempo_descanso = $("#formulario-cadastrar-ficha input[name='tempo_descanso']").val();

        if(!exercicio_id){
            alert("Informe o excercício");
            return;
        }

        if(!num_series){
            alert("Informe o Nº de série");
            return;
        }

        if(!num_repeticoes){
            alert("Informe o Nº de repetição");
            return;
        }

        if(!tempo_descanso){
            alert("Informe o tempo de descanso");
            return;
        }

        let exercicio_nome = $("#formulario-cadastrar-ficha select[name='exercicio_id']").find(":selected").attr("data-nome");

        let obj = {
            exercicio_id,
            exercicio_nome,
            num_series,
            num_repeticoes,
            tempo_descanso
        }

        let exercicios = localStorage.getItem("exercicios");

        if(exercicios){
            exercicios = JSON.parse(localStorage.getItem("exercicios"));
        }else{
            localStorage.setItem("exercicios", JSON.stringify([]));
            exercicios = [];
        }
        
        exercicios.push(obj);
        
        localStorage.setItem("exercicios", JSON.stringify(exercicios));

        let html = "";

        for (let exercicio of exercicios) {
            html += `<tr>`;
            html += `<td>${exercicio.exercicio_nome}</td>`;
            html += `<td>${exercicio.num_series}</td>`;
            html += `<td>${exercicio.num_repeticoes}</td>`;
            html += `<td>${exercicio.tempo_descanso}</td>`;
            html += `</tr>`;
        }

        $("#cadastro-ficha-lista-exercicios").html(html);
    });
    
    $("#formulario-cadastrar-ficha").on("submit", function(e){
        e.preventDefault();

        let exercicios = localStorage.getItem("exercicios");

        if(exercicios){
            exercicios = JSON.parse(localStorage.getItem("exercicios"));
        }else{
            exercicios = [];
        }

        let data = $(this).serialize() + "&" + $.param({exercicios});

        $.ajax({
            url: "cadastrar.php",
            method: "POST",
            data,
            success: response => {
                location.reload();
            }
        });
    }); 

    // ----------------

    $(".botao-editar-ficha-lista-exercicios").on("click", function(){

        let exercicio_id = $("#formulario-editar-ficha select[name='exercicio_id']").val();
        let num_series = $("#formulario-editar-ficha input[name='num_series']").val();
        let num_repeticoes = $("#formulario-editar-ficha input[name='num_repeticoes']").val();
        let tempo_descanso = $("#formulario-editar-ficha input[name='tempo_descanso']").val();

        if(!exercicio_id){
            alert("Informe o excercício");
            return;
        }

        if(!num_series){
            alert("Informe o Nº de série");
            return;
        }

        if(!num_repeticoes){
            alert("Informe o Nº de repetição");
            return;
        }

        if(!tempo_descanso){
            alert("Informe o tempo de descanso");
            return;
        }

        let exercicio_nome = $("#formulario-editar-ficha select[name='exercicio_id']").find(":selected").attr("data-nome");

        let obj = {
            exercicio_id,
            exercicio_nome,
            num_series,
            num_repeticoes,
            tempo_descanso
        }

        let exercicios = localStorage.getItem("exercicios");

        if(exercicios){
            exercicios = JSON.parse(localStorage.getItem("exercicios"));
        }else{
            localStorage.setItem("exercicios", JSON.stringify([]));
            exercicios = [];
        }
        
        exercicios.push(obj);
        
        localStorage.setItem("exercicios", JSON.stringify(exercicios));

        let html = "";

        for (let exercicio of exercicios) {
            html += `<tr>`;
            html += `<td>${exercicio.exercicio_nome}</td>`;
            html += `<td>${exercicio.num_series}</td>`;
            html += `<td>${exercicio.num_repeticoes}</td>`;
            html += `<td>${exercicio.tempo_descanso}</td>`;
            html += `</tr>`;
        }

        $("#editar-ficha-lista-exercicios").html(html);
    });

    $(".botao-selecionar-ficha").on("click", function () {
        let { id, nome, dia_treino } = $(this).data();

        $("#editar").modal("show");

        localStorage.setItem("exercicios", JSON.stringify([]));

        $("#formulario-editar-ficha input[name='id']").val(id);
        $("#formulario-editar-ficha input[name='nome']").val(nome);
        $("#formulario-editar-ficha select[name='dia_treino']").val(dia_treino);

        $.ajax({
            url: "exercicios.php",
            type: "POST",
            data: { id },
            dataType:"json",
            success: response =>{
                let { exercicios } = response;

                localStorage.setItem("exercicios", JSON.stringify(exercicios));

                let html = "";

                for (let exercicio of exercicios) {
                    html += `<tr>`;
                    html += `<td>${exercicio.exercicio_nome}</td>`;
                    html += `<td>${exercicio.num_series}</td>`;
                    html += `<td>${exercicio.num_repeticoes}</td>`;
                    html += `<td>${exercicio.tempo_descanso}</td>`;
                    html += `<td><a href="excluir.php?id=${exercicio.id}" class="btn btn-sm btn-danger p-0 ps-2 pe-2">EXCLUIR</a></td>`;
                    html += `</tr>`;
                }

                $("#editar-ficha-lista-exercicios").html(html);
            }
        })
    });

    $("#formulario-editar-ficha").on("submit", function(e){
        e.preventDefault();

        let exercicios = localStorage.getItem("exercicios");

        if(exercicios){
            exercicios = JSON.parse(localStorage.getItem("exercicios"));
        }else{
            exercicios = [];
        }

        let data = $(this).serialize() + "&" + $.param({exercicios});

        $.ajax({
            url: "editar.php",
            method: "POST",
            data,
            success: response => {
                location.reload();
            }
        });
    }); 
    $(".botao-gerar-pdf").on("click", function(){
        window.print();
    });
});

