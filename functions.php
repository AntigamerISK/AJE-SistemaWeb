<?php
@set_time_limit( 300 );
/**
 * functions.php
 * @package WordPress
 * @subpackage Grogin
 * @since Grogin 1.2.7
 * 
 */

/*************************************************
## Get Theme Info
*************************************************/ 
if ( ! function_exists( 'grogin_get_theme_info' ) ) {
	function grogin_get_theme_info( $parameter ) {
		
		$theme_info = wp_get_theme( get_template() )->get( $parameter );
		
		return $theme_info;
	}
}

define( 'GROGIN_VERSION', '1.3.3' );

/*************************************************
## Admin style and scripts  
*************************************************/ 
function grogin_admin_styles() {
	wp_enqueue_style('grogin-klbtheme',     get_template_directory_uri() .'/assets/css/admin/klbtheme.css');
	wp_enqueue_script('grogin-init', 	    get_template_directory_uri() .'/assets/js/init.js', array('jquery','media-upload','thickbox'));
    wp_enqueue_script('grogin-register',    get_template_directory_uri() .'/assets/js/admin/register.js', array('jquery'), GROGIN_VERSION, true);
	wp_register_style( 'grogin-klbtheme-icons', 	get_template_directory_uri() .'/assets/css/klbtheme-icons.css', false, GROGIN_VERSION);
	wp_register_style( 'grogin-klbtheme-social', 	get_template_directory_uri() .'/assets/css/klbtheme-social.css', false, GROGIN_VERSION);
}
add_action('admin_enqueue_scripts', 'grogin_admin_styles');

 /*************************************************
## Grogin Fonts
*************************************************/
function grogin_fonts_url() {
	$fonts_url = '';

	$allfont = array();
	
	$inter 		= '"Inter", sans-serif';
	$barlow 	= '"Barlow", sans-serif';

	$allfont[] = isset(get_theme_mod('grogin_body_typography', [])['font-family']) ? get_theme_mod('grogin_body_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('grogin_heading_typography', [])['font-family']) ? get_theme_mod('grogin_heading_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('grogin_menu_typography', [])['font-family']) ? get_theme_mod('grogin_menu_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('grogin_form_typography', [])['font-family']) ? get_theme_mod('grogin_form_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('grogin_button_typography', [])['font-family']) ? get_theme_mod('grogin_button_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('grogin_price_typography', [])['font-family']) ? get_theme_mod('grogin_price_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('grogin_product_name_typography', [])['font-family']) ? get_theme_mod('grogin_product_name_typography', [])['font-family'] :'';
	$allfont[] = isset(get_theme_mod('grogin_topbar_typography', [])['font-family']) ? get_theme_mod('grogin_topbar_typography', [])['font-family'] :'';
	
	$font_families = array();
	
	if(in_array($inter, $allfont) || !$allfont) {
		$font_families[] = 'Inter:wght@100;200;300;400;500;600;700;800;900';
	}
	
	if(in_array($barlow, $allfont)) {
		$font_families[] = 'Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900';
	}
	
	if(in_array($inter, $allfont) || in_array($barlow, $allfont) || !$allfont) {
		$query_args = array( 
			'family' => rawurldecode( implode( '&family=', $font_families ) ), 
			'subset' => rawurldecode( 'latin,latin-ext' ), 
		); 
		 
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css2' );
	}
	
	return esc_url_raw( $fonts_url );
}

/*************************************************
## Styles and Scripts
*************************************************/ 
define('GROGIN_INDEX_CSS', 	  get_template_directory_uri()  . '/assets/css');
define('GROGIN_INDEX_JS', 	  get_template_directory_uri()  . '/assets/js');

