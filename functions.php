<?php
add_action( 'send_headers', 'add_header_seguridad' );
function add_header_seguridad() {
	header( 'X-Content-Type-Options: nosniff' );
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'X-XSS-Protection: 1;mode=block' );
}
/**
 * megamart functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 *
 * @package WordPress
 * @subpackage Megamart
 * @since Megamart 1.0
 */

/* Define variables */

define( 'THEME_URI', get_template_directory_uri());
define( 'THEME_DIR_URI', get_template_directory());
define( 'MEGAMART_IMAGES', THEME_URI . '/assets/img');

/* Set the content width based on the theme's design and stylesheet.*/
if ( ! isset( $content_width ) ) {
$content_width = 1320;
}
if ( ! function_exists( 'megamart_setup' ) ) {
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function megamart_setup() {

/* Add Redux Framework */
require THEME_DIR_URI.'/admin/admin-init.php';

/* Make theme available for translation.*/
load_theme_textdomain( 'megamart', THEME_DIR_URI . '/languages' );

/* Add default posts and comments RSS feed links to head.*/
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-formats', array(
'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
));

/* Let WordPress manage the document title. */
add_theme_support( 'title-tag' );

/* Enable support for Post Thumbnails on posts and pages. */
if ( function_exists( 'add_theme_support' ) ) {
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 1320, 770, true ); /*default Featured Image dimensions (cropped)*/
}

add_filter( 'use_default_gallery_style', '__return_false' );
/*This theme uses wp_nav_menu() in one location.*/
register_nav_menu( 'primary_menu', esc_html__( 'Primary Menu', 'megamart' ));
register_nav_menu( 'vertical_menu', esc_html__( 'Vertical Menu', 'megamart' ));
register_nav_menu( 'information', esc_html__( 'Information Menu', 'megamart' ));
register_nav_menu( 'myCategories', esc_html__( 'MyCategories Menu', 'megamart' ));
register_nav_menu( 'services', esc_html__( 'Services Menu', 'megamart' ));

/* Switch default core markup for search form, comment form, and comments */
add_theme_support( 'html5', array(
'search-form',
'comment-form',
'comment-list',
'gallery',
'caption',
) );

/*Set up the WordPress core custom background feature.*/
add_theme_support( 'custom-background', apply_filters( 'megamart_custom_background_args', array(
'default-color' => 'ffffff',
'default-image' => '',
) ) );

/*Add theme support for selective refresh for widgets.*/
add_theme_support( 'customize-selective-refresh-widgets' );

/* Add support for core custom logo. */
add_theme_support( 'custom-logo', array(
'height'=> 250,
'width' => 250,
'flex-width'=> true,
'flex-height' => true,
) );
add_editor_style( 'editor-style.css' );
}
}
add_action( 'after_setup_theme', 'megamart_setup' );

function megamart_widgets_init() {

register_sidebar( array(
'name'=> esc_html__( 'Blog Sidebar', 'megamart' ),
'id'=> 'sidebar-1',
'description' => esc_html__( 'Add widgets here to appear in your Blog sidebar.', 'megamart' ),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h4 class="widget-title block-title"><span>',
'after_title' => '</span></h4>',
) );

register_sidebar( array(
'name' => esc_html__( 'Page Sidebar', 'megamart' ),
'id' => 'page',
'description' => esc_html__( 'Appears on Page page', 'megamart' ),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h4 class="widget-title block-title"><span>',
'after_title' => '</span></h4>',
) );

register_sidebar( array(
'name' => esc_html__( 'Shop Sidebar', 'megamart' ),
'id' => 'shop',
'description' => esc_html__( 'Sidebar on shop page', 'megamart' ),
'before_widget' => '<aside id="%1$s" class="widget %2$s">',
'after_widget' => '</aside>',
'before_title' => '<h4 class="widget-title block-title"><span>',
'after_title' => '</span></h4>',
) );

register_sidebar( array(
'id' => 'home-widget',
'name' => esc_html__( 'Home Bottom Widget Area ', 'megamart' ),
'description' => esc_html__( 'Widget Area Home page', 'megamart' ),
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<h2 class="widget-title"><span>',
'after_title' => '</span></h2>',
) );
}
add_action( 'widgets_init', 'megamart_widgets_init' );

