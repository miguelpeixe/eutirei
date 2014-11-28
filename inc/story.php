<?php

/*
 * Aborto
 * Stories
 */

class Abr_Story {


	function __construct() {

		add_action('init', array($this, 'register_post_type'));
		add_action('init', array($this, 'submit'));
		add_action('pre_get_posts', array($this, 'pre_get_posts'));
		add_action('wp_footer', array($this, 'submit_form'));
	}

	function pre_get_posts() {
		global $wp_query;
		if(is_front_page()) {
			$wp_query->set('post_type', array('story'));
		}
	}

	function register_post_type() {

		$labels = array(
			'name'               => _x( 'Stories', 'post type general name', 'abr' ),
			'singular_name'      => _x( 'Story', 'post type singular name', 'abr' ),
			'menu_name'          => _x( 'Stories', 'admin menu', 'abr' ),
			'name_admin_bar'     => _x( 'Story', 'add new on admin bar', 'abr' ),
			'add_new'            => _x( 'Add new', 'story', 'abr' ),
			'add_new_item'       => __( 'Add new story', 'abr' ),
			'new_item'           => __( 'New story', 'abr' ),
			'edit_item'          => __( 'Edit story', 'abr' ),
			'view_item'          => __( 'View story', 'abr' ),
			'all_items'          => __( 'All stories', 'abr' ),
			'search_items'       => __( 'Search stories', 'abr' ),
			'parent_item_colon'  => __( 'Parent stories:', 'abr' ),
			'not_found'          => __( 'No stories found.', 'abr' ),
			'not_found_in_trash' => __( 'No stories found in trash.', 'abr' )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'story' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 3,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
		);

		register_post_type( 'story', $args );

	}

	function submit_form() {

		$nonce = wp_create_nonce('submit-story');

		?>
		<div id="abr-submit-story" class="abr-submit-form-container">
			<a class="close background-close" href="javascript:void(0);"></a>
			<form id="abr_submit_form" method="POST">
				<h2>Envie seu relato anônimo</h2>
				<input type="hidden" name="submit_story" value="1" />
				<input type="hidden" name="_nonce" value="<?php echo $nonce; ?>" />
				<textarea name="story_content"></textarea>
				<input type="submit" value="<?php _e('Submit'); ?>" />
			</form>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$('.open-abr-submit-form').on('click', function() {
					$('#abr-submit-story').addClass('active');
					$('html').css({
						'overflow': 'hidden'
					});
				});
				$('#abr-submit-story .close').on('click', function() {
					$('#abr-submit-story').removeClass('active');
					$('html').css({
						'overflow': 'auto'
					});
				});
				$(document).keyup(function(e) {
					if(e.keyCode == 27) {
						$('#abr-submit-story').removeClass('active');
					$('html').css({
						'overflow': 'auto'
					});
					}
				});
			});
		</script>
		<?php

	}

	function submit() {

		if(isset($_POST['submit_story']) && wp_verify_nonce($_POST['_nonce'], 'submit-story')) {

			$post = array(
				'post_type' => 'story',
				'post_status' => 'pending',
				'post_title' => substr($_POST['story_content'], 0, 40) . '...',
				'post_content' => $_POST['story_content']
			);

			wp_insert_post($post);

			echo 'thanks!';

		}

	}

}

$GLOBALS['abr_story'] = new Abr_Story();

function abr_story_submit_form() {
	$GLOBALS['abr_story']->submit_form();
}