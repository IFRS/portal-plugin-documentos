<?php
// Fix Media Permissions
add_action('init', function() {
    global $wp_post_types;
    $wp_post_types['attachment']->cap->edit_posts = 'edit_files';
    $wp_post_types['attachment']->cap->delete_posts = 'delete_files';
});

function ifrs_portal_documentos_addRoles() {
    if (!get_role('cadastrador_documentos')) {
        add_role('cadastrador_documentos', __('Cadastrador de Documentos'), array(
            'read'                    => true,
            'upload_files'            => true,
            'edit_files'              => true,
            'delete_files'            => false,

            'create_documentos'       => true,
            'publish_documentos'      => true,
            'edit_documentos'         => true,
            'delete_documentos'       => false,

            'assign_documento_type'   => true,
            'assign_documento_origin' => true
        ));
    }

    if (!get_role('gerente_documentos')) {
        add_role('gerente_documentos', __('Gerente de Documentos'), array(
            'read'                    => true,
            'upload_files'            => true,
            'edit_files'              => true,
            'delete_files'            => true,

            'create_documentos'       => true,
            'publish_documentos'      => true,
            'edit_documentos'         => true,
            'delete_documentos'       => true,

            'assign_documento_type'   => true,
            'assign_documento_origin' => true
        ));
    }
}

function ifrs_portal_documentos_removeRoles() {
    if (get_role('cadastrador_documentos')) {
        remove_role('cadastrador_documentos');
    }
    if (get_role('gerente_documentos')) {
        remove_role('gerente_documentos');
    }
}