function grogin_scripts() {

	if ( is_admin_bar_showing() ) {
		wp_enqueue_style( 'grogin-klbtheme', GROGIN_INDEX_CSS . '/admin/klbtheme.css', false, GROGIN_VERSION);    
	}	

	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
	
	wp_enqueue_style( 'bootstrap', 						GROGIN_INDEX_CSS . '/bootstrap.min.css', false, GROGIN_VERSION);
	wp_enqueue_style( 'grogin-klbtheme-icons', 			GROGIN_INDEX_CSS . '/klbtheme-icons.css', false, GROGIN_VERSION);
	wp_enqueue_style( 'grogin-klbtheme-social', 		GROGIN_INDEX_CSS . '/klbtheme-social.css', false, GROGIN_VERSION);
	
	// Carga condicional de Slick Carousel (solo en Home, Tienda, Categorías y Ficha de Producto)
	if ( is_front_page() || is_home() || is_shop() || is_product_category() || ( function_exists( 'is_product' ) && is_product() ) ) {
		wp_enqueue_style( 'slick', 							GROGIN_INDEX_CSS . '/slick.css', false, GROGIN_VERSION);
	}
	
	wp_enqueue_style( 'grogin-social-media', 			GROGIN_INDEX_CSS . '/modules/social-media.css', false, GROGIN_VERSION);
	wp_style_add_data( 'grogin-social-media', 'rtl', 'replace' );
	wp_enqueue_style( 'grogin-slider', 					GROGIN_INDEX_CSS . '/modules/slider.css', false, GROGIN_VERSION);
	wp_style_add_data( 'grogin-slider', 'rtl', 'replace' );
	wp_enqueue_style( 'grogin-banner', 					GROGIN_INDEX_CSS . '/modules/banner.css', false, GROGIN_VERSION);
	wp_style_add_data( 'grogin-banner', 'rtl', 'replace' );
	wp_enqueue_style( 'grogin-iconbox', 				GROGIN_INDEX_CSS . '/modules/iconbox.css', false, GROGIN_VERSION);
	wp_style_add_data( 'grogin-iconbox', 'rtl', 'replace' );
	wp_enqueue_style( 'grogin-hover-gallery', 			GROGIN_INDEX_CSS . '/modules/hover-gallery.css', false, GROGIN_VERSION);
	wp_style_add_data( 'grogin-hover-gallery', 'rtl', 'replace' );
	wp_enqueue_style( 'grogin-product-grid', 			GROGIN_INDEX_CSS . '/modules/product-grid.css', false, GROGIN_VERSION);
	wp_style_add_data( 'grogin-product-grid', 'rtl', 'replace' );
	wp_enqueue_style( 'grogin-promo-banner', 			GROGIN_INDEX_CSS . '/modules/promo-banner.css', false, GROGIN_VERSION);
	wp_style_add_data( 'grogin-promo-banner', 'rtl', 'replace' );
	wp_enqueue_style( 'grogin-store-box', 				GROGIN_INDEX_CSS . '/modules/store-box.css', false, GROGIN_VERSION);
	wp_style_add_data( 'grogin-store-box', 'rtl', 'replace' );
	wp_enqueue_style( 'grogin-category-box', 			GROGIN_INDEX_CSS . '/modules/category-box.css', false, GROGIN_VERSION);
	wp_style_add_data( 'grogin-category-box', 'rtl', 'replace' );
	
	// Carga condicional de estilos de Blog
	if ( is_home() || is_archive() || is_single() || is_search() ) {
		wp_enqueue_style( 'grogin-blog', 					GROGIN_INDEX_CSS . '/modules/blog.css', false, GROGIN_VERSION);
		wp_style_add_data( 'grogin-blog', 'rtl', 'replace' );
	}
	
	// Carga condicional de estilos de Página de Contacto
	if ( is_page_template( 'page-templates/contact.php' ) || is_page( 'contact' ) || is_page( 'contacto' ) ) {
		wp_enqueue_style( 'grogin-contact-page', 			GROGIN_INDEX_CSS . '/modules/contact-page.css', false, GROGIN_VERSION);
		wp_style_add_data( 'grogin-contact-page', 'rtl', 'replace' );
	}
	
	wp_enqueue_style( 'magnific-popup', 				GROGIN_INDEX_CSS . '/magnific-popup.css', false, GROGIN_VERSION);
	wp_enqueue_style( 'typography', 					GROGIN_INDEX_CSS . '/typography-min.css', false, GROGIN_VERSION);
	wp_enqueue_style( 'grogin-spaces', 					GROGIN_INDEX_CSS . '/spaces-min.css', false, GROGIN_VERSION);
	wp_style_add_data( 'grogin-spaces', 'rtl', 'replace' );
	wp_enqueue_style( 'colors-min', 					GROGIN_INDEX_CSS . '/colors-min.css', false, GROGIN_VERSION);
	wp_enqueue_style( 'grogin-base', 					GROGIN_INDEX_CSS . '/base.css', false, GROGIN_VERSION);
	wp_style_add_data( 'grogin-base', 'rtl', 'replace' );
	wp_enqueue_style( 'grogin-font-url',  					grogin_fonts_url(), array(), null );
	wp_enqueue_style( 'grogin-style',         	get_stylesheet_uri() );
	wp_style_add_data( 'grogin-style', 'rtl', 'replace' );

	$mapkey = get_theme_mod('grogin_mapapi');
	
	
	wp_enqueue_script( 'imagesloaded');
	wp_enqueue_script( 'bootstrap-bundle',    	    	 GROGIN_INDEX_JS . '/bootstrap.bundle.min.js', array('jquery'), GROGIN_VERSION, true);
	
	// Carga condicional de Scripts de Cuenta Regresiva (Offers / Deals)
	if ( is_front_page() || is_home() || is_shop() || is_product_category() || ( function_exists( 'is_product' ) && is_product() ) ) {
		wp_enqueue_script( 'jquery-countdown',    	   		 GROGIN_INDEX_JS . '/jquery.countdown.min.js', array('jquery'), GROGIN_VERSION, true);
		wp_enqueue_script( 'grogin-countdown',        		 GROGIN_INDEX_JS . '/custom/countdown.js', array('jquery'), GROGIN_VERSION, true);
	}
	
	// Carga condicional de animaciones GSAP & Draggable (solo en Home y archivos principales de catálogo)
	if ( is_front_page() || is_home() || is_shop() || is_product_category() ) {
		wp_enqueue_script( 'Draggable',    	   				 GROGIN_INDEX_JS . '/Draggable.min.js', array('jquery'), GROGIN_VERSION, true);
		wp_enqueue_script( 'gsap-min',    	    	 	 	 GROGIN_INDEX_JS . '/gsap.min.js', array('jquery'), GROGIN_VERSION, true);
	}
	
	// Carga condicional de Slick Slider JS
	if ( is_front_page() || is_home() || is_shop() || is_product_category() || ( function_exists( 'is_product' ) && is_product() ) ) {
		wp_enqueue_script( 'slick-min',    	    	 		 GROGIN_INDEX_JS . '/slick.min.js', array('jquery'), GROGIN_VERSION, true);
	}
	
	wp_enqueue_script( 'hover-gallery',    	    	 	 GROGIN_INDEX_JS . '/hover-gallery.js', array('jquery'), GROGIN_VERSION, true);
	wp_register_script( 'theia-sticky-sidebar',    		 GROGIN_INDEX_JS . '/theia-sticky-sidebar.min.js', array('jquery'), GROGIN_VERSION, true);
	wp_enqueue_script( 'jquery-magnific-popup',    		 GROGIN_INDEX_JS . '/jquery.magnific-popup.min.js', array('jquery'), GROGIN_VERSION, true);
	wp_enqueue_script( 'grogin-siteslider',    	 		 GROGIN_INDEX_JS . '/custom/siteslider.js', array('jquery'), GROGIN_VERSION, true);
	wp_enqueue_script( 'grogin-productquantity',    	 GROGIN_INDEX_JS . '/custom/productquantity.js', array('jquery'), GROGIN_VERSION, true);
	wp_register_script( 'grogin-mobilesorting',     	 GROGIN_INDEX_JS . '/custom/mobilesorting.js', array('jquery'), GROGIN_VERSION, true);
	wp_register_script( 'grogin-stickysidebar',     	 GROGIN_INDEX_JS . '/custom/stickysidebar.js', array('jquery'), GROGIN_VERSION, true);
	wp_register_script( 'grogin-sidebarfilter',     	 GROGIN_INDEX_JS . '/custom/sidebarfilter.js', array('jquery'), GROGIN_VERSION, true);
    wp_enqueue_script( 'grogin-cartquantity',    		 GROGIN_INDEX_JS . '/custom/cartquantity.js', array('jquery'), GROGIN_VERSION, true);
	wp_register_script( 'grogin-flex-thumbs',      		 GROGIN_INDEX_JS . '/custom/flex-thumbs.js', array('jquery'), GROGIN_VERSION, true);
	wp_register_script( 'grogin-loginform',   			 GROGIN_INDEX_JS . '/custom/loginform.js', array('jquery'), GROGIN_VERSION, true);
	wp_register_script( 'grogin-hoverslider',       	 GROGIN_INDEX_JS . '/custom/hoverslider.js', array('jquery'), GROGIN_VERSION, true);
	wp_enqueue_script( 'grogin-sitescroll',     		 GROGIN_INDEX_JS . '/custom/sitescroll.js', array('jquery'), GROGIN_VERSION, true);
	wp_enqueue_script( 'grogin-productshare',     		 GROGIN_INDEX_JS . '/custom/productshare.js', array('jquery'), GROGIN_VERSION, true);
	wp_enqueue_script( 'bundle',    	    	 	GROGIN_INDEX_JS . '/bundle.js', array('jquery'), GROGIN_VERSION, true);

	
}
add_action( 'wp_enqueue_scripts', 'grogin_scripts' );

