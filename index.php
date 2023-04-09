<?php

    session_start();
    $msg = "";
    if(isset($_SESSION['msg'])){
        $msg = $_SESSION['msg'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
    <title>Multistep Form</title>
</head>
<body onload="showTab(current);hideMsg();">
<?php

    if($msg == "done"){
    echo "<div id='msg' class='msg'>
            <p>You have registered successfully!</p>
          </div>";
    }

?>
    <div id="container" class="container">
        
        <form id="regForm" method="post" action="process.php">
            <ul id="progressbar">
                <li class="active" id="account">Household Info</li>
                <li id="address">Appliances</li>
                <li id="personal">Power Generation</li>
                <li id="contact">Done</li>
            </ul>
            <div class="tab">
                <label>Email</label>
                <input type="text" name="email" placeholder="Enter Email" oninput="this.className=''">
                
                <label>Postal</label>
                <input type="number" name="postal" placeholder="Enter Postal" oninput="this.className=''">
                
                <label>HomeType</label>
                <select name="hometype" id="hometype" placeholder="Select HomeType" oninput="this.className=''">
                    <option value="">--- Choose HomeType ---</option>
                    <option value="house">House</option>
                    <option value="apartment">Apartment</option>
                    <option value="flat">Flat</option>
                </select>

                <label>Household Size</label>
                <input type="number" name="footage" placeholder="SquareFootage" oninput="this.className=''">
                
                <level>Select PublicUtilities</level>
                <input type="checkbox" name='lang[]' value="electric"> 
                <label for="utilities-electricity">Electricity</label>
                <input type="checkbox" name='lang[]' value="gas">
                <label for="utilities-gas">Gas</label>
                <input type="checkbox" name='lang[]' value="fuel"> 
                <label for="utilities-gas">Fuel</label>
                <input type="checkbox" name='lang[]' value="steam"> 
                <label for="utilities-gas">Steam</label>

                
                <label>Heating:</label>
                <input type="checkbox" id="checkbox" name="checkbox" value="1">
                <input type="number" id="number" name="number" min="0" max="100" value="0">
                <label>Cooling:</label>
                <input type="checkbox" id="checkbox" name="checkbox" value="1">
                <input type="number" id="number" name="number" min="0" max="100" value="0">
            </div>    
            

            <div class="tab">
            <label>Email</label>
                <input type="text" name="email" placeholder="Enter Email" oninput="this.className=''">
                
                <label>Postal</label>
                <input type="number" name="postal" placeholder="Enter Postal" oninput="this.className=''">
                
                <label>HomeType</label>
                <select name="hometype" id="hometype" placeholder="Select HomeType" oninput="this.className=''">
                    <option value="">--- Choose HomeType ---</option>
                    <option value="house">House</option>
                    <option value="apartment">Apartment</option>
                    <option value="flat">Flat</option>
                </select>

                <label>Household Size</label>
                <input type="number" name="footage" placeholder="SquareFootage" oninput="this.className=''">
                
                <level>Select PublicUtilities</level>
                <input type="checkbox" name='lang[]' value="electric"> 
                <label for="utilities-electricity">Electricity</label>
                <input type="checkbox" name='lang[]' value="gas">
                <label for="utilities-gas">Gas</label>
                <input type="checkbox" name='lang[]' value="fuel"> 
                <label for="utilities-gas">Fuel</label>
                <input type="checkbox" name='lang[]' value="steam"> 
                <label for="utilities-gas">Steam</label>

                
                <label>Heating:</label>
                <input type="checkbox" id="checkbox" name="checkbox" value="1">
                <input type="number" id="number" name="number" min="0" max="100" value="0">
                <label>Cooling:</label>
                <input type="checkbox" id="checkbox" name="checkbox" value="1">
                <input type="number" id="number" name="number" min="0" max="100" value="0">
                
            </div>

            <div class="tab">
            <label>Email</label>
                <input type="text" name="email" placeholder="Enter Email" oninput="this.className=''">
                
                <label>Postal</label>
                <input type="number" name="postal" placeholder="Enter Postal" oninput="this.className=''">
                
                <label>HomeType</label>
                <select name="hometype" id="hometype" placeholder="Select HomeType" oninput="this.className=''">
                    <option value="">--- Choose HomeType ---</option>
                    <option value="house">House</option>
                    <option value="apartment">Apartment</option>
                    <option value="flat">Flat</option>
                </select>

                <label>Household Size</label>
                <input type="number" name="footage" placeholder="SquareFootage" oninput="this.className=''">
                
                <level>Select PublicUtilities</level>
                <input type="checkbox" name='lang[]' value="electric"> 
                <label for="utilities-electricity">Electricity</label>
                <input type="checkbox" name='lang[]' value="gas">
                <label for="utilities-gas">Gas</label>
                <input type="checkbox" name='lang[]' value="fuel"> 
                <label for="utilities-gas">Fuel</label>
                <input type="checkbox" name='lang[]' value="steam"> 
                <label for="utilities-gas">Steam</label>

                
                <label>Heating:</label>
                <input type="checkbox" id="checkbox" name="checkbox" value="1">
                <input type="number" id="number" name="number" min="0" max="100" value="0">
                <label>Cooling:</label>
                <input type="checkbox" id="checkbox" name="checkbox" value="1">
                <input type="number" id="number" name="number" min="0" max="100" value="0">
            </div>

            <div class="tab">
            <label>Email</label>
                <input type="text" name="email" placeholder="Enter Email" oninput="this.className=''">
                
                <label>Postal</label>
                <input type="number" name="postal" placeholder="Enter Postal" oninput="this.className=''">
                
                <label>HomeType</label>
                <select name="hometype" id="hometype" placeholder="Select HomeType" oninput="this.className=''">
                    <option value="">--- Choose HomeType ---</option>
                    <option value="house">House</option>
                    <option value="apartment">Apartment</option>
                    <option value="flat">Flat</option>
                </select>

                <label>Household Size</label>
                <input type="number" name="footage" placeholder="SquareFootage" oninput="this.className=''">
                
                <level>Select PublicUtilities</level>
                <input type="checkbox" name='lang[]' value="electric"> 
                <label for="utilities-electricity">Electricity</label>
                <input type="checkbox" name='lang[]' value="gas">
                <label for="utilities-gas">Gas</label>
                <input type="checkbox" name='lang[]' value="fuel"> 
                <label for="utilities-gas">Fuel</label>
                <input type="checkbox" name='lang[]' value="steam"> 
                <label for="utilities-gas">Steam</label>

                
                <label>Heating:</label>
                <input type="checkbox" id="checkbox" name="checkbox" value="1">
                <input type="number" id="number" name="number" min="0" max="100" value="0">
                <label>Cooling:</label>
                <input type="checkbox" id="checkbox" name="checkbox" value="1">
                <input type="number" id="number" name="number" min="0" max="100" value="0">
            </div>
            
            <div style="overflow: hidden;">
                <div style="float: right;">
                    <button onclick="nextPrev(-1);" type="button" id="prev">Previous</button>
                    <button onclick="nextPrev(1);" type="button" id="next">Next</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>