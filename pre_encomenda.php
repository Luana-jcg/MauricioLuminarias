<?php
    session_start(); 
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MaurícioLuminárias</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    
    <!-- Folha de Estilo -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
    $(document).ready(function() {
        $('#formEncomenda').submit(function(event) {
            event.preventDefault();
            // seleciona o botão de submit
            var botao = $(this).find('input[type="submit"]');
            // desabilita o botão para evitar multiplos envio
            botao.prop("disabled", true).val("Enviando..").css('opacity', '0.5');
            $.ajax({
                type: "post",
                url: "bd/gravar_pre_encomenda.php",
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function( data ){
                    if(data === "sucesso" || data === "sucessosucesso"){
                        window.location.href = "encomendaRealizada.php";
                    } else{
                        $("#resposta_ajax").removeClass("alert-success").addClass("alert-danger").css('display', 'block').html(data);
                    }
                    botao.prop("disabled", false).val("Enviar").css('opacity', '1');
                }
            });
        });
    });
        
    //Máscara telefone
    function formatar(mascara, documento){
        var i = documento.value.length;
        var saida = mascara.substring(0,1);
        var texto = mascara.substring(i);

        if (texto.substring(0,1) != saida){
            documento.value += texto.substring(0,1);
        }
    }
    </script>
</head>

<body class="bg-dark">


    <div id="container6" class="container-fluid">
        <?php include 'topo.php'; ?>
        <div class="d-flex justify-content-center">

            <div class="card mt-2 grow">
                <div class="card-header">
                    <div class="d-flex justify-content-center social_icon">
                        <span><i class="fas fa-clipboard fa-3x"></i></span>
                        <h5 class="mt-2 ml-2">Formulário de Pré-Encomenda</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="resposta_ajax" class="alert" style="display:none"></div>
                    <form id="formEncomenda" enctype="multipart/form-data" class="form-group" method="post">
                       
                        <div class="input-group form-group d-flex">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-user"></i></span>
                            </div>
                            <input type="text" name="nome" class="form-control" placeholder="Nome Completo *" required>
                        </div>
                        
                        <div class="input-group form-group d-flex">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control" placeholder="E-mail *" required>
                        </div>
                        
                        <div class="form-group d-flex row">
                            
                            <div class="col input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="height: 38px;"><i class="fa fa-mobile"></i></span>
                                </div>
                                <input type="tel" name="celular" class="form-control" placeholder="Celular" maxlength="13" pattern="[0-9]{2} [0-9]{5}-[0-9]{4}" OnKeyPress="formatar('## #####-####', this)">
                            </div>
                            <div class="col input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="height: 38px;"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="tel" name="telefone" class="form-control" placeholder="Telefone" maxlength="12" pattern="[0-9]{2} [0-9]{4}-[0-9]{4}" OnKeyPress="formatar('## ####-####', this)">
                            </div>
                        </div>
                        
                        <div class="input-group form-group d-flex">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-clipboard"></i></span>
                            </div>
                            <input type="text" class="form-control" disabled placeholder="Descrição do Ambiente *">
                            <textarea class="form-control z-depth-1" name="descricao" id="exampleFormControlTextarea6" style="border: solid 1px; opacity: 0.5; border-radius: 5px;" placeholder="Ex: Empresa, Universidade, Museu, Restaurante, etc.&#10No ambiente possuímos móveis com cores em madeira..." rows="2" maxlength="255" required></textarea>
                        </div>
                        
                        <div class="form-group d-flex row">
                            <div class="col input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="height: 38px;"><i class="fas fa-list-ol">*</i></span>
                                </div>
                                <input type="text" name="medida" class="form-control" placeholder="Medidas: Ex: 1,5 x 2,0 m" required>
                            </div>

                            <div class="col input-group form-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="height: 38px;"><i class="fas fa-list-ol">*</i></span>
                                </div>
                                <input type="number" name="quantidade" class="form-control" min="1" placeholder="Quantidade" required>
                            </div>
                        </div>

                        <label>Envie uma foto do ambiente para obtermos mais detalhes</label>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" style="height: 30px;"><i class="far fa-folder-open"></i></span>
                            </div>
                            <input type="file" name="imagem" class="upload">
                        </div>
                        <p class="text-info">Todos com <span class="text-danger">* </span>são obrigatórios</p>

                        <div class="card-footers mb-2">
                            <div class="d-flex justify-content-end links">
                                <input type="submit" name="enviarEncomenda" style="font-weight: bold;" class="nav-link btn btn-outline-dark">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