/*************************************************
## Theme Setup
*************************************************/ 

if ( ! isset( $content_width ) ) $content_width = 960;

function grogin_theme_setup() {
	
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-formats', array('gallery', 'audio', 'video'));
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'woocommerce', array('gallery_thumbnail_image_width' => 99,) );
	load_theme_textdomain( 'grogin', get_template_directory() . '/languages' );
	remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'grogin_theme_setup' );

/*************************************************
## Include the TGM_Plugin_Activation class.
*************************************************/ 

require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'grogin_register_required_plugins' );

function grogin_register_required_plugins() {

	$url = 'http://klbtheme.com/grogin/plugins/';
	$mainurl = 'http://klbtheme.com/plugins/';

	$plugins = array(
		
        array(
            'name'                  => esc_html__('Meta Box','grogin'),
            'slug'                  => 'meta-box',
        ),

        array(
            'name'                  => esc_html__('Contact Form 7','grogin'),
            'slug'                  => 'contact-form-7',
        ),
		
        array(
            'name'                  => esc_html__('Kirki','grogin'),
            'slug'                  => 'kirki',
        ),
		
		array(
            'name'                  => esc_html__('MailChimp Subscribe','grogin'),
            'slug'                  => 'mailchimp-for-wp',
        ),
		
        array(
            'name'                  => esc_html__('Elementor','grogin'),
            'slug'                  => 'elementor',
            'required'              => true,
        ),
		
        array(
            'name'                  => esc_html__('WooCommerce','grogin'),
            'slug'                  => 'woocommerce',
            'required'              => true,
        ),

        array(
            'name'                  => esc_html__('Grogin Core','grogin'),
            'slug'                  => 'grogin-core',
            'source'                => $url . 'grogin-core.zip',
            'required'              => true,
            'version'               => '1.2.5',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),

        array(
            'name'                  => esc_html__('Envato Market','grogin'),
            'slug'                  => 'envato-market',
            'source'                => $mainurl . 'envato-market.zip',
            'required'              => true,
            'version'               => '2.0.12',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),


	);

	$config = array(
		'id'           => 'grogin',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

/*************************************************
## Grogin Register Menu 
*************************************************/

function grogin_register_menus() {
	register_nav_menus( array( 'main-menu' 	   => esc_html__('Primary Navigation Menu','grogin')) );
	
	$canvasbottommenu = get_theme_mod('grogin_canvas_bottom_menu','0');
	$topleftmenu = get_theme_mod('grogin_top_left_menu','0');
	$toprightmenu = get_theme_mod('grogin_top_right_menu','0');
	$footermenu = get_theme_mod('grogin_footer_menu','0');
	$sidebarmenu = get_theme_mod('grogin_header_sidebar','0');
	
	if($canvasbottommenu == '1'){
	register_nav_menus( array( 'canvas-bottom' 	   => esc_html__('Canvas Bottom Menu','grogin')) );
	}
	
	if($topleftmenu == '1'){
		register_nav_menus( array( 'top-left-menu'     => esc_html__('Top Left Menu','grogin')) );
	}
	
	if($toprightmenu == '1'){
		register_nav_menus( array( 'top-right-menu'     => esc_html__('Top Right Menu','grogin')) );
	}
	
	if($sidebarmenu == '1'){
		register_nav_menus( array( 'sidebar-menu'       => esc_html__('Sidebar Menu','grogin')) );
	}
	
	if($footermenu == '1'){
		register_nav_menus( array( 'footer-menu'       => esc_html__('Footer Menu','grogin')) );
	}
	
}
add_action('init', 'grogin_register_menus');

/*************************************************
## Excerpt More
*************************************************/ 

function grogin_excerpt_more($more) {
  global $post;
  return '<div class="klb-readmore entry-button"><a class="btn btn-primary link" href="'. esc_url(get_permalink($post->ID)) . '">' . esc_html__('Read More', 'grogin') . ' <i class="klbth-icon-right-arrow"></i></a></div>';
  }
 add_filter('excerpt_more', 'grogin_excerpt_more');
 
/*************************************************
## Word Limiter
*************************************************/ 
function grogin_limit_words($string, $limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $limit));
}

