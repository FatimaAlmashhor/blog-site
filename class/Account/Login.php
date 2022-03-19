<?php

namespace Account;

require_once __DIR__ . "/../../vendor/autoload.php";

use Database\DBConnection;
use PDO;

/**
 * Class Login
 */
class Login
{
    private string $email;
    private string $password;
    private int $userId;
    private string $isAdmin;

    /**
     * Login constructor.
     * @param string $email
     * @param string $password
     */
    public function __construct(string $email, string $password)
    {
        $this->email = trim($email);
        $this->password = trim($password);
    }

    /**
     * Login the user
     * @return void
     */
    public function loginUser()
    {
        $this->verifyStandard();
        $this->verifyPassword();
        // save the user
        session_start();
        $_SESSION["isLogged"] = true;
        $_SESSION["email"] = $this->email;
        $_SESSION["id"] = $this->userId;
        $_SESSION["isAdmin"] = $this->isAdmin;
    }

    /**
     * Verify Standard
     * @return void
     */
    private function verifyStandard()
    {
        // Review the data
        if (empty($this->email) || empty($this->password)) {
            header("location: login.php?error=1");
            die();
        }
    }
    public static function printError(int $error)
    {
        $errorMessage = "";
        switch ($error) {
            case 1:
                $errorMessage = "Eamil and Password cloud not be empty";
                break;
            case 2:
                $errorMessage = "User not exist";
                break;
            case 3:
                $errorMessage = "Password not correct";
                break;
        }
?>
<div class="pt-3 pb-3 text-center text-red-400 bg-danger w-100 h-auto">
    <small><?php echo $errorMessage; ?></small>
</div>
<?php
    }
    /**
     * Verify the password
     * @return void
     */
    private function verifyPassword()
    {
        // Create database connection
        $db = new DBConnection();
        // Send query
        $db->query("SELECT `auth_id`, `auth_password`, `auth_type` FROM `auth` WHERE auth_email=:email");
        $db->bind(":email", $this->email, PDO::PARAM_STR);
        $db->execute();
        $result = $db->fetch();
        // Check the user is found or not
        if ($db->rowCount() !== 1) {
            header("location: login.php?error=2");
            die();
        }
        if (password_verify($this->password, $result->auth_password)) {
            $this->userId = intval($result->auth_id);
            $this->isAdmin = $result->auth_type;
            if ($this->isAdmin == 0) {
                header('location: ./admin');
            } else {
                header('location: ./');
            }
        } else {
            header("location: login.php?error=3");
            die();
        }
    }
}