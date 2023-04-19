<?php
$query = "select * from power order by id desc";
$res = mysqli_query($conn,$query);
$arows = mysqli_num_rows($res);
if($arows > 0 && $_REQUEST['action'] <> 'add'){
echo '<div class="title">Power generation
    <p>You have added these to your household</p>
    </div>';
echo "<table border = 1 width = '80%'>
    <tr>
    <td>Num</td>
    <td>Type</td>
    <td>Monthly kWh</td>
    <td>Battery kWh</td>
    <td></td>
    </tr>";
$i = 1;
while($v = mysqli_fetch_array($res)){
echo "<tr>
<td>".$i++."</td>
<td>".$v['ptype']."</td>
<td>".$v['mkwh']."</td>
<td>".$v['skwh']."</td>
<td>
<p><a href = '?step=power&delpower=".$v['id']."'>Delete</a></p>
</td>
</tr>";
}
echo "</table>";
echo "<p><a href = '?step=power&action=add'>Add more power</a></p>";
?><input type='button' class='next-2 next' onclick='location.href="?step=done"' value = 'Finish'><?php
}else{
?>
<form id = 'fstep3' action="?step=power" method = 'post'> 
          <div class="page">
            <div class="title">Add Power generation:
            <p>Please provide power generation details.</p>
            </div>
            <div class="field">
              <div class="label">Type:</div>
                <select name="ptype" id="ptype" >
                <option value="">Select Type</option>
                <option value="Solar-electric">Solar-electric</option>
                <option value="Wind">Wind</option>
                </select>
            </div>
            <div class="field" >
              <div class="label">Monthly kWh:</div>
              <input type="number" name ='mkwh' value = '' >
            </div>
            <div class="field">
              <div class="label">Storage kWh:</div>
              <input type="number" name ='skwh' value = ''>
            </div>
            <div class="field btns">
              <input type='button' onclick="location.href='?step=appliance'" value = 'Previous'>
              <input type='button' class="next-2 next" onclick="location.href='?step=done'" value  = 'Skip'>
              <input type='submit' class="next-2 next" value = 'Add'>
              <input type ='hidden' name ='action' value ='powergeneration'>
            </div>
          </div>
    </form>
    <?php } ?>