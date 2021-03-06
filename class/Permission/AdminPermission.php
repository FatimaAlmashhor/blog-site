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
        if ($_SESSION["isLogged"] == true  && $_SESSION["isAdmin"] == 0) {
            return true;
        } else {
            return false;
        }
    }
    function logout()
    {
        // $_SESSION["isLogged"] = false;
        unset($_SESSION["isLogged"]);
        unset($_SESSION["isAdmin"]);
    }
}