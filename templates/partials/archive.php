<div class="row">
    <div class="col-12 col-lg-9">
        <div class="documentos">
            <h2 class="documentos__title">
                <?php
                if (is_post_type_archive('documento')) {
                    _e('Documentos', 'ifrs-portal-plugin-documentos');
                }

                if (is_tax('documento_type')) {
                    single_term_title();
                }

                if (is_tax('documento_origin')) {
                    printf(__('Documentos de %s', 'ifrs-portal-plugin-documentos'), single_term_title('', false));
                }

                if (is_search() && get_search_query()) {
                    printf(__('<small>(Resultados com o termo &ldquo;%s&rdquo;)</small>', 'ifrs-portal-plugin-documentos'), get_search_query());
                }
                ?>
            </h2>
            <p><?php _e('Esta página disponibiliza documentos oficiais emitidos pela Reitoria do IFRS: atas, boletins de pessoal, boletins de serviço, contratos, documentos norteadores da instituição, instruções normativas, planos de ação, políticas, portarias, relatórios e resoluções.', 'ifrs-portal-plugin-documentos'); ?></p>
            <p><?php _e('A relação abaixo está organizada por ordem de publicação ou atualização, os mais atuais aparecem primeiro. Mas é possível, também, consultar por categorias. Basta clicar, no menu à direita, no tipo de documento procurado.', 'ifrs-portal-plugin-documentos'); ?></p>
            <p><?php _e('Documentos antigos podem ser buscados no site anterior do IFRS, na página do setor ao qual o documento está vinculado.', 'ifrs-portal-plugin-documentos'); ?></p>
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
    </div>
    <div class="col-12 col-lg-3">
        <?php load_template(plugin_dir_path(__FILE__) . 'filter.php'); ?>
    </div>
</div>
