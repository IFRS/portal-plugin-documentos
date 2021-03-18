<?php the_post(); ?>

<section class="documento">
    <article class="documento__main">
        <h2 class="documento__title"><?php the_title(); ?></h2>
        <div class="documento__content">
            <?php the_content(); ?>
        </div>
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
        <?php if ( !empty( $edital_files ) ) : ?>
            <div class="table-responsive">
                <table class="table table-striped documento__table">
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
            </div>
        <?php endif; ?>
    </article>
    <aside class="documento__dados">
        <h3 class="documento__dados-title"><?php _e('Dados do Documento'); ?></h3>
        <p>
            <strong>Tipo</strong>
            <br>
            <?php echo get_the_term_list( get_the_ID(), 'documento_type', '', '<br>', '' ); ?>
        </p>
        <?php $documento_origin_list = get_the_term_list( get_the_ID(), 'documento_origin', '', '<br>', '' ); ?>
        <?php if ($documento_origin_list) : ?>
            <p>
                <strong>Origem</strong>
                <br>
                <?php echo $documento_origin_list; ?>
            </p>
        <?php endif; ?>
        <p>
            <strong>Publica&ccedil;&atilde;o</strong>
            <br>
            <?php echo get_the_date(); ?> <?php _e('às'); ?> <?php echo get_the_time('G\hi'); ?>
        </p>
    </aside>
</section>
