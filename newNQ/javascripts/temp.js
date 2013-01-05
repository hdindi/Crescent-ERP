        
            
/*jQuery(function(){
    jQuery("#tcsv1").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv2").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv3").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv4").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv5").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv6").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv7").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });  
    jQuery("#tcsv8").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });  
    jQuery("#tcsv9").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv10").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv11").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv12").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv13").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv14").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv15").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv16").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv17").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv18").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv19").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
    jQuery("#tcsv20").validate({
        expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
        message: "Please enter a valid number"
    });
                
                
    jQuery('.AdvancedForm').validated(function(){
        alert("Use this call to tmake AJAX submissions.");
    });
});
/* ]]> */
      
//finding the sum=======================================================================================================
//==================================================================================================================
$(document).ready(function(){
    $('.num').live('keyup',function () {
        var sum = 0;
        var sum1=0;
        var answer=0;
        var answer1=0;
       var boxes= $('.num[value!=""]').length;
        $('.num').each(function() {
            sum += Number($(this).val());
           sum1=sum.toFixed(4);
           answer=sum1/boxes;
           answer1=answer.toFixed(4);
        });
        
      $('input#totals').val(sum1);
      $('input#av1').val(answer1);
     
    });
});


var tma1;
       
var tma2;
        
var tma3;
       
var tma4;
       
var tma5;
        
var tma6;
       
var tma7;
        
var tma8;
        
var tma9;
        
var tma10;
        
var tma11;
        
var tma12;
       
var tma13;
       
var tma14;
       
var tma15;
      
var tma16;
       
var tma17;
       
var tma18;
        
var tma19;
        
var tma20;
      

