<?php

function http_response(int $status, $data)
{
    http_response_code($status);

    if ($data) {
        echo json_encode($data);
    }
}
