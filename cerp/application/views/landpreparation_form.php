<?php if ($user = Current_User::user()): ?>
	Hello, <em><?php echo $user->username; ?></em> <br/>
	<?php echo anchor('index.php/logout', 'Logout'); ?>
<?php else: ?>
	<?php echo anchor('index.php/login','Login'); ?> |
	<?php echo anchor('index.php/createaccount', 'Register'); ?>		
<?php endif; ?>





   <fieldset class="overall"> 
   <fieldset class="weight">
   <legend></legend><h3>Worksheet Information</h3> 
       <label for="SampleName"> Sample Name :</label>  <input type="text" name="SampleName" value="<?php echo $Info->chemical_name; ?>"/><p></p>
       <label for="LabRef"> Lab Reference No :</label>  <input type="text" name="LabRef" value="<?php echo $Info->request_id; ?>"/><p></p>
        <label for="LabelClaim">Label Claim:</label> <textarea name="LabelClaim" ><?php echo $Info->label_claim; ?></textarea><p></p>
        <label for="ActiveInng">Active Ingredient</label> <input type="text" name="ActiveInng" value="<?php echo $Info->active_ing; ?>"/><p></p>
       <label for="DateCompleted" >Date Completed :</label>  <input type="text" name="DateCompleted"  id="DateCompleted"/><p></p>
        
</fieldset>  

    <fieldset class="weight">
        <legend></legend><h3>Standard Assay </h3>
        
        <label for="assayDesired">Desired Weight:</label>:  <input type="text" name="assayDesired" value="<?php echo $stddesired->desired_weight; ?>"/><p></p>
        <label for="standardA">Standard A: </label><input type="text" name="standardA" value="<?php echo $stdweight['0']->weight; ?>"/><p></p>
       <label for="standardB"> Standard B: </label><input type="text" name="standardB" value="<?php echo $stdweight['1']->weight; ?>"/>
        </fieldset>
        
        <fieldset id="SampleAssay">
       <legend></legend><h3>Sample Assay </h3>
        
        <fieldset class="weight">
        <legend><h4>Powder weight</h4></legend>
        
        <?php foreach ($sample_assay as $assay);?>
         <?php foreach ($sample_assay_desired as $desired);?>

        <p>
        <label for ="sampleDesiredpw">Desired :</label> <input type="text" name="sampleDesiredpw" value="<?php echo $desired->powder_weight; ?>"/></p>
       <label for ="sasandarda"> Standard A:</label> <input type="text" name="sastandarda" value="<?php echo $sample_assay ['0']->powder_weight; ?>"/><p></p>
         <label for ="sasandardb">Standard B:</label> <input type="text" name="sastandardb" value="<?php echo $sample_assay ['1']->powder_weight; ?>"/><p></p>
         <label for ="sasandardc">Standard C:</label> <input type="text"  name="sastandardc" value="<?php echo $sample_assay ['2']->powder_weight; ?>"/>
         </fieldset>
       <fieldset class="weight">
        <legend><h4>API Weight</h4></legend>
     <label for=s"ampleDesiredap" >  Desired Weight :</label> <input type="text" name="sampleDesiredap"value="<?php echo $desired->api_weight; ?>"/><p></p>
        <label for ="apstandarda"> Standard A : </label> <input type="text" name="apstandarda" value="<?php echo $sample_assay ['0']->api_weight; ?>"/><p></p>
       <label for ="apstandardb"> Standard B:</label> <input type="text" name="apstandardb" value="<?php echo $sample_assay ['1']->api_weight; ?>"/><p></p>
        <label for ="apstandardc">Standard C: </label><input type="text" name="apstandardc" value="<?php echo $sample_assay ['2']->api_weight; ?>"/>
        </fieldset>
        </fieldset>
       </fieldset>