/*************************************************
## Widgets
*************************************************/ 

function grogin_widgets_init() {
	register_sidebar( array(
	  'name' => esc_html__( 'Blog Sidebar', 'grogin' ),
	  'id' => 'blog-sidebar',
	  'description'   => esc_html__( 'These are widgets for the Blog page.','grogin' ),
	  'before_widget' => '<div class="widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Shop Sidebar', 'grogin' ),
	  'id' => 'shop-sidebar',
	  'description'   => esc_html__( 'These are widgets for the Shop.','grogin' ),
	  'before_widget' => '<div class="widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer First Column', 'grogin' ),
	  'id' => 'footer-1',
	  'description'   => esc_html__( 'These are widgets for the Footer.','grogin' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Second Column', 'grogin' ),
	  'id' => 'footer-2',
	  'description'   => esc_html__( 'These are widgets for the Footer.','grogin' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Third Column', 'grogin' ),
	  'id' => 'footer-3',
	  'description'   => esc_html__( 'These are widgets for the Footer.','grogin' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );

	register_sidebar( array(
	  'name' => esc_html__( 'Footer Fourth Column', 'grogin' ),
	  'id' => 'footer-4',
	  'description'   => esc_html__( 'These are widgets for the Footer.','grogin' ),
	  'before_widget' => '<div class="klbfooterwidget widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h4 class="widget-title">',
	  'after_title'   => '</h4>'
	) );
}
add_action( 'widgets_init', 'grogin_widgets_init' );
 
/*************************************************
## Grogin Comment
*************************************************/

if ( ! function_exists( 'grogin_comment' ) ) :
 function grogin_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
   case 'pingback' :
   case 'trackback' :
  ?>

   <article class="post pingback">
   <p><?php esc_html_e( 'Pingback:', 'grogin' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'grogin' ), ' ' ); ?></p>
  <?php
    break;
   default :
  ?>
  
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
		  <article class="comment-body klb-comment-body">
			  <div class="vcard">
				<img src="<?php echo get_avatar_url( $comment, 90 ); ?>" alt="<?php comment_author(); ?>" class="avatar">
			  </div>
			<div class="comment-right-side comment-meta">
				<div class="comment-author">
				<b class="fn"><a class="url"><?php comment_author(); ?></a></b>
				</div>
				<div class="comment-metadata">
				  <time><?php comment_date(); ?></time>
				</div><!-- comment-metadata -->
			
				<div class="comment-content">
					<div class="klb-post">
						<?php comment_text(); ?>
						<?php if ( $comment->comment_approved == '0' ) : ?>
						<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'grogin' ); ?></em>
						<?php endif; ?>
					</div>
				</div><!-- comment-content -->
				<div class="reply">
				  <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- reply -->
			</div><!-- comment-right-side -->

		  </article>
	    </div>
	</li>

  <?php
    break;
  endswitch;
 }
