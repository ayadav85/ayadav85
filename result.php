<?php

            echo 'Name'.' '. 'Email'.' '.'Number'.' '.'Gender'.'<br>';

            $connection = mysqli_connect("localhost", "root", "", "sample");

            if (!$connection){
                die("connection failed: " .mysqli_connect_error());
            }

            echo "connected <br> <br>";
            
           
            $query = "SELECT * FROM `sampleinfo`";

                $result = mysqli_query($connection, "SELECT * FROM sampleinfo", MYSQLI_USE_RESULT);
                if ($result) {
                    while ($row = mysqli_fetch_row($result)) {
                       echo("Name: ".$row[0]."\n");
                       echo "<br><br>";
                       echo("Email: ".$row[1]."\n");
                       echo "<br><br>";
                       print("Number: ".$row[2]."\n");
                       echo "<br><br>";
                       print("Gender: ".$row[3]."\n");
                       echo "<br><br>";
                    }
                 }
              
                 //Closing the connection
                 mysqli_close($connection);
                
?>