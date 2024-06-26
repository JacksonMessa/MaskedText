<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Cadastro</title>
</head>
<body onload="load()">
    <form action="">
        <div class="container">
            <h1>Cadastro de Pessoa</h1>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 ">
                    <label for="nome" class="form-label">Nome</label>
                    <input class="form-control" type="text" name="nome">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 ">
                    <label onclick="load()" for="cpf" class="form-label">CPF</label>
                    <input class='form-control' type='text' name='cpf' id='cpf'>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 ">
                    <label for="data" class="form-label">Data de Nascimento</label>
                    <input class="form-control" type="text" name="data" id="data">                
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 ">
                    <label for="rg" class="form-label">RG</label>
                    <input class="form-control" type="text" name="rg" id="rg">
                </div>
            </div>
            <div class="botao-direita">
                <button type="reset" class="btn btn-danger botao">Limpar</button>
                <button class="btn btn-primary botao">Cadastrar</button>
            </div>
        </div>
    </form>
    <div id="script"></div>
</body>

<script>
    function load() {
        let cpfInput = jQuery("<div>").append($("#cpf").clone()).html();
        let cpfData = {
                mask: "cpf",
                input: cpfInput
            };

         $.ajax({
            url: "http://localhost/api/masked_text/setinputmask",
            type:"POST",
            data: cpfData,
            success: function(resultado) {
                if(resultado.status){
                    $("#script").html(resultado.script);
                    $("#cpf").replaceWith(resultado.input);   
                }else{
                    console.log(resultado);
                }
                
            },
            error: function(e) {
                console.log("ERRO: " + e.responseText);
            }
        });

        let dataInput = jQuery("<div>").append($("#data").clone()).html();
        let dataData = {
                mask: "data",
                input: dataInput
            };

         $.ajax({
            url: "http://localhost/api/masked_text/setinputmask",
            type:"POST",
            data: dataData,
            success: function(resultado) {
                if(resultado.status){
                    $("#data").replaceWith(resultado.input);
                }else{
                    console.log(resultado);
                }    
            },
            error: function(e) {
                console.log("ERRO: " + e.responseText);
            }
        });

        let RGInput = jQuery("<div>").append($("#rg").clone()).html();
        let RGData = {
                mask: "**.***.***-*",
                input: RGInput
            };

         $.ajax({
            url: "http://localhost/api/masked_text/setinputmask",
            type:"POST",
            data: RGData,
            success: function(resultado) {
                if(resultado.status){
                    $("#rg").replaceWith(resultado.input);
                }else{
                    console.log(resultado);
                }    
            },
            error: function(e) {
                console.log("ERRO: " + e.responseText);
            }
        });

    }
</script>

<style type="text/css">
    .botao-direita{
        display: flex;
        justify-content: end;
        margin-top: 2%;
    }

    .botao{
        margin-left: 2%;
    }


</style>
</html>