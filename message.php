<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = strip_tags($_POST['email']);
    $name = strip_tags($_POST['name']);
    $err = false;
    $msg = "Dear ".$name.", \n Thank you for your enquiry.\n \n  We will get back to you within the next 3 business days \n \n In case you want to amend an existing order, please send an email to this mailbox: abracadabra@cara.com  \n Thank you, \n Cara ";
    mail($email,"Thank you for your enquiry",$msg);

    echo "<script> location.href='index.php'</script>";
}


?>