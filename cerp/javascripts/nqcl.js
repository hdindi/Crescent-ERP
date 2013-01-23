var th = ['','thousand','million', 'billion','trillion'];
// uncomment this line for English Number System
// var th = ['','thousand','million', 'milliard','billion'];

var dg = ['zero','one','two','three','four', 'five','six','seven','eight','nine'];var tn = ['ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen', 'seventeen','eighteen','nineteen'];var tw = ['twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];function toWords(s){s = s.toString();s = s.replace(/[\, ]/g,'');if (s != parseFloat(s)) return 'not a number';var x = s.indexOf('.');if (x == -1) x = s.length;if (x > 15) return 'too big';var n = s.split('');var str = '';var sk = 0;for (var i=0; i < x; i++) {if ((x-i)%3==2) {if (n[i] == '1') {str += tn[Number(n[i+1])] + ' ';i++;sk=1;} else if (n[i]!=0) {str += tw[n[i]-2] + ' ';sk=1;}} else if (n[i]!=0) {str += dg[n[i]] +' ';if ((x-i)%3==0) str += 'hundred ';sk=1;}if ((x-i)%3==1) {if (sk) str += th[(x-i-1)/3] + ' ';sk=0;}}if (x != s.length) {var y = s.length;str += 'point ';for (var i=x+1; i<y; i++) str += dg[n[i]] +' ';}return str.replace(/\s+/g,' ');}
       
            
jQuery(function(){
    jQuery("#utcsv1").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv2").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv3").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv4").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv5").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv6").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv7").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });  
    jQuery("#utcsv8").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });  
    jQuery("#utcsv9").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv10").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv11").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv12").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv13").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv14").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv15").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv16").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv17").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv18").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv19").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#utcsv20").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
                
                
    jQuery("#uecsv1").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
                
    jQuery("#uecsv2").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv3").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv4").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv5").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv6").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv7").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv8").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv9").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv10").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv11").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
            
    jQuery("#uecsv12").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv13").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv14").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv15").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv16").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv17").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv18").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv19").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#uecsv20").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
                
                
    jQuery('.AdvancedForm').validated(function(){
        alert("Use this call to make AJAX submissions.");
    });
});
/* ]]> */
      
//finding the sum=======================================================================================================
//==================================================================================================================
$(document).ready(function(){
    $('.unum').live('keyup',function () {
        var sum = 0;
        var sum1=0;
        var answer=0;
        var answer1=0;
        var boxes= $('.unum[value!=""]').length;
        $('.unum').each(function() {
            sum += Number($(this).val());
            sum1=sum.toFixed(4);
            answer=sum1/boxes;
            answer1=answer.toFixed(4);
        });
        
        $('input#utotals').val(sum1);
        $('input#uav1').val(answer1);
     
    });
});

$(document).ready(function(){
    $('.unum1').live('keyup',function () {
        var sum = 0;
        var sum1=0;
        var answer=0;
        var answer1=0;
        var boxes= $('.unum2[value!=""]').length;
        $('.unum2').each(function() {
            sum += Number($(this).val());
            sum1=sum.toFixed(4);
            answer=sum1/boxes;
            answer1=answer.toFixed(4);
        });
        
        $('input#utotals2').val(sum1);
        $('input#uav3').val(answer1);
     
    });
});

//difference
//------------88888888888888888888--------------------------------------------88888888888888888888888888888888888

$(document).ready(function() {
    $('#utcsv1, #uecsv1').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv1').val());
        var b=parseFloat($('#uecsv1').val());
              
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
                      
            var difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc1').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv2, #uecsv2').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv2').val());
        var b=parseFloat($('#uecsv2').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            var difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc2').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv3, #uecsv3').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv3').val());
        var b=parseFloat($('#uecsv3').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            var difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc3').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv4, #uecsv4').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv4').val());
        var b=parseFloat($('#uecsv4').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            var difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc4').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv5, #uecsv5').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv5').val());
        var b=parseFloat($('#uecsv5').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            var difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc5').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv6, #uecsv6').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv6').val());
        var b=parseFloat($('#uecsv6').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc6').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv7, #uecsv7').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv7').val());
        var b=parseFloat($('#uecsv7').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc7').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv8, #uecsv8').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv8').val());
        var b=parseFloat($('#uecsv8').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc8').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv9, #uecsv9').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv9').val());
        var b=parseFloat($('#uecsv9').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc9').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv9, #uecsv9').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv9').val());
        var b=parseFloat($('#uecsv9').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc9').val(difference.toFixed(2));
    });

});


$(document).ready(function() {
    $('#utcsv10, #uecsv10').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv10').val());
        var b=parseFloat($('#uecsv10').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc10').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv11, #uecsv11').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv11').val());
        var b=parseFloat($('#uecsv11').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc11').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv12, #uecsv12').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv12').val());
        var b=parseFloat($('#uecsv12').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc12').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv13, #uecsv13').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv13').val());
        var b=parseFloat($('#uecsv13').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc13').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv14, #uecsv14').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv14').val());
        var b=parseFloat($('#uecsv14').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc14').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv15, #uecsv15').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv15').val());
        var b=parseFloat($('#uecsv15').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            var difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc15').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv16, #uecsv16').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv16').val());
        var b=parseFloat($('#uecsv16').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            var difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc16').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv17, #uecsv17').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv17').val());
        var b=parseFloat($('#uecsv17').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            var difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc17').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv18, #uecsv18').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv18').val());
        var b=parseFloat($('#uecsv18').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            var difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc18').val(difference.toFixed(2));
    });

});