/* Customizer Function. */
if ( file_exists( THEME_DIR_URI.'/inc/theme-functions.php' ) ) {
require_once( THEME_DIR_URI.'/inc/theme-functions.php' );
}

/*Script & Css */
if ( file_exists( THEME_DIR_URI.'/inc/head-media.php' ) ) {
require_once( THEME_DIR_URI.'/inc/head-media.php' );
}

/* Customizer additions */
if ( file_exists( THEME_DIR_URI.'/inc/customizer.php' ) ) {
require_once( THEME_DIR_URI.'/inc/customizer.php' );
}

/*Custom template tags for this theme.*/
if ( file_exists( THEME_DIR_URI.'/inc/template-tags.php' ) ) {
require_once( THEME_DIR_URI.'/inc/template-tags.php' );
}

/*Implement the Custom Header feature.*/
if ( file_exists( THEME_DIR_URI.'/inc/custom-header.php' ) ) {
require_once( THEME_DIR_URI.'/inc/custom-header.php' );
}


/* custom fields form register */
/**
 * @snippet Add First & Last Name to My Account Register Form - WooCommerce
 * @how-toWatch tutorial @ https://businessbloomer.com/?p=19055
 * @sourcecodehttps://businessbloomer.com/?p=21974
 * @authorRodolfo Melogli
 * @credits Claudio SM Web
 * @compatibleWC 3.4
*/
// 1. ADD FIELDS
 
add_action( 'woocommerce_register_form_end', 'bbloomer_add_name_woo_account_registration' );
 
function bbloomer_add_name_woo_account_registration() {
}

// 2. VALIDATE FIELDS
 
add_filter( 'woocommerce_registration_errors', 'bbloomer_validate_name_fields', 10, 3 );
 
function bbloomer_validate_name_fields( $errors, $username, $email ) {
	if ( isset( $_POST['billing_country'] ) && empty( $_POST['billing_country'] ) ) {
		$errors->add( 'billing_country_error', 'Seleccione pais' );
	}

	if ( isset( $_POST['billing_city'] ) && empty( $_POST['billing_city'] ) ) {
		$errors->add( 'billing_city_error', 'Ingrese ciudad' );
	}

	if ( isset( $_POST['billing_address'] ) && empty( $_POST['billing_address'] ) ) {
		$errors->add( 'billing_address_error', 'Ingrese dirección' );
	}

	if ( isset( $_POST['billing_company'] ) && empty( $_POST['billing_company'] ) ) {
		$errors->add( 'billing_company_error', 'Ingrese nombre de la óptica' );
	}

	return $errors;
}

// 3. SAVE FIELDS
 
add_action( 'woocommerce_created_customer', 'bbloomer_save_name_fields' );
 
function bbloomer_save_name_fields( $customer_id ) {
	if ( isset( $_POST['billing_country'] ) ) {
		update_user_meta( $customer_id, 'billing_country', sanitize_text_field( $_POST['billing_country'] ) );
		update_user_meta( $customer_id, "billing_country", sanitize_text_field( $_POST['billing_country'] ) );
	}

	if ( isset( $_POST['billing_company'] ) ) {
		update_user_meta( $customer_id, 'billing_company', sanitize_text_field( $_POST['billing_company'] ) );
		update_user_meta( $customer_id, "billing_company", sanitize_text_field( $_POST['billing_company'] ) );
	}

	if ( isset( $_POST['billing_city'] ) ) {
		update_user_meta( $customer_id, 'billing_city', sanitize_text_field( $_POST['billing_city'] ) );
		update_user_meta( $customer_id, "billing_city", sanitize_text_field( $_POST['billing_city'] ) );
	}

	if ( isset( $_POST['billing_address'] ) ) {
		update_user_meta( $customer_id, 'billing_address', sanitize_text_field( $_POST['billing_address'] ) );
		update_user_meta( $customer_id, "billing_address_1", sanitize_text_field( $_POST['billing_address'] ) );
	}
}

/* short code for maps */

function link_mapa() {
global $wpdb;
wp_enqueue_style( 'datatable', '//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css',false,'1.1','all');
?>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<style>
#map {
	width: 100%;
	height: 400px;
}

