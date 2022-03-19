<?php

namespace Permission;

class AdminPermission
{
    public function __construct()
    {
        session_start();
    }

    /**
     * Admin panel permission manager
     */
    function permissionAdmin()
    {
        if (isset($_SESSION["isLogged"])  && isset($_SESSION["isAdmin"])) {
            header("location: /");
            die();
        } else {
            header("location: login.php");
            die();
        }
    }
}