endif;

/*************************************************
## Grogin Widget Count Filter
 *************************************************/

function grogin_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span class="catcount">(', $links);
  $links = str_replace(')', ')</span>', $links);
  return grogin_sanitize_data($links);
}
add_filter('wp_list_categories', 'grogin_cat_count_span');
 
function grogin_archive_count_span( $links ) {
	$links = str_replace( '</a>&nbsp;(', '</a><span class="catcount">(', $links );
	$links = str_replace( ')', ')</span>', $links );
	return grogin_sanitize_data($links);
}
add_filter( 'get_archives_link', 'grogin_archive_count_span' );


/*************************************************
## Pingback url auto-discovery header for single posts, pages, or attachments
 *************************************************/
function grogin_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'grogin_pingback_header' );

/*************************************************
## Nav Description
 *************************************************/
function grogin_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<span class="badge ' . $item->description . '">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
    }
 
    return grogin_sanitize_data($item_output);
}
add_filter( 'walker_nav_menu_start_el', 'grogin_nav_description', 10, 4 );

/************************************************************
## DATA CONTROL FROM PAGE METABOX OR ELEMENTOR PAGE SETTINGS
*************************************************************/
function grogin_page_settings( $opt_id){
	
	if ( class_exists( '\Elementor\Core\Settings\Manager' ) ) {
		// Get the current post id
		$post_id = get_the_ID();

		// Get the page settings manager
		$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

		// Get the settings model for current post
		$page_settings_model = $page_settings_manager->get_model( $post_id )->get_data('settings');

		// Retrieve the color we added before
		return isset($page_settings_model['grogin_elementor_'.$opt_id]) ? $page_settings_model['grogin_elementor_'.$opt_id] : false;

	}
}