table, td, th, tr {
	border: none !important;
}
.table-borderless td,
.table-borderless th {
	border: 0;
    border-top: #ddd solid 1px !important;
}
a.paginate_button {
	background: #f7f7f7;
}
a.paginate_button:hover {
    background: #a4cc39 !important;
    border: none !important;
    color: #fff !important;
}
a.paginate_button.current {
	background:  #a4cc39 !important;
	border: none !important;
	color: #fff !important;
}
@media (max-width: 600px) {
	.kc-raw-code {
	    display: block !important;
	}
}
</style>
<div style="text-align: center;">
<h1>Localizador de ópticas</h1>
</div>
<p>
Encuentra fácilmente la óptica más cercana para que puedas adquirir nuestros productos. Te explicamos como: <br>
1) Ubicate en el mapa haciendo uso del buscador o de forma manual en el mismo. <br>
2) Haz click en el punto en el cual te ubicas. <br>
3) Se desplegaran en el mapa las diferentes ópticas que poseen nuestros productos y que se encuentran cerca de ti.
</p>

<div id="map"></div>

<div style="text-align: center; margin: 20px 0;">
<h2 class="text-center">Listado de opticas</h2>
</div>

<div class="col-xs-12 col-sm-8 col-md-8" style="float: none; margin: 0 auto;">
<div class="row" style="margin: 0 auto;">
	<div class="col-xs-12 col-sm-6 col-md-6">¿En que pais te encuentras?</div>
	<div class="col-xs-12 col-sm-6 col-md-6">
		<select name="pais" class="form-control">
			<option value="0">Seleccione</option>
			<option value="1">Uruguay</option>
			<option value="2">Paraguay</option>
		</select>
	</div>
</div>

<div class="row" style="margin: 15px auto;">
	<div class="col-xs-12 col-sm-6 col-md-6">¿En que departamento te encuentras?</div>
	<div class="col-xs-12 col-sm-6 col-md-6">
		<select name="departamento" class="form-control">
			<option value="0">Seleccione</option>
		</select>
	</div>
</div>

