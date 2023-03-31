<!DOCTYPE html>
<html>
    <head>
        <body>

                <?php

            $name = $email = $number = $gender = $age = " ";

            if ($_SERVER["REQUEST_METHOD"]=="POST") {
                $name = test_input($_POST["name"]);
                $email = test_input($_POST["email"]);
                $number = test_input($_POST["number"]);
                $gender = test_input($_POST["gender"]);
                
            }

            function test_input($data) {
                $data = trim($data);
                $data = stripcslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            ?>

            <h2>Form Validation</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Name: <input type="text" name="name">
            <br> <br>
            Email: <input type="text" name="email">
            <br> <br>
            Number: <input type="number" name="number">
            <br> <br>
            Gender: 
            <input type="radio" name="gender" value="female">Female
            <input type="radio" name="gender" value="male">Male
            <br> <br>
            <input type="submit" name="click" value="click">


            <?php
            $connection = mysqli_connect("localhost", "root", "", "sample");
            if (!$connection){
                die("connection failed: " .mysqli_connect_error());
            }

            echo "connected";
            
           
                $query = "INSERT INTO sampleinfo(Name, Email, Number, Gender) values ('$name', '$email', '$number', '$gender')";
                if(mysqli_query($connection, $query)){
                    echo "record inserted";
                }
                
                else {
                    echo "<p>Insertion Failed <br/> Some Fields are Blank....!!</p>" .mysqli_error($connection); 
                }

            
            $close = mysqli_close($connection);

            if ($close){
                echo "connection closed";
            }
            else{
                echo "error " .mysqli_error($connection);
            }
            ?>
            </form>

            

           
        </body>
</html>