/************************************************************
## Elementor Register Location
*************************************************************/
function grogin_register_elementor_locations( $elementor_theme_manager ) {

    $elementor_theme_manager->register_location( 'header' );
    $elementor_theme_manager->register_location( 'footer' );
    $elementor_theme_manager->register_location( 'single' );
	$elementor_theme_manager->register_location( 'archive' );

}
add_action( 'elementor/theme/register_locations', 'grogin_register_elementor_locations' );

/************************************************************
## Elementor Get Templates
*************************************************************/
function grogin_get_elementor_template($template_id){
	if($template_id){

		$frontend = \Elementor\Plugin::instance()->frontend;
	    printf( '<div class="grogin-elementor-template template-'.esc_attr($template_id).'">%1$s</div>', $frontend->get_builder_content_for_display( $template_id, true ) );	
	   
	   if ( class_exists( '\Elementor\Plugin' ) ) {
	        $elementor = \Elementor\Plugin::instance();
	        $elementor->frontend->enqueue_styles();
			$elementor->frontend->enqueue_scripts();
	    }
	
	    if ( class_exists( '\ElementorPro\Plugin' ) ) {
	        $elementor_pro = \ElementorPro\Plugin::instance();
	    }

	}

}
add_action( 'grogin_before_main_shop', 	 'grogin_get_elementor_template', 10);
add_action( 'grogin_after_main_shop', 	 'grogin_get_elementor_template', 10);
add_action( 'grogin_before_main_footer', 'grogin_get_elementor_template', 10);
add_action( 'grogin_after_main_footer',  'grogin_get_elementor_template', 10);
add_action( 'grogin_before_main_header', 'grogin_get_elementor_template', 10);
add_action( 'grogin_after_main_header',  'grogin_get_elementor_template', 10);

/************************************************************
## Do Action for Templates and Product Categories
*************************************************************/
function grogin_do_action($hook){
	
	if ( !class_exists( 'woocommerce' ) ) {
		return;
	}

	$categorytemplate = get_theme_mod('grogin_elementor_template_each_shop_category');
	if(is_product_category()){
		if($categorytemplate && array_search(get_queried_object()->term_id, array_column($categorytemplate, 'category_id')) !== false){
			foreach($categorytemplate as $c){
				if($c['category_id'] == get_queried_object()->term_id){
					do_action( $hook, $c[$hook.'_elementor_template_category']);
				}
			}
		} else {
			do_action( $hook, get_theme_mod($hook.'_elementor_template'));
		}
	} else {
		do_action( $hook, get_theme_mod($hook.'_elementor_template'));
	}
	
}

/*************************************************
## Grogin Get Image
*************************************************/
function grogin_get_image($image){
	$app_image = ! wp_attachment_is_image($image) ? $image : wp_get_attachment_url($image);
	
	return esc_html($app_image);
}

/*************************************************
## Grogin Get options
*************************************************/
function grogin_get_option(){	
	if ( ! current_user_can( 'manage_options' ) ) {
		return '';
	}
	$getopt  = isset( $_GET['opt'] ) ? $_GET['opt'] : '';

	return esc_html($getopt);
}

/*************************************************
## Grogin Body Class
*************************************************/ 
function grogin_body_input_class( $classes ) {
	
	if(get_theme_mod('grogin_body_input_type') == 'filled') {
		$classes[] = 'input-variation-filled';
	} else {
		$classes[] = 'input-variation-default';
	}	
	
	return $classes;
}
add_filter('body_class', 'grogin_body_input_class');

/*************************************************
## Grogin Custom 404 Page
*************************************************/ 
if ( ! function_exists( 'grogin_custom_404_page' ) ) {
	function grogin_custom_404_page( $template ) {
		global $wp_query;
		$custom_404 = get_theme_mod('grogin_404_page');

		if ( $custom_404 === 'default' || empty( $custom_404 ) ) {
			return $template;
		}

		$wp_query->query( 'page_id=' . $custom_404 );
		$wp_query->the_post();
		$template = get_page_template();
		rewind_posts();

		return $template;
	}

	add_filter( '404_template', 'grogin_custom_404_page', 999 );
}

