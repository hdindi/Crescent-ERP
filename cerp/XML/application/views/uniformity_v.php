<div id="main_wrapper"> 
    <head>
    <style type="text/css">
            table{
                border: #000000 1px solid;
                padding: 0px;
            }
            td{
                border: #000000 1px solid;
            }
            input[type=text]{
                text-align: center;
            }
            
    </style>
            <link rel="stylesheet" type="text/css" href="stylesheets/jquery.validate.css" />
        <link rel="stylesheet" type="text/css" href="stylesheets/style1.css" />
        <script src="lib/jquery/jquery-1.3.2.js" type="text/javascript">
        </script>
        <script src="javascripts/jquery.validate.js" type="text/javascript">
        </script>
        <script src="javascripts/jquery.validation.functions.js" type="text/javascript">
        </script>
        <script src="javascripts/nqcl.js" type="text/javascript">
        </script>
        
    </head>
      <h1>Capsule/Tablet/S/V Weight uniformity</h1>
  <p>
    <label>
      <input type="radio" name="type" value="Individual" id="type_0" checked="checked" />
      Capsule</label>
    <label>
      <input type="radio" name="type" value="Company" id="type_1" />
      Tablets</label>
  </p>
  <div id="Individual_box">
    
        <?php echo form_open('uniformity/save_capsule_weights/');?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="dave-table">
    <p>The colored fields are required</p/
  <tr>
    <td width="45" height="53"><div align="center">No.</div></td>
    <td width="144" align="center" valign="middle"><p align="center">Tablets/Capsules/Sachets/Vials  (mg)</p></td>
    <td width="155">Empty Capsule/ Sachet/Vial  (mg)</td>
    <td width="147" align="center" valign="middle">Capsule/Sachet/Vial Content (mg)</td>
    <td width="138" valign="middle">% Deviation From mean (for deviating tabs/caps)</td>
  </tr>
  <tr>
    <td><div align="center">1</div></td>
    <td><input type="text" id="tcsv1" name="tcsv1" size="25" class="num" required/></td>
    <td><input type="text" id="ecsv1" name="ecsv1" size="25" class="num1" required/></td>
    <td><input type="text" id="csvc1" name="csvc1" size="25" class="num2"readonly="readonly" /></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">2</div></td>
     <td><input type="text" id="tcsv2" name="tcsv2" class="num" size="25" required/></td>
    <td><input type="text" id="ecsv2" name="ecsv2" class="num1" size="25" required>
    <td><input type="text" id="csvc2" name="csvc2"  class="num2"size="25"readonly="readonly" /></td>
    <td><input type="text" name="" class="num3" size="25"/></td>
    </tr>
  <tr>
    <td><div align="center">3</div></td>
     <td><input type="text" id="tcsv3" name="tcsv3"  class="num" size="25" required/></td>
    <td><input type="text" id="ecsv3" name="ecsv3" class="num1" size="25" required/></td>
    <td><input type="text"  id="csvc3" name="csvc3" class="num2" size="25" readonly="readonly" /></td>
    <td><input type="text" name="" size="25" class="num3" /></td>
  </tr>
  <tr>
    <td><div align="center">4</div></td>
     <td><input type="text" id="tcsv4" name="tcsv4" class="num" size="25" required/></td>
    <td><input type="text" id="ecsv4" name="ecsv4" class="num1" size="25" required/></td>
    <td><input type="text" id="csvc4" name="csvc4" class="num2" size="25" readonly="readonly" /></td>
    <td><input type="text"  name="" class="num3" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">5</div></td>
     <td><input type="text" id="tcsv5" name="tcsv5" size="25" class="num" required/></td>
    <td><input type="text" id="ecsv5" name="ecsv5" size="25"  class="num1" required/></td>
    <td><input type="text" id="csvc5" name="csvc5" class="num2" size="25" readonly="readonly"/></td>
    <td><input type="text" name="" size="25" class="num3" /></td>
  </tr>
  <tr>
    <td><div align="center">6</div></td>
    <td><input type="text" id="tcsv6" name="tcsv6" size="25" class="num" required/></td>
    <td><input type="text" id="ecsv6" name="ecsv6" size="25" class="num1" required/></td>
    <td><input type="text" id="csvc6"name="csvc6" size="25" class="num2" readonly="readonly"/></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">7</div></td>
     <td><input type="text" id="tcsv7" name="tcsv7" size="25" class="num" required/></td>
    <td><input type="text" id="ecsv7" name="ecsv7" size="25" class="num1" required/></td>
    <td><input type="text" id="csvc7" name="csvc7" size="25" class="num2" readonly="readonly" /></td>
    <td><input type="text" name="" size="25" class="num3" /></td>
  </tr>
  <tr>
    <td><div align="center">8</div></td>
     <td><input type="text" id="tcsv8" name="tcsv8" size="25" class="num"  required/></td>
    <td><input type="text"  id="ecsv8" name="ecsv8" size="25" class="num1" required/></td>
    <td><input type="text" id="csvc8" name="csvc8" size="25" class="num2"  readonly="readonly"/></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
    <tr>
    <td><div align="center">9</div></td>
     <td><input type="text" id="tcsv9" name="tcsv9" size="25" class="num"  required/></td>
    <td><input type="text"  id="ecsv9" name="ecsv9" size="25" class="num1" required/></td>
    <td><input type="text" id="csvc9" name="csvc9" size="25" class="num2"  readonly="readonly"/></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">10</div></td>
     <td><input type="text" id="tcsv10"  name="tcsv10" class="num" size="25" required/></td>
    <td><input type="text" id="ecsv10" name="ecsv10"  class="num1" size="25" required/></td>
    <td><input type="text" id="csvc10"  name="csvc10" class="num2" size="25" readonly="readonly"/></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">11</div></td>
     <td><input type="text" id="tcsv11" name="tcsv11" class="num" size="25" required/></td>
    <td><input type="text" id="ecsv11" name="ecsv11"class="num1"  size="25" required/></td>
    <td><input type="text" id="csvc11"name="csvc11" class="num2" size="25" readonly="readonly" /></td>
    <td><input type="text" name="" class="num3" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">12</div></td>
     <td><input type="text" id="tcsv12" name="tcsv12" class="num" size="25" required/></td>
    <td><input type="text" id="ecsv12" name="ecsv12" class="num1" size="25" required/></td>
    <td><input type="text" id="csvc12" name="csvc12" class="num2" size="25" readonly="readonly" /></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">13</div></td>
     <td><input type="text" id="tcsv13"  name="tcsv13" size="25" class="num" required/></td>
    <td><input type="text" id="ecsv13" name="ecsv13" size="25" required class="num1"/></td>
    <td><input type="text" id="csvc13"name="csvc13" size="25" class="num2" readonly="readonly"/></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">14</div></td>
     <td><input type="text" id="tcsv14" name="tcsv14" size="25" required class="num"/></td>
    <td><input type="text" id="ecsv14" name="ecsv14" size="25" required class="num1"/></td>
    <td><input type="text" id="csvc14" name="csvc14" size="25" class="num2" readonly="readonly"/></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">15</div></td>
     <td><input type="text" id="tcsv15" name="tcsv15" size="25" required class="num"/></td>
    <td><input type="text" id="ecsv15" name="ecsv15" size="25" required class="num1"/></td>
    <td><input type="text" id="csvc15" name="csvc15" size="25" class="num2" readonly="readonly"/></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">16</div></td>
     <td><input type="text" id="tcsv16" name="tcsv16" size="25" required class="num"/></td>
    <td><input type="text" id="ecsv16"name="ecsv16" size="25" required class="num1"/></td>
    <td><input type="text"  id="csvc16"name="csvc16" size="25" class="num2" readonly="readonly" /></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">17</div></td>
     <td><input type="text" id="tcsv17"name="tcsv17" size="25" required class="num"/></td>
    <td><input type="text" id="ecsv17" name="ecsv17" size="25" required class="num1"/></td>
    <td><input type="text" id="csvc17" name="csvc17" size="25" class="num2" readonly="readonly" /></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">18</div></td>
     <td><input type="text" id="tcsv18" name="tcsv18" size="25" class="num" required/></td>
    <td><input type="text" id="ecsv18" name="ecsv18" size="25" class="num1" required/></td>
    <td><input type="text" id="csvc18" name="csvc18" size="25" class="num2" readonly="readonly" /></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">19</div></td>
     <td><input type="text"id="tcsv19" name="tcsv19" size="25" required class="num"/></td>
    <td><input type="text" id="ecsv19" name="ecsv19" size="25" required class="num1"/></td>
    <td><input type="text" id="csvc19" name="csvc19" size="25" class="num2" readonly="readonly"/></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">20</div></td>
     <td><input type="text"id="tcsv20"  name="tcsv20" size="25" required class="num"/></td>
    <td><input type="text" id="ecsv20" name="ecsv20" size="25" required class="num1"/></td>
    <td><input type="text" id="csvc20" name="csvc20" size="25" class="num2" readonly="readonly"/></td>
    <td><input type="text" name="" size="25" class="num3"/></td>
  </tr>
  <tr>
    <td><div align="center">Total</div></td>
     <td><span class="total" id="totals"></span></td>
     <input type="hidden" id="totalss" name="totalss" />
    <td><span class="total1" id="totals1"></span></td>
    <input type="hidden" id="totalss1" name="totalss1" />
    <td><span class="total2" id="totals2"></span></td>
    <input type="hidden" id="totalss2" name="totalss1"/>
    <td><span class="total3" id="totals3"></span></td>
    <input type="hidden" id="totalss3" name="totalss3"/>
  </tr>
  <tr>
    <td><div align="center">Average</div></td>
     <td><span class="av" id="av1" </span></td>
    <td><span class="av1"  id="av2" </span></td>
    <td><span class="av2" id="av3"  </span></td>
    <td><input type="text" name="average4" size="25"/></td>
  </tr>
  <tr>
    <td>Calculation of deviation Limits</td>  
  </tr>
