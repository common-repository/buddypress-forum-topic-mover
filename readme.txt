=== Buddypress Forum Topic Mover ===
Contributors: twodeuces
Donate link: http://twodeuces.com/wordpress-plugins/buddypress-forum-topic-mover
Tags: BuddyPress, forum, moderate, group, move, administrator, moderator
Requires at least: WP 2.9.2, BuddyPress 1.2.3	
Tested up to: WP 2.9.2, BuddyPress 1.3
Stable tag: 1.0.0

Allows forum moderators and system administrators to move topics placed under the incorrect group in BuddyPress. Requires BuddyPress 1.3. 

== Description ==

Sometimes your users may inadvertently place a forum topic under the incorrect group in BuddyPress. This add in component helps moderators and administrators move those topics to the correct groups. It will also adjust the appropriate topic and post counts within BuddyPress. A very simplistic process but very convient to help keep boards neat and clean.

A few notes about BuddyPress Forum Topic Mover:

*   Creates a simple drop down menu and move topic button.
*   Only shows for those users with admin or moderator privileges.
*   Does require a TEMPLATE EDIT. See Installation.
*   Ideal for BuddyPress with smaller number of groups.

== Installation ==

Installation Steps:

1. Upload `buddypress-forum-topic-mover` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Place `<?php if (function_exist('bp_forum_topic_mover_init')) do_action('bp_forum_after_the_topic_admin_links'); ?>` in your theme template file /groups/single/forum/topic.php after the call to "bp_the_topic_admin_links()".

== Frequently Asked Questions ==

= Do I have to place the do_action hook right after the admin links? =

The answer is no. You can place it where you would like for it to show within your template. We just included after the admin_links call because it made logical and aesthetic sense.

= How come after I move it, it looks like it is still in the same group? =

We choose not to refresh the page at this time. We may change our minds on that in the future, but our reasoning was after moving a topic, we figured you would go back to either a group listing or the forum listing page. When you go to one of those pages, it will reflect the topic having been moved.

== Screenshots ==

1. BuddyPress Forum Topic Mover in action showing the drop down menu of choices to move the current topic to.

== Changelog ==

= 1.0 =
* Initial Public Release.
* No programming changes made from private version.

== Upgrade Notice ==

= 1.0 =
Upgrade to the current version to ensure all readme files and documentation are up to date.

== Arbitrary section ==

No additional notes required.
