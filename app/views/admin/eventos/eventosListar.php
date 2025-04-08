<a href="http://localhost/sistema-pqmarisa/public/eventos/adicionar" class="btn btn-primary">Cadastrar eventos </a>

<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">Foto</th>
      <th scope="col">ID</th>
      <th scope="col">Nome do Evento</th>
      <th scope="col">Status</th>
      <th>Editar</th>
      <th>Desativar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    foreach ($eventos as $linha): ?>
    <tr>
    <td scope="col">
            <?php

            $caminhoBase = "http://localhost/sistema-ti26/public/uploads/";
            $caminhoFoto = $caminhoBase . $linha['foto_eventos'];

            if($linha['foto_eventos'] != '' ){
                $urlFoto = $caminhoFoto;
            }else{
                $urlFoto = $caminhoBase . 'semfoto.png';
            }
                /*
                $urlFoto = $linha['foto_eventos'] != '' && file_exists($caminhoFoto)
                ? $caminhoFoto : $caminhoBase . 'semfoto.png';
                */






        ?>
        <img src="<?php echo $caminhoFoto;['foto_eventos']; ?>" class="img-thumbnail" alt="<?php echo $linha['nome_eventos']; ?>">

        </td>
      <td scope="col"><?php echo $linha['id_eventos']; ?></td>
      <td scope="col"><?php echo $linha['nome_eventos']; ?></td>
      <td scope="col"><?php echo $linha['status_eventos']; ?></td>
      
      <td>
        <a href="editar_evento.php?id=<?php echo $linha['id_eventos']; ?>" class="btn btn-warning">Editar</a>
      </td>
      <td>
        <a href="desativar_evento.php?id=<?php echo $linha['id_eventos']; ?>" class="btn btn-danger">Desativar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
