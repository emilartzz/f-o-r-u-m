<!DOCTYPE html>
            <html lang="sv">
           
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>OK</title>
           
                    <!-- Link CSS -->
               <link rel="stylesheet" href="../css/main.css">
               <link rel="stylesheet" href="../css/admin.css">
           
               <!-- Link Fonts -->
               <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
           
            </head>
           
            <body>

            <a class="admin_user_change_back_button" href="../admin.php">Back</a>
           
            <div class="admin_edit_user_info">
           
            <form action="submit_userchanges.php" method="post" onSubmit="return confirm('Confirm changes.')">
           
            <h4>Edit user</h4>
            <p>Change the info you want</p>
 
 <?php 
 /* KOLLAR OM EDIT USER BUTTON IS CLICKED */
 if (isset($_GET['a_edit_user'])) {

    

    session_start();
    /* KOLLAR SÅ MAN ÄR ADMIN */
    if ($_SESSION['uRole'] != 1) {
        header('Location: ../dashboard.php'); 
    }
 
    require "db_conn.php";
    /* KOLLAR USER ID FRÅN FÖRRA FORM */
    $uID = $_GET['admin_select_user'];
    /* KOLLAR OM NÅGOT ÄR TOMT */
    if (empty($uID)){
        header("Location: ../admin.php?error=emptyFields&uid=" . $uName);
        exit();
    }
    else {
        /* SELECT USER DÄR UID = $UID */
            $sql = "SELECT uID, uFName, uLName, uName, uMail, uAdress, uPhone, uPass, uRole FROM forumusers WHERE uID=$uID";
            $result = $conn->query($sql);
            /* SKRIVER UT ALLT SOM HITTATS */
            if ($result->num_rows > 0) {

                $row = $result->fetch_assoc();

            $_SESSION['auID'] = $row['uID'];
            $_SESSION['auName'] = $row['uName'];
            echo '<input class="aflname" type="text" name="auFName" id="FName" placeholder="First name" required value="' . $row["uFName"] . '">';
            echo '<input class="aflname" type="text" name="auLName" id="LName" placeholder="Last name" style="margin-left: 4px;" required value="' . $row["uLName"] . '">';
            echo '<input type="text" name="auName" id="aName" placeholder="Username" required value="' . $row["uName"] . '">';
            echo '<input type="email" name="auMail" id="aMail" placeholder="forum@example.com" required value="' . $row["uMail"] . '">';
            echo '<input type="text" name="auAdress" id="aAdress" placeholder="Adress" required value="' . $row["uAdress"] . '">';
            echo '<input type="tel" name="auPhone" id="aPhone" placeholder="+46123456789" required value="' . $row["uPhone"] . '">';

            echo '<select name="aRole" id="aRole">';
            switch ($row['uRole']) {
                case '1':
                    echo'
                    <option value="0">[Member]</option>
                    <option value="1" selected="selected">[Admin]</option>
                    <option value="2">[Developer]</option>
                    ';
                    break;
                case '2':
                    echo'
                    <option value="0">[Member]</option>
                    <option value="1">[Admin]</option>
                    <option value="2" selected="selected">[Developer]</option>
                    ';
                    break;
                
                default:
                    echo'
                    <option value="0">[Member]</option>
                    <option value="1">[Admin]</option>
                    <option value="2">[Developer]</option>
                    ';
                    break;
            }
            /* SKICKAR TILL NÄSTA SIDA SOM SPARAR ALLT */
        echo'
         </select>
         <button type="submit" name="admin_submit_userchanges" style="display: block;">Confirm</button>


     </form>

     <img src="../img/admin/admin_edit_user_illustration.svg" alt="Register illustration">

 </div>

</body>

</html>';

        }
    }
}
 
 ?>
 <!-- $row["uRole"] -->
