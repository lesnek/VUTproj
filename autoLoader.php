<?php
/**
 * @param $trida
 */
function autoLoader($trida) {
    $require = "tridy/$trida.php";
    /** @var string */
    require($require);
}
spl_autoload_register("autoLoader");