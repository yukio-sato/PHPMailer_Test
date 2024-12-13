<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Mailer Test</title>
</head>
<body>
<?php
    $emailDirecionado = "yukioutiyamasato@gmail.com";
    // require part - tenha certeza que a pasta seja nomeada -> "src" e esteja com o PHPMailer 
    require_once ('src/PHPMailer.php');
    require_once ('src/SMTP.php');
    require_once ('src/Exception.php');

    // email part
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    
    $mail = new PHPMailer(true); //linha de teste
    
    /*
    Para criar uma senha codificada é necessário ter a verificação de duas etapas ativado
    Após isso você deve acessar https://myaccount.google.com/apppasswords?
    Coloque qualquer nome e guarde o código
    */

    try {
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = ''; // email responsavel por enviar
        $mail->Password = ''; // senha codificada

        $mail->Port = '587';
    
        $mail->setFrom(''); // repita o valor da linha $mail->Username ou da linha 34
        $mail->addAddress($emailDirecionado); // email redirecionado
    
        $mail->isHTML(true);
        $mail->Subject = 'Teste de Envio de Email'; // titulo do email
        $mail->Body = '
        <h1>Olá <strong>'.$emailDirecionado.'<strong>!</h1>
        <h3>Segue abaixo o Link para o QR Code</h3>
        <hr>
        <a href="">Teste Link!</a>
        '; // descrição
        $mail->AltBody = 'Chegou mensagem'; // texto para cegos?
    
        if ($mail->send()) {
            echo '
                <div class="content">
                <br>
                <br>
                <h1>Email Enviado!</h1>
                <button onclick="window.location.reload();">Reenviar Email</button>
                </div>
            ';
        }else {
            echo '
                <div class="content">
                    <br>
                    <br>
                    <h1>Ocorreu um erro inesperado</h1>
                    <p>Por favor tente novamente mais tarde.</p>
                </div>
            ';
        }
    } catch (Exception $e) {
        //echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
?>
</body>
</html>