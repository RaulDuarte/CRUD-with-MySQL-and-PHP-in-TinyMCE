<?php   
        include 'header.php';
        include './connection/connection.php';

        if(isset($_POST['submit'])){

            if(isset($_POST['titulo']) && !empty($_POST['titulo'])){

                $title = $_POST['titulo']; 
                
            }else{

                $titleError = "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Erro! O documento deve conter um título.</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                </div>
                ";

            }
            
            if(isset($_POST['content']) && !empty($_POST['content'])){

                $content = $_POST['content'];

            }else{

                $contentError = "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Erro! O documento está em branco.</strong>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
                </div>
                ";

            }

            if(isset($_POST['titulo']) && !empty($_POST['titulo']) && isset($_POST['content']) && !empty($_POST['content'])){
                
                $query = "INSERT INTO container (title,content) VALUES ('$title', '$content')";

                if(mysqli_query($link, $query)){
                    header("Location: listar.php");
                }else{
                    $mysqlError = "
                    <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Erro ao Gravar no Banco de Dados</strong><br>".mysqli_error($link).
                    "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button></div>
                    ";
                }

            }

        }

?>


    <div class="container">
        <?php if(isset($mysqlError)) echo $mysqlError; ?>
        <h3 class="text-center">Adicionar Anotação</h3>
        <br>
        <div class="row">
            <div class="col-md-12">

                <form action="" method="post">

                    <?php if(isset($titleError)) echo $titleError; ?>

                    <label for="Título"><strong>Título</strong></label>
                    <input class="form-control" name="titulo" type="text" value="<?php if(isset($title)) echo $title;?>">

                    <br>

                    <textarea name="content" id="tinyMCEArea" cols="30" rows="10">

                        <?php
                            if(isset($content)) echo $content;
                        ?>
                    
                    </textarea>

                    <?php if(isset($contentError)) echo $contentError;?>

                    <br>

                    <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
                </form>

            </div>
        </div>
        <br>
 
               
  
    </div>


<?php include 'footer.php' ?>