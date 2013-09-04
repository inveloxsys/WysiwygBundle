WysiwygBundle
=============

This bundles makes really easy to add a ckeditor4, tinymce4 to your forms with per input field settings. Optional integrate the elfinder file manager. You extend it to use with your prefered editors.

ckeditor with ajax requests
            (function( $ ) {
                var id = 'idOfTheEditor';

                $( '#load' ).on( 'click', function() {
                    $.ajax({
                        type: 'POST',
                        url: 'index.php',
                        data: {
                            id: id
                        },
                        error: function(){
                            console.log( 'Error?' );
                        },
                        success: function( data ) {
                            if ( window.CKEDITOR && CKEDITOR.instances[ id ] ) {
                                console.log( 'Desytroying an existing instance!' );
                                CKEDITOR.instances[ id ].destroy();
                            }
                            $( '#mydiv' ).html( data );
                        }
                    });
                });

            })( jQuery );

git clone git@github.com:Studio-42/elFinder.git ./vendor/studio-42/elfinder