$(document).ready(function() {
    $('#utcsv19, #uecsv19').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv19').val());
        var b=parseFloat($('#uecsv19').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            var difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc19').val(difference.toFixed(2));
    });

});


$(document).ready(function() {
    $('#utcsv20, #uecsv20').keyup(function() {
        var difference=0;
        var a=parseFloat($('#utcsv20').val());
        var b=parseFloat($('#uecsv20').val());
        if(a<0 || b<0){
            alert("Please input a positive value");
        }
        else if(a<b){
            alert("The second value must be less than the first value");
        }else{
            var difference =a-b;                  
        //  $('.utotal').text(sum);
        }
        $('#ucsvc20').val(difference.toFixed(2));
    });

});

var ma1;
       
var ma2;
        
var ma3;
       
var ma4;
       
var ma5;
        
var ma6;
       
var ma7;
        
var ma8;
        
var ma9;
        
var ma10;
        
var ma11;
        
var ma12;
       
var ma13;
       
var ma14;
       
var ma15;
      
var ma16;
       
var ma17;
       
var ma18;
        
var ma19;
        
var ma20;
      

$(document).ready(function(){  
    $('#calculate').click(function(){  
        $('#Refresh').show();
        $(this).hide();
        
        var a=$('#utcsv1').val();
        var b=$('#utcsv2').val();
        var c=$('#utcsv3').val();
        var d=$('#utcsv4').val();
        var e=$('#utcsv5').val();
        var f=$('#utcsv6').val();
        var g=$('#utcsv7').val();
        var h=$('#utcsv8').val();
        var i=$('#utcsv9').val();
        var j=$('#utcsv10').val();
        var k=$('#utcsv11').val();
        var l=$('#utcsv12').val();
        var m=$('#utcsv13').val();
        var n=$('#utcsv14').val();
        var o=$('#utcsv15').val();
        var p=$('#utcsv16').val();
        var q=$('#utcsv17').val();
        var r=$('#utcsv18').val();
        var s=$('#utcsv19').val();
        var t=$('#utcsv20').val();
        
    
              
  
        var span_text =parseFloat($('#uav3').val());     
      
            
      
        a=parseFloat($('#ucsvc1').val());
        b=parseFloat($('#ucsvc2').val());
        c=parseFloat($('#ucsvc3').val());
        d=parseFloat($('#ucsvc4').val());
        e=parseFloat($('#ucsvc5').val());
        f=parseFloat($('#ucsvc6').val());
        g=parseFloat($('#ucsvc7').val());
        h=parseFloat($('#ucsvc8').val());
        i=parseFloat($('#ucsvc9').val());
        j=parseFloat($('#ucsvc10').val());
        k=parseFloat($('#ucsvc11').val());
        l=parseFloat($('#ucsvc12').val());
        m=parseFloat($('#ucsvc13').val());
        n=parseFloat($('#ucsvc14').val());
        o=parseFloat($('#ucsvc15').val());
        p=parseFloat($('#ucsvc16').val());
        q=parseFloat($('#ucsvc17').val());
        r=parseFloat($('#ucsvc18').val());
        s=parseFloat($('#ucsvc19').val());
        t=parseFloat($('#ucsvc20').val());
         
        ma1 =((a-span_text)/span_text)*100;
        $('input#udfm1').val( ma1.toFixed(2));
        ma2 =((b-span_text)/span_text)*100;
        $('input#udfm2').val( ma2.toFixed(2));
        ma3 =((c-span_text)/span_text)*100;
        $('input#udfm3').val( ma3.toFixed(2));
        ma4 =((d-span_text)/span_text)*100;
        $('input#udfm4').val( ma4.toFixed(2));
        ma5 =((e-span_text)/span_text)*100;
        $('input#udfm5').val( ma5.toFixed(2));
        ma6 =((f-span_text)/span_text)*100;
        $('input#udfm6').val( ma6.toFixed(2));
        ma7 =((g-span_text)/span_text)*100;
        $('input#udfm7').val( ma7.toFixed(2));
        ma8 =((h-span_text)/span_text)*100;
        $('input#udfm8').val( ma8.toFixed(2));
        ma9 =((i-span_text)/span_text)*100;
        $('input#udfm9').val( ma9.toFixed(2));
        ma10 =((j-span_text)/span_text)*100;
        $('input#udfm10').val( ma10.toFixed(2));
        ma11 =((k-span_text)/span_text)*100;
        $('input#udfm11').val( ma11.toFixed(2));
        ma12 =((l-span_text)/span_text)*100;
        $('input#udfm12').val( ma12.toFixed(2));
        ma13 =((m-span_text)/span_text)*100;
        $('input#udfm13').val( ma13.toFixed(2));
        ma14 =((n-span_text)/span_text)*100;
        $('input#udfm14').val( ma14.toFixed(2));
        ma15 =((o-span_text)/span_text)*100;
        $('input#udfm15').val( ma15.toFixed(2));
        ma16 =((p-span_text)/span_text)*100;
        $('input#udfm16').val( ma16.toFixed(2));
        ma17 =((q-span_text)/span_text)*100;
        $('input#udfm17').val( ma17.toFixed(2));
        ma18 =((r-span_text)/span_text)*100;
        $('input#udfm18').val( ma18.toFixed(2));
        ma19 =((s-span_text)/span_text)*100;
        $('input#udfm19').val( ma19.toFixed(2));
        ma20 =((t-span_text)/span_text)*100;
        $('input#udfm20').val( ma20.toFixed(2));
        var red = 0;
        var green=0;
        var space=", ";
        var holder, holderr,holder1,holderR;
        var oncer, once1;
        var passed="#complies";
        var failed="#dcomply";
        for(var kj = 1;kj<21;kj++){
            var val=window["ma"+kj];
            if(window["ma"+kj]<0){
                val=window['ma'+kj]*-1;
            }else{
                val=window["ma"+kj];
            }
            var div = "#span"+kj+"1"; //red
            var div2 = "#span"+kj+"2"; //blue
            var div3 = "#span"+kj+"3"; //green
           
            if(span_text<300){
                 
                if(val>=10 && val<=20){
                    $(div3).show();
                       green++;                 
                    holder= window['ma'+kj].toFixed(2)+'%'+space;                        
                    once1+=holder.toString();                         
                    holder1=once1.replace("undefined","");
                    holder1 = holder1.substring(0,holder1.length - 2);
                
                }
                else if(val>=0 &&val<=10  ){
                    $(div2).show();                 
                }
                else{
                    $(div).show(); 
                    red++
                    holderr= window['ma'+kj].toFixed(2)+'%'+space;                       
                    oncer+=holderr.toString();                             
                    holderR=oncer.replace("undefined","");
                    holderR = holderR.substring(0,holderR.length - 2);
                }
            }else if(span_text>300){
                   
                if(val>=7.5 && val<=15){
                    $(div3).show();
                     green++;                 
                    holder= window['ma'+kj].toFixed(2)+'%'+space;                        
                    once1+=holder.toString();                         
                    holder1=once1.replace("undefined","");
                    holder1 = holder1.substring(0,holder1.length - 2);
                   
                
                }
                else if(val<=7.5 && val>=0){
                    $(div2).show();
                  
                }
                else{
                    $(div).show(); 
                    red++
                    holderr= window['ma'+kj].toFixed(2)+'%'+space;                       
                    oncer+=holderr.toString();                             
                    holderR=oncer.replace("undefined","");
                    holderR = holderR.substring(0,holderR.length - 2);
                }
            
            }   
            //end of main loop
             
        }
              
             if(green!=0 && red!=0){
             $(failed).show(); 
           var n1= parseInt(green)+parseInt(red);
           var total= toWords(n1);
                //var redwords =toWords(red);
                $('#com').val( total+ "deviate ("+holder1+ ", "  +holderR+")"); 
            }
            if(green!=0 && red==0){              
                var  greenwords= toWords(green);                 
                $('#com').val(greenwords+ "deviate ("+holder1+")"); 
                  if(green>1){
                    $(failed).show(); 
                }else{
                    $(passed).show(); 
                }
            }
            if(red!=0 && green==0){
                 var  redwords= toWords(red); 
                $(failed).show(); 
                $('#com').val(redwords+ "deviate ("+holderR+")");  
            }
             
            if(green==0 &&red==0){
                $(passed).show(); 
                $('#com').val("None Deviates");  
            }
 });
        
});




