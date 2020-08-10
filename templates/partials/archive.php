<section class="documentos">
    <div class="documentos__main">
        <h2 class="documentos__title">
            <?php
            if (is_post_type_archive('documento')) {
                _e('Documentos', 'ifrs-portal-plugin-documentos');
            }

            if (is_tax('documento_type') && !isset($_POST['documento_type'])) {
                single_term_title();
            }

            if (is_tax('documento_origin') && !isset($_POST['documento_origin'])) {
                printf(__('Documentos de %s', 'ifrs-portal-plugin-documentos'), single_term_title('', false));
            }

            if (is_search() && get_search_query()) {
                printf(__('<small>(Resultados com o termo &ldquo;%s&rdquo;)</small>', 'ifrs-portal-plugin-documentos'), get_search_query());
            }
            ?>
        </h2>
        <?php echo wpautop(get_option( 'ifrs_documentos_intro' )); ?>
        <?php if (have_posts()) : ?>
            <?php load_template(plugin_dir_path(__FILE__) . 'loop.php'); ?>
        <?php else : ?>
            <?php if (is_search()) : ?>
                <div class="alert alert-danger" role="alert">
                    <p><?php _e('N&atilde;o foram encontrados Documentos com os termos buscados.'); ?></p>
                </div>
            <?php else : ?>
                <div class="alert alert-warning" role="alert">
                    <p><strong><?php _e('Ops!'); ?></strong>&nbsp;<?php printf(__('N&atilde;o foram encontrados Documentos publicados.', 'ifrs-portal-plugin-documentos'), single_term_title('', false)); ?></p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="documentos__aside">
        <?php load_template(plugin_dir_path(__FILE__) . 'filter.php'); ?>
    </div>
</section>
