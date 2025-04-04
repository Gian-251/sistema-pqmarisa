<?php

//reconhecer os arquivos do phpmailer
require_once("phpmailer/src/PHPMailer.php");
require_once("phpmailer/src/SMTP.php");

function enviarEmail($dados){
    try{
        $enviar = new PHPMailer\PHPMailer\PHPMailer();
        $enviar->isSMTP();
        $enviar->SMTPDebug = 0;
        $enviar->Host = "smtp.hostinger.com";
        $enviar->Port = 465;
        $enviar->SMTPSecure = 'ssl';
        $enviar->SMTPAuth = true;
        $enviar->Username = "ti26@smpsistema.com.br";
        $enviar->Password = "Senac@ti26";
        $enviar->isHTML(true);
        
        //configurar o e-mail principal
        $enviar->setFrom("ti26@smpsistema.com.br", $dados['nome']);
        $enviar->addAddress("pxlab.lab@gmail.com", "Contato via Mestre Motores");
        $enviar->Subject = $dados['assunto'];
        $enviar->msgHTML("Nome: {$dados['nome']} <br>
                         E-mail: {$dados['email']} <br>
                         Telefone: {$dados['fone']} <br>
                          Mensagem: {$dados['mensagem']}");
        $enviar->AltBody = "Nome: {$dados['nome']} \n
                          E-mail: {$dados['email']} \n
                          Telefone: {$dados['fone']} \n
                           Mensagem: {$dados['mensagem']}";      
                           
        if (!$enviar->send()){
            throw new Exception("Erro ao enviar o E-mail: " . $enviar->ErrorInfo);
        }                   

    }
    catch(Exception $erro){
        return false;
    }
    return true;
}

function enviarEmailResposta($dados){
    try{
        $enviar = new PHPMailer\PHPMailer\PHPMailer();
        $enviar->isSMTP();
        $enviar->SMTPDebug = 0;
        $enviar->Host = "smtp.hostinger.com";
        $enviar->Port = 465;
        $enviar->SMTPSecure = 'ssl';
        $enviar->SMTPAuth = true;
        $enviar->Username = "ti26@smpsistema.com.br";
        $enviar->Password = "Senac@ti26";
        $enviar->isHTML(true);
        
        //configurar o e-mail principal
        $enviar->setFrom("ti26@smpsistema.com.br", "Resposta Mestre Motores");
        $enviar->addAddress($dados['email'], $dados['nome']);
        $enviar->Subject = $dados['assunto'];
        $enviar->msgHTML("Olá{$dados['nome']} <br>
                         . <br>
                          Mensagem: {$dados['mensagem']} <br>
                          Em caso de Duvidas ligue para (11)99962=3300");
        $enviar->AltBody = "Olá{$dados['nome']} \n
                            Em breve retornaremos seu contato. \n
                           Mensagem: {$dados['mensagem']} \n
                           Em caso de Duvidas ligue para (11)99962=3300";      
                           
        $enviar->send();                    
    }  catch(Exception $erro){
        return false;

    }
    return true;
}
//salvar banco de dados
function salvarContato($dados)
{
    try{
        //abrir a conexao com banco de dados
        
        $pdo = new PDO("mysql:host=smpsistema.com.br;dbname=u283879542_marisa;","u283879542_marisa","@MarisaPxLab12");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Inserir as informações nesse banco
        $inserir = "INSERT INTO tbl_contato (nome_contato, tel_contato, email_contato, mensagem_contato, status_contato)
                    VALUES (:nome, :tel, :email, :mensagem, 'aguardando')";
        $stmt = $pdo->prepare($inserir);
        $stmt->bindParam(':nome', $dados['nome']);
        $stmt->bindParam(':tel', $dados['fone']);
        $stmt->bindParam(':email', $dados['email']);
        $stmt->bindParam(':mensagem',$dados['mensagem']);
        $stmt->execute();
        return true;            

    }
    catch (PDOException $e){ 
        error_log("erro ao salvar no banco de dados: " . $e->getMessage());
        return false;
    }
}
//Estrutura logica
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])){
    $dados = [
        'nome'=> htmlspecialchars($_POST['nome']),
        'email' => filter_var($_POST['email'], FILTER_SANITIZE_EMAIL),
        'fone' => htmlspecialchars($_POST['fone']),
        'mensagem' => htmlspecialchars($_POST['mensagem']),
        'assunto' => "CONTATO SITE - MESTRE MOTORES" 
    ];
    //salvar no banco
$contatoSalvo = salvarContato($dados);

if ($contatoSalvo) { 
   $emailEnviado = enviarEmail($dados);
 if ($emailEnviado) {
    enviarEmailResposta($dados);
    header("Location: index.php?status=sucesso");
    exit;
 } else {
    header("Location: index.php?status=erro");
    exit;
 }
  } else {
    header("Location: index.php?status=erro_banco");
    exit;
  }


}?>
^