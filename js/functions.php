<?php
if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    switch($action) {
        case 'getd' : $result = glob('../discs/*');
                        print_r($result);;break;
        case 'blah' : blah();break;
        // ...etc...
    }
}
?>

