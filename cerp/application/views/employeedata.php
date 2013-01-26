<html>
<head>
<title>EMPLOYEE DATA INFORMATION</title>

<base href="<?php echo base_url() ?>" />

<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/smoothness/jquery-ui-1.8.2.custom.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/styles.css" />
   <link rel="stylesheet" href="" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
    <script>
    $(document).ready(function(){
    $(function() {
        $( "#cDate" ).datepicker({
           dateFormat: 'mm-dd-yy'
        });
    });
  });
    //$('.date').datePicker({startDate: '01/01/2012'});
    </script>

<script>
    $(document).ready(function() {
$('.error').hide();
$('#btnSubmit').click(function(event){
   var dtVal=$('#cDate').val();
   if(ValidateDate(dtVal))
   {
      $('.error').hide();

   }
   else
   {
     $('.error').show();
     event.preventDefault();
   }
   });
});

function ValidateDate(dtValue)
{
var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
return dtRegex.test(dtValue);
}
    </script>
    <style type="text/css">   
    .error
{
    color: red;
    font-family : ;
    font-size : ;
}
    </style>

</head>

<body>

<div id="ajaxLoadAni">
    <img src="images/ajax-loader.gif" alt="Ajax Loading Animation" />
    <span>Loading...</span>
</div>

<div id="tabs">
    
    <ul>
        <li><a href="#read">Read</a></li>
        <li><a href="#create">Create</a></li>
    </ul>
    
    <div id="read">
        <table id="records"></table>
    </div>
    <div id="create">
        <form action="" method="post">
           <p>
               <label for="cName">First Name:</label>
               <input placeholder="   " type="text" id="cName" name="cName" />
           </p>
           
           <p>
               <label for="cSurname">SurName:</label>
               <input type="text" id="cSurname" name="cSurname" />
           </p>
		     <p>
            
               <label for="cDate">Date of Birth:</label>
               <input placeholder="  year-m-d " type="text" id="cDate" name="cDate" />
               <span class="error"> Invalid Date.(mm/dd/yyyy or mm-dd-yyyy)
</span>
               
           </p>
		   <p>
               <label for="cAddress">Address:</label>
               <input type="text" id="cAddress" name="cAddress" />
           </p>
		      <p>
               <label for="cNhifno">NHIF No:</label>
               <input type="text" id="cNhifno" name="cNhifno" />
           </p>
		   <p>
               <label for="cEmployeetype">Employee type:</label>
               <input type="text" id="cEmployeetype" name="cEmployeetype" />
           </p>
		
		   
         
           
           <p>
               <label>&nbsp;</label>
               <input type="submit" name="createSubmit"  id="btnSubmit" value="Submit" />
           </p>
        </form>
    </div>

</div> <!-- end tabs -->

<!-- update form in dialog box -->
<div id="updateDialog" title="Update">
    <div>
        <form action="" method="post">
            <p>
               <label for="name">First Name:</label>
               <input type="text" id="name" name="name" />
            </p>
            
            <p>
               <label for="surname">SurName:</label>
               <input type="text" id="surname" name="surname" />
            </p>
			 <p>
               <label for="date">Date:</label>
               <input type="text" id="date" name="date" />
            </p>
			<p>
               <label for="address">Address:</label>
               <input type="text" id="address" name="address" />
            </p>
			<p>
               <label for="nhifno">NHIF No:</label>
               <input type="text" id="nhifno" name="nhifno" />
            </p>
			<p>
               <label for="employeetype">Employee Type:</label>
               <input type="text" id="employeetype" name="employeetype" />
            </p>
			
           
            
            <input type="hidden" id="userId" name="id" />
        </form>
    </div>
</div>

<!-- delete confirmation dialog box -->
<div id="delConfDialog" title="Confirm">
    <p>Are you sure?</p>
</div>


<!-- message dialog box -->
<div id="msgDialog"><p></p></div>


<script type="text/javascript" src="<?php echo base_url()."javascripts/jquery-1.4.2.min.js"?>"></script>
<script type="text/javascript" src="<?php echo base_url()."javascripts/jquery-ui-1.8.2.min.js"?>"></script>
<script type="text/javascript" src="<?php echo base_url()."javascripts/jquery-templ.js"?>"></script>
<script type="text/javascript" src="<?php echo base_url()."javascripts/jquery.validate.min.js"?>"></script>

<script type="text/template" id="readTemplate">
    <tr id="${id}">
        <td>${id}</td>
        <td>${firstname}</td>
        <td>${surname}</td>
        <td>${date}</td>
		<td>${address}</td>
        <td>${nhifno}</td>
		<td>${
			employeetype
		}</td>
		}
		
        <td><a class="updateBtn" href="${updateLink}">Update</a> | <a class="deleteBtn" href="${deleteLink}">Delete</a></td>
    </tr>
</script>

<script type="text/javascript" src="<?php echo base_url()."javascripts/add.js"?>"></script>


</body>
</html>