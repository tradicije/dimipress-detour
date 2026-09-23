<?php
/**
 * Plugin Name: DimiPress Detour
 * Plugin URI: https://dimitrium.org/en/dimipress/detour
 * Description: Temporarily redirects public visitors to a page you choose while your WordPress site is being updated.
 * Version: 1.0.1
 * Author: Aleksa Dimitrijević
 * Author URI: https://dimitrium.org/en/dimipedia/aleksa-dimitrijevic
 * License: AGPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/agpl-3.0.html
 * Text Domain: dimipress-detour
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const DIMIPRESS_DETOUR_OPTION = 'dimipress_detour_settings';

/** Register the small configuration screen under Settings. */
function dimipress_detour_register_settings() {
	register_setting(
		'dimipress_detour',
		DIMIPRESS_DETOUR_OPTION,
		array(
			'type'              => 'array',
			'sanitize_callback' => 'dimipress_detour_sanitize_settings',
			'default'           => array( 'page_id' => 0, 'allow_subpages' => 0, 'allowed_roles' => array() ),
		)
	);
	add_settings_section( 'dimipress_detour_main', __( 'Public visitor redirect', 'dimipress-detour' ), '__return_false', 'dimipress-detour' );
	add_settings_field( 'page_id', __( 'Destination page', 'dimipress-detour' ), 'dimipress_detour_page_field', 'dimipress-detour', 'dimipress_detour_main' );
	add_settings_field( 'allow_subpages', __( 'Allow destination subpages', 'dimipress-detour' ), 'dimipress_detour_subpages_field', 'dimipress-detour', 'dimipress_detour_main' );
	add_settings_field( 'allowed_roles', __( 'Roles with full site access', 'dimipress-detour' ), 'dimipress_detour_roles_field', 'dimipress-detour', 'dimipress_detour_main' );
}
add_action( 'admin_init', 'dimipress_detour_register_settings' );

function dimipress_detour_add_settings_page() {
	add_options_page( __( 'DimiPress Detour', 'dimipress-detour' ), __( 'DimiPress Detour', 'dimipress-detour' ), 'edit_pages', 'dimipress-detour', 'dimipress_detour_render_settings_page' );
}
add_action( 'admin_menu', 'dimipress_detour_add_settings_page' );

function dimipress_detour_sanitize_settings( $input ) {
	$input = is_array( $input ) ? $input : array();
	$page_id = isset( $input['page_id'] ) ? absint( $input['page_id'] ) : 0;
	$page = $page_id ? get_post( $page_id ) : null;
	if ( ! $page || 'page' !== $page->post_type || 'publish' !== $page->post_status ) {
		$page_id = 0;
	}
	return array(
		'page_id'        => $page_id,
		'allow_subpages' => empty( $input['allow_subpages'] ) ? 0 : 1,
		'allowed_roles'  => isset( $input['allowed_roles'] ) && is_array( $input['allowed_roles'] )
			? array_values( array_intersect( array_map( 'sanitize_key', $input['allowed_roles'] ), array_keys( wp_roles()->roles ) ) )
			: array(),
	);
}

function dimipress_detour_page_field() {
	$options = get_option( DIMIPRESS_DETOUR_OPTION, array() );
	$page_id = isset( $options['page_id'] ) ? absint( $options['page_id'] ) : 0;
	wp_dropdown_pages(
		array(
			'name'              => DIMIPRESS_DETOUR_OPTION . '[page_id]',
			'echo'              => 1,
			'show_option_none'  => __( 'Disabled — do not redirect', 'dimipress-detour' ),
			'option_none_value' => '0',
			'sort_column'       => 'post_title',
			'sort_order'        => 'ASC',
			'selected'          => $page_id,
			'post_status'       => 'publish',
		)
	);
	printf( '<p class="description">%s</p>', esc_html__( 'Choose the published page visitors should see while the site is being updated.', 'dimipress-detour' ) );
}

