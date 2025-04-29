<?php


if(session_status() == PHP_SESSION_NONE){
  session_start();
}

if(isset($_SESSION['mensagem']) && isset($_SESSION['tipo-msg'])){


  //exibir a mensagem
  $mens = $_SESSION['mensagem'];
  $tipo = $_SESSION['tipo-msg'];


  if($tipo == 'sucesso'){

    echo $mens;
    echo '<div class="alert alert-primary" role="alert">' . $mens . '</div>';
 

  }elseif($tipo == 'erro'){


    echo '<div class="alert alert-danger" role="alert">' . $mens .  '</div>';
   
  

  }

  unset($_SESSION['mensagem']);
  unset($_SESSION['tipo-msg']);

}

?>
<a href="http://localhost/sistema-pqmarisa/public/servico/adicionar" class="btn btn-primary">Cadastrar Serviço </a>



<table class="table table-dark table-striped">
  <thead>
    <tr>
      <th scope="col">Nome do Serviço</th>
      <th scope="col">Descrição</th>
      <th scope="col">Valor (R$)</th>
      <th scope="col">Foto</th>
      <th scope="col">Brinquedo</th>
      <th>Editar</th>
      <th>Desativar</th>
    </tr>
  </thead>
  <tbody>

    

    <?php 
    
    
    
    foreach ($servicos as $linha): ?>
    <tr>
        <td scope="col">
            <?php

            $caminhoBase = "http://localhost/sistema-pqmarisa/public/uploads/";
            $caminhoFoto = $caminhoBase . $linha['foto_servico'];

            if($linha['foto_servico'] != '' ){
                $urlFoto = $caminhoFoto;
            }else{
                $urlFoto = $caminhoBase . 'semfoto.png';
            }
                /*
                $urlFoto = $linha['foto_servico'] != '' && file_exists($caminhoFoto)
                ? $caminhoFoto : $caminhoBase . 'semfoto.png';
                */

            




        ?>
       
          <img src="<?php echo $urlFoto; ?>"
            class="img-thumbnail"
            alt="<?php echo htmlspecialchars($linha['nome_servico']); ?>"
            style="max-width: 120px;">

        </td>
      <td scope="col"><?php echo $linha['nome_servico']; ?></td>
      <td scope="col"><?php echo $linha['descricao_servico']; ?></td>
      <td scope="col"><?php echo $linha['valor_servico']; ?></td>
      <td scope="col"><?php echo $linha['id_servico']; ?></td>
      <td>
        <a href="http://localhost/sistema-pqmarisa/public/servico/editar/<?php echo $linha['id_servico']; ?>"
          type="button" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a>
      </td>
      <td>
        <a href="#"
          type="button" class="btn btn-danger" title="Desativar" onclick="abrirModal(<?php echo $linha['id_servico']; ?>); return false;">
          <i class="bi bi-trash-fill"></i></a>
      </td>
    </tr>
        <?php endforeach; ?>
  </tbody>
</table>




<!-- Modal -->
<div class="modal fade" id="desativarModal" tabindex="-1" aria-labelledby="desativarModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="desativarModalLabel">Confirmarção de Desativação</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h2>Deseja realmente desativar esse serviço</h2>
        <input type="hidden" id="idParaDesativar" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btnDesativar">Desativar</button>
      </div>
    </div>
  </div>
</div>


<script>
 document.addEventListener('DOMContentLoaded', function() {
  function abrirModal(id_servico) {
    if ($('#desativadaModal').hasClass('show')) {
      return;
    }

    console.log(id_servico);
    document.getElementById('idParaDesativar').value = id_servico;
    $('#desativarModal').modal('show');
  }

  document.getElementById('btnDesativar').addEventListener('click', function() {
    const idServico = document.getElementById('idParaDesativar').value;
    if (idServico) { 
      console.log("Id recuperado: " + idServico);
      desativarServico(idServico);  // Chama a função desativarServico
    }
  });

  function desativarServico(idServico) {
    fetch(`http://localhost/sistema-pqmarisa/public/servico/desativar/${idServico}`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      }
    })
    .then(response => {
      if (!response.ok) {
        throw new Error(`Erro HTTP: ${response.status}`);
      }
      return response.json();
    })
    .then(data => {
      // Resposta com SUCESSO
      console.log("Serviço desativado com sucesso");
      $('#desativarModal').modal('hide');
      location.reload();
    })
    .catch(error => {
      console.error('Error: ', error);
      alert("Erro na Requisição. Verifique a conexão com o servidor");
    });
  }

  window.abrirModal = abrirModal;
});

</script>