<?php
function verificarArquivo($arquivo) {
    if (file_exists($arquivo) && is_readable($arquivo)) {
        return true;
    }
    return false;
}
