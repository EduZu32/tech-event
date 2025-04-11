<?php
function validarEntero($valor)
{
    return filter_var($valor, FILTER_VALIDATE_INT);
}

function sanitizarTexto($texto)
{
    return htmlspecialchars(trim($texto), ENT_QUOTES, 'UTF-8');
}
