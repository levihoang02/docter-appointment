<?php
function sendEmail($to, $subject, $body)
{
    if (mail($to, $subject, $body)) {
        return true;
    } else {
        return false;
    }
}
?>