<table class="table table-borderless table-condensed table-hover" id="table-opticas">
<thead>
<tr>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<?php
$marker = $wpdb->get_results('SELECT * FROM wp_nvfi_mapas');
foreach($marker as $optica) {
?>
<?php if($optica->lat != '' && $optica->log != '') : ?>
<tr>
<td>
<div style="padding: 15px 10px 0 60px; text-align: right;">
<a href="#" onclick="loadNewMarker(this, event);" data-location="<?php echo $optica->lat; ?>, <?php echo $optica->log; ?>" data-optica="<?php echo $optica->title; ?>" data-direccion="<?php echo $optica->direccion; ?>"><img src="<?php echo home_url(); ?>/images/location.png" width="60" height="60" alt=""></a>
</div>
</td>
<td>
<div style="padding: 0 10px;">
<h5><?php echo $optica->title; ?></h5>
<strong>Pais</strong>: <?php echo $optica->pais; ?> <br>
<strong>Departamento</strong>: <?php echo $optica->ciudad; ?> <br>
<strong>Dirección</strong>: <?php echo $optica->direccion; ?>
</div>
</td>
</tr>
<?php endif; ?>
<?php
}
?>
</tbody>
</table>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjzCYLTM9d5Of9Z29-XkChYqTf-EQN6Wc&callback=initMap"
async defer></script>
<script>
var dataTable;
(function($) {
	dataTable = jQuery("#table-opticas").DataTable({
		"lengthChange": false,
		"bInfo" : false,
		"ordering": false,
		language: {
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords":"No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":"",
			"sSearch": "Buscar:",
			"sUrl":"",
			"sInfoThousands": ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":"Primero",
				"sLast": "Último",
				"sNext": ">",
				"sPrevious": "<"
			},
			"oAria": {
				"sSortAscending":": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});

	$("select[name=pais]").on("change", function() {
		var country = $(this).val();
		changeCountry(country);
	});

	$("select[name=departamento]").on('change', function() {
		var cc = $("select[name=pais]").val();
		var country = $("select[name=pais] option[value="+cc+"]").text();
		var city = $(this).val();
		//var city = $("select[name=departamento] option[value="+c+"]").text();
		geolocate(country, city);
	});
})(jQuery);
//uruguay defecto
var lat = -32.6005596;
var lng = -58.0283107;
/* Paraguay
lat = -23.3401052;
lng = -60.6368911;*/

var map;
var marker = [];
var icon = {
	cliente: 'http://opticalcollection.com/images/001-navigation.png',
	opticas: 'http://opticalcollection.com/images/002-marker.png'
};

function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		center: {lat: lat, lng: lng},
		zoom: 7,
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	google.maps.event.addListener(map, 'click', function(event) {
		clearAll();
		var latitud = event.latLng.lat();
		var longitud = event.latLng.lng();
		//alert(latitud+', '+longitud);

		var cliente = new google.maps.Marker({
			position: {lat: latitud, lng: longitud},
			map: map,
			icon: icon.cliente,
			title: 'Cliente'
		});
		marker.push(cliente);
		jQuery.ajax({
			type: "POST",
			url: "/wp-admin/admin-ajax.php", 
			data: {action: "mapas", lat: latitud, lng:longitud},
			dataType: "json",
			success: function(data) {
				jQuery.each(data, function(e, r) {
					var contentString = '<div id="content">'+
					'<h1 id="firstHeading" class="firstHeading">'+r.title+'</h1>'+
					'Departamento: '+ r.ciudad+
					'<br>'+
					'Dirección: '+r.direccion+
					'</div>';
					var infowindow = new google.maps.InfoWindow({
						content: contentString
					});

					var myLatLng = {lat: parseFloat(r.lat), lng: parseFloat(r.log)};
					var optica = new google.maps.Marker({
						position: myLatLng,
						map: map,
						icon: icon.opticas,
						title: r.title
					});

					optica.addListener('click', function() {
						infowindow.open(map, optica);
					});

					marker.push(optica);
				});
			}
		});
	});
}

function setMapOnAll(map) {
	//hace ciclo sobre los marcadores que hemos guardado en la variable markers
	for (var i = 0; i < marker.length; i++) {
		marker[i].setMap(map);
	}
}

function clearAll() {
	setMapOnAll(null);
	marker = [];
}

function changeCountry(country) {
	if (country == 1) {
		var lat = -32.6005596;
		var lon = -58.0283107;
		var ct = 'Uruguay';
	}else if(country == 2) {
		var lat = -23.3401052;
		var lon = -60.6368911;
		var ct = 'Paraguay';
	}
	if (country > 0) {
		dataTable
			.column(1)
			.search( ct )
			.draw();
		jQuery("select[name=departamento]").html(jQuery("<option/>").text('Seleccione').val(0));
		jQuery.ajax({
			type: "POST",
			url: "/wp-admin/admin-ajax.php", 
			data: {action: "departamentos", country: ct},
			dataType: "json",
			success: function(data) {
				jQuery.each(data, function(e, r) {
					jQuery("select[name=departamento]").append(jQuery("<option/>").text(r.ciudad).val(r.ciudad));
				});
			}
		});
		map.setCenter({lat:lat, lng:lon});
	}
}

function geolocate(country, city) {
	dataTable
		.column(1)
		.search( city )
		.draw();
	/*var dataset = [];
	jQuery.ajax({
		type: "POST",
		url: "/wp-admin/admin-ajax.php", 
		data: {action: "seldepartamentos", country: country, city: city},
		dataType: "json",
		success: function(data) {
			console.log(data);
			jQuery.each(data, function(e, r) {
				if(r.lat != '' && r.log != '')  {
					var ubicar = '<a href="#" onclick="loadNewMarker(this, event);" data-location="'+r.lat+', '+r.log+'" data-optica="'+r.title+'" data-direccion="'+r.direccion+'">Ubicación</a>';
				}else {
					var ubicar = '';
				}
				dataset.push( [ ubicar, r.pais, r.ciudad, r.direccion, r.title ] );
				dataTable.clear();
				dataTable.rows.add(dataset);
				dataTable.draw();

			});
		}
	});
	/*var address = country+', '+city;
	alert(address);
	var geocoder = new google.maps.Geocoder();
	geocoder.geocode({'address': address}, function(results, status) {
		if (status === 'OK') {
			map.setCenter(results[0].geometry.location);
		}
	});*/
}

function loadNewMarker(e, v) {
	v.preventDefault();
	var top = jQuery("#map").offset().top;
	jQuery('html, body').animate({scrollTop: top}, 1000);

	clearAll();
	var l = e.getAttribute("data-location");
	var location = l.split(',');
	var optica = e.getAttribute('data-optica');
	var direccion = e.getAttribute('data-direccion');

	var contentString = '<div id="content">'+
	'<h1 id="firstHeading" class="firstHeading">'+optica+'</h1>'+
	'Dirección: '+direccion+
	'</div>';
	
	var infowindow = new google.maps.InfoWindow({
		content: contentString
	});

	console.log(location[0]+', '+location[1]);
	var cliente = new google.maps.Marker({
		position: {lat: parseFloat(location[0]), lng: parseFloat(location[1])},
		map: map,
		icon: icon.opticas,
		title: optica
	});

	map.setCenter(cliente.getPosition());

	cliente.addListener('click', function() {
		infowindow.open(map, cliente);
	});

	marker.push(cliente);
}
</script>
<?php
//fin mapa
}
add_shortcode('mapa', 'link_mapa');

/* action map search */

function getBoundaries($lat, $lng, $distance = 1, $earthRadius = 6371) {
	$return = array();
	// Los angulos para cada dirección
	$cardinalCoords = array(
		'north' => '0',
		'south' => '180',
		'east' => '90',
		'west' => '270'
	);
	$rLat = deg2rad($lat);
	$rLng = deg2rad($lng);
	$rAngDist = $distance/$earthRadius;
	foreach ($cardinalCoords as $name => $angle) {
		$rAngle = deg2rad($angle);
		$rLatB = asin(sin($rLat) * cos($rAngDist) + cos($rLat) * sin($rAngDist) * cos($rAngle));
		$rLonB = $rLng + atan2(sin($rAngle) * sin($rAngDist) * cos($rLat), cos($rAngDist) - sin($rLat) * sin($rLatB));
		$return[$name] = array('lat' => (float) rad2deg($rLatB), 
		'lng' => (float) rad2deg($rLonB));
	}
	return array('min_lat'=> floatval($return['south']['lat']),
	'max_lat' => floatval($return['north']['lat']),
	'min_lng' => floatval($return['west']['lng']),
	'max_lng' => floatval($return['east']['lng']));
}

function mapas(){
	global $wpdb;
	$lat = floatval(sanitize_text_field($_POST['lat']));
	$lng = floatval(sanitize_text_field($_POST['lng']));
	$distance = 3;
	$box = getBoundaries($lat, $lng, $distance);

	$marker = $wpdb->get_results($wpdb->prepare('SELECT *, (6371 * ACOS( 
	SIN(RADIANS(lat)) 
	* SIN(RADIANS(' . $lat . ')) 
	+ COS(RADIANS(log - ' . $lng . ')) 
	* COS(RADIANS(lat)) 
	* COS(RADIANS(' . $lat . '))
	)) AS distance FROM wp_nvfi_mapas WHERE (lat BETWEEN ' . $box['min_lat']. ' AND ' . $box['max_lat'] . ') AND (log BETWEEN ' . $box['min_lng']. ' AND ' . $box['max_lng']. ') HAVING distance< ' . $distance . ' ORDER BY distance ASC'));
	echo json_encode($marker);
	die();
}

add_action('wp_ajax_mapas', 'mapas');
add_action('wp_ajax_nopriv_mapas', 'mapas');


function departamentos() {
	global $wpdb;
	$country = sanitize_text_field($_POST['country']);
	$marker = $wpdb->get_results($wpdb->prepare('SELECT ciudad FROM wp_nvfi_mapas WHERE pais = "'.$country.'" GROUP BY ciudad'));
	echo json_encode($marker);
	die();
}
add_action('wp_ajax_departamentos', 'departamentos');
add_action('wp_ajax_nopriv_departamentos', 'departamentos');

function seldepartamentos() {
	global $wpdb;
	$country = sanitize_text_field($_POST['country']);
	$city = sanitize_text_field($_POST['city']);
	$marker = $wpdb->get_results($wpdb->prepare('SELECT * FROM wp_nvfi_mapas WHERE pais = "'.$country.'" AND ciudad = "'.$city.'"'));
	echo json_encode($marker);
	die();
}
add_action('wp_ajax_seldepartamentos', 'seldepartamentos');
add_action('wp_ajax_nopriv_seldepartamentos', 'seldepartamentos');

/* otros script*/

add_action( 'woocommerce_single_product_summary', 'userLogged', 5 );

function userLogged() {
if (!is_user_logged_in()){
$addres_1 = get_user_meta( get_current_user_id() , 'billing_address_1', true );
$addres_2 = get_user_meta( get_current_user_id() , 'billing_address_2', true );
echo '<div>¿Donde puedo adquirirlo? <a href="'.get_site_url().'/mapa" class="btn btn-primary btn-sm">Ubicar</a></div>';
}
}


add_action( 'woocommerce_single_product_summary', 'remove_add_to_cart_buttons', 1 );
function remove_add_to_cart_buttons() {
global $product;

// For simple product types
if( $product->is_type( 'simple' ) ) {
if ( !is_user_logged_in() ) {
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'woocommerce_single_product_summary', 'custom_before_single_add_to_cart', 30 );
}
}
// For variable product types (keeping attribute select fields)
elseif( $product->is_type( 'variable' ) ) {
if ( !is_user_logged_in() ) {
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
}
}
}

