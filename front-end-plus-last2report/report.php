<!DOCTYPE html>
<html>
<head></head>

<body>





<h1>View reports</h1>
    <form id = 'fstep3' method = 'post'> 
           <div class="field">
                <select name="ptype" id="ptype" >
                <option value="">Select Report type:</option>
                <option value="Top 25 manufacturer">Top 25 manufacturer</option>
				<option value="Manufacturer/model search">Manufacturer/model search</option>
				<option value="Heating/cooling method details">Heating/cooling method details</option>
				<option value="Water heater statistics by state">Water heater statistics by state</option>
				<option value="OffGrid1">Off-the-grid household dashboard with state count</option>
                <option value="OffGrid2">Off-the-grid household details with BatteryStorageCapacity</option>
                <option value="OffGrid3">Off-the-grid household details with WaterHeaterCapacity</option>
                <option value="OffGrid4">Off-the-grid household details with SolarPanelCapacity</option>
				<option value="radius">Household averages by radius</option>		
                </select>
            </div>
			<input type='submit' class="next-2 next" value = 'Submit'>
    </form>		

<?php

/*if($_REQUEST['manu']){
$query = "select * from appliance where manufacturer = '".$_REQUEST['manu']."' order by id desc";
$res = mysqli_query($conn,$query);
$arows = mysqli_num_rows($res);
echo "<h1>You are viewing ".$_REQUEST['manu']." details</h1>";
echo "<table border = 1 width = '80%'><tr>
<td>Appliance#</td>
<td>Type</td>
<td>Model</td>
</tr>";
$i = 1;
while($v = mysqli_fetch_array($res)){
echo "<tr>
<td>".$i++."</td>
<td>".$v['appliance_type']."</td>
<td>".$v['model']."</td>
</tr>";


}
echo "</table>";
echo "<p><a href = '?step=report&report_type=top25'>Back</a></p>";
}

else if($_REQUEST['report_type'] == 'top25'){

    $query = "select manufacturer,count(*) as cnt from appliance group by manufacturer order by cnt desc limit 25 ";
    $res = mysqli_query($conn,$query);
    if (mysqli_error($conn))
    {
        die("report failed: " . mysqli_error($conn));
    }
    echo "<h1>Top 25 Manufacturers</h1>";
    echo "<table border = 1 width = '80%'>
    <tr><td>Manufacturer</td><td>Count</td></tr>
    ";
    while($v = mysqli_fetch_array($res)){
    echo "<tr>
    <td><a href = '?step=report&manu=".$v['manufacturer']."'>".$v['manufacturer']."</a></td>
    <td><a href = '?step=report&manu=".$v['manufacturer']."'>".$v['cnt']."</a></td></tr>";
    }
    echo "</table>";
    echo 
    "<p><a href = '?'>Home</a></p>";
}*/

/* Display state name along with count of most off-the-grid households in that state */
//echo $_REQUEST['ptype'];
if ($_REQUEST['ptype'] == 'OffGrid1') {
    $query1 = "Select State, count_of_houses
                From 
                (
                Select P.State, count(H.Email_Address) as count_of_houses
                From 
                `postal_code` AS P
                Inner join `household` AS H
                On H.PostalCode = P.PostalCode
                left  join `public_utilites` UT
                On H.Email_Address = UT.Email_Address
                Where H.Email_Address NOT IN (select  UT.Email_Address 
                                            from `public_utilites` UT
                                            where H.Email_Address=UT.Email_Address)
                                                Group by P.State
			) as X 
            GROUP BY State
            ORDER BY count_of_houses DESC
            LIMIT 1;";
    
    $result1 = mysqli_query($conn, $query1, MYSQLI_USE_RESULT);
    echo "<table>";
    echo "<tr><th>State</th><th>Count</th></tr>";
    if ($result1) {
        while ($row1 = mysqli_fetch_row($result1)) {
            echo "<tr><td>".$row1[0]."</td><td>".$row1[1]."</td></tr>";

        }
        echo "</table>";
    }
}

/* Display Battery Storage Capacity */
if ($_REQUEST['ptype'] == 'OffGrid2') {
    $query2 = "SELECT ROUND(AVG(Battery_Storage_Capacity),0)
                        FROM `household` AS H 
                        LEFT JOIN `public_utilites` AS P
                        on H.Email_Address = P.Email_Address
                        LEFT JOIN `power_generator` PG
                        on H.Email_Address = PG.Email_Address
                        WHERE H.Email_Address NOT IN (select P.Email_Address 
                                                        from `public_utilites` AS P
                                                        WHERE P.Email_Address = H.Email_Address )
                        AND H.Email_Address IN (SELECT PG.Email_Address
                                                        FROM `power_generator` AS PG
                                                         WHERE PG.Email_Address = H.Email_Address)";
    
    
    $result2 = mysqli_query($conn, $query2, MYSQLI_USE_RESULT);

    echo "<table>";
    echo "<tr><th>StorageCapacity</th></tr>";
    if ($result2) {
        while ($row2 = mysqli_fetch_row($result2)) {
            echo "<tr><td>".$row2[0]."</td></tr>";

        }
        echo "</table>";
    }

}

