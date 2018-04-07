<?php 

function br() {
    return "<br/>\r\n";
}

function hr() {
    return "<hr/>\r\n";
}

function strong($var) {
    return "<strong>". $var . "</strong>";
}

function echoWithBreak ($var) {
    echo $var . br();
}