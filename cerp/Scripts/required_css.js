
$(function() {
$('#applicant_name').change(function() {
		$.ajax({
			url : '../api.php',
			data : "id=" + $(this).val(),
			dataType : 'json',
			success : function(data) {
				//alert(data);
			var appl_ref_no = data[6]


	
	if(appl_ref_no != null ){			
	$('#appl_ref_no').replaceWith('<input type="text" name="applicant_reference_number" id="appl_ref_no" required />');
	$('#appl_ref_no').val(appl_ref_no);
	}
	else{
	$('#appl_ref_no').replaceWith('<input type="text" name="applicant_reference_number" id="appl_ref_no"/>');	
	}	
}
	})
	
})
	
});
