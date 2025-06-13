<?php
    $criaaulas = Db::conexao()->query("SELECT * FROM `aulas`")->fetchAll(PDO::FETCH_OBJ);

    foreach ($criaaulas as $criaaula) {
?>
    <tr>
        <td><?php echo htmlspecialchars($criaaula->nome_aluno); ?></td>
        <td><?php echo htmlspecialchars($criaaula->dia_semana); ?></td>
        <td><?php echo htmlspecialchars(substr($criaaula->horario_inicio, 0, 5)); ?></td>
        <td><?php echo htmlspecialchars($criaaula->professor); ?></td>
        <td class="conteudo-esconder-pdf">
            <button 
                class="conteudo-esconder-pdf btn btn-primary btn-sm p-0 ps-2 pe-2 botao-selecionar-aula"
                data-id="<?php echo htmlspecialchars($criaaula->id); ?>"
                data-nome_aula="<?php echo htmlspecialchars($criaaula->nome_aluno); ?>"
                data-dia_aula="<?php echo htmlspecialchars($criaaula->dia_semana); ?>"
                data-horario_aula="<?php echo htmlspecialchars($criaaula->horario_inicio); ?>"
                data-professor_aula="<?php echo htmlspecialchars($criaaula->professor); ?>">
                EDITAR
            </button>
        </td>
    </tr>
<?php } ?>
