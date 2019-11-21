<?php
if ( ! function_exists( 'documento_origin_taxonomy' ) ) {
    // Register Custom Taxonomy
    function documento_origin_taxonomy() {
        $labels = array(
            'name'                       => _x( 'Origens do Documento', 'Taxonomy General Name', 'ifrs-portal-plugin-documentos' ),
            'singular_name'              => _x( 'Origem do Documento', 'Taxonomy Singular Name', 'ifrs-portal-plugin-documentos' ),
            'menu_name'                  => __( 'Origens', 'ifrs-portal-plugin-documentos' ),
            'all_items'                  => __( 'Todas as Origens de Documento', 'ifrs-portal-plugin-documentos' ),
            'parent_item'                => __( 'Origem do Documento pai', 'ifrs-portal-plugin-documentos' ),
            'parent_item_colon'          => __( 'Origem do Documento pai:', 'ifrs-portal-plugin-documentos' ),
            'new_item_name'              => __( 'Nova Origem de Documento', 'ifrs-portal-plugin-documentos' ),
            'add_new_item'               => __( 'Adicionar Nova Origem de Documento', 'ifrs-portal-plugin-documentos' ),
            'edit_item'                  => __( 'Editar Origem do Documento', 'ifrs-portal-plugin-documentos' ),
            'update_item'                => __( 'Atualizar Origem do Documento', 'ifrs-portal-plugin-documentos' ),
            'separate_items_with_commas' => __( 'Origens do Documento separadas por vírgula', 'ifrs-portal-plugin-documentos' ),
            'search_items'               => __( 'Buscar Origem do Documento', 'ifrs-portal-plugin-documentos' ),
            'add_or_remove_items'        => __( 'Adicionar ou remover Origem do Documento', 'ifrs-portal-plugin-documentos' ),
            'choose_from_most_used'      => __( 'Escolher pela Origem do Documento mais usada', 'ifrs-portal-plugin-documentos' ),
            'not_found'                  => __( 'Não encontrada', 'ifrs-portal-plugin-documentos' ),
        );
        $capabilities = array(
    		'manage_terms'       => 'manage_documento_origin',
            'assign_terms'       => 'assign_documento_origin',
    		'edit_terms'         => 'edit_documento_origin',
    		'delete_terms'       => 'delete_documento_origin',
    	);
        $args = array(
            'labels'            => $labels,
            'hierarchical'      => false,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_nav_menus' => true,
            'show_tagcloud'     => false,
            'capabilities'      => $capabilities,
            'rewrite'           => array('slug' => 'documentos/origens', 'with_front' => false),
        );
        register_taxonomy( 'documento_origin', array( 'documento' ), $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'documento_origin_taxonomy', 0 );
}
