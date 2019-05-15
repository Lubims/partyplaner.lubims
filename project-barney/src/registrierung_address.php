<?php
header('Content-Type: application/json');
require_once('registrierung.php');

$aResult = array();

if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

if( isset($_POST['arguments']) ) { $aResult['error'] = 'Function arguments!'; }

if( !isset($aResult['error']) ) {

    switch($_POST['functionname']) {
        case 'registrierung':
           $aResult['result'] = registrierung();
           break;

        default:
           $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
           break;
    }

}

echo json_encode($aResult);

?>