$(document).ready(function(){
    $('#calculatetabs').click(function(){       
        
        var a=$('#tcsv1').val();
        var b=$('#tcsv2').val();
        var c=$('#tcsv3').val();
        var d=$('#tcsv4').val();
        var e=$('#tcsv5').val();
        var f=$('#tcsv6').val();
        var g=$('#tcsv7').val();
        var h=$('#tcsv8').val();
        var i=$('#tcsv9').val();
        var j=$('#tcsv10').val();
        var k=$('#tcsv11').val();
        var l=$('#tcsv12').val();
        var m=$('#tcsv13').val();
        var n=$('#tcsv14').val();
        var o=$('#tcsv15').val();
        var p=$('#tcsv16').val();
        var q=$('#tcsv17').val();
        var r=$('#tcsv18').val();
        var s=$('#tcsv19').val();
        var t=$('#tcsv20').val();
        
        if( a == "" || b == "" || c== "" || d== "" || e== "" || f== "" || g== "" || h== "" || i== "" || j== "" || k== "" || l== "" || m== "" || n== "" || o== "" || p== "" || q== "" || r== "" || s== "" || t== ""  ){
            
            alert("Please fill in the required fields first before calculating the deviations!");
        }
        else{
    
       var span_text=parseFloat($('input#av1').val());
          
            a=parseFloat($('#tcsv1').val());
            b=parseFloat($('#tcsv2').val());
            c=parseFloat($('#tcsv3').val());
            d=parseFloat($('#tcsv4').val());
            e=parseFloat($('#tcsv5').val());
            f=parseFloat($('#tcsv6').val());
            g=parseFloat($('#tcsv7').val());
            h=parseFloat($('#tcsv8').val());
            i=parseFloat($('#tcsv9').val());
            j=parseFloat($('#tcsv10').val());
            k=parseFloat($('#tcsv11').val());
            l=parseFloat($('#tcsv12').val());
            m=parseFloat($('#tcsv13').val());
            n=parseFloat($('#tcsv14').val());
            o=parseFloat($('#tcsv15').val());
            p=parseFloat($('#tcsv16').val());
            q=parseFloat($('#tcsv17').val());
            r=parseFloat($('#tcsv18').val());
            s=parseFloat($('#tcsv19').val());
            t=parseFloat($('#tcsv20').val());
         
            tma1 =((a-span_text)/span_text)*100;
            $('input#dfm1').val( tma1.toFixed(2));
            tma2 =((b-span_text)/span_text)*100;
            $('input#dfm2').val( tma2.toFixed(2));
            tma3 =((c-span_text)/span_text)*100;
            $('input#dfm3').val( tma3.toFixed(2));
            tma4 =((d-span_text)/span_text)*100;
            $('input#dfm4').val( tma4.toFixed(2));
            tma5 =((e-span_text)/span_text)*100;
            $('input#dfm5').val( tma5.toFixed(2));
            tma6 =((f-span_text)/span_text)*100;
            $('input#dfm6').val( tma6.toFixed(2));
            tma7 =((g-span_text)/span_text)*100;
            $('input#dfm7').val( tma7.toFixed(2));
            tma8 =((h-span_text)/span_text)*100;
            $('input#dfm8').val( tma8.toFixed(2));
            tma9 =((i-span_text)/span_text)*100;
            $('input#dfm9').val( tma9.toFixed(2));
            tma10 =((j-span_text)/span_text)*100;
            $('input#dfm10').val( tma10.toFixed(2));
            tma11 =((k-span_text)/span_text)*100;
            $('input#dfm11').val( tma11.toFixed(2));
            tma12 =((l-span_text)/span_text)*100;
            $('input#dfm12').val( tma12.toFixed(2));
            tma13 =((m-span_text)/span_text)*100;
            $('input#dfm13').val( tma13.toFixed(2));
            tma14 =((n-span_text)/span_text)*100;
            $('input#dfm14').val( tma14.toFixed(2));
            tma15 =((o-span_text)/span_text)*100;
            $('input#dfm15').val( tma15.toFixed(2));
            tma16 =((p-span_text)/span_text)*100;
            $('input#dfm16').val( tma16.toFixed(2));
            tma17 =((q-span_text)/span_text)*100;
            $('input#dfm17').val( tma17.toFixed(2));
            tma18 =((r-span_text)/span_text)*100;
            $('input#dfm18').val( tma18.toFixed(2));
            tma19 =((s-span_text)/span_text)*100;
            $('input#dfm19').val( tma19.toFixed(2));
            tma20 =((t-span_text)/span_text)*100;
            $('input#dfm20').val( tma20.toFixed(2));
            
           
            var counter = 0;
            var counter1=0;
            var bluecounter=0;
                   var greencounter=0;
                   var redcounter=0;
            for(var kj = 1;kj<21;kj++){
            
                var div = "#span"+kj+"1";
                var div2 = "#span"+kj+"2";
                var div3="#span"+kj+"3";
                if(window["tma"+kj]<0){
                	var val=window['tma'+kj]*-1;
                }else{
                	 val=window["tma"+kj];
                }
                
                if(span_text<=80){
    
                    if(val>=10 && val<=20){
                        $(div3).show();
                
                    }
                    else if(val<=10 && val>=0){
                        $(div2).show();
                        counter1++;
                    }
                    else{
                        $(div).show(); 
                        counter++;
                    }
                
                   
                
                
                }else if(span_text>80 && span_text<250){
                    var absolute1=7.5;
                 
                    if(val>=7.5 && val<=15){
                        $(div3).show();
                
                    }
                    else if(val<=7.5 && val>=0){
                        $(div2).show();
                        counter1++;
                    }
                    else{
                        $(div).show(); 
                        counter++;
                    }
                }else{
                    if(span_text>=250){
                      
                
                        if(val>=5 && val<=10){
                            $(div3).show();
                            greencounter++;
                            var gonce ;
                              gonce =window['tma'+kj].toFixed(2)+'%';
                    var ts1;
                   ts1+=gonce.toString()+"<br/> ";
                    ;
              var   comm=greencounter+" Deviate Once "+gonce+"<br/>";
               //  $('#comments').append(comm);
                             $('tma'+kj).each(function(i,j){
                                alert(j)
                             })
                          
                         
     }
                        else if(val<=5 && val>=0){
                            bluecounter++;
                            $(div2).show();
                            
                        }
                        else{
                            $(div).show(); 
                            redcounter++;
                             
               var once ;
               once =window['tma'+kj].toFixed(2)+'%';
               var ts;
                   ts+=once.toString()+"<br/> ";
               // alert(ts);
                     
                   var   comm1=redcounter+" More than Double Deviation "+once+"<br/>";
                      // $('#comments').append(comm1);
             
                             var twice =window["tma"+kj];
                        }
                   
                    }
                    
                }
                
            } 
            if(redcounter>0||greencounter>0){
                
            
           var comm2="<b><u>Summary of Double Deviation</u></b> <br/>"+redcounter+" Deviate More than Double <br/><b><u>Values</u></b><br/>"+ts.replace("undefined"," ")+"<p>";
           var comm3="<b><u>Summary of Deviation Once</u></b> <br/>"+greencounter+" Deviate Once <br/><b><u>Values</u></b><br/>"+ts1.replace("undefined"," ")+"<p>";   
              $("#comments").append(comm2);
              $("#comments").append(comm3);
          }
          else{
              var comm4="None Deviates";
            $("#comments").append(comm4);  
          }
      //$('#comments').append(once);  
  
                       //  var jo  = new Array();
                         // jo.push(once);
 // $('#comments').append(once); 
  // $('#com').val(once); //textarea id, brings blank
//}

        //nje ya loop
      //alert(alphy1);
        }
        
    });
        
});




$(document).ready(function(){
    $('#FormSubmit').click(function(){       
        
        var a=$('#dfm1').val();
        var b=$('#dfm2').val();
        var c=$('#dfm3').val();
        var d=$('#dfm4').val();
        var e=$('#dfm5').val();
        var f=$('#dfm6').val();
        var g=$('#dfm7').val();
        var h=$('#dfm8').val();
        var i=$('#dfm9').val();
        var j=$('#dfm10').val();
        var k=$('#dfm11').val();
        var l=$('#dfm12').val();
        var m=$('#dfm13').val();
        var n=$('#dfm14').val();
        var o=$('#dfm15').val();
        var p=$('#dfm16').val();
        var q=$('#dfm17').val();
        var r=$('#dfm18').val();
        var s=$('#dfm19').val();
        var t=$('#dfm20').val();
        
        if( a == "" || b == "" || c== "" || d== "" || e== "" || f== "" || g== "" || h== "" || i== "" || j== "" || k== "" || l== "" || m== "" || n== "" || o== "" || p== "" || q== "" || r== "" || s== "" || t== ""  ){
            
            alert("Please click the deviation label to fill in the percentages first!");
            return false;
        }else{
            return true;
        }
        
    });


});



        
        


