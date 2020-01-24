<div class="row">
    <div class="col-12 col-lg-9" id="documentos">
        <h2 class="title">
            <?php
            if (is_post_type_archive('documento')) {
                _e('Documentos');
            } elseif (is_tax('documento_type')) {
                single_term_title();
            } elseif (is_tax('documento_origin')) {
                printf(__('Documentos de %s'), single_term_title('', false));
            }

            if (is_year()) {
                echo get_the_date(' \d\e Y');
            }

            if (is_month()) {
                echo get_the_date(' \d\e F \d\e Y');
            }

            if (is_search() && get_search_query()) : ?>
                <small>(Resultados da busca por &ldquo;<?php echo get_search_query(); ?>&rdquo;)</small>
            <?php endif; ?>
        </h2>
        <p><?php _e('Esta página disponibiliza documentos oficiais emitidos pela Reitoria do IFRS: atas, boletins de pessoal, boletins de serviço, contratos, documentos norteadores da instituição, instruções normativas, planos de ação, políticas, portarias, relatórios e resoluções.', 'ifrs-portal-theme'); ?></p>
        <p><?php _e('A relação abaixo está organizada por ordem de publicação ou atualização, os mais atuais aparecem primeiro. Mas é possível, também, consultar por categorias. Basta clicar, no menu à direita, no tipo de documento procurado.', 'ifrs-portal-theme'); ?></p>
        <p><?php _e('Documentos antigos podem ser buscados no site anterior do IFRS, na página do setor ao qual o documento está vinculado.', 'ifrs-portal-theme'); ?></p>
        <?php if (have_posts()) : ?>
            <?php load_template(plugin_dir_path(__FILE__) . 'loop.php'); ?>
        <?php else : ?>
            <?php if (is_search()) : ?>
                <div class="alert alert-danger" role="alert">
                    <p><?php _e('N&atilde;o foram encontrados Documentos com os termos buscados.'); ?></p>
                </div>
            <?php else : ?>
                <div class="alert alert-warning" role="alert">
                    <p><strong><?php _e('Aguarde!', 'ifrs-portal-theme'); ?></strong>&nbsp;<?php if (is_tax('documento_type')) : _e('Ainda n&atilde;o h&aacute; Documentos deste tipo publicados.', 'ifrs-portal-theme'); else : _e('Ainda n&atilde;o h&aacute; Documentos publicados.', 'ifrs-portal-theme'); endif; ?></p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="col-12 col-lg-3">
        <?php load_template(plugin_dir_path(__FILE__) . 'filter.php'); ?>
    </div>
</div>
