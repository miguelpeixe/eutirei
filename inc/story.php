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
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut massa eros, consequat eget tortor id, malesuada cursus mi. Nam nec rutrum lacus. Aliquam porta, libero sed pretium egestas, enim felis sodales arcu, a egestas elit nulla sollicitudin lectus. Phasellus interdum mi orci. Nulla vestibulum consequat euismod. Nullam sit amet facilisis neque. Phasellus luctus tortor in massa tempus, vulputate tincidunt nisi tincidunt. Nullam finibus vehicula magna vitae dapibus. Nulla euismod leo vel ligula bibendum ultrices. Suspendisse potenti. Nunc venenatis risus id nunc lobortis ultricies et non tellus. Phasellus ipsum risus, hendrerit vel vulputate tincidunt, molestie ac ante. Cras quis dolor ligula. Cras nec velit tempus, aliquet dolor ut, tincidunt ipsum. Duis tincidunt libero nec augue tempor efficitur. Ut ac urna mauris.</p>
				<input type="hidden" name="submit_story" value="1" />
				<input type="hidden" name="_nonce" value="<?php echo $nonce; ?>" />
				<textarea name="story_content"></textarea>
				<p><a class="details-toggle">Colabore também com a nossa pesquisa preenchendo alguns campos a mais</a></p>
				<div class="details">
					<h3>Sobre você</h3>
					<p class="gender">
						<label for="gender_input">Gênero com que você se identifica</label>
						<input type="text" id="gender_input" name="gender" />
					</p>
					<p class="birthyear">
						<label for="birthyear_input">Ano de nascimento</label>
						<input type="text" id="birthyear_input" name="birthyear" />
					</p>
					<p class="ethnicity">
						<label for="ethnicity_input">Cor</label>
						<input type="text" id="ethnicity_input" name="ethnicity" />
					</p>
					<p class="religion">
						<label for="religion_input">Religião</label>
						<input type="text" id="religion_input" name="religion" />
					</p>
					<p class="social_status">
						<label for="social_status_input">Situação econômica</label>
						<input type="text" id="social_status_input" name="social_status" />
					</p>
					<h3>Informações sobre o aborto</h3>
					<p class="age">
						<label for="age_input">Idade quando realizou o aborto</label>
						<input type="text" id="age_input" name="age" />
					</p>
					<p class="gestation_period">
						<label for="gestation_period_input">Tempo de gestação</label>
						<input type="text" id="gestation_period_input" name="gestation_period" />
					</p>
					<p class="reason">
						<label>Motivo</label>
						<div "
						<input type="checkbox" id="reason_wealth" name="reason" value="wealth" /> <label for="reason_wealth">Econômico</label>
						<input type="checkbox" id="reason_wealth" name="reason" value="wealth" /> <label for="reason_wealth">Econômico</label>
						<input type="checkbox" id="reason_wealth" name="reason" value="wealth" /> <label for="reason_wealth">Econômico</label>
					</p>
					<h3>Sua situação familiar</h3>
					<p class="amount_children">
						<label for="amount_children_input">Número de filhos</label>
						<input type="text" id="amount_children_input" name="amount_children" />
					</p>
					<p class="amount_children">
						<label for="amount_children_input">Número de filhos</label>
						<input type="text" id="amount_children_input" name="amount_children" />
					</p>
				</div>
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