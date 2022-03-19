<?php

use Account\Register;
// use Permission\AdminPermission ;

require_once __DIR__ . '/vendor/autoload.php';
include_once('./templates/navbar.php');
if (isset($_POST['register'])) {
    $username = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["cpassword"];
    $register = new Register($username, $email, $password, $passwordConfirm, "register.php");
    if ($register->registerAdmin(true)) {
        header("location: login.php");
        die();
    }
}


?><div class="  top-0 fixed mode w-screen h-screen flex justify-center items-center bg-black bg-opacity-60 z-50">
    <div class=" relative w-96 h-fil border-4 border-white p-3 rounded-md bg-white">
        <a href='payment.process.php?do=closeModel' style="top:-26px; left:-20px; " class=" absolute z-20 flex justify-center items-center overflow-hidden w-12 h-12
            cursor-pointer bg-red-400 hover:bg-red-300 p-2 rounded-full border-4 border-white transition-all">
            <ion-icon class="text-white font-bold" name="close-outline"></ion-icon>
        </a>
        <div class="flex w-full flex-col justify-center items-center ">
            <h2 class="text-2xl">Register</h2>
            <form class="flex flex-col w-full" action='register.php?type=admin' method="POST">
                <label for='email'>Full Name</label>
                <input class='p-2 my-1 border border-gray-400 rounded' type="text" name='fullname'
                    placeholder="Enter your full anme " required />
                <label for='email'>Email</label>
                <input class='p-2 my-1 border border-gray-400 rounded' type="email" name='email'
                    placeholder="Enter your email " required />
                <label for='password'>Password</label>
                <input class='p-2 my-1 border border-gray-400 rounded' type="password" name='password'
                    placeholder="Enter your password " required />
                <label for='cpassword'>Confirm Password</label>
                <input class='p-2 my-1 border border-gray-400 rounded' type="password" name='cpassword'
                    placeholder="Enter your password " required />
                <?php
                if (isset($_GET["error"])) {
                    $error = intval($_GET["error"]);
                    Account\Register::printError($error);
                }
                ?>
                <button class="my-2 p-2 rounded bg-blue-400 text-white" type="submit" name='register'> Regsiter</button>
            </form>
            <p>
                You do not have an account ?<a href='payment.process.php?do=loginModel' class="text-blue-400">
                    login
                </a>
            </p>
        </div>
    </div>
</div>
</body>


</html>