
<!DOCTYPE html>
<html>
    <head>
        <title>Form</title>
        <meta charset="utf-8">
    </head>

    <body>
        
        <form method="post">
            PostalCode: 
            <input type="number" name="postal">
            <br> <br>
            Radius: 
            <select name="radius" id="radius">
            <option value="">--- Select Radius ---</option>
            <option value="0">0</option>
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
            <option value="250">250</option>
            <option value="1000">1000</option>
            </select>
            <br> <br>
            <input type="submit" name="submit">
        </form>

        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST") {
                $postal = $_POST['postal'];
                $radius = $_POST['radius'];
            }
            
            $connection = mysqli_connect("localhost", "root", "Aky@4939552e", "cs6400_db23_team072");
            if(!$connection) {
                die("Connection failed: " . mysqli_connect_error());
            }


            $query = "SELECT Latitude, Longitude FROM `postal_code` WHERE PostalCode = $postal;";

            $query .= "SELECT PostalCode

				    FROM (
					SELECT A.PostalCode, B.Radius,
      					B.distance_unit* DEGREES(ACOS(LEAST(1.0, COS(RADIANS(latpoint))
                 							* COS(RADIANS($latpoint))
                 							* COS(RADIANS(longpoint) - RADIANS($longpoint))
                 							+ SIN(RADIANS(latpoint))
                 							* SIN(RADIANS($latpoint))))) AS distance_in_km
					FROM `postal_code` as A
					JOIN (
						SELECT  42.81  AS latpoint,  -70.81 AS longpoint,
						1000.0 as Radius, 111.045 as distance_unit
					) AS B
   
					where A.Latitude
					BETWEEN B.latpoint - (B.Radius / B.distance_unit)
        				AND B.latpoint  + (B.Radius / B.distance_unit)
					AND A.Longitude
					BETWEEN B.longpoint - (B.Radius / (B.distance_unit * COS(RADIANS(B.latpoint))))
         				AND B.longpoint + (B.Radius / (B.distance_unit * COS(RADIANS(B.latpoint))))

 					) as X
			WHERE distance_in_km <= Radius
			ORDER BY distance_in_km";

            if (mysqli_multi_query($connection, $query)) {
                do {
                    if ($result = mysqli_store_result($connection)) {
                        while ($row = mysqli_fetch_row($result)) {
                            $lat = $row[0];
                            $long = $row[1];
                        }
                        mysqli_free_result($result);
                    }
                } while (mysqli_next_result($connection));
            }


            $resultpoint = mysqli_query($connection, $queryForLatLongpoint, MYSQLI_USE_RESULT);

            if ($resultpoint) {
                while ($row = mysqli_fetch_row($resultpoint)) {
                    $latpoint = $row[0];
                    $longpoint = $row[1];
                }
            }

            else {
                echo "Error: " . $querylatpoint . "<br>" . mysqli_error($connection);
            } 

            

            
            // CODE TO SELECT POSTAL CODE WITHIN GIVEN RADIUS, LATPOINT AND LONGPOINT ARE THE LATITUDE AND LONGITUDE OF THE POSTAL CODE ENTERED BY THE USER

           

            $resultPostal = mysqli_query($connection, $queryPostal, MYSQLI_USE_RESULT);

            $postals = array();

            if ($resultPostal) {
                while ($row = mysqli_fetch_row($resultPostal)) {
                    $postals[] = $row[0];
                }
            }
            else {
                echo "Error in execution";
                }
            // convert postals into list of strings
            $postals = implode(",", $postals);

            // select all the household ids that are in the postal codes
            $query1 = "SELECT Email_Address, Household_Type, Heating, Cooling FROM `household` WHERE PostalCode IN ($postals)";

            $result1 = mysqli_query($connection, $query1, MYSQLI_USE_RESULT);

            if ($result1) {
                while ($row1 = mysqli_fetch_row($result1)) {
                    echo("Email_Address: ".$row1[0]."\n");
                    echo "<br><br>";

                    print("Household_Type: ".$row1[1]."\n");
                    echo "<br><br>";

                    print("Heating: ".$row1[2]."\n");
                    echo "<br><br>";

                    print("Cooling: ".$row1[3]."\n");
                    echo "<br><br>";
                }
            }
            else {
                echo "Error in execution";
                }

            mysqli_close($connection);

        ?>

    </body>
</html> 