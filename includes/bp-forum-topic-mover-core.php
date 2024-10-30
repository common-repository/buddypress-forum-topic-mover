<?php

function forum_topic_mover() {
	if ( bp_group_is_admin() || bp_group_is_mod() ) {
		echo forum_topic_mover_create_dropdown_box();
	}
}

  function forum_topic_mover_create_dropdown_box() {
  	global $bp, $forum_template, $wpdb;
  	
  	$action_url = $bp->root_domain . '/' . BP_GROUPS_SLUG . '/' . $forum_template->topic->object_slug . '/forum/';
  	//$action_url = $bp->root_domain . '/forums/';
		$topic_id = bp_get_the_topic_id();
		$group_id = $bp->groups->current_group->id;
		
  	if ( bp_has_groups() ) {
  		global $groups_template;
  		
    	// Insert dropdown option box in text.
    	$output = "\n<form action='{$action_url}' method='post' name='forum_topic_mover_dropdown'>\n";
    	$output .= ' | ' . __('Move Topic To: ', 'forum_topic_mover') . "\n";
    	$output .= '<select name="bp_ftm_new_group_id">' . "\n";
    	
    	$sql = "SELECT id, name FROM wp_bp_groups ORDER BY name ASC";
    	$results = $wpdb->get_results($sql);
    	foreach ($results as $result) {
    		$is_selected = ($group_id == $result->id) ? "selected" : "";
    		$output .= "<option {$is_selected} value='{$result->id}'>{$result->name}</option>\n";
    	}

    	$output .= '</select>' . "\n";
    	$output .= "<input type='hidden' name='topic_mover' value='1' />\n";
    	$output .= "<input type='hidden' name='bp_ftm_old_group_id' value='{$group_id}' />\n";
    	$output .= "<input type='hidden' name='bp_ftm_topic_id' value='{$topic_id}' />\n";
    	$output .= '<input type="submit" value="Move Topic" />';
    	$output .= '</form>';
    	
    	return $output;
    } else {
    	return false;
    }
  }

add_action('bp_forum_after_the_topic_admin_links', 'forum_topic_mover');

function forum_topic_mover_handler() {
	
	function update_forum_meta_data($forum_id = "") {
		global $wpdb;
		
		if ( !empty($forum_id) ) {
			$num_topics = $wpdb->get_var("SELECT COUNT(*) FROM wp_bb_topics WHERE forum_id={$forum_id}");
			$num_posts = $wpdb->get_var("SELECT COUNT(*) FROM wp_bb_posts WHERE forum_id={$forum_id}");
			$results = $wpdb->query("UPDATE wp_bb_forums SET topics={$num_topics}, posts={$num_posts} WHERE forum_id={$forum_id}");
			return true;
		} else {
			return false;
		}
	}
	
	if ( isset($_POST['topic_mover']) && '1' == $_POST['topic_mover'] && isset($_POST['bp_ftm_old_group_id']) && isset($_POST['bp_ftm_topic_id']) && isset($_POST['bp_ftm_new_group_id']) ) {
		global $wpdb;
		
		// Load Values form Post
		$old_group_id = $_POST['bp_ftm_old_group_id'];
		$new_group_id = $_POST['bp_ftm_new_group_id'];
		$topic_id = $_POST['bp_ftm_topic_id'];
		$old_forum_id = groups_get_groupmeta( $old_group_id, 'forum_id' );
		$new_forum_id = groups_get_groupmeta( $new_group_id, 'forum_id' );
		 
		// Move Topic to new Forum
		$sql1 = "UPDATE wp_bb_topics SET forum_id={$new_forum_id} WHERE topic_id={$topic_id}";
		$sql2 = "UPDATE wp_bb_posts SET forum_id={$new_forum_id} WHERE topic_id={$topic_id}";
		$result1 = $wpdb->query($sql1);
		$result2 = $wpdb->query($sql2);
		
		// Update New Forum Meta
		update_forum_meta_data($new_forum_id);
		 
		// Update Old Forum Meta
		update_forum_meta_data($old_forum_id);
		
	}
}

add_action('init', 'forum_topic_mover_handler');
?>