function custom_before_single_add_to_cart(){
global $product;

if ( ! $product->is_purchasable() ) return;

// Simple Products
if ( $product->is_in_stock() ) {
do_action( 'woocommerce_before_add_to_cart_form' ); // (Optional)

## @since 2.1.0.
do_action( 'woocommerce_before_add_to_cart_button' ); // <== NEEDED by Add-ons

## @since 3.0.0.
do_action( 'woocommerce_before_add_to_cart_quantity' ); // Optional

## @since 3.0.0.
do_action( 'woocommerce_after_add_to_cart_quantity' ); // Optional

## @since 2.1.0.
do_action( 'woocommerce_after_add_to_cart_button' ); // Optional

do_action( 'woocommerce_after_add_to_cart_form' ); // Optional
}
}

/* script by jsstoni */


add_filter( 'woocommerce_variable_sale_price_html', 'ayudawp_remove_prices', 10, 2 );
add_filter( 'woocommerce_variable_price_html', 'ayudawp_remove_prices', 10, 2 );
add_filter( 'woocommerce_get_price_html', 'ayudawp_remove_prices', 10, 2 );
add_filter( 'woocommerce_template_single_price', 'ayudawp_remove_prices', 10, 2 );
 
function ayudawp_remove_prices( $price, $product ) {
$price = '';
return $price;
}

