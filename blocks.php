<?php
/**
 * Bloco: Últimos Documentos
 * Renderiza os últimos documentos cadastrados ou atualizados
 */

function render_ultimos_documentos_block($attributes) {
  $title = isset($attributes['title']) ? sanitize_text_field($attributes['title']) : 'Últimos Documentos';
  $posts_per_page = isset($attributes['postsPerPage']) ? intval($attributes['postsPerPage']) : 5;

  $query = array(
      'orderby' => 'modified',
      'order' => 'DESC',
      'post_type' => 'documento',
      'posts_per_page' => $posts_per_page
  );

  $latest_documentos = new WP_Query($query);

  ob_start();
?>
  <div class="ultimos-documentos">
    <!-- wp:heading {"className":"ultimos-documentos__title"} -->
    <h2 class="wp-block-heading ultimos-documentos__title"><?php echo esc_html($title); ?></h2>
    <!-- /wp:heading -->
    <?php if ($latest_documentos->have_posts()) : ?>
      <?php while ($latest_documentos->have_posts()) : $latest_documentos->the_post(); ?>
        <a href="<?php the_permalink(); ?>" class="documento-recente">
          <div class="documento-recente__meta">
            <p class="documento-recente__datetime">
              <?php echo do_shortcode( '[icon name="calendar" prefix="far"]'); ?>
              <?php echo get_the_modified_date('d/m/Y'); ?>
              &agrave;s
              <?php echo get_the_modified_time('G\hi'); ?>
            </p>
            &bull;
            <?php
              $terms = get_the_terms(get_the_ID(), 'documento_type');
              if ($terms && !is_wp_error($terms)) {
                echo '<ul class="documento-recente__taxonomy-list"><li>' .
                implode('</li><li>', wp_list_pluck($terms, 'name')) .
                '</li></ul>';
              }
            ?>
          </div>
          <h3 class="documento-recente__title">
            <?php echo get_the_title(); ?>
          </h3>
        </a>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>

  <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
  <div class="wp-block-buttons">
    <!-- wp:button {"className":"is-style-outline"} -->
    <div class="wp-block-button is-style-outline">
      <a class="wp-block-button__link wp-element-button" href="<?php echo esc_url(get_post_type_archive_link('documento')); ?>">Acesse todos os Documentos</a>
    </div>
    <!-- /wp:button -->
  </div>
  <!-- /wp:buttons -->
<?php
  wp_reset_query();

  return do_blocks(ob_get_clean());
}

function register_ultimos_documentos_block() {
  // Verifica se a função de registar blocos existe
  if (!function_exists('register_block_type')) {
    return;
  }

  // Define o caminho para os arquivos do bloco
  $block_dir = plugin_dir_path(__FILE__);
  $block_script = $block_dir . 'block.js';
  $block_asset_path = $block_dir . 'block.asset.php';

  // Verifica se os arquivos build existem (produção)
  if (file_exists($block_script) && file_exists($block_asset_path)) {
    $asset_file = require($block_asset_path);

    // Registra o script do bloco
    wp_register_script(
      'ifrs-ultimos-documentos-block',
      plugins_url('block.js', __FILE__),
      isset($asset_file['dependencies']) ? $asset_file['dependencies'] : array(),
      isset($asset_file['version']) ? $asset_file['version'] : filemtime($block_script)
    );

    // Registra o bloco
    register_block_type('ifrs/ultimos-documentos', array(
      'editor_script' => 'ifrs-ultimos-documentos-block',
      'render_callback' => 'render_ultimos_documentos_block',
      'attributes' => array(
        'title' => array(
          'type' => 'string',
          'default' => 'Últimos Documentos'
        ),
        'postsPerPage' => array(
          'type' => 'number',
          'default' => 5
        )
      )
    ));
  }
}

add_action('init', 'register_ultimos_documentos_block');
