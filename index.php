<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projeto Crud</title>
     <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/e1d7925497.js" crossorigin="anonymous"></script>
</head>
<body>
    <nav class="corSecundaria navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand textoBranco" href="">Cadastro.Com...></a>
    </nav>
    <div class="text-center .textoBranco">
        <h2 class="jumbotron-heading textoBranco">Cadastre-se</h2>
        <p class="lead textoBranco"> 
           Fassa seu cadastro para utilizar nossas funções.
          </p>    
  </div>
  
  <body>


    <?php
    
        session_start();
        require 'assets/usuarios.php';
    ?>
    
    <?php
    
        //CRIAR OBEJETO USUARIO E CADASTRAR
            $usuario = new Usuarios();
    
            if(isset($_POST['cadastrar'])):
    
                $nome  = $_POST['nome'];
                $email = $_POST['email'];
    
                $usuario->setNome($nome);
                $usuario->setEmail($email);
    
                // INSERIR NO BANCO
                if($usuario->insert()){
                    echo "Inserido com sucesso!";
                }
    
            endif;
    
            ?>
            <section class="jumbotron text-center corPrimaria">
            <header>
            <p>
            <img class="foto-perfil" src="assets/img/Default.png" alt="">
            </p>
            <p>
            <a href="assets/index.php" class="btn btn-dark my-2">inicio</a>
            </p>
            </header>
            </section>
            <?php 
    
            // ATUALIZAR
            if(isset($_POST['atualizar'])):
    
                $id = $_POST['id'];
                $nome = $_POST['nome'];
                $email = $_POST['email'];
    
                $usuario->setNome($nome);
                $usuario->setEmail($email);
    
                if($usuario->update($id)){
                    echo "Atualizado com sucesso!";
                }
    
            endif;
            ?>
    
            <?php
            // DELETAR
            if(isset($_GET['acao']) && $_GET['acao'] == 'deletar'):
    
                $id = (int)$_GET['id'];
                if($usuario->delete($id)){
                    echo "Deletado com sucesso!";
                }
    
            endif;
            ?>
    
            <?php
    
            // EDITAR
            if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){
    
                $id = (int)$_GET['id'];
                $resultado = $usuario->find($id);
            ?>
            <div id="corpo-form">
            <form id="corpoForm" method="post" action="">
    
                    <input type="text" name="nome" value="<?php echo $resultado->nome; ?>" placeholder="Digite seu Nome"/>
                    <input type="text" name="email" value="<?php echo $resultado->email; ?>" placeholder="E-mail:"/> 
    
                    <input type="hidden" name="id" value="<?php echo $resultado->id; ?>"><br /> 
                    <input type="submit" name="atualizar" value="Atualizar dados">			
                    <p class="lead textoBranco"> 
                  Alterar Nome e E-mail  
          </p> 	
                </form>
                </div>
            </section>
            <?php }else{ ?>
    
           <div id="corpo-form">
            <form id="corpoForm" method="post" action="">
                    <input type="text" name="nome" placeholder="Digite seu Nome"/>
                    <input type="text" name="email" placeholder="E-mail" /><br />
                    <input type="submit" name="cadastrar" class="" value="Cadastrar">					
            </form>
            </div>
            </section>
            <?php } ?>
    
            <table>
                
                <thead class="textoBranco">
                 <div class="text-center"> 
                
                    </div>  
                </thead>
    
                <!-- MOSTRA TODOS OS DADOS INSERIDOS NO BANCO -->
                <?php foreach($usuario->findAll() as $key => $value): ?>
                
                <tbody class="textoBranco">
                    <tr>
                        <td><?php echo $value->id; ?></td>
                        <td><?php echo $value->nome; ?></td>
                        <td><?php echo $value->email; ?></td>
                            
                        

                            <td  class="container ">


                                <?php echo "<a href='index.php?acao=editar&id=" .  $value->id . "'>Editar</a>"; ?><br>
                                <?php echo "<a href='index.php?acao=deletar&id=" . $value->id . "' onclick='return confirm(\"Deseja realmente deletar?\")'>Deletar</a>"; ?><br>
                                
                                    
                            </td>
                    </tr>
                </tbody>
                
                <?php endforeach; ?>
    
            </table>
    
    </body>
    </html>
    <footer class="text-center corSecundaria textoFooter">
        <p class="textoBranco">Copyright - 2021  </p>    
        <p class="textoBranco">Desenvolvido por Geanderson ferreira - Alessandro Aelson</p>    
        <p class="textoBranco">Viviane Raquel - João Vilar</p>  
    </footer>
    
</body>
</html>