function user_autologout(){
if ( is_user_logged_in() ) {
$current_user = wp_get_current_user();
$user_id = $current_user->ID;
 
$approved_status = get_user_meta($user_id, 'wp-approve-user', true);
 
//if the user hasn't been approved yet by WP Approve User plugin, log them out
if ( $approved_status == 1 ){
return $redirect_url;
}
else {
wp_logout();
return get_permalink(woocommerce_get_page_id('myaccount')) . "?approved=false";
}
}
}
add_action('woocommerce_registration_redirect', 'user_autologout', 2);

function registration_message(){
 $not_approved_message = '
 ¡Envíe su solicitud de registro hoy!<br>
 NOTA: Su cuenta pasará por moderación y no podrá iniciar sesión hasta que la misma sea aprobada.
 ';
 
 if( isset($_REQUEST['approved']) ){
$approved = $_REQUEST['approved'];
if ($approved == 'false') echo '
<div class="bg-success" style="padding: 10px; margin: 0 0 10px 0;">¡Registro exitoso! Se le notificará a la aprobación de su cuenta.</div>
';
else echo $not_approved_message;
}
 else echo $not_approved_message;
}
add_action('woocommerce_before_customer_login_form', 'registration_message', 2);

function cp_youtube() {
	$args = array(
		'id' => 'cpyoutube',
		'label' => __( 'Url de youtube', 'cpy' ),
		'class' => 'cpy-custom-field',
		'desc_tip' => true,
		'description' => __( 'Ingresa la url de youtube', 'cpyd' ),
	);
	woocommerce_wp_text_input( $args );
}
add_action( 'woocommerce_product_options_general_product_data', 'cp_youtube' );


function cp_save_youtube( $post_id ) {
	$product = wc_get_product( $post_id );
	$title = isset( $_POST['cpyoutube'] ) ? $_POST['cpyoutube'] : '';
	$product->update_meta_data( 'cpyoutube', sanitize_text_field( $title ) );
	$product->save();
}
add_action( 'woocommerce_process_product_meta', 'cp_save_youtube' );

