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
            Email: 
            <input type="text" name="email">
            <br> <br>
            PostalCode: 
            <input type="number" name="number">
            <br> <br>
            HomeType: 
            <select name="hometype" id="hometype">
            <option value="">--- Choose HomeType ---</option>
            <option value="house">House</option>
            <option value="apartment">Apartment</option>
            <option value="flat">Flat</option>
            </select>
            <br> <br>
            SquareFootage:
            <input type="number" name="number">
            <br> <br>
            PublicUtilities:
            <span>Select PublicUtilities</span><br/>
            <input type="checkbox" name='lang[]' value="electric"> Electric <br/>
            <input type="checkbox" name='lang[]' value="gas"> Gas <br/>
            <input type="checkbox" name='lang[]' value="fuel"> Fuel Oil <br/>
            <input type="checkbox" name='lang[]' value="steam"> Steam <br/>





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