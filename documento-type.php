<?php
if ( ! function_exists( 'documento_type_taxonomy' ) ) {
    // Register Custom Taxonomy
    function documento_type_taxonomy() {
        $labels = array(
            'name'                       => _x( 'Tipos de Documento', 'Taxonomy General Name', 'ifrs-portal-plugin-documentos' ),
            'singular_name'              => _x( 'Tipo de Documento', 'Taxonomy Singular Name', 'ifrs-portal-plugin-documentos' ),
            'menu_name'                  => __( 'Tipos', 'ifrs-portal-plugin-documentos' ),
            'all_items'                  => __( 'Todas os Tipos de Documento', 'ifrs-portal-plugin-documentos' ),
            'parent_item'                => __( 'Tipo de Documento pai', 'ifrs-portal-plugin-documentos' ),
            'parent_item_colon'          => __( 'Tipo de Documento pai:', 'ifrs-portal-plugin-documentos' ),
            'new_item_name'              => __( 'Novo Tipo de Documento', 'ifrs-portal-plugin-documentos' ),
            'add_new_item'               => __( 'Adicionar Novo Tipo de Documento', 'ifrs-portal-plugin-documentos' ),
            'edit_item'                  => __( 'Editar Tipo de Documento', 'ifrs-portal-plugin-documentos' ),
            'update_item'                => __( 'Atualizar Tipo de Documento', 'ifrs-portal-plugin-documentos' ),
            'separate_items_with_commas' => __( 'Tipos de Documento separadas por vírgula', 'ifrs-portal-plugin-documentos' ),
            'search_items'               => __( 'Buscar Tipo de Documento', 'ifrs-portal-plugin-documentos' ),
            'add_or_remove_items'        => __( 'Adicionar ou remover Tipo de Documento', 'ifrs-portal-plugin-documentos' ),
            'choose_from_most_used'      => __( 'Escolher pelo Tipo de Documento mais usado', 'ifrs-portal-plugin-documentos' ),
            'not_found'                  => __( 'Não encontrado', 'ifrs-portal-plugin-documentos' ),
        );
        $capabilities = array(
    		'manage_terms'       => 'manage_documento_type',
            'assign_terms'       => 'assign_documento_type',
    		'edit_terms'         => 'edit_documento_type',
    		'delete_terms'       => 'delete_documento_type',
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
            'rewrite'           => array('slug' => 'documentos/tipos', 'with_front' => false),
        );
        register_taxonomy( 'documento_type', array( 'documento' ), $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'documento_type_taxonomy', 0 );
}

// Single Term
$single_term_campus = new Taxonomy_Single_Term( 'documento_type' );
$single_term_campus->set( 'priority', 'default' );
// $single_term_campus->set( 'context', 'normal' );
$single_term_campus->set( 'metabox_title', __( 'Tipo', 'ifrs-portal-plugin-documentos' ) );
$single_term_campus->set( 'force_selection', true );
$single_term_campus->set( 'indented', false );
$single_term_campus->set( 'allow_new_terms', false );
