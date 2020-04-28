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
?>
<aside class="filter">
    <h3 class="filter__title"><?php _e('Filtros', 'ifrs-portal-plugin-documentos'); ?></h3>

    <form action="<?php echo get_post_type_archive_link( 'documento' ); ?>" method="POST" class="filter__form">
        <fieldset>
            <legend>Tipo</legend>
            <?php foreach ($tipos as $tipo): ?>
                <?php $field_id = uniqid(); ?>
                <?php $tipo_check = (isset($_POST['documento_type']) && in_array($tipo->slug, $_POST['documento_type'])) || is_tax('documento_type', $tipo->slug); ?>
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
                <?php $origem_check = (isset($_POST['documento_origin']) && in_array($origem->slug, $_POST['documento_origin'])) || is_tax('documento_origin', $origem->slug); ?>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="documento_origin[]" value="<?php echo $origem->slug; ?>" id="<?php echo $field_id; ?>" <?php echo $origem_check ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="<?php echo $field_id; ?>"><?php echo $origem->name; ?></label>
                </div>
            <?php endforeach; ?>
        </fieldset>

        <div class="btn-group" role="group" aria-label="Ações do Filtro">
            <input type="submit" value="Filtrar" class="btn btn-primary">
            <a href="<?php echo get_post_type_archive_link( 'documento' ); ?>" class="btn btn-outline-secondary"><?php _e('Limpar', 'ifrs-portal-plugin-documentos'); ?></a>
        </div>
    </form>
</aside>