// Add Shortcode
function custom_shortcode() {
	global $post;
	// Check for the custom field value
	$product = wc_get_product( $post->ID );
	$title = $product->get_meta( 'cpyoutube' );
	if(preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $title, $matches)) {
		$title = 'https://www.youtube.com/embed/'.$matches[1];
	}
	$html .= '<div class="modal-video" id="yovid"><div class="modal-v-content">';
	if($title) {
	$html .= sprintf(
		'<iframe width="%s" height="315" src="%s?enablejsapi=1&version=3&playerapiid=ytplayer&showinfo=0" class="youtube-video" frameborder="0" allowfullscreen></iframe>',
		'100%',
		$title
	);
	}else {
	$html .= '<strong class="novideo">No hay video</strong>';
	}
	$html .= '</div></div>';
	return $html;
}
add_shortcode( 'youtube', 'custom_shortcode' );

function woo_personalizar_menu_ordenar ($orderby) {
	unset ($orderby ["price"]);
	unset ($orderby ["price-desc"]);
	return $orderby;
}
add_filter ("woocommerce_catalog_orderby", "woo_personalizar_menu_ordenar", 20);

add_action ('wp_print_scripts', function () {
	if (wp_script_is ('wc-password-strength-meter', 'enqueued'))
		wp_dequeue_script ('wc-password-strength-meter');
}, 100);


add_shortcode('contacto', 'form_contact');

