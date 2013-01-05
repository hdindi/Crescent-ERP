var readUrl   = 'farms/read',
    updateUrl = 'farms/update',
    delUrl    = 'farms/delete',
    delHref,
    updateHref,
    updateId;

        $( '#updateDialog' ).dialog({
        autoOpen: false,
        buttons: {
            'Update': function() {
                $( '#ajaxLoadAni' ).fadeIn( 'slow' );
                $( this ).dialog( 'close' );
                
                $.ajax({
                    url: updateHref,
                    type: 'POST',
                    data: $( '#updateDialog form' ).serialize(),
                    
                    success: function( response ) {
                        
                        $( '#msgDialog > p' ).html( response );
                        $( '#msgDialog' ).dialog( 'option', 'title', 'Success' ).dialog( 'open' );
                        
                        $( '#ajaxLoadAni' ).fadeOut( 'slow' );
                        
                        //--- update row in table with new values ---
                        var plotnumber = $( 'tr#' + updateId + ' td' )[ 1 ];
                        var farmname = $( 'tr#' + updateId + ' td' )[ 2 ];
                        var crop = $( 'tr#' + updateId + ' td' )[ 3 ];
                        var fielddescription = $( 'tr#' + updateId + ' td' )[ 4 ];
                        var leasorname = $( 'tr#' + updateId + ' td' )[ 5 ];
                        var date = $( 'tr#' + updateId + ' td' )[ 6 ];
                        
                        $( plotnumber ).html( $( '#plotnumber' ).val() );
                        $( farmname ).html( $( '#farmname' ).val() );
                        $( crop ).html( $( '#crop' ).val() );
                        $( fielddescription ).html( $( '#fielddescription' ).val() );
                        $( leasorname ).html( $( '#leasorname' ).val() );
                        $( date ).html( $( '#date' ).val() );
                        
                        //--- clear form ---
                        $( '#updateDialog form input' ).val( '' );
                        
                    } //end success
                    
                }); //end ajax()
            },
            
            'Cancel': function() {
                $( this ).dialog( 'close' );
            }
        },
        width: '350px'
    }); //end update dialog


    $( '#farms' ).delegate( 'a.updateBtn', 'click', function() {
        updateHref = $( this ).attr( 'href' );
        updateId = $( this ).parents( 'tr' ).attr( "id" );
        
        $( '#ajaxLoadAni' ).fadeIn( 'slow' );
        
        $.ajax({
            url: 'farms/getById/' + updateId,
            dataType: 'json',
            
            success: function( response ) {
                $( '#plotnumber' ).val( response.name );
                $( '#farmname' ).val( response.email );
                $( '#crop' ).val( response.date );
                $( '#fielddescription' ).val( response.name );
                $( '#leasorname' ).val( response.email );
                $( '#date' ).val( response.date );
                
                $( '#ajaxLoadAni' ).fadeOut( 'slow' );
                
                //--- assign id to hidden field ---
                $( '#farmId' ).val( updateId );
                
                $( '#updateDialog' ).dialog( 'open' );
            }
        });
        
        return false;
    }); //end update delegate

function readUsers() {
    //display ajax loader animation
    $( '#ajaxLoadAni' ).fadeIn( 'slow' );
    
    $.ajax({
        url: 'farms/read',
        dataType: 'json',
        success: function( response ) {
            
            for( var i in response ) {
                response[ i ].updateLink = updateUrl + '/' + response[ i ].id;
                response[ i ].deleteLink = delUrl + '/' + response[ i ].id;
            }
            
            //clear old rows
            $( '#records' ).html( '' );
            
            //append new rows
            $( '#readTemplate' ).render( response ).appendTo( "#records" );
            
            //hide ajax loader animation here...
            $( '#ajaxLoadAni' ).fadeOut( 'slow' );
        }
    });
} // end readUsers