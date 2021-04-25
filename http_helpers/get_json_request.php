<?php

function get_json_request()
{
    $inputJSON = file_get_contents('php://input');
    $data = json_decode($inputJSON, TRUE);
    return $data;
}
