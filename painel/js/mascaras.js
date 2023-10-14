function mascaraCpf(){
    var valor = $(this).val();
    if (valor.length == 3 || valor.length == 7) {
        valor = valor + ".";
    }

    if (valor.length == 11) {
        valor = valor + "-";
    }

    $('#cpf').val(valor);
    return;

}

function mascaraTelefone(){
    var valor = $(this).val();
    if (valor.length == 2) {
        valor = "("+valor+") ";
    }

    if (valor.length == 10) {
        valor += "-";
    }

    $('#telefone').val(valor);
    return;
}