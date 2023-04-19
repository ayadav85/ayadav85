<?php
 $servername = "localhost:3306";
 $username = "root";
 $password = "Aky@4939552e";
 $conn = mysqli_connect($servername, $username, $password,'cs6400_db23_team072');
 if (!$conn)
 {
   die("Connection failed: " . mysqli_connect_error());
 }
if($_REQUEST['delapp']){
    $query = "delete from appliance where id = '".$_REQUEST['delapp']."'  ";
    mysqli_query($conn,$query);
    if (mysqli_error($conn))
    {
        die("delet failed: " . mysqli_error($conn));
    }

}
if($_REQUEST['delpower']){
    $query = "delete from power where id = '".$_REQUEST['delpower']."'  ";
    mysqli_query($conn,$query);
    if (mysqli_error($conn))
    {
        die("delet failed: " . mysqli_error($conn));
    }

}
if($_POST['action'] == 'household'){

    $query = "insert into household (email,
    pincode,
    hometype,
    footage,
    heating,
    noheat,
    colling,
    nocolling,
    uelectric,
    ugas,
    usteam,
    ufuel
    )values (
        '".$_POST['email']."',
        '".$_POST['pincode']."',
        '".$_POST['hometype']."',
        '".$_POST['footage']."',
        '".$_POST['heating']."',
        '".$_POST['noheat']."',
        '".$_POST['colling']."',
        '".$_POST['nocolling']."',
        '".$_POST['uelectric']."',
        '".$_POST['ugas']."',
        '".$_POST['usteam']."',
        '".$_POST['ufuel']."'
           
    )";
    mysqli_query($conn,$query);
    if (mysqli_error($conn))
    {
        die("household insertion failed: " . mysqli_error($conn));
    }

}
if($_POST['action'] == 'appliance'){
 
    $query = "insert into appliance (appliance_type,
    manufacturer,
    model,
    aircondition,
    heater,
    heatpump,
    energyratio,
    energysource,
    energysource2,
    capacity,
    btu,
    temperature) values (
            '".$_POST['appliance_type']."',
            '".$_POST['manufacturer']."',
            '".$_POST['model']."',
            '".$_POST['aircondition']."',
            '".$_POST['heater']."',
            '".$_POST['heatpump']."',
            '".$_POST['energyratio']."',
            '".$_POST['energysource']."',
            '".$_POST['energysource2']."',
            '".$_POST['capacity']."',
            '".$_POST['btu']."',
            '".$_POST['temperature']."'
    )";
    mysqli_query($conn,$query);
    if (mysqli_error($conn))
    {
        echo $query;
        die("household insertion failed: " . mysqli_error($conn));
    }

}
if($_POST['action'] == 'powergeneration'){
    $query = "insert into power (ptype,
    mkwh,
    skwh
    ) values (
            '".$_POST['ptype']."',
            '".$_POST['mkwh']."',
            '".$_POST['skwh']."'
    )";
    mysqli_query($conn,$query);
    if (mysqli_error($conn))
    {
        echo $query;
        die("household insertion failed: " . mysqli_error($conn));
    }

}
?>