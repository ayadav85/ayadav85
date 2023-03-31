<!DOCTYPE html>
<html>
    <head>
        <style>
            .error {color: brown;}
        </style>
    </head>

    <body>

        <?php
        $nameErr = $emailErr = $numberErr = $genderErr = " ";
        $name = $email = $number = $gender = " ";
        
        if($_SERVER["REQUEST_METHOD"]=="POST") {
            if(empty($_POST["name"])) {
                $nameErr = "pls enter valid name";
            }
            else {
                $name = test_input($_POST["name"]);
                if(!preg_match("/^([a-zA-Z' ]+)$/", $name)){
                    $nameErr = "Only letters and white space allowed";
                }
            }
        

            if(empty($_POST["email"])) {
                $emailErr = "pls enter valid email";
            }
            else {
                $email = test_input($_POST["email"]);
                if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email)){
                    $emailErr = "pls input valid email";
                }
            }

            if(empty($_POST["number"])) {
                $numberErr = "pls enter valid number";
            }
            else {
                $number = test_input($_POST["number"]);
                if(!preg_match("/^[1-9][0-9]{0,15}$/", $number)){
                    $numberErr = "pls input valid number";
                }
            }

            if(empty($_POST["gender"])) {
                $genderErr = "Gender required";
            }
            else {
                $gender = test_input($_POST["gender"]);
            }

            $checkbox_value = isset($_POST['checkbox']) ? $_POST['checkbox'] : '';

            if ($checkbox_value == "heating") {
                $number_value = isset($_POST['number_hot']) ? $_POST['number_hot']:'0';
            }
            elseif ($checkbox_value == "cooling") {
                $number_value = isset($_POST['number_cool']) ? $_POST['number_cool']:'0';
            }
            else {
                echo "checkbox is unchecked";
            }
            
            
            if (!empty($_POST['utility'])) {
                foreach($_POST['utility'] as $selected);
                    
            }

            $selected_option = isset($_POST['hometype']) ? $_POST['hometype'] : '';


        }

        function test_input($data) {
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
            
        ?>

        <h2>PHP form validation </h2>
        <p><span class="error"> required field </span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

        Name: <input type="text" name="name">
        <span class="error"><?php echo $nameErr; ?></span>
        <br> <br>
        Email: <input type="text" name="email">
        <span class="error"><?php echo $emailErr; ?></span>
        <br> <br>
        Number: <input type="number" name="number">
        <span class="error"><?php echo $numberErr; ?></span>
        <br> <br>
        Gender: 
            <input type="radio" name="gender" value="female">Female
            <input type="radio" name="gender" value="male">Male
            <span class="error"><?php echo $genderErr; ?></span>
        <br> <br>
        PublicUtilities:
            <span>Select PublicUtilities</span><br/>
            <input type="checkbox" name='utility[]' value="electric"> Electric <br/>
            <input type="checkbox" name='utility[]' value="gas"> Gas <br/>
            <input type="checkbox" name='utility[]' value="fuel"> Fuel Oil <br/>
            <input type="checkbox" name='utility[]' value="steam"> Steam <br/>
        <br><br>
        HomeType: 
            <select name="hometype" id="hometype">
            <option value="">--- Choose HomeType ---</option>
            <option value="house">House</option>
            <option value="apartment">Apartment</option>
            <option value="flat">Flat</option>
            </select>
        <br><br>
        Heating/Cooling:
        <br> <br>
            <label for="checkbox">Heating:</label>
            <input type="checkbox" id="checkbox" name="checkbox" value="heating">

            <label for="number">Temp:</label>
            <input type="number" id="number" name="number_hot" min="0" max="100" value="0">
            <br> <br>
            <label for="checkbox">Cooling:</label>
            <input type="checkbox" id="checkbox" name="checkbox" value="cooling">

            <label for="number">Temp:</label>
            <input type="number" id="number" name="number_cool" min="0" max="100" value="0">

            <br> <br>
            <input type="submit" name="click" value="click">
        <br><br>

        </form>
        <?php
        echo "<h2>Your input</h2>";
        echo $name; 
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $number;
        echo "<br>";
        echo $gender;
        echo "<br>";
        echo $number_value;
        echo "<br>";
        echo $selected_option;
        echo "<br>";
        echo "<br>";
        echo $selected;



        ?>