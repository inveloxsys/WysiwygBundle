# WysiwygBundle

This bundles makes really easy to add a ckeditor4, tinymce4 to your forms with per input field settings. Optional integrate the elfinder file manager. You extend it to use with your prefered editors.

## Security
Add the route you need to secure to the security.yml access-control part:
''' yaml
    access_control:
        - ...
        - { path: ^/_wysiwyg, role: ROLE_IPE_EDITOR }
        - { path: ^/_elfinder, role: ROLE_IPE_EDITOR }
'''

## ElFinder (file manager)

app/console assetic:dump

Pending:
add flash connector

todo
- integrar con ckeditor y tinymce


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