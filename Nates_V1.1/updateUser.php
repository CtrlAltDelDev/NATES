<?php
global $dbc;
include("includes/header.php");
include("includes/nav.php");
include_once("db/dbconnect.php");

if (isset($_GET['userId'])) {
    $getRecordsQuery = $dbc->prepare("SELECT * FROM `userTable` WHERE userId = :userId");
    $getRecordsQuery->bindParam(':userId', $_GET['userId']);
    $getRecordsQuery->execute();

    echo '<main>';
    if (isset($_GET['error'])) {
        echo "<section>" . $_GET['error'] . "</section>";
    }
    echo "    <form method='post' action='" . $_SERVER['PHP_SELF'] . "'>";
    include("includes/adminNav.php"); // fieldset // legend // nav area

    while ($row = $getRecordsQuery->fetch()) {
        echo "            <label for='firstName'>First Name</label>";
        echo "            <input type='text' name='firstName' id='firstName' value='" . htmlspecialchars($row['firstName']) . "'>";

        echo "            <label for='lastName'>Last Name</label>";
        echo "            <input type='text' name='lastName' id='lastName' value='" . htmlspecialchars($row['lastName']) . "'>";

        echo "            <label for='phone'>Phone Number</label>";
        echo "            <input type='text' name='phone' id='phone' value='" . htmlspecialchars($row['phone']) . "'>";

        echo "            <label for='email'>Email</label>";
        echo "            <input type='text' name='email' id='email' value='" . htmlspecialchars($row['email']) . "'>";

        echo "            <label for='password'>Password</label>";
        echo "            <input type='password' name='password' id='password' value=''>";

        echo "            <label for='Role'>User Role</label>";
        echo "            <select name='Role' id='Role'>";
        if ($row['Role'] == 'Admin') {
            echo "                <option value='Admin' selected>Admin</option>";
            echo "                <option value='User'>User</option>";
        } else {
            echo "                <option value='User' selected>User</option>";
            echo "                <option value='Admin'>Admin</option>";
        }
        echo "            </select>";
    }
    echo "            <input type='hidden' name='userId' value='" . $_GET['userId'] . "'>";
    echo "            <input type='submit' value='Update User'>";
    echo "        </fieldset>";
    echo "    </form>";
    echo "</main>";
}

elseif (isset($_POST['userId'])) {
    $error = array();
    $data = array();

    if (!empty($_POST["firstName"])) {
        $data["firstName"] = $_POST["firstName"];
    } else {
        $error["firstName"] = "First name is required";
    }

    if (!empty($_POST["lastName"])) {
        $data["lastName"] = $_POST["lastName"];
    } else {
        $error["lastName"] = "Last name is required";
    }

    if (!empty($_POST["email"])) {
        $data["email"] = $_POST["email"];
    } else {
        $error["email"] = "Email is required";
    }

    if (!empty($_POST["password"])) {
        $data["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
    } else {
        unset($data["password"]);
    }

    if (!empty($_POST["phone"])) {
        $data["phone"] = $_POST["phone"];
    } else {
        $error["phone"] = "Phone is required";
    }

    if (!empty($_POST["Role"])) {
        $data["Role"] = $_POST["Role"];
    } else {
        $error["Role"] = "Role is required";
    }

    $data['userId'] = $_POST['userId'];
    if (empty($error)) {
        $updatequery = $dbc->prepare("
            UPDATE userTable 
            SET firstName = :firstName, 
                lastName = :lastName, 
                phone = :phone, 
                email = :email, 
                Role = :Role
            WHERE userId = :userId
        ");

        if (!empty($data["password"])) {
            $updatequery = $dbc->prepare("
                UPDATE userTable 
                SET firstName = :firstName, 
                    lastName = :lastName, 
                    phone = :phone, 
                    email = :email, 
                    password = :password, 
                    Role = :Role
                WHERE userId = :userId
            ");
        }

        // Debugging: Check what data is being passed
        // print_r($data); // Comment out this line after debugging

        $updatequery->execute($data);
        header("Location: success.php");
    } else {
        $message = "<ul>";
        foreach ($error as $value) {
            $message .= "<li>$value</li>";
        }
        $message .= "</ul>";
        $message = urlencode($message);

        header("Location: " . $_SERVER['PHP_SELF'] . "?error=$message&userId=" . $_POST['userId']);
    }
} else {
    header("Location: addUser.php");
}

include("includes/footer.php");
?>
