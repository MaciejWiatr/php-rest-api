<?php

class UserController extends BaseController
{
    public function get()
    {
        $response["message"] = "test";
        echo json_encode($response);
    }

    public function post()
    {
        echo "test";
    }
}