/*************************************************
## Grogin Subscribe Form
*************************************************/ 
if ( ! function_exists( 'grogin_subscribe_form' ) ) {
	function grogin_subscribe_form($formid = '') {
		echo do_shortcode('[mc4wp_form id="'.$formid.'"]');
	}
}	

/*************************************************
## Grogin FT
*************************************************/ 
if ( ! function_exists( 'grogin_ft' ) ) {
	function grogin_ft() {
		return;
	}
}

/*************************************************
## Grogin Theme options
*************************************************/
	
	require_once get_template_directory() . '/includes/metaboxes.php';
	require_once get_template_directory() . '/includes/woocommerce.php';
	require_once get_template_directory() . '/includes/woocommerce-filter.php';
	require_once get_template_directory() . '/includes/pjax/filter-functions.php';
	require_once get_template_directory() . '/includes/sanitize.php';
	require_once get_template_directory() . '/includes/merlin/theme-register.php';
	require_once get_template_directory() . '/includes/merlin/setup-wizard.php';
	require_once get_template_directory() . '/includes/header/main-header.php';
	require_once get_template_directory() . '/includes/footer/main_footer.php';

/************************************************************
## REGISTRAR Y MOSTRAR EL PRECIO MÍNIMO DE LOS ÚLTIMOS 30 DÍAS
*************************************************************/

/**
 * Registrar el historial de precios al guardar un producto
 */
add_action( 'woocommerce_admin_process_product_object', 'grogin_log_product_price_history' );
function grogin_log_product_price_history( $product ) {
    $price = $product->get_price();
    if ( ! $price ) return;

    $post_id = $product->get_id();
    $history = get_post_meta( $post_id, '_price_history_30_days', true );
    if ( ! is_array( $history ) ) {
        $history = array();
    }

    $timestamp = time();
    $history[$timestamp] = floatval( $price );

    // Filtrar para mantener solo los precios de los últimos 30 días (2592000 segundos)
    foreach ( $history as $time => $val ) {
        if ( $time < ( $timestamp - 2592000 ) ) {
            unset( $history[$time] );
        }
    }

    update_post_meta( $post_id, '_price_history_30_days', $history );
}

/**
 * Mostrar el precio más bajo de los últimos 30 días en la ficha de producto
 */
add_action( 'woocommerce_single_product_summary', 'grogin_display_lowest_price_30_days', 15 );
function grogin_display_lowest_price_30_days() {
    global $product;
    if ( ! $product ) return;

    $post_id = $product->get_id();
    $history = get_post_meta( $post_id, '_price_history_30_days', true );

    if ( is_array( $history ) && ! empty( $history ) ) {
        // Obtener el precio más bajo del historial
        $lowest_price = min( $history );
        
        // Solo mostrarlo si el precio actual es diferente (o si está en oferta)
        if ( floatval( $product->get_price() ) != floatval( $lowest_price ) || $product->is_on_sale() ) {
            echo '<div class="lowest-price-30-days" style="font-size: 0.85rem; color: #7c2d12; margin-top: 5px;">';
            printf( 
                esc_html__( 'Precio más bajo en los últimos 30 días: %s', 'grogin' ), 
                wc_price( $lowest_price ) 
            );
            echo '</div>';
        }
    }
}

/*************************************************
## TRADUCCIONES PERSONALIZADAS DE CABECERA Y BUSCADOR
*************************************************/
add_filter( 'gettext', 'aje_custom_theme_translations', 20, 3 );
function aje_custom_theme_translations( $translated_text, $text, $domain ) {
    if ( 'grogin' === $domain ) {
        switch ( $text ) {
            case 'Your Cart':
                $translated_text = 'Mi Carrito';
                break;
            case 'Wishlist':
                $translated_text = 'Favoritos';
                break;
            case 'Account':
                $translated_text = 'Mi Cuenta';
                break;
            case 'Search for products, categories or brands...':
                $translated_text = 'Buscar productos, categorías o marcas...';
                break;
            case 'Trending Products':
                $translated_text = 'Más Vendidos';
                break;
            case 'Almost Finished':
                $translated_text = 'Por Agotarse';
                break;
            case 'Shop Now':
                $translated_text = 'Comprar';
                break;
        }
    }
    return $translated_text;
}



