<form id = 'fstep1' action="?step=appliance" method = 'post'>
          <div class="page slide-page">
            <div class="title">Enter Household info</div>
            <div class="field">
              <div class="label">Please enter your email address:</div>
              </br><input type="text" name = 'email' value = ''>
            </div>
            <div class="field">
              <div class="label">Please enter your five digit postal code:</div>
              <input type="text" name = 'pincode' value = '' require>
            </div>
            
              <div style = 'text-align:left'>Please enter the following details for your household.</div>
              <div class="field">
                <div class="label">Home type:</div>
              <select name="hometype" id="hometype" require>
                <option value="">Select Type</option>
                <option value="Solar-electric">Townhome</option>
                <option value="Wind">Wind</option>
                </select>
            </div>
            <div class="field">
              <div class="label">Square footage:</div>
              <input type="text" name = 'footage' value = ''>
            </div>
            <div class="field">
              <div class="label">Thermostat setting for heating:</div>
              <input type="text" name = 'heating' value = ''>
              <input type ="checkbox" name ='noheat' value = 1>No heat
            </div>
            <div class="field">
              <div class="label">Thermostat setting for cooling:</div>
              <input type="text" name = 'colling' value = ''>
              <input type ="checkbox" name ='nocolling' value = 1>No cooling
            </div>
            <div class="field">
              <div class="label">Public utilities:</br>
              <h8 style="font:size 2px;">(if none, leave unchecked)</h8>
            </div>
            </div>
            <div style="text-align:left;position: relative;margin-top:0px;">
              <input type ="checkbox" name ='uelectric' value = 1>Electric
              <input type ="checkbox" name ='ugas' value = 1>Gas
              <input type ="checkbox" name ='usteam' value = 1>Steam
              <input type ="checkbox" name ='ufuel' value = 1>Fuel oil
            </div>
            <div class="field">
              <input type='submit' class="firstNext next"  value = 'Next'>
              <input type ='hidden' name ='action' value = 'household'>
            </div>
          </div>
  </form>
    
  