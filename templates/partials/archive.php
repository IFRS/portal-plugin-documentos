<?php do_action('ifrs_documentos_before_archive'); ?>

<section class="documentos">
  <?php echo do_blocks( '<!-- wp:query-title {"type":"archive","level":2,"showPrefix":false,"className":"mb-4"} /-->' ); ?>

  <?php echo wpautop(get_option( 'ifrs_documentos_intro' )); ?>

  <?php load_template(plugin_dir_path(__FILE__) . 'filter.php'); ?>

  <?php if (have_posts()) : ?>
    <?php load_template(plugin_dir_path(__FILE__) . 'loop.php'); ?>
  <?php else : ?>
    <?php if (is_search()) : ?>
      <div class="alert alert-danger" role="alert">
        <p><?php _e('N&atilde;o foram encontrados Documentos com os termos buscados.'); ?></p>
      </div>
    <?php else : ?>
      <div class="alert alert-warning" role="alert">
        <strong><?php _e('Ops!'); ?></strong>&nbsp;<?php _e('N&atilde;o foram encontrados Documentos publicados.', 'ifrs-portal-plugin-documentos'); ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</section>

<?php do_action('ifrs_documentos_after_archive'); ?>
