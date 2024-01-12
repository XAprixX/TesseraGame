<?php
include_once("conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Pessoas cadastradas</title>
</head>

<body>
    <h2>Pessoas cadastradas</h2>
    <?php
    $sql = "SELECT * FROM usuario";
    $dadosPessoas = $conn->query($sql);


    if ($dadosPessoas->num_rows > 0) {
        ?>
        <table class="table table-striped">

            <thead>
                <tr>
                    <th>Nickname</th>
                    <th>Senha</th>
                    <th>ID</th>
                    <th>Número</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>

            <tbody>
                <?php
                while ($dadosExibir = $dadosPessoas->fetch_assoc()) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $dadosExibir["Nickname"] ?>
                        </td>
                        <td>
                            <?php echo $dadosExibir["Senha"] ?>
                        </td>
                        <td>
                            <?php echo $dadosExibir["ID"] ?>
                        </td>
                        <td>
                            <?php echo $dadosExibir["player_number"] ?>
                        </td>
                        
                        <td><a href="editar.php?id=<?php echo $dadosExibir["ID"] ?>">Editar Usuário</a></td>


                        <td><a href="#" onclick="confirmaExclusao(
                            ' <?php echo $dadosExibir ["Nickname"] ?>',
                            ' <?php echo $dadosExibir["Senha"]?> ',
                            '<?php echo $dadosExibir["ID"]?>',
                            '<?php echo $dadosExibir["player_number"]?>') ">Excluir</a></td>
                    </tr>

                    <?php
                }

                ?>
            </tbody>

        </table>

        <?php
    } else {
        echo "Nenhum registro encontrado";
    }
    ?>
</body>

<script>
    function confirmaExclusao(nick, senha, id, number){
        if(window.confirm("Deseja excluir essa coluna? \n(ID: "+id+"; Nick: "+nick+")")){
            window.location = "excluir.php?ID="+id;
        }
    }
</script>

</html>