<?php

namespace Account;


use Database\DBConnection;
use PDO;

class Register
{
    private string $username;
    private string $email;
    private string $password;
    private string $passwordConfirm;
    private string $passwordHash;
    private string $baseUri;

    
    function __construct(string $username, string $email, string $password, string $passwordConfirm, string $baseUri)
    {
        $this->username = trim($username);
        $this->email = trim($email);
        $this->password = trim($password);
        $this->passwordConfirm = trim($passwordConfirm);
        $this->passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $this->baseUri = $baseUri;
    }

    //  error pallet 
    public static function printError(int $error): void
    {
        $errorMessage = "";
        switch ($error) {
            case 1:
                $errorMessage = "Username field is empty";
                break;
            case 2:
                $errorMessage = "Username contains forbidden symbols (~!@#$%^&*()_+)";
                break;
            case 3:
                $errorMessage = "Passwords field is empty";
                break;
            case 4:
                $errorMessage = "Passwords does not match";
                break;
            case 6:
                $errorMessage = "Email not valid ";
                break;
            case 5:
                $errorMessage = "User exists";
                break;
        }
?>
<div class="pt-3 pb-3 text-center text-white bg-danger w-100 h-auto">
    <b><?php echo $errorMessage; ?></b>
</div>
<?php
    }


    function registerAdmin($admin)
    {
        $this->verifyStandard();
        $this->verifyDatabase();
        return $this->registerUserInDatabase($admin);
    }
    private function verifyStandard()
    {
        // Check the username is empty or not
        if (empty($this->username)) {
            header("location: /" . $this->baseUri . "?error=1");
            die();
        }
        // Check the username is contain forbidden symbols
        $banedSymbols = ["~", "!", "@", "#", "$", "%", "^", "&", "*", "_", "+", "."];
        foreach ($banedSymbols as $value) {
            if (strpos($this->username, $value)) {
                header("location: /" . $this->baseUri . "?error=2");
                die();
            }
        }
        // Check the password and passwordConfirm are empty or not
        if (empty($this->password) || empty($this->passwordConfirm)) {
            header("location: /" . $this->baseUri . "?error=3");
            die();
        }
        // Check the password and passwordConfirm to be equal
        if ($this->password !== $this->passwordConfirm) {
            header("location: /" . $this->baseUri . "?error=4");
            die();
        }
    }

    /**
     * Verify data with database
     * @return void
     */
    private function verifyDatabase()
    {
        // Create database connection
        $db = new DBConnection();
        // Send query to database
        $db->query("SELECT * FROM `auth` WHERE auth_name=:username");
        $db->bind(":username", $this->username, PDO::PARAM_STR);
        $db->execute();

        // Check how many user found
        if ($db->rowCount()) {
            header("location: /" . $this->baseUri . "?error=5");
            die();
        }
    }
    private function registerUserInDatabase($admin): bool
    {
        // Create database connection
        $db = new DBConnection();
        // Send query to database
        if (!$admin) {

            $db->query("INSERT INTO `auth`(`auth_name`, `auth_email`, `auth_password` , `auth_type`) VALUES (:username,:email, :hashpassword , 1)");
        } else {
            $db->query("INSERT INTO `auth`(`auth_name`, `auth_email`, `auth_password`,`auth_type`) VALUES (:username ,:email, :hashpassword , 0)");
        }
        $db->bind(":username", $this->username, PDO::PARAM_STR);
        $db->bind(":email", $this->email, PDO::PARAM_STR);
        $db->bind(":hashpassword", $this->passwordHash, PDO::PARAM_STR);
        if ($db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}