/* AVERAGE WATER HEATER CAPACITY FOR ALL ON-GRID HOUSEHOLDS */

if ($_REQUEST['ptype'] == 'OffGrid3') {
    $query3 = "SELECT ROUND(AVG(Capacity),1)
		FROM Household AS H 
        LEFT JOIN public_utilites AS P
        on H.Email_Address = P.Email_Address
        LEFT JOIN water_heater AS WH
        on H.Email_Address = WH.Email_Address
       	WHERE  H.Email_Address IN (SELECT P.Email_Address
                               FROM public_utilites AS P
                               WHERE P.Email_Address = H.Email_Address)";

    $result3 = mysqli_query($conn, $query3, MYSQLI_USE_RESULT);

    echo "<table>";
    echo "<tr><th>Capacity</th></tr>";
    if ($result3) {
        while ($row3 = mysqli_fetch_row($result3)) {
            echo "<tr><td>".$row3[0]."</td></tr>";

        }
        echo "</table>";
    }
}

/* AVERAGE WATER HEATER CAPACITY FOR ALL OFF-GRID HOUSEHOLDS */
if ($_REQUEST['ptype'] == 'OffGrid4') {
    $query4 = " SELECT AVG(Capacity)
                FROM Household AS H 
                LEFT JOIN public_utilites AS P
                on H.Email_Address = P.Email_Address
                LEFT JOIN water_heater AS WH
                on H.Email_Address = WH.Email_Address
                WHERE  H.Email_Address NOT IN (SELECT P.Email_Address
                                    FROM public_utilites AS P
                                    WHERE P.Email_Address = H.Email_Address)";
    $result4 = mysqli_query($conn, $query4, MYSQLI_USE_RESULT);

    echo "<table>";
    echo "<tr><th>Capacity</th></tr>";
    if ($result4) {
        while ($row4 = mysqli_fetch_row($result4)) {
            echo "<tr><td>".$row4[0]."</td></tr>";

        }
        echo "</table>";
    }
}

/* MIN, MAX, AVG BTU RATING FOR ALL APPLIANCES FOR ALL OFF-GRID HOUSEHOLDS */
if ($_REQUEST['ptype'] == 'OffGrid4') {
    $query4 =  "SELECT Appliance_Type,  ROUND( MIN(BTU_Rating),0),ROUND( MAX(BTU_Rating),0), ROUND(AVG(BTU_Rating),0)
                From household AS H
                LEFT JOIN appliance A
                on H.Email_Address = A.Email_Address
                LEFT JOIN public_utilites P
                on H.Email_Address = P.Email_Address

                WHERE H.Email_Address NOT IN (select P.Email_Address 
                                                from public_utilites AS P
                                                WHERE H.Email_Address = P.Email_Address)
    Group by Appliance_Type";

    $result4 = mysqli_query($conn, $query4, MYSQLI_USE_RESULT);

    echo "<table>";
    echo "<tr><th>Appliance_Type</th><th>MIN</th><th>MAX</th><th>AVG</th></tr>";
    if ($result5) {
        while ($row5 = mysqli_fetch_row($result4)) {
            echo "<tr><td>".$row5[0]."</td><td>".$row5[1]."</td><td>".$row5[2]."</td><td>".$row5[3]."</td></tr>";

        }
        echo "</table>";
    }

}

/* percent contrubution of each generation type for all off-grid households */
if ($_REQUEST['ptype'] == 'OffGrid5') {
    $query5 =  "SELECT PG.Generation_Type, H.Email_Address,  (PG.Average_Monthly_KWpH * 100/ (SELECT SUM(Average_Monthly_KWpH) over (partition by Generation_Type) FROM power_generator )) AS PercentContributionOfEachGenerationType
		FROM household AS H 
        LEFT JOIN power_generator AS PG 
        ON H.Email_Address = PG.Email_Address
        LEFT JOIN public_utilites AS P
        on H.Email_Address = P.Email_Address
                              
		WHERE PG.Generation_Type IN ('Wind', 'Solar-Electric')
		AND (H.Email_Address NOT IN (select P.Email_Address 
                                            from public_utilites
                                            WHERE H.Email_Address = P.Email_Address))
        GROUP BY Generation_Type , Email_Address";

    $result6 = mysqli_query($conn, $query6, MYSQLI_USE_RESULT);

    echo "<table>";
    echo "<tr><th>Generation_Type</th><th>Email_Address</th><th>PercentContributionOfEachGenerationType</th></tr>";
    if ($result6) {
        while ($row6 = mysqli_fetch_row($result6)) {
            echo "<tr><td>".$row6[0]."</td><td>".$row6[1]."</td><td>".$row6[2]."</td></tr>";

        }
        echo "</table>";
    }
}

if ($_REQUEST['ptype'] == 'radius') {
    header("Location: radius1.php");
    die();
}
?>


    </body>
    </html>