function form_contact() {
if (isset($_POST['btn-send'])) {
	global $reg_errors;
	$reg_errors = new WP_Error;
	$nombre = sanitize_text_field($_POST['nombre']);
	$eres = sanitize_text_field($_POST['eres']);
	$nameoptica = sanitize_text_field($_POST['nameoptica']);
	$direccion = sanitize_text_field($_POST['direccion']);
	$email = sanitize_email($_POST['email']);
	$phone = sanitize_text_field($_POST['phone']);
	$como = sanitize_text_field($_POST['como']);
	$mensaje = sanitize_text_field($_POST['mensaje']);

	if (empty($nombre)) {
		$reg_errors->add("empty-name", "El campo nombre es obligatorio");
	}
	if($eres == "si") {
		if (empty($nameoptica)) {
			$reg_errors->add("empty-nameoptica", "El campo nombre de óptica es obligatorio");
		}
	}
	if (empty($email)) {
		$reg_errors->add("empty-email", "El campo email es obligatorio");
	}
	if (empty($phone)) {
		$reg_errors->add("empty-phone", "El campo teléfono es obligatorio");
	}
	if (empty($direccion)) {
		$reg_errors->add("empty-direccion", "El campo dirección es obligatorio");
	}
	if (empty($mensaje)) {
		$reg_errors->add("empty-mensaje", "El campo comentario es obligatorio");
	}
	if (count($reg_errors->get_error_messages()) == 0) {
		$recipient = "tienda@opticalcollection.com";
		$subject = "Contactos Optical Collection";
		$headers = "Reply-to: " . $nombre . " <" . $email . ">\r\n";
		$optica_n = $eres == "si" ? '<strong>Nombre de óptica: </strong>'.$nameoptica : '';
		$message = <<<mensaje
<strong>Nombre</strong>: $nombre<br>
<strong>¿Eres Optica?</strong><br>
$eres <br>
$optica_n <br>
<strong>Email:</strong> $email <br>
<strong>Teléfono:</strong> $phone <br>
<strong>Dirección:</strong> $direccion <br>
<strong>Como te enteraste de Optial Collection</strong><br>
$como <br>
<strong>Mensaje</strong> <br>
$mensaje
mensaje;
unset($nombre);
		unset($email);
		unset($eres);
		unset($direccion);
		unset($como);
		unset($mensaje);
		add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
		$envio = wp_mail( $recipient, $subject, $message, $headers, $attachments);
?>
<div class="alert alert-success alert-dismissable">
Gracias se ha enviado su solicitud en la brevedad posible sera contactado por un operador
</div>
<?php
	}
	if ( is_wp_error( $reg_errors ) ) {
	if(count($reg_errors->get_error_messages()) > 0) {
?>
<ul class="woocommerce-error" role="alert">
<?php foreach ($reg_errors->get_error_messages() as $key => $value) : ?>
	<li>
	<strong>-Error:</strong> <?php echo $value; ?></li>
<?php endforeach; ?>
</ul>
<?php
	}
	}
}
?>
<style>
@media (max-width: 600px) {
	.kc-raw-code {
	    display: block !important;
	}
}
</style>
<div class="col-xs-12 col-sm-9 col-md-9" style="float: none; margin: 0 auto;">
<div style="text-align: center;">
<h3>¿Interesado en ofrecer nuestros productos?</h3>
</div>
<p>Te ofrecemos productos de comprobada calidad, contando a su vez con un asesoramiento técnico y un respaldo que solo nuestra firma puede ofrecer. Completa el siguiente formulario y uno de nuestros representantes de ventas te contactará en breve.</p>
<form action="<?php echo get_permalink();?>#contact-form" method="post">
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	<label for="nombre">Nombre completo:</label>
	<input type="text" name="nombre" class="woocommerce-Input woocommerce-Input--text input-text form-control" id="nombre">
	</p>

	<label for="eres">¿Eres Óptica?</label>
	<select name="eres" class="woocommerce-Input woocommerce-Input--text input-text  form-control" id="eres">
		<option value="si">Si</option>
		<option value="no">No</option>
	</select>
	</p>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	<label for="nameoptica">Nombre de la Óptica</label>
	<input type="text" name="nameoptica" class="woocommerce-Input woocommerce-Input--text input-text form-control" id="nameoptica">
	</p>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	<label for="pais">País</label>
	<select name="direccion" class="woocommerce-Input woocommerce-Input--text input-text form-control" id="pais">
		<option value="Uruguay">Uruguay</optinion>
		<option value="Paraguay">Paraguay</optinion>
		<option value="Argentina">Argentina</optinion>
		<option value="Brasil">Brasil</optinion>
		<option value="Bolivia">Bolivia</optinion>
		<option value="Chile">Chile</optinion>
		<option value="Colombia">Colombia</optinion>
		<option value="Ecuador">Ecuador</optinion>
		<option value="Perú">Perú</optinion>
		<option value="United States">United states</optinion>
		<option value="Venezuela">Venezuela</optinion>
		<option value="Otro">Otro</optinion>
	</select>
	</p>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	<label for="email">Correo electrónico</label>
	<input type="text" name="email" class="woocommerce-Input woocommerce-Input--text input-text form-control" id="email">
	</p>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	<label for="phone">Teléfono de contacto</label>
	<input type="text" name="phone" class="woocommerce-Input woocommerce-Input--text input-text form-control" id="phone">
	</p>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	<label for="como">¿Como te enteraste de <strong>Optical Collection</strong>?</label>
	<input type="text" name="como" class="woocommerce-Input woocommerce-Input--text input-text form-control" id="como">
	</p>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
	<label for="mensaje">Comentario</label>
	<textarea name="mensaje" class="woocommerce-Input woocommerce-Input--text input-text form-control" id="mensaje" rows="4"></textarea>
	</p>
	<div style="text-align: center;">
	<button type="submit" name="btn-send" class="btn btn-success">Enviar</button>
	</div>
</form>
</div>
<?php
}

add_action( 'show_user_profile', 'add_custom_fields_to_users' );
add_action( 'edit_user_profile', 'add_custom_fields_to_users' );
function add_custom_fields_to_users( $user ) {
$user_rsoscial = esc_attr( get_the_author_meta( 'user_rsoscial', $user->ID ) );?>
 
<h3>Datos</h3>
 
<table class="form-table">
<tr>
<th><label for="user_town">Razón social</label></th>
<td><input type="text" name="user_rsoscial" id="user_town" class="regular-text" value="<?php echo $user_rsoscial;?>" /></td>
</tr>
</table>
<?php }

add_action( 'personal_options_update', 'save_user_fields' );
add_action( 'edit_user_profile_update', 'save_user_fields' );

function save_user_fields($user_id) {
if ( !current_user_can( 'edit_user', $user_id ) ) {
return false;
}

if( isset($_POST['user_rsoscial']) ) {
$user_rsoscial = sanitize_text_field($_POST['user_rsoscial']);
update_user_meta( $user_id, 'user_rsoscial', $user_rsoscial );
}
}

add_filter( 'xmlrpc_methods', function( $methods ) {
 unset( $methods['pingback.ping'] );
 return $methods;
} );