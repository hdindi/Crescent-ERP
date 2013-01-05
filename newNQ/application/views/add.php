<html>
<head>
    <title>CRUD Operations using jQuery and Codeigniter</title>
 
    
 
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/smoothness/jquery-ui-1.8.2.custom.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/add.css" />
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
 
    <div id="create">Create form goes here...</div>
 
</div> <!-- end tabs -->
<!-- update form in dialog box -->
<div id="updateDialog" title="Update">
    <div>
        <form action="" method="post">
            <p>
               <label for="name">Name:</label>
               <input type="text" id="name" name="name" />
            </p>
 
            <p>
               <label for="email">Email:</label>
               <input type="text" id="email" name="email" />
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
    <tr>
        <td>${id}</td>
        <td>${name}</td>
        <td>${email}</td>
        <td><a class="updateBtn" href="${updateLink}">Update</a> | <a class="deleteBtn" href="${deleteLink}">Delete</a></td>
    </tr>
</script>
 
<script type="text/javascript" src="<?php echo base_url()."javascripts/add.js"?>"></script>
 
</body>
</html>