<script>
    var key;
    var last_char;
    function set_key(last_text){
        last_char = last_text.charAt(last_text.length-1);
        key = event.keyCode || event.charCode;
    }
    function mask(texto,mascara,id) {
        let position = event.target.selectionStart;
        var removechar = false;
        if(position!=texto.length){
            texto = texto.substr(0,position)+"*"+texto.substr(position,texto.length-position);
            var removechar = true;
        }
        if(key != 8 && key != 46 || removechar ){
            $.ajax({
                url: "http://localhost/api/masked_text/unmask",
                type:"GET",
                dataType: "json",
                data: {
                    mask: mascara,
                    text: texto
                },
                success: function(result) {
                    if(removechar){
                        result.dados = result.dados.replace('*','');
                    }
                    $.ajax({
                        url: "http://localhost/api/masked_text/mask",
                        type:"GET",
                        dataType: "json",
                        data: {
                            mask:mascara,
                            text: result.dados
                        },
                        success: function(resultado) {
                            $("#" + id ).val(resultado.dados);
                            if(removechar){
                                document.getElementById(id).setSelectionRange(position, position);
                            }
                            
                        },
                        error: function(e) {
                            console.log(e);

                        }
                    });
                }
            });
        }else{
            if(!$.isNumeric(last_char)){
                console.log(last_char);
                $( "#" + id ).val(texto.slice(0,-1));
            }
        }
    }
</script>