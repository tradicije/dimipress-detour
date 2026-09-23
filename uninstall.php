<?php
/** Remove DimiPress Detour settings when the plugin is deleted. */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

if ( is_multisite() ) {
	$offset = 0;
	$batch_size = 100;

	do {
		$site_ids = get_sites(
			array(
				'fields' => 'ids',
				'number' => $batch_size,
				'offset' => $offset,
			)
		);

		foreach ( $site_ids as $site_id ) {
			switch_to_blog( $site_id );
			delete_option( 'dimipress_detour_settings' );
			restore_current_blog();
		}

		$offset += count( $site_ids );
	} while ( count( $site_ids ) === $batch_size );
} else {
	delete_option( 'dimipress_detour_settings' );
}