function dimipress_detour_subpages_field() {
	$options = get_option( DIMIPRESS_DETOUR_OPTION, array() );
	$enabled = ! empty( $options['allow_subpages'] );
	printf(
		'<label><input type="checkbox" name="%1$s[allow_subpages]" value="1" %2$s> %3$s</label><p class="description">%4$s</p>',
		esc_attr( DIMIPRESS_DETOUR_OPTION ),
		checked( $enabled, true, false ),
		esc_html__( 'Allow visitors to browse child pages of the selected destination.', 'dimipress-detour' ),
		esc_html__( 'When enabled, the selected page and its nested child pages remain publicly accessible.', 'dimipress-detour' )
	);
}

function dimipress_detour_roles_field() {
	$options = get_option( DIMIPRESS_DETOUR_OPTION, array() );
	$selected_roles = isset( $options['allowed_roles'] ) && is_array( $options['allowed_roles'] ) ? $options['allowed_roles'] : array();
	$roles = wp_roles()->roles;
	echo '<fieldset><p>' . esc_html__( 'Administrators always have full access. Choose any additional roles that should be able to browse the entire site while detour is active.', 'dimipress-detour' ) . '</p>';
	foreach ( $roles as $role_key => $role_data ) {
		if ( 'administrator' === $role_key ) {
			continue;
		}
		$input_name = DIMIPRESS_DETOUR_OPTION . '[allowed_roles][]';
		printf(
			'<label style="display:block"><input type="checkbox" name="%1$s" value="%2$s" %3$s> %4$s</label>',
			esc_attr( $input_name ),
			esc_attr( $role_key ),
			checked( in_array( $role_key, $selected_roles, true ), true, false ),
			esc_html( translate_user_role( $role_data['name'] ) )
		);
	}
	echo '</fieldset>';
}

function dimipress_detour_render_settings_page() {
	if ( ! current_user_can( 'edit_pages' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'DimiPress Detour', 'dimipress-detour' ); ?></h1>
		<p><?php esc_html_e( 'Send public visitors to a page you choose while work is in progress. This plugin does not create or style a maintenance page.', 'dimipress-detour' ); ?></p>
		<form action="options.php" method="post">
			<?php
			settings_fields( 'dimipress_detour' );
			do_settings_sections( 'dimipress-detour' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}

/** True when the current page is the configured page or one of its descendants. */
function dimipress_detour_is_destination_or_child( $destination_id ) {
	if ( is_page( $destination_id ) ) {
		return true;
	}
	if ( ! is_page() ) {
		return false;
	}
	$ancestors = get_post_ancestors( get_queried_object_id() );
	return in_array( (int) $destination_id, array_map( 'absint', $ancestors ), true );
}

/** Redirect public front-end requests, leaving editors and essential endpoints available. */
function dimipress_detour_redirect_public_visitors() {
	if ( is_admin() || wp_doing_ajax() || wp_doing_cron() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || is_preview() ) {
		return;
	}
	if ( ! in_array( strtoupper( $_SERVER['REQUEST_METHOD'] ?? 'GET' ), array( 'GET', 'HEAD' ), true ) ) {
		return;
	}
	$user = wp_get_current_user();
	if ( current_user_can( 'manage_options' ) || in_array( 'administrator', (array) $user->roles, true ) ) {
		return;
	}
	$options = get_option( DIMIPRESS_DETOUR_OPTION, array() );
	$allowed_roles = isset( $options['allowed_roles'] ) && is_array( $options['allowed_roles'] ) ? $options['allowed_roles'] : array();
	if ( array_intersect( $allowed_roles, (array) $user->roles ) ) {
		return;
	}
	$destination_id = isset( $options['page_id'] ) ? absint( $options['page_id'] ) : 0;
	$destination = $destination_id ? get_post( $destination_id ) : null;
	if ( ! $destination || 'page' !== $destination->post_type || 'publish' !== $destination->post_status ) {
		return;
	}
	$allow_subpages = ! empty( $options['allow_subpages'] );
	if ( is_page( $destination_id ) || ( $allow_subpages && dimipress_detour_is_destination_or_child( $destination_id ) ) ) {
		return;
	}
	$url = get_permalink( $destination_id );
	if ( $url ) {
		wp_safe_redirect( $url, 302, 'DimiPress Detour' );
		exit;
	}
}
add_action( 'template_redirect', 'dimipress_detour_redirect_public_visitors', 1 );
