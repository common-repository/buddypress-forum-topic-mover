<?php
/*
Plugin Name: BuddyPress Forum Topic Mover
Plugin URI: http://twodeuces.com/wordpress-plugins/buddypress-forum-topic-mover
Description: This BuddyPress component is created to help admins and moderators move topics to an appropriate group forum.
Version: 1.0.0
Revision Date: May 10, 2010
Requires at least: WP 2.9.2, BuddyPress 1.2.3 
Tested up to: What WP 2.9.2, BuddyPress 1.2.3
License: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html
Author: Scott Hair
Author URI: http://twodeuces.com
*/

/*  Copyright 2010  Scott Hair  (email : scott@foodblogforum.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*************************************************************************************************************
 --- FORUM TOPIC MOVER V1.0.0 ---

 Contributors: Scott Hair

	This plugin was created initially for use on buddypress v1.2.3 and requires a custom hook to be created were 
	you would like the moving menu to be added. The hook code that needs to be added is "<?php do_action( 
	'bp_forum_after_the_topic_admin_links') ?>". We placed this in our child theme directory in the file 
	child_theme/groups/single/forum/topic.php after the call to "bp_the_topic_admin_links()".
	
 *************************************************************************************************************/


/*
Changelog
1.0.0 	- Initial Public Release (May 10, 2010)
*/

/* Only load the component if BuddyPress is loaded and initialized. */
function bp_forum_topic_mover_init() {
	require( dirname( __FILE__ ) . '/includes/bp-forum-topic-mover-core.php' );
}

if ( defined( 'BP_VERSION' ) )
	bp_forum_topic_mover_init();
else
	add_action( 'bp_init', 'bp_forum_topic_mover_init' );
	

/* Put setup procedures to be run when the plugin is activated in the following function */
function bp_forum_topic_mover_activate() {
	global $wpdb;

	if ( !empty($wpdb->charset) )
		$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";

}
register_activation_hook( __FILE__, 'bp_forum_topic_mover_activate' );

/* On deacativation, clean up anything your component has added. */
function bp_forum_topic_mover_deactivate() {
	/* You might want to delete any options or tables that your component created. */
}
register_deactivation_hook( __FILE__, 'bp_forum_topic_mover_deactivate' );
?>