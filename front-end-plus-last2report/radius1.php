<!DOCTYPE html>
    <html>
    <body>
        <form method="post">
            
            PostalCode:
            <input type="number" name="postal">
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

            if (!$connection){
                die("connection failed: " .mysqli_connect_error());
            }

            // select the latitude and longitude of the postal code
            $query1 = "SELECT Latitude, Longitude FROM `postal_code` WHERE PostalCode = $postal";

            $result1 = mysqli_query($connection, $query1, MYSQLI_USE_RESULT);
            if ($result1) {
                while ($row1 = mysqli_fetch_row($result1)) {
                    $latpoint   = $row1[0];
                    $longpoint  = $row1[1];
        
                }
            }
            else {
                echo "Error: " . $query1 . "<br>" . mysqli_error($connection);
            }

            $query2 = "SELECT PostalCode

				FROM (
					SELECT A.PostalCode,A.Latitude, A.Longitude, B.Radius,
      					B.distance_unit* DEGREES(ACOS(LEAST(1.0, COS(RADIANS(latpoint))
                 							* COS(RADIANS(Latitude))
                 							* COS(RADIANS(longpoint) - RADIANS(Longitude))
                 							+ SIN(RADIANS(latpoint))
                 							* SIN(RADIANS(Latitude))))) AS distance_in_km
					FROM `postal_code` as A
					JOIN (
						SELECT  $latpoint  AS latpoint,  $longpoint AS longpoint,
						$radius as Radius, 111.045 as distance_unit
					) AS B
   
					where A.Latitude
					BETWEEN B.latpoint - (B.Radius / B.distance_unit)
        				AND B.latpoint  + (B.Radius / B.distance_unit)
					AND A.Longitude
					BETWEEN B.longpoint - (B.Radius / (B.distance_unit * COS(RADIANS(B.latpoint))))
         				AND B.longpoint + (B.Radius / (B.distance_unit * COS(RADIANS(B.latpoint))))

 					) as X
			WHERE distance_in_km <= Radius
			ORDER BY distance_in_km
			LIMIT 15";
            
            $result2 = mysqli_query($connection, $query2, MYSQLI_USE_RESULT);
            
            $postals = array();

            if ($result2) {
                while ($row = mysqli_fetch_row($result2)) {
                    $postals[] = $row[0];
                }
            }
            else {
                echo "Error in execution";
                }
            // convert postals into list of strings
            $postals = implode(",", $postals);
            echo $postals;

            /*// select all the household ids that are in the postal codes
            $query3 = "SELECT Email_Address, Household_Type, Heating, Cooling FROM `household` WHERE PostalCode IN ($postals)";

            $result3 = mysqli_query($connection, $query3, MYSQLI_USE_RESULT);

            if ($result3) {
                while ($row1 = mysqli_fetch_row($result3)) {
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
                } */

            // count the number of household that lies in given radius group by Postal Code

            $query4 = "SELECT count(Email_Address) as count_houses_by_postal FROM `household` WHERE PostalCode IN ($postals) group by PostalCode";

            $result4 = mysqli_query($connection, $query4, MYSQLI_USE_RESULT); 
            
            echo "<table>";
            echo "<tr><th>NumberOfHouses</th></tr>";
            if ($result4) {
            while ($row4 = mysqli_fetch_row($result4)) {
            echo "<tr><td>".$row4[0]."</td></tr>";

            }
            echo "</table>";
            }

            //-- count the number of household that lies in given radius group by Household Type
            $query5 = "SELECT count(Email_Address) as count_houses_by_type FROM `household` WHERE PostalCode IN ($postals) group by Household_Type";

            $result5 = mysqli_query($connection, $query5, MYSQLI_USE_RESULT);

            echo "<table>";
            echo "<tr><th>NumberOfHouses</th></tr>";
            if ($result5) {
            while ($row5 = mysqli_fetch_row($result5)) {
            echo "<tr><td>".$row5[0]."</td></tr>";

            }
            echo "</table>";
        }

        // average square footage of the households that lies within given postal codes
        $query6 = "SELECT ROUND(avg(Square_Footage),1) as avg_sqft FROM `household` WHERE PostalCode IN ($postals)";

        $result6 = mysqli_query($connection, $query6, MYSQLI_USE_RESULT);

        echo "<table>";
        echo "<tr><th>average square footage</th></tr>";
        if ($result6) {
            while ($row6 = mysqli_fetch_row($result6)) {
            echo "<tr><td>".$row6[0]."</td></tr>";

            }
            echo "</table>";
        }

        // AVERAGE HEATING TEMP WITHIN GIVEN POSTAL CODES
        $query7 = "SELECT ROUND(avg(Heating), 1) as avg_heating_temp FROM `household` WHERE PostalCode IN ($postals)";

        $result7 = mysqli_query($connection, $query7, MYSQLI_USE_RESULT);

        echo "<table>";
        echo "<tr><th>average heating temperature</th></tr>";
        if ($result7) {
            while ($row7 = mysqli_fetch_row($result7)) {
            echo "<tr><td>".$row7[0]."</td></tr>";

            }
            echo "</table>";
        }

        // AVERAGE COOLING TEMP WITHIN GIVEN POSTAL CODES
        $query8 = "SELECT ROUND(avg(Cooling), 1) as avg_cooling_temp FROM `household` WHERE PostalCode IN ($postals)";

        $result8 = mysqli_query($connection, $query8, MYSQLI_USE_RESULT);

        echo "<table>";
        echo "<tr><th>average cooling temperature</th></tr>";
        if ($result8) {
            while ($row8 = mysqli_fetch_row($result8)) {
            echo "<tr><td>".$row8[0]."</td></tr>";

            }
            echo "</table>";
        }

        //  COUNT OF OFF-GRID HOUSEHOLD
        $query9 = "SELECT count(Email_Address) as off_grid_houses FROM `household` AS H 
                                                    WHERE PostalCode IN ($postals) 
                                                    AND 
                                                    Email_Address NOT IN (SELECT Email_Address 
                                                                        FROM `public_utilites` AS U 
                                                                        WHERE H.Email_Address = U.Email_Address)";

        $result9 = mysqli_query($connection, $query9, MYSQLI_USE_RESULT);

        echo "<table>";
        echo "<tr><th>count of off-grid household</th></tr>";
        if ($result9) {
            while ($row9 = mysqli_fetch_row($result9)) {
            echo "<tr><td>".$row9[0]."</td></tr>";

            }
            echo "</table>";
        }

        // COUNT OF HOUSEHOLD WITH POWER GENERATION
        $query10 = "SELECT count(Email_Address) as count_houses_with_power_generation FROM `household` AS H 
        WHERE PostalCode IN ($postals) 
        AND 
        Email_Address IN (SELECT Email_Address 
                                    FROM `power_generator` AS PG 
                                    WHERE H.Email_Address = PG.Email_Address)";
        
        
                                    
        $result10 = mysqli_query($connection, $query10, MYSQLI_USE_RESULT);

        echo "<table>";
        echo "<tr><th>count of household with power generation</th></tr>";
        if ($result10) {
            while ($row10 = mysqli_fetch_row($result10)) {
            echo "<tr><td>".$row10[0]."</td></tr>";

            }
            echo "</table>";
        }

        // MOST COMMON POWER GENERATION TYPE
        $query11 = "SELECT COUNT(Generation_Type) as count_of_generation_type, Generation_Type  FROM `household` AS H
                                                inner join `power_generator` AS PG
                                                on H.Email_Address = PG.Email_Address
                                                WHERE PostalCode IN ($postals)
                                                AND 
                                                H.Email_Address IN ( SELECT Email_Address FROM `power_generator` AS PG
                                                                   WHERE H.Email_Address = PG.Email_Address)
                                                GROUP BY Generation_Type
                                                ORDER BY count_of_generation_type DESC";
        
        $result11 = mysqli_query($connection, $query11, MYSQLI_USE_RESULT);

        echo "<table>";
        echo "<tr><th>most common power generation type</th></tr>";
        if ($result11) {
            while ($row11 = mysqli_fetch_row($result11)) {
            echo "<tr><td>".$row11[0]."</td></tr>";

            }
            echo "</table>";
        }

        // AVERAGE MONTHLY POWER GENERATION
        $query12 = "SELECT avg(Average_Monthly_KWph) as avg_monthly_generation FROM `household` AS H 
        inner join `power_generator` AS PG
        on H.Email_Address = PG.Email_Address
        WHERE H.PostalCode IN ($postals)
        AND 
        H.Email_Address IN (SELECT Email_Address 
                                    FROM `power_generator` AS PG 
                                    WHERE H.Email_Address = PG.Email_Address)";
        $result12 = mysqli_query($connection, $query12, MYSQLI_USE_RESULT);

        echo "<table>";
        echo "<tr><th>average monthly power generation</th></tr>";
        if ($result12) {
            while ($row12 = mysqli_fetch_row($result12)) {
            echo "<tr><td>".$row12[0]."</td></tr>";

            }
            echo "</table>";
        }

        // COUNT OF HOUSEHOLD WITH BATTERY STORAGE
        $query11 = "SELECT COUNT(H.Email_Address) as count_houses_with_battery_storage FROM `household` AS H 
        WHERE H.PostalCode IN ($postals) 
        AND 
        H.Email_Address IN (SELECT PG.Email_Address 
                                    FROM `power_generator` AS PG 
                                    WHERE H.Email_Address = PG.Email_Address)
        GROUP BY Battery_Storage_Capacity";
        $result11 = mysqli_query($connection, $query11, MYSQLI_USE_RESULT);

        echo "<table>";
        echo "<tr><th>count of household with battery storage</th></tr>";
        if ($result11) {
            while ($row11 = mysqli_fetch_row($result11)) {
            echo "<tr><td>".$row11[0]."</td></tr>";

            }
            echo "</table>";
        }
        


        mysqli_close($connection);
        ?>

    </html>