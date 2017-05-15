<?php
if ( ! function_exists('documento_post_type') ) {
    function documento_post_type() {
        $labels = array(
            'name'               => _x( 'Documentos', 'Post Type General Name', 'ifrs-portal-common-plugin' ),
            'singular_name'      => _x( 'Documento', 'Post Type Singular Name', 'ifrs-portal-common-plugin' ),
            'menu_name'          => __( 'Documentos', 'ifrs-portal-common-plugin' ),
            'name_admin_bar'     => __( 'Documentos', 'ifrs-portal-common-plugin' ),
            'parent_item_colon'  => __( 'Documento principal:', 'ifrs-portal-common-plugin' ),
            'all_items'          => __( 'Todos os Documentos', 'ifrs-portal-common-plugin' ),
            'add_new_item'       => __( 'Adicionar Novo Documento', 'ifrs-portal-common-plugin' ),
            'add_new'            => __( 'Adicionar Novo', 'ifrs-portal-common-plugin' ),
            'new_item'           => __( 'Novo Documento', 'ifrs-portal-common-plugin' ),
            'edit_item'          => __( 'Editar Documento', 'ifrs-portal-common-plugin' ),
            'update_item'        => __( 'Atualizar Documento', 'ifrs-portal-common-plugin' ),
            'view_item'          => __( 'Ver Documento', 'ifrs-portal-common-plugin' ),
            'search_items'       => __( 'Buscar Documento', 'ifrs-portal-common-plugin' ),
            'not_found'          => __( 'Não encontrado', 'ifrs-portal-common-plugin' ),
            'not_found_in_trash' => __( 'Não encontrado na Lixeira', 'ifrs-portal-common-plugin' ),
        );
        $capabilities = array(
			// meta caps (don't assign these to roles)
			'edit_post'              => 'edit_documento',
			'read_post'              => 'read_documento',
			'delete_post'            => 'delete_documento',

			// primitive/meta caps
			'create_posts'           => 'create_documentos',

			// primitive caps used outside of map_meta_cap()
			'edit_posts'             => 'edit_documentos',
			'edit_others_posts'      => 'manage_documentos',
			'publish_posts'          => 'manage_documentos',
			'read_private_posts'     => 'read',

			// primitive caps used inside of map_meta_cap()
			'read'                   => 'read',
			'delete_posts'           => 'manage_documentos',
			'delete_private_posts'   => 'manage_documentos',
			'delete_published_posts' => 'manage_documentos',
			'delete_others_posts'    => 'manage_documentos',
			'edit_private_posts'     => 'edit_documentos',
			'edit_published_posts'   => 'edit_documentos',
		);
        $args = array(
            'label'               => __( 'documento', 'ifrs-portal-common-plugin' ),
            'description'         => __( 'Documentos para o Boletim de Serviço', 'ifrs-portal-common-plugin' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'revisions' ),
            'taxonomies'          => array( 'documento_type' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 10,
            'menu_icon'           => 'dashicons-media-document',
            'can_export'          => true,
            'has_archive'         => true,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => array( 'documento', 'documentos' ),
            'map_meta_cap'        => true,
            'capabilities'        => $capabilities,
            'rewrite'             => array( 'slug' => 'documentos' ),
        );
        register_post_type( 'documento', $args );
    }

    // Hook into the 'init' action
    add_action( 'init', 'documento_post_type', 1 );
}

// MetaBox
function documentos_meta_boxes( $meta_boxes ) {
    $meta_boxes[] = array(
        'title'      => __( 'Arquivo Associado', 'ifrs-portal-common-plugin' ),
        'post_types' => 'documento',
        'priority'   => 'high',
        'fields'     => array(
            array(
                'id'               => 'documento_file',
                'name'             => __( 'Documento', 'ifrs-portal-common-plugin' ),
                'desc'             => __( 'Envio do Documento', 'ifrs-portal-common-plugin' ),
                'type'             => 'file_advanced',
                'max_file_uploads' => 1,
            ),
        ),
    );

    return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'documentos_meta_boxes' );
