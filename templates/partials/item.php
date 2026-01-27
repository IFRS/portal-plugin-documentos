<?php ob_start(); ?>

<?php do_action('ifrs_documentos_before_single'); ?>

<article class="documento">
  <!-- wp:post-title /-->

  <!-- wp:group {"className":"documento__meta","layout":{"type":"flex","flexWrap":"wrap"}} -->
  <div class="wp-block-group documento__meta">
    <!-- wp:paragraph -->
    <p><strong><?php _e('Data de Cadastro'); ?>:</strong> <?php echo get_the_date(); ?> <?php _e('às'); ?> <?php echo get_the_time('G\hi'); ?></p>
    <!-- /wp:paragraph -->

    <!-- wp:paragraph -->
    <p><strong><?php _e('&Uacute;ltima Modifica&ccedil;&atilde;o'); ?>:</strong> <?php echo get_the_modified_date(); ?> <?php _e('às'); ?> <?php echo get_the_modified_time('G\hi'); ?></p>
    <!-- /wp:paragraph -->

    <!-- wp:paragraph -->
    <p><strong><?php _e('Tipo'); ?>:</strong> <?php echo get_the_term_list( get_the_ID(), 'documento_type', '', '<br>', '' ); ?></p>
    <!-- /wp:paragraph -->

    <?php $documento_origin_list = get_the_term_list( get_the_ID(), 'documento_origin', '', '<br>', '' ); ?>
    <?php if ($documento_origin_list) : ?>
      <!-- wp:paragraph -->
      <p><strong><?php _e('Origem'); ?>:</strong> <?php echo $documento_origin_list; ?></p>
      <!-- /wp:paragraph -->
    <?php endif; ?>
  </div>
  <!-- /wp:group -->

  <!-- wp:post-content /-->

  <?php
    $documento_files = array();
    $documento_files = array_merge(
      $documento_files,
      array_map(function($arr){
        return $arr + ['date' => get_the_modified_date('U', $arr['ID']), 'group' => 'Documento'];
      }, rwmb_meta('documento_file' ))
    );
    $documento_files = array_merge(
      $documento_files,
      array_map(function($arr){
        return $arr + ['date' => get_the_modified_date('U', $arr['ID']), 'group' => 'Anexos'];
      }, rwmb_meta('documento_anexos' ))
    );
  ?>
  <?php if ( !empty( $documento_files ) ) : ?>
    <table class="table documento__table">
      <thead>
        <tr>
          <th><?php _e('Publicado em'); ?></th>
          <th><?php _e('Arquivo'); ?></th>
          <th><?php _e('Grupo'); ?></th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($documento_files as $key => $file) : ?>
        <tr>
          <td><?php echo date_i18n( 'd/m/Y H:i', $file['date'] ); ?></td>
          <td><a href="<?php echo $file['url']; ?>"><strong><?php echo $file['title']; ?></strong></a></td>
          <td><?php echo $file['group']; ?></td>
        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</article>

<?php do_action('ifrs_documentos_after_single'); ?>

<?php echo do_blocks(ob_get_clean()); ?>
