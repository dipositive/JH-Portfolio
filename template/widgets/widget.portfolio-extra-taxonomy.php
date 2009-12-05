<?php### Class: JH Portfolio Selector class WP_Widget_JH_Portfolio_Extra_Taxonomy extends WP_Widget {	// Constructor	function WP_Widget_JH_Portfolio_Extra_Taxonomy() {		$widget_ops = array( 'description' => __( 'Shows a list of tags from the extra taxonomy', 'table_rss_news' ) );		$this->WP_Widget( 'jh_portfolio_extra_taxonomy', __( 'JH Portfolio Extra Taxonomy' ), $widget_ops );	} 	// Display Widget	function widget( $args, $instance ) {		extract( $args, EXTR_SKIP );		extract( $instance );								echo $before_widget;		?>		<?php global $post; if( $terms = wp_get_object_terms( $post->ID,  'jh-portfolio-tag' ) ) : ?>			<h4><?php echo $tax_title ?></h4>			<div id="jh-portfolio-extra-taxonomy">				<p>					<?php foreach( (array) $terms as $key => $term ) : ?>						<?php if( $show_link ) : ?>					   		<a href="<?php echo get_term_link( $term, 'jh-portfolio-tag' ) ?>"><?php echo $term->name ?></a><?php echo $key + 1 !== count( $terms ) ? ', ' : '' ?>						<?php else : ?>					   		<?php echo $term->name ?><?php echo $key + 1 !== count( $terms ) ? ', ' : '' ?>						<?php endif; ?>					<?php endforeach; ?>				</p>			</div>				<?php		endif;		echo $after_widget;		}		function update( $new_instance, $old_instance ) {		$instance = $old_instance;		$instance['tax_title'] = (string) strip_tags( $new_instance['tax_title'] );		$instance['show_link'] = (string) strip_tags( $new_instance['show_link'] );		return $instance;	}	function form( $instance ) {		$instance = wp_parse_args( (array) $instance, array( 'width' => 200, 'height' => 150 ) );		$tax_title = esc_attr( $instance['tax_title'] );		$show_link = $instance['show_link'];		?>				<p>			<label for="<?php echo $this->get_field_id('tax_title'); ?>">				<?php _e('Extra Taxonomy Title:'); ?>				<input class="widefat" id="<?php echo $this->get_field_id('tax_title'); ?>" name="<?php echo $this->get_field_name('tax_title'); ?>" type="text" value="<?php echo $tax_title; ?>" />			</label>		</p>		<p>			<label for="<?php echo $this->get_field_id('show_link'); ?>">				<?php _e('Show links in terms:'); ?>				<input id="<?php echo $this->get_field_id('show_link'); ?>" name="<?php echo $this->get_field_name('show_link'); ?>" type="checkbox"<?php echo $show_link ? ' checked="checked"' : '' ?> />			</label>		</p>			<?php		}}  ### Function: Init Table News Widgetadd_action('widgets_init', 'widget_jh_portfolio_extra_taxonomy');function widget_jh_portfolio_extra_taxonomy() {	register_widget( 'WP_Widget_JH_Portfolio_Extra_Taxonomy' );}?>