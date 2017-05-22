<?php
add_action('init', function() {
    if (get_role( 'cadastrador_documentos' )) {
        remove_role( 'cadastrador_documentos' );
    }
    add_role('cadastrador_cursos', __('Cadastrador de Documentos'), array(
        'read'                  => true,
        'upload_files'          => true,

        'create_documentos'     => true,
        'edit_documentos'       => true,
        'manage_documentos'     => false,

        'assign_documento_type' => true
    ));
});
