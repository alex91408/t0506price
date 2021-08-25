<?php
function dd($variable)
{
    echo '<pre>';
    // die(var_export($variable));
    //var_dump($variable);
    //var_export($variable);
    print_r($variable);
    echo '</pre>';
}
