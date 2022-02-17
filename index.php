<?php
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=ordenar_resutados', 'root', '');

    } catch(PDOException $e){
        echo $e->getMessage();
    }
?>
<form method="GET">
    <select name="ordem" onchange="this.form.submit()">
    <option></option>
        <option value="nome"<?php // echo ($ordem=="nome")?'selected="selected"':''; ?>>Pelo nome</option>
        <option value="preco" <?php //echo ($ordem=="preco")?'selected="selected"':''; ?>>Pelo preço</option>
    </select>
</form>

<table border="1" width="400">
        <tr>
            <th>Nome do produto</th>
            <th>Preço do produto</th>
        </tr>
        <?php
        if(isset($_GET['ordem']) && !empty($_GET['ordem'])){
            $ordem = addslashes($_GET['ordem']);
            $sql = "SELECT * FROM produtos ORDER BY $ordem";
        } else {
            $ordem = '';
            $sql = 'SELECT * FROM produtos ';
        }
          
            $sql = $pdo->query($sql);
            if($sql->rowCount() > 0){
                foreach($sql->fetchAll() as $produto){
                    echo '<tr>';
                    echo '<td>'.$produto['nome'].'</td>';
                    echo '<td>'.$produto['preco'].'</td>';
                    echo '</tr>';
                }
            }
        

        ?>
</table>