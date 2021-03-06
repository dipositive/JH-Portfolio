<?php
$portfolio_base = get_option('jhp_url_base', 'portfolio');

//portfolio home
if( file_exists( $portfolio_file = get_template_directory() . '/' . get_option( 'jhp_template_home', 'portfolio-home.php' ) ) );
else $portfolio_file = dirname( __FILE__ ) . '/template/portfolio.php';

//portfolio single
if( file_exists( $single_file = get_template_directory() . '/' . get_option( 'jhp_template_single', 'portfolio-single.php' ) ) );
else $single_file = dirname( __FILE__ ) . '/template/portfolio.single.php';
$single_base = untrailingslashit(get_option('jhp_single_base', '%category%'));
$single_base = trim( str_ireplace( '%category%', '[^\/]*', $single_base ), '/' );

//portfolio category
if( file_exists( $category_file = get_template_directory() . '/' . get_option( 'jhp_template_category', 'portfolio-category.php' ) ) );
else $category_file = dirname( __FILE__ ) . '/template/portfolio.php';

//portfolio tag
if( file_exists( $tag_file = get_template_directory() . '/' . get_option( 'jhp_template_tag', 'portfolio-tag.php' ) ) );
else $tag_file = dirname( __FILE__ ) . '/template/portfolio.php';

//portfolio home
tj_add_rewrite_rule( "^$portfolio_base(/page/([0-9]*))?/?$", 'is_portfolio=1&static=1&is_page=1&post_type=jh-portfolio&paged=$matches[2]', $portfolio_file );

//category
tj_add_rewrite_rule( "^$portfolio_base/([^/]*)(/page/([0-9]*))?/?$", 'is_portfolio=1&is_portfolio_category=1&taxonomy=jh-portfolio-category&term=$matches[1]&post_type=jh-portfolio&paged=$matches[3]', $category_file );

//tag
tj_add_rewrite_rule( "^$portfolio_base/tag/([^/]*)(/page/([0-9]*))?/?$", 'is_portfolio=1&is_portfolio_tag=1&taxonomy=jh-portfolio-tag&term=$matches[1]&post_type=jh-portfolio&paged=$matches[3]', $tag_file );

//single
tj_add_rewrite_rule( "^$portfolio_base" . ( $single_base ? "/$single_base" : "" ) . "/([^\/]*)/?$", 'is_portfolio_single=1&name=$matches[1]&post_type=jh-portfolio', $single_file );


function jhp_get_single_permastruct() {

	return get_bloginfo( 'url' ) . '/' . get_option('jhp_url_base', 'portfolio') . '/' . trim( get_option('jhp_single_base', '%category%'), '/' ) . '/%post_name%/'; 

}

?>