$(document).ready(function(){
    $('#FormSubmit').click(function(){       
        
        var a=$('#udfm1').val();
        var b=$('#udfm2').val();
        var c=$('#udfm3').val();
        var d=$('#udfm4').val();
        var e=$('#udfm5').val();
        var f=$('#udfm6').val();
        var g=$('#udfm7').val();
        var h=$('#udfm8').val();
        var i=$('#udfm9').val();
        var j=$('#udfm10').val();
        var k=$('#udfm11').val();
        var l=$('#udfm12').val();
        var m=$('#udfm13').val();
        var n=$('#udfm14').val();
        var o=$('#udfm15').val();
        var p=$('#udfm16').val();
        var q=$('#udfm17').val();
        var r=$('#udfm18').val();
        var s=$('#udfm19').val();
        var t=$('#udfm20').val();
        
        if( a == "" || b == "" || c== "" || d== "" || e== "" || f== "" || g== "" || h== "" || i== "" || j== "" || k== "" || l== "" || m== "" || n== "" || o== "" || p== "" || q== "" || r== "" || s== "" || t== ""  ){
            
            alert("Please click the deviation label to fill in the percentages first!");
            return false;
        }else{
            return true;
        }
        
    });


});
$().ready(function(){
      $('#Refresh').hide();
$('#Refresh').click(function(){    
    location.reload();
    $('#calculate').show();
});
});


        
        


