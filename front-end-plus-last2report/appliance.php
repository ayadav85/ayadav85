<?php
$query = "select * from appliance order by id desc";
$res = mysqli_query($conn,$query);
$arows = mysqli_num_rows($res);
if($arows > 0 && $_REQUEST['action'] <> 'add'){
echo "<table border = 1 width = '80%'><tr>
<td>Appliance#</td>
<td>Type</td>
<td>Manufacturer</td>
<td>Model</td>
<td></td>
</tr>";
$i = 1;
while($v = mysqli_fetch_array($res)){
echo "<tr>
<td>".$i++."</td>
<td>".$v['appliance_type']."</td>
<td>".$v['manufacturer']."</td>
<td>".$v['model']."</td>
<td>
<p><a href = '?step=appliance&delapp=".$v['id']."'>Delete</a></p>
</td>
</tr>";

}
echo "</table>";
echo "<p><a href = '?step=appliance&action=add'>Add another appliance</a></p>";
?><input type='button' class='next-2 next' onclick='location.href="?step=power"' value = 'Next'><?php
}else{
?>
<script>
  function appliance_list(val){
    document.getElementById("app_air").style.display = 'none';
    document.getElementById("app_water").style.display = 'none';
    if(val == 'Air handler'){
      document.getElementById("app_air").style.display = 'block';
    }
    if(val == 'Water heater'){
      document.getElementById("app_water").style.display = 'block';
    }


  }
</script>
<form id = 'fstep2' action="?step=appliance" method = 'post'>
          <div class="page">
            <div class="title">Add Appliances</div>
            <p>Please provide the details for the appliance</p>
            <div class="field">
              <div class="label">Appliance type:</div>
              <select name="appliance_type" id="appliance_type"  onchange = "appliance_list(this.value)" require>
                <option value="">Select Type</option>
                <option value="Air handler">Air handler</option>
                <option value="Water heater">Water heater</option>
                </select>
            </div>
           <div class="field">
            <div class="label">Manufacturer:</div>
              <select name="manufacturer" id="manufacturer" require>
                <option value="">Select</option>
                <option value="Quarkingen">Quarkingen</option>
                <option value="Varmvatten">Varmvatten</option>
                </select>
            </div>
            <div class="field">
              <div class="label">Model name:</div>
              <input type="text" name ='model' value = ''>
            </div>
            <div id = 'app_air' style="display:none" >
            <div style="text-align:left;position: relative;margin-top:0px;">
              <input type ="checkbox" name ='aircondition' value = 1>Air Condition
              <input type ="checkbox" name ='heater' value = 1>Heater
              <input type ="checkbox" name ='heatpump' value = 1>Heat pump
           </div>
           <div class="field">
              <div class="label">Energy efficency ratio:</div>
              <input type="text" name ='energyratio' value = ''>
            </div>
            <div class="field">
            <div class="label">Energy source:</div>
              <select name="energysource" id="energysource" require>
                <option value="">Select</option>
                <option value="Elecrtic">Elecrtic</option>
                <option value="Other">Other</option>
                </select>
            </div>
          </div>
            <div id = 'app_water' style="display:none" >
            <div class="field">
            <div class="label">Energy source:</div>
              <select name="energysource2" id="energysource2" require>
                <option value="">Select</option>
                <option value="Heat pump">Heat pump</option>
                <option value="Other">Other</option>
                </select>
            </div>
            <div class="field">
              <div class="label">Capacity(gallons):</div>
              <input type="text" name ='capacity' value = ''>
            </div>
            <div class="field">
              <div class="label">BTU rating:</div>
              <input type="text" name ='btu' value = ''>
            </div>
            <div class="field">
              <div class="label">Temperature:</div>
              <input type="text" name ='temperature' value = ''>
            </div>
            </div>
            <div class="field btns">
              <input type ='submit' value = 'Add'>
   
            </div>
          </div>
          <input type ='hidden' name ='action' value = 'appliance'>
</form>
<?php } ?>