<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marisa parque de diversão</title>
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/reset.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!--Animação fotos-->
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>assets/css/slick.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>assets/css/slick-theme.css" />
    <!--Animação video-->
    <link href="<?php echo BASE_URL ?>assets/css/lity.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


    <link rel="icon" type="image/x-icon" href="<?php echo BASE_URL ?>assets/img/Logos/LOGOMARISA.svg">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>assets/css/estilo.css">
    

        <?php if (!empty($bannerAleatorio)):?>
            <style>
                
                #home header {
                    width: 100%;
                    height: 800px;
                    background: url("<?php echo BASE_URL . $bannerAleatorio['video_banner']; ?>");
                    background-size: cover;
                    animation: switchBackground 30s forwards;
                }

                @keyframes switchBackground {

                    0%,
                    99% {
                        background: url("<?php echo BASE_URL . $bannerAleatorio['video_banner']; ?>");
                        background-size: cover;
                    }

                    100% {
                        background: url("<?php echo BASE_URL . $bannerAleatorio['foto_banner']; ?>");
                        background-size: cover;
                    }
                }
                
            </style>
            <?php endif ;?>


</head>