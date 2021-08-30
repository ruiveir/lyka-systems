function showNotificacao(div) {
    div.find('.descricaoNotificacao').first().css({
        "display": "block"
    });
    div.find('.mostraNotificacao').first().css({
        "display": "none"
    });
}

function hideNotificacao(div) {
    div.find('.descricaoNotificacao').first().css({
        "display": "none"
    });
    div.find('.mostraNotificacao').first().css({
        "display": "block"
    });
}
