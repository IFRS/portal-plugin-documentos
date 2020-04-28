<?php
class Documentos_Widget extends WP_Widget {
    function __construct() {
        parent::__construct(
            'documentos_widget',
            esc_html__( 'Últimos Documentos', 'ifrs-portal-plugin-documentos' ),
            array( 'description' => esc_html__( 'Últimos Documentos cadastrados ou atualizados', 'ifrs-portal-plugin-documentos' ), )
        );
    }

    private $widget_fields = array();

    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        $query = array(
            'orderby' => 'modified',
            'order' => 'DESC',
            'post_type' => 'documento',
            'posts_per_page' => 5
        );

        $latest_documentos = new WP_Query($query);

        if ($latest_documentos->have_posts()) :
?>
            <div class="ultimos-documentos">
                <?php
                    if ( ! empty( $instance['title'] ) ) {
                        echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
                    }
                ?>
                <?php while ($latest_documentos->have_posts()) : $latest_documentos->the_post(); ?>
                    <div class="ultimos-documentos__documento">
                        <p class="ultimos-documentos__documento-datetime">
                            <?php echo get_the_modified_date('d/m/Y'); ?>
                            &agrave;s
                            <?php echo get_the_modified_time('G\hi'); ?>
                        </p>
                        &bull;
                        <?php echo get_the_term_list(get_the_ID(), 'documento_type', '<ul class="ultimos-documentos__documento-types"><li>', ',&nbsp;</li><li>', '</li></ul>'); ?>
                        <h3 class="ultimos-documentos__documento-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    </div>
                <?php endwhile; ?>
            </div>

            <?php wp_reset_query(); ?>

            <div class="acesso-todos-documentos">
                <hr class="acesso-todos-documentos__separador">
                <a href="<?php echo get_post_type_archive_link( 'documento' ); ?>" class="acesso-todos-documentos__link"><?php _e('Acesse todos os Documentos'); ?></a>
            </div>
<?php
        endif;

        echo $args['after_widget'];
    }

    public function field_generator( $instance ) {
        $output = '';

        foreach ( $this->widget_fields as $widget_field ) {
            $default = '';

            if ( isset($widget_field['default']) ) {
                $default = $widget_field['default'];
            }

            $widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'ifrs-portal-plugin-documentos' );

            switch ( $widget_field['type'] ) {
                default:
                    $output .= '<p>';
                    $output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'ifrs-portal-plugin-documentos' ).':</label> ';
                    $output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
                    $output .= '</p>';
            }
        }

        echo $output;
    }

    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'ifrs-portal-plugin-documentos' );
?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'ifrs-portal-plugin-documentos' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
<?php

        $this->field_generator( $instance );
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();

        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

        foreach ( $this->widget_fields as $widget_field ) {
            switch ( $widget_field['type'] ) {
                default:
                    $instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
            }
        }

        return $instance;
    }
}

function register_documentos_widget() {
    register_widget( 'Documentos_Widget' );
}

add_action( 'widgets_init', 'register_documentos_widget' );
