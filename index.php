<?php get_header(); ?>

<div id="call-story">
	<div class="container">
		<h2>Ajude a ampliar a voz das mulheres</h2>
		<a class="button open-abr-submit-form" href="javascript:void(0);">Conte-nos sua história</a>
	</div>
</div>

<?php if ( have_posts() ) : ?>

<div class="container">
	<div class="row" id="blog" >
    
	<?php if ( ( suevafree_template('sidebar') == "left-sidebar" ) || ( suevafree_template('sidebar') == "right-sidebar" ) ) : ?>
        
        <div class="<?php echo suevafree_template('span') .' '. suevafree_template('sidebar'); ?>"> 
        <div class="row"> 
        
    <?php endif; ?>

    	<h2 class="span12">Histórias compartilhadas</h2>        
		
		<?php while ( have_posts() ) : the_post(); ?>

        <div <?php post_class(array('pin-article', suevafree_template('span') )); ?> >
    
				<?php do_action('suevafree_postformat'); ?>
        
                <div style="clear:both"></div>
            
            </div>
		
		<?php endwhile; else:  ?>

        <div <?php post_class(array('pin-article', suevafree_template('span') )); ?> >
    
                <article class="article category">
                    
                    <h1> Not found </h1>
                    <p><?php _e( 'Sorry, no posts matched into ',"wip" ) ?> <strong>: <?php the_category(' '); ?></strong></p>
     
                </article>
    
            </div>
	
		<?php endif; ?>
        
	<?php if ( ( suevafree_template('sidebar') == "left-sidebar" ) || ( suevafree_template('sidebar') == "right-sidebar" ) ) : ?>
        
        </div>
        </div>
        
    <?php endif; ?>

	<?php if ( suevafree_template('span') == "span8" ) :  ?>

    <!-- HOME WIDGET -->

    <section id="sidebar" class="pin-article span4">
    	<div class="sidebar-box">

			<?php if ( is_active_sidebar('home_sidebar_area') ) { 
            
				dynamic_sidebar('home_sidebar_area');
            
            } else { 
                
                the_widget( 'WP_Widget_Archives','',
				array('before_widget' => '<div class="widget-box">',
					  'after_widget'  => '</div>',
					  'before_title'  => '<h3 class="title">',
					  'after_title'   => '</h3>'
				));

                the_widget( 'WP_Widget_Calendar',
				array("title"=> __('Calendar','wip')),
				array('before_widget' => '<div class="widget-box">',
					  'after_widget'  => '</div>',
					  'before_title'  => '<h3 class="title">',
					  'after_title'   => '</h3>'
				));

                the_widget( 'WP_Widget_Categories','',
				array('before_widget' => '<div class="widget-box">',
					  'after_widget'  => '</div>',
					  'before_title'  => '<h3 class="title">',
					  'after_title'   => '</h3>'
				));
            
             } 
			 
			 ?>

            </div>
        </section>

	<!--  END HOME WIDGET -->

	<?php endif;?>

    </div>
</div>

<?php

	get_template_part('pagination');
	get_footer(); 

?>