</table>
<p>  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><label for="comment">comments:</label> </strong>                 
</p><div align="center"><textarea name="comment" cols="90"></textarea></div>
<p><input type="submit" value="Save Weights" class="submit-button" id="FormSubmit"></input></p>
</form>
</div>
  
    <script src="javascripts/nqcl.js" type="text/javascript">
        </script>
  <div id="Company_box">
   <?php echo form_open('uniformity/save_tablet_weights/');?>
<table width="400" border="1" align="center" cellpadding="1" cellspacing="0">
  <tr>
    <td width="20" height="53"><div align="center">No.</div></td>
    <td width="130" align="center" valign="middle"><p align="center">Tablets/Capsules/Sachets/Vials  (mg)</p></td>
   
    <td width="150" valign="middle">% Deviation From mean (for deviating tabs/caps)</td>
  </tr>
  <tr>
    <td><div align="center">1</div></td>
    <td><input type="text" id="tcsv1" name="tcsv1" size="25" required/></td>
  
    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">2</div></td>
     <td><input type="text" id="tcsv2" name="tcsv2" size="25" required/></td>

    <td><input type="text" name="" size="25"/></td>
    </tr>
  <tr>
    <td><div align="center">3</div></td>
     <td><input type="text" id="tcsv3" name="tcsv3" size="25" required/></td>
 
    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">4</div></td>
     <td><input type="text" id="tcsv4" name="tcsv4" size="25" required/></td>
 

    <td><input type="text"  name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">5</div></td>
     <td><input type="text" id="tcsv5" name="tcsv5" size="25" required/></td>

    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">6</div></td>
    <td><input type="text" id="tcsv6" name="tcsv6" size="25" required/></td>

    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">7</div></td>
     <td><input type="text" id="tcsv7" name="tcsv7" size="25" required/></td>

    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">8</div></td>
     <td><input type="text" id="tcsv8" name="tcsv8" size="25" required/></td>

    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">9</div></td>
     <td><input type="text" id="tcsv9"  name="tcsv9" size="25" required/></td>

    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">10</div></td>
     <td><input type="text" id="tcsv10"  name="tcsv10" size="25" required/></td>
 
    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">11</div></td>
     <td><input type="text" id="tcsv11" name="tcsv11" size="25" required/></td>

    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">12</div></td>
     <td><input type="text" id="tcsv12" name="tcsv12" size="25" required/></td>
  
    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">13</div></td>
     <td><input type="text" id="tcsv13"  name="tcsv13" size="25" required/></td>
 
    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">14</div></td>
     <td><input type="text" id="tcsv14" name="tcsv14" size="25" required/></td>

    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">15</div></td>
     <td><input type="text" id="tcsv15" name="tcsv15" size="25" required/></td>

    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">16</div></td>
     <td><input type="text" id="tcsv16" name="tcsv16" size="25" required/></td>
    
    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">17</div></td>
     <td><input type="text" id="tcsv17"name="tcsv17" size="25" required/></td>

    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">18</div></td>
     <td><input type="text" id="tcsv18" name="tcsv18" size="25" required/></td>

    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">19</div></td>
     <td><input type="text"id="tcsv19" name="tcsv19" size="25" required/></td>
   
    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">20</div></td>
     <td><input type="text"id="tcsv20"  name="tcsv20" size="25" required/></td>

    <td><input type="text" name="" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">Total</div></td>
     <td><input type="text" id="total1" name="total1" size="25" /></td>
   
    <td><input type="text" name="total4" size="25"/></td>
  </tr>
  <tr>
    <td><div align="center">Average</div></td>
     <td><input type="text" id="average1" name="average1" size="25"/></td>
  
    <td><input type="text" name="average4" size="25"/></td>
  </tr>
  <tr>
    <td>Calculation of deviation Limits</td>  
  </tr>
</table>
<p>  
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><label for="comment">comments:</label> </strong>                 
</p><div align="center"><textarea name="comment" cols="90"></textarea></div>
<p><input type="submit" value="Save Weights" class="submit-button" id="FormSubmit"></input></p>
</form>
</div>


    

