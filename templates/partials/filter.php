<?php
  $tipos = get_terms(array(
    'taxonomy' => 'documento_type',
    'hide_empty' => false,
    'orderby' => 'term_order',
  ));

  $origens = get_terms(array(
    'taxonomy' => 'documento_origin',
    'hide_empty' => false,
    'orderby' => 'term_order',
  ));

  $has_filter = !empty($_POST['documento-data-inicio']) || !empty($_POST['documento-data-fim']) || !empty($_POST['documento_type']) || !empty($_POST['documento_origin']);
?>
<aside class="documentos__filter">
  <details <?php echo ($has_filter) ? 'open' : ''; ?>>
    <summary><?php _e('Filtros', 'ifrs-portal-plugin-documentos'); ?></summary>

    <form action="<?php echo get_post_type_archive_link( 'documento' ); ?>" method="POST">
      <fieldset class="row">
        <legend class="col-12">Data do Documento</legend>
        <div class="form-group col-12 col-sm-6">
          <?php $field_id = uniqid(); ?>
          <label for="<?php echo $field_id; ?>" class="mb-sm-0 mr-sm-1">de</label>
          <input type="date" id="<?php echo $field_id; ?>" name="documento-data-inicio" value="<?php echo (!empty($_POST['documento-data-inicio'])) ? sanitize_text_field($_POST['documento-data-inicio']) : ''; ?>" class="form-control form-control-sm mr-sm-1">
          <small class="form-text text-muted">No formato <em>dia/mês/ano</em>, por exemplo 29/12/2008</small>
        </div>
        <div class="form-group col-12 col-sm-6">
          <?php $field_id = uniqid(); ?>
          <label for="<?php echo $field_id; ?>" class="mb-sm-0 mr-sm-1">até</label>
          <input type="date" id="<?php echo $field_id; ?>" name="documento-data-fim" value="<?php echo (!empty($_POST['documento-data-fim'])) ? sanitize_text_field($_POST['documento-data-fim']) : ''; ?>" class="form-control form-control-sm">
          <small class="form-text text-muted">No formato <em>dia/mês/ano</em>, por exemplo 29/12/2008</small>
        </div>
      </fieldset>
      <fieldset>
        <legend>Tipo</legend>
        <?php foreach ($tipos as $tipo): ?>
          <?php $field_id = uniqid(); ?>
          <?php $tipo_check = (!empty($_POST['documento_type']) && in_array($tipo->slug, $_POST['documento_type'])) || is_tax('documento_type', $tipo->slug); ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="documento_type[]" value="<?php echo $tipo->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $tipo_check ? 'checked' : ''; ?>>
            <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $tipo->name; ?></label>
          </div>
        <?php endforeach; ?>
      </fieldset>
      <fieldset>
        <legend>Origem</legend>
        <?php foreach ($origens as $origem): ?>
          <?php $field_id = uniqid(); ?>
          <?php $origem_check = (!empty($_POST['documento_origin']) && in_array($origem->slug, $_POST['documento_origin'])) || is_tax('documento_origin', $origem->slug); ?>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" name="documento_origin[]" value="<?php echo $origem->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $origem_check ? 'checked' : ''; ?>>
            <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $origem->name; ?></label>
          </div>
        <?php endforeach; ?>
      </fieldset>

      <fieldset>
        <div class="btn-group" role="group" aria-label="Ações do Filtro">
          <input type="submit" value="Filtrar" class="btn btn-outline-primary">
          <a href="<?php echo get_post_type_archive_link( 'documento' ); ?>" class="btn btn-outline-secondary"><?php _e('Limpar', 'ifrs-portal-plugin-documentos'); ?></a>
        </div>
      </fieldset>
    </form>
  </details>
</aside>
