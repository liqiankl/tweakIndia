<?php
/**
 *  Template Name: Front Page
 *
 */
get_header(); 
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
  $lang = ICL_LANGUAGE_CODE;
}

$limit= 3;
$blog_title = get_bloginfo();
$custom_home_page_layout_options = get_field( "custom_home_page_layout_options" );
if(!empty($custom_home_page_layout_options['full_width_feature_post_override']))
{
	 $full_width_feature_post_override = $custom_home_page_layout_options['full_width_feature_post_override'];
} 
$most_popular_post = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => array('template-most-popular-post.php')
));
$MostPopularID=$most_popular_post[0]->ID;
$video_popular_post = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => array('template-video-popular-post.php')
));
$VideoPopularID=$video_popular_post[0]->ID;
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
        <h1 style="display:none"><?php echo wp_title();?></h1>
        <article
            id="post-19"
            class="frontPageSection twentyseventeen-panel post-19 page type-page status-publish hentry">

            <!-- Start Top Full width Feature -->

        <?php

 	$top_recent_data =  array(); 
	if(!empty($full_width_feature_post_override))	
	{
		$data  = get_post($full_width_feature_post_override);
		$top_recent_data['ID'] = $data->ID;
		$get_data = get_post_meta($data->ID);
		$top_recent_data['link']   = esc_url( get_permalink( $data->ID ));
		$top_recent_data['category'] = get_the_category($data->ID);
		$top_recent_data['title']  = $data->post_title; 
		$author = get_user_by( 'ID' , $data->post_author );
		$authorname= $author->display_name;
		$top_recent_data['post_date']  = $data->post_date;
		
		
	}
	else
	{
	    //$args = array( 'numberposts' => '1','post_status'=>'publish','post_type' => 'post','orderby' => 'date', 'order' => 'DESC');
		$args = array( 'numberposts' => '1','lang' => $lang, 'has_password'=>FALSE, 'post_status'=>'publish','post_type' => 'post','orderby' => 'date', 'order' => 'DESC','suppress_filters'=>0,
		
		
		'tax_query' => array( array(
            'taxonomy' => 'post_format',
            'field' => 'slug',
            'terms' => array('post-format-video'),
            'operator' => 'NOT IN'
           ) )
		
		);
	    $recent_posts = wp_get_recent_posts( $args );
	   	
	    foreach( $recent_posts as $recent )
	    {
		   $top_recent_data['ID']     = $recent['ID'];
		   $top_recent_data['category'] = get_the_category($recent['ID']);
		   $top_recent_data['link']   = esc_url( get_permalink( $recent['ID'] ) );
		   $top_recent_data['title']  = $recent['post_title'];
		   $top_recent_data['author'] = $recent['post_author'];
		   $author = get_user_by( 'ID' , $recent['post_author'] );
		   $authorname= $author->display_name;
		   $top_recent_data['post_date'] = $recent['post_date'];
	    }

	}
if(!empty($top_recent_data['ID']))
{
?>
            <section class="c-superfeature btm-bottom full-inside-wrapper-sec1">
                <div class="c-superfeature-wrapper">
                    <div class="c-superfeature__images">
                        <div class="c-superfeature__images-wrapper home_img_wrapper_first">
                            <div class="c-superfeature__image">
                                <div class="c-superfeature__image-wrapper">
                                    <picture class="test-cls-<?php echo 'tt'.wp_is_mobile(); ?>">
                                        <script type="text/javascript">
                                            console.log('HTTP_USER_AGENT' + <?php var_dump($_SERVER['HTTP_USER_AGENT']); ?>);
                                        </script>
                                        <?php if ( strpos( $_SERVER['HTTP_USER_AGENT'], 'Mobile' ) !== false || strpos( $_SERVER['HTTP_USER_AGENT'], 'Android' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Silk/' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Kindle' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'BlackBerry' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false
        || strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mobi' ) !== false ) { ?>
                                        <div class="col-md-12 mobile-divice">
                                            <div class="row">
                                                <a
                                                    href="<?php echo get_permalink($top_recent_data['ID']) ?>"
                                                    title="<?php echo strip_tags( $top_recent_data['title'] ); ?>">
                                                    <?php 
                                                        echo get_the_post_thumbnail( $top_recent_data['ID'], 'home-tweak-mobile' );
                                                        //$img_big = get_the_post_thumbnail( $top_recent_data['ID'], 'home-tweak-mobile' );
                                                        //$img_big = str_replace("lazy","no-lazy", $img_big);
                                                        //echo $img_big;
                                                    ?>
                                                </a>
                                            </div>
                                        </div>
                                    	<?php }else{  ?>
                                        <div class="col-md-12 desk-divice">
                                            <div class="row">
                                                <a
                                                    href="<?php echo get_permalink($top_recent_data['ID']) ?>"
                                                    title="<?php echo strip_tags( $top_recent_data['title'] ); ?>">
                                                    <?php 
                                                        echo get_the_post_thumbnail( $top_recent_data['ID'], 'mfb-large' );
                                                        //$img_big = get_the_post_thumbnail( $top_recent_data['ID'], 'mfb-large' );
                                                        //$img_big = str_replace("lazy","no-lazy", $img_big);
 //                                                       echo $img_big;
                                                    ?>
                                                </a>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </picture>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="c-superfeature__contents">
						<p class="c-superfeature__tag spreme_tag">
                            <span>
                                <?php 
								$top_post_categories = get_post_primary_category($top_recent_data['ID'], 'category'); 
								$top_categories_name = $top_post_categories['primary_category']->name;
								$top_category_link = get_category_link($top_post_categories['primary_category']->term_id );
								?>
                                <a
                                    href="<?php echo esc_url( $top_category_link ); ?>"
                                    title="<?php echo $top_categories_name; ?>">
                                    <?php echo $top_categories_name; ?>
                                </a>
                            </span>
                        </p>
                        <div class="c-superfeature__contents-wrapper mb-text">
                            <div class="share-icon pt-2 pr-2 text-right">
                                <div class="a2a_kit a2a_kit_size_32 addtoany_list">
                                    <a
                                        href="https://www.facebook.com/share.php?u=<?php echo get_permalink($top_recent_data['ID']) ?>"
                                        title="<?php echo $top_recent_data['title']; ?>"
                                        class="btn_share_facebook"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                            <path
                                                fill="#fff"
                                                d="M14.41 6.64l-.23 3h-3.07V20H7.24V9.64H5.18v-3h2.06v-2a5.37 5.37 0 0 1 .67-3.1A3.68 3.68 0 0 1 11.11 0a13 13 0 0 1 3.71.37l-.52 3.09a7 7 0 0 0-1.67-.25c-.8 0-1.52.29-1.52 1.09v2.34z"></path>
                                        </svg>
                                    </a>
                                    <a
                                        href="https://twitter.com/intent/tweet?text=<?php echo $top_recent_data['title']; ?>;url=<?php echo get_permalink($top_recent_data['ID']) ?>;via=<?php echo $blog_title; ?>"
                                        title="<?php echo $top_recent_data['title']; ?>"
                                        class="btn_share_twitter"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                            <path
                                                fill="#fff"
                                                d="M18 5.92v.53A11.59 11.59 0 0 1 6.5 18.13h-.21A11.62 11.62 0 0 1 0 16.28a8.24 8.24 0 0 0 1 .06 8.22 8.22 0 0 0 5.1-1.76 4.1 4.1 0 0 1-3.83-2.85 4.11 4.11 0 0 0 1.85-.07 4.1 4.1 0 0 1-3.29-4 4.11 4.11 0 0 0 1.86.51 4.11 4.11 0 0 1-1.3-5.55 11.65 11.65 0 0 0 8.46 4.29 4.11 4.11 0 0 1 7-3.74 8.2 8.2 0 0 0 2.61-1 4.11 4.11 0 0 1-1.8 2.27A8.22 8.22 0 0 0 20 3.8a8.31 8.31 0 0 1-2 2.12"></path>
                                        </svg>
                                    </a>
                                    <a
                                        href="mailto:?subject=<?php echo $top_recent_data['title']; ?>&body=<?php echo get_permalink($top_recent_data['ID']) ?>"
                                        class="btn_share_mail">
                                        <svg
                                            id="Layer_1"
                                            data-name="Layer 1"
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewbox="0 0 20 20">
                                            <defs>
                                                <style>
                                                    .cls-1 {
                                                        fill-rule: evenodd;
                                                    }
                                                </style>
                                            </defs>
                                            <path fill="#fff" class="cls-1" d="M20 4.83V17H0V4.83L10 14z"></path>
                                            <path fill="#fff" class="cls-1" d="M10 12l10-9H0l10 9z"></path>
                                        </svg>
                                    </a>
                                </div>
                                <i class="fa fa-share-alt" aria-hidden="true"></i>
                            </div>
                        </div>
                        
                        <h3 class="c-superfeature__title">
                            <span>
                                <a
                                    href="<?php echo get_permalink($top_recent_data['ID']) ?>"
                                    title="<?php echo strip_tags($top_recent_data['title']); ?>">
                                    <?php 
				   		
				   		echo  $top_recent_data['title'];
				   ?>
                                </a>
                            </span>
                        </h3>
                        <p class="c-superfeature__byline small-tag">
                            <span class="c-superfeature__byline-prefix">
                                <?php _e('By','twentyseventeen-child'); ?>
                            </span>
                            <span class="c-superfeature__byline-name">
                                <?php echo $authorname; ?>
                            </span>
                        </p>
                        <ul class="c-superfeature__meta">
                            <li class="c-superfeature__meta-item c-superfeature__meta-item--date">
                                <span class="">
                                    <?php echo human_time_diff( strtotime( $top_recent_data['post_date'] ), current_time('timestamp') ) ?>
                                    <?php _e('ago','twentyseventeen-child'); ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
            <?php } ?>

            <!-- End Top Full width Feature -->
            <section class="c-superfeature img-avd horizontal-ad space-mt">
                <div class="c-superfeature-wrapper">
                    <div class="c-splash__cards mb-bottom">
                        <div class="c-splash__cards-wrapper">
                        <?php 
		 if ( wp_is_mobile() ) {
		 	if (function_exists ('adinserter')) echo adinserter (6); 
		 }
		 else{	
		    if (function_exists ('adinserter')) echo adinserter (1); 
         }
		 ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Start Most Popular Post -->
            <?php 


$most_popular_stories_override = $custom_home_page_layout_options['most_popular_stories_override'];
//echo $most_popular_stories_override;

?>
            <section class="c-splash most-popular">
                <div class="c-splash-wrapper">
                    <div class="c-splash__cards mobile-tbd">
                        <div class="c-splash__cards-wrapper">
                            <ul class="c-splash__cards-list c-card-list--c-splash">
                            <?php 
						if($most_popular_stories_override != '')
						{
							$postnum = 2;
						}
				   		else{
					  		$postnum = 3; 
				   		}
		   		$popularpost = new WP_Query( array(
		   		'posts_per_page' => $postnum,
                    'post_status'=>'publish',
                    'post_type'=>'post',
                    	'has_password'=>FALSE,
                    'meta_key' => 'post_views_count',
                    'orderby' => 'meta_value_num',
					'order' => 'DESC',
					'post__not_in'=>array( $top_recent_data['ID']),
                    'lang' => $lang,
                    'suppress_filters'=>0,
					'date_query' => array( array('after' => '-100 days'),


					

                    ) ));
				
				$i=0;	
				foreach($popularpost->posts as $post)
				{
					if($i % 2)
					{

						$class ="c-border-box-patten-5";
						$bgCls="";
						$shareClass="tab-share";
						$textClass="";
					}
					else
					{
						$class="c-border-box-patten-2";
						$bgCls="";
						$shareClass="";
						$textClass="";
					}
					
				?>
                                <li class="c-splash__cards-listitem ">
                                    <article class="c-card c-card--splash">
                                        <div class="c-card__obj">
                                            <div class="c-card__obj__header">
                                                <div class="c-card__images">
                                                    <div class="c-card__image col-md-12 <?php echo $class ?>">
                                                        <div class="row">
                                                            <a
                                                                href="<?php echo esc_url( get_permalink( $post->ID ) );  ?>"
                                                                title="<?php echo strip_tags($post->post_title); ?>">
                                                            <?php
											$most_second_featured_image = get_field( "second_featured_image", $post->ID );
											if(!empty($most_second_featured_image))	
											{
												echo wp_get_attachment_image($most_second_featured_image,"mfb-medium");
											}
											else
											{
												
												echo get_the_post_thumbnail( $post->ID,'mfb-medium');
											} 
										 ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="c-card__obj__body <?php echo $bgCls; ?>">
                                                <div class="c-card__header">
                                                    <p class="c-card__tag">
                                                        <?php 
											$post_categories = get_post_primary_category($post->ID, 'category'); 
											$categories_name = $post_categories['primary_category']->name;
											$category_link = get_category_link( $post_categories['primary_category']->term_id );
										?>
                                                        <a
                                                            href="<?php echo esc_url( $category_link ); ?>"
                                                            title="<?php echo $categories_name; ?>">
                                                            <?php echo $categories_name; ?>
                                                        </a>
                                                    </p>

                                                    <div class="share-icon pt-2 pr-2 text-right <?php echo $shareClass ?>">
                                                        <div class="a2a_kit a2a_kit_size_32 addtoany_list">
                                                            <a
                                                                href="https://www.facebook.com/share.php?u=<?php echo get_permalink($post->ID) ?>"
                                                                title="<?php echo $post->post_title; ?>"
                                                                class="btn_share_facebook"
                                                                target="_blank">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                                                    <path
                                                                        fill="#fff"
                                                                        d="M14.41 6.64l-.23 3h-3.07V20H7.24V9.64H5.18v-3h2.06v-2a5.37 5.37 0 0 1 .67-3.1A3.68 3.68 0 0 1 11.11 0a13 13 0 0 1 3.71.37l-.52 3.09a7 7 0 0 0-1.67-.25c-.8 0-1.52.29-1.52 1.09v2.34z"></path>
                                                                </svg>
                                                            </a>
                                                            <a
                                                                href="https://twitter.com/intent/tweet?text=<?php echo $post->post_title; ?>;url=<?php echo get_permalink( $post->ID) ?>;via=<?php echo $blog_title; ?>"
                                                                title="<?php echo $post->post_title; ?>"
                                                                class="btn_share_twitter"
                                                                target="_blank">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                                                    <path
                                                                        fill="#fff"
                                                                        d="M18 5.92v.53A11.59 11.59 0 0 1 6.5 18.13h-.21A11.62 11.62 0 0 1 0 16.28a8.24 8.24 0 0 0 1 .06 8.22 8.22 0 0 0 5.1-1.76 4.1 4.1 0 0 1-3.83-2.85 4.11 4.11 0 0 0 1.85-.07 4.1 4.1 0 0 1-3.29-4 4.11 4.11 0 0 0 1.86.51 4.11 4.11 0 0 1-1.3-5.55 11.65 11.65 0 0 0 8.46 4.29 4.11 4.11 0 0 1 7-3.74 8.2 8.2 0 0 0 2.61-1 4.11 4.11 0 0 1-1.8 2.27A8.22 8.22 0 0 0 20 3.8a8.31 8.31 0 0 1-2 2.12"></path>
                                                                </svg>
                                                            </a>
                                                            <a
                                                                href="mailto:?subject=<?php echo $post->post_title; ?>&body=<?php echo get_permalink( $post->ID) ?>"
                                                                class="btn_share_mail">
                                                                <svg
                                                                    id="Layer_1"
                                                                    data-name="Layer 1"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewbox="0 0 20 20">
                                                                    <defs>
                                                                        <style>
                                                                            .cls-1 {
                                                                                fill-rule: evenodd;
                                                                            }
                                                                        </style>
                                                                    </defs>
                                                                    <path fill="#fff" class="cls-1" d="M20 4.83V17H0V4.83L10 14z"></path>
                                                                    <path fill="#fff" class="cls-1" d="M10 12l10-9H0l10 9z"></path>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                    </div>

                                                    <h3 class="c-card__title <?php echo $textClass; ?>">
                                                        <span>
                                                            <a href="<?php echo esc_url( get_permalink($post->ID) ); ?>">
                                                                <?php echo strip_tags($post->post_title); ?>
                                                            </a>
                                                        </span>
                                                    </h3>
                                                    <p class="c-card__teaser">
                                                        We can't wait.
                                                    </p>
                                                    <hr class="c-card__separator">
                                                </div>
                                                <div class="c-card__footer">
                                                    <ul class="global__list-reset c-card__meta ">
                                                        <li class="c-card__meta-item  c-card__meta-item--date">
                                                            <span class="">
                                                                <?php echo human_time_diff( strtotime( $post->post_date ), current_time('timestamp') ) ?>
                                                                <?php _e('ago','twentyseventeen-child'); ?>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </li>
                                <?php 
				$i++;
				}
		   if($most_popular_stories_override != '')
						{
			   $dataa  = get_post($most_popular_stories_override);
		$atop_recent_data['ID'] = $dataa->ID;
		$aget_data = get_post_meta($dataa->ID);
		$atop_recent_data['link']   = esc_url( get_permalink( $dataa->ID ));
		$atop_recent_data['category'] = get_the_category($dataa->ID);
		$atop_recent_data['title']  = $dataa->post_title; 
		$aauthor = get_user_by( 'ID' , $dataa->post_author );
		$aauthorname= $author->display_name;
		$atop_recent_data['post_date']  = $dataa->post_date;
			   
			   ?>
                                <li class="c-splash__cards-listitem ">
                                    <article class="c-card c-card--splash">
                                        <div class="c-card__obj">
                                            <div class="c-card__obj__header">
                                                <div class="c-card__images">
                                                    <div class="c-card__image col-md-12 <?php echo $class ?>">
                                                        <div class="row">
                                                            <a
                                                                href="<?php echo get_permalink($atop_recent_data['ID']) ?>"
                                                                title="<?php echo strip_tags($atop_recent_data['title']); ?>">
                                                            <?php
											$most_second_featured_image = get_field( "second_featured_image", $atop_recent_data['ID'] );
											if(!empty($most_second_featured_image))	
											{
												echo wp_get_attachment_image($most_second_featured_image,"mfb-medium");
											}
											else
											{
												
												echo get_the_post_thumbnail( $atop_recent_data['ID'],'mfb-medium');
											} 
										 ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="c-card__obj__body <?php echo $bgCls; ?>">
                                                <div class="c-card__header">
                                                    <p class="c-card__tag">
                                                        <?php 
											$post_categories = get_post_primary_category($atop_recent_data['ID'], 'category'); 
											$categories_name = $post_categories['primary_category']->name;
											$category_link = get_category_link( $post_categories['primary_category']->term_id );
										?>
                                                        <a
                                                            href="<?php echo esc_url( $category_link ); ?>"
                                                            title="<?php echo $categories_name; ?>">
                                                            <?php echo $categories_name; ?>
                                                        </a>
                                                    </p>

                                                    <div class="share-icon pt-2 pr-2 text-right <?php echo $shareClass ?>">
                                                        <div class="a2a_kit a2a_kit_size_32 addtoany_list">
                                                            <a
                                                                href="https://www.facebook.com/share.php?u=<?php echo get_permalink($atop_recent_data['ID']) ?>"
                                                                title="<?php echo strip_tags($atop_recent_data['title']); ?>"
                                                                class="btn_share_facebook"
                                                                target="_blank">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                                                    <path
                                                                        fill="#fff"
                                                                        d="M14.41 6.64l-.23 3h-3.07V20H7.24V9.64H5.18v-3h2.06v-2a5.37 5.37 0 0 1 .67-3.1A3.68 3.68 0 0 1 11.11 0a13 13 0 0 1 3.71.37l-.52 3.09a7 7 0 0 0-1.67-.25c-.8 0-1.52.29-1.52 1.09v2.34z"></path>
                                                                </svg>
                                                            </a>
                                                            <a
                                                                href="https://twitter.com/intent/tweet?text=<?php echo strip_tags($atop_recent_data['title']); ?>;url=<?php echo get_permalink($atop_recent_data['ID']) ?>;via=<?php echo $blog_title; ?>"
                                                                title="<?php echo strip_tags($atop_recent_data['title']); ?>"
                                                                class="btn_share_twitter"
                                                                target="_blank">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                                                    <path
                                                                        fill="#fff"
                                                                        d="M18 5.92v.53A11.59 11.59 0 0 1 6.5 18.13h-.21A11.62 11.62 0 0 1 0 16.28a8.24 8.24 0 0 0 1 .06 8.22 8.22 0 0 0 5.1-1.76 4.1 4.1 0 0 1-3.83-2.85 4.11 4.11 0 0 0 1.85-.07 4.1 4.1 0 0 1-3.29-4 4.11 4.11 0 0 0 1.86.51 4.11 4.11 0 0 1-1.3-5.55 11.65 11.65 0 0 0 8.46 4.29 4.11 4.11 0 0 1 7-3.74 8.2 8.2 0 0 0 2.61-1 4.11 4.11 0 0 1-1.8 2.27A8.22 8.22 0 0 0 20 3.8a8.31 8.31 0 0 1-2 2.12"></path>
                                                                </svg>
                                                            </a>
                                                            <a
                                                                href="mailto:?subject=<?php echo strip_tags($atop_recent_data['title']); ?>&body=<?php echo get_permalink($atop_recent_data['ID']) ?>"
                                                                class="btn_share_mail">
                                                                <svg
                                                                    id="Layer_1"
                                                                    data-name="Layer 1"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewbox="0 0 20 20">
                                                                    <defs>
                                                                        <style>
                                                                            .cls-1 {
                                                                                fill-rule: evenodd;
                                                                            }
                                                                        </style>
                                                                    </defs>
                                                                    <path fill="#fff" class="cls-1" d="M20 4.83V17H0V4.83L10 14z"></path>
                                                                    <path fill="#fff" class="cls-1" d="M10 12l10-9H0l10 9z"></path>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>
                                                    </div>

                                                    <h3 class="c-card__title <?php echo $textClass; ?>">
                                                        <span>
                                                            <a href="<?php echo esc_url( get_permalink($atop_recent_data['ID']) ); ?>">
                                                                <?php echo strip_tags($atop_recent_data['title']); ?>
                                                            </a>
                                                        </span>
                                                    </h3>
                                                    <p class="c-card__teaser">
                                                        We can't wait.
                                                    </p>
                                                    <hr class="c-card__separator">
                                                </div>
                                                <div class="c-card__footer">
                                                    <ul class="global__list-reset c-card__meta ">
                                                        <li class="c-card__meta-item  c-card__meta-item--date">
                                                            <span class="">
                                                                <?php echo human_time_diff( strtotime( $atop_recent_data['post_date'] ), current_time('timestamp') ) ?>
                                                                <?php _e('ago','twentyseventeen-child'); ?>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </li>
                                <?php
			   
							
						}
		   
				?>
                                <li class="c-splash__cards-listitem advertisement">
                                <?php 
		 if ( wp_is_mobile() ) {
		 	if (function_exists ('adinserter')) echo adinserter (7); 
		 }
		 else{	
		    if (function_exists ('adinserter')) echo adinserter (2); 
           }
		 ?>
                                </li>
                            </ul>
                            <footer class="c-card-section__footer">
                                <a
                                    title="View More"
                                    href="<?php echo esc_url( get_page_link( $MostPopularID ) ); ?>"
                                    class="c-card-section__btn ">
                                    <?php _e('Read all our most popular stories','twentyseventeen-child');?>
                                </a>
                            </footer>
                        </div>
                    </div>

                <?php 
	  
	$previous_full_width_id = $top_recent_data['ID']; 
	  
	$second_recent_data=array(); 
	  
	if(!empty($custom_home_page_layout_options['second_full_width_feature_post_override']))
	{
		$second_recent_post_id_override = $custom_home_page_layout_options['second_full_width_feature_post_override'];
		
		if($previous_full_width_id==$second_recent_post_id_override) 
		{
			//Top full width id and Second recent post id overrid same 
			
			$args = array (
			'post_type'              => 'post',
			'post_status'			=> 'publish',	
			'orderby' 			=> 'date',
			'order'				=> 'DESC',
			'has_password'=>FALSE,
			'posts_per_page'         => 1,
			//'post__in'               => array($previous_full_width_id),
			'lang' 				=> $lang,
			'suppress_filters'		=> 0,
				
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) : 
			while ( $query->have_posts() ) : $query->the_post();
			
			$previous_post = get_previous_post();
			
			$second_recent_post = get_post($previous_post->ID);
			$second_recent_data['ID'] = $second_recent_post->ID;
			$second_recent_data['category'] = get_the_category($second_recent_data['ID']);
			$second_recent_data['title'] = $second_recent_post->post_title;
			$second_recent_data['link']   = esc_url( get_permalink( $second_recent_data['ID'] ) );
			$second_recent_data['post_date']   = $second_recent_post->post_date;
			$author = get_user_by( 'ID' , $second_recent_post->post_author );
			$authorname= $author->display_name;
			$second_recent_data['author']   = $authorname;
			
			
			endwhile;
			endif; 
			wp_reset_postdata();
			
		}












		else
		{
			// if Top full width id and Second recent post id overrid is not same 
			
			$second_recent_post = get_post($second_recent_post_id_override);
			
			$second_recent_data['ID'] = $second_recent_post->ID;
			$second_recent_data['category'] = get_the_category($second_recent_data['ID']);
			$second_recent_data['title'] = $second_recent_post->post_title;
			$second_recent_data['link']   = esc_url( get_permalink( $second_recent_data['ID'] ) );
			$second_recent_data['post_date']   = $second_recent_post->post_date;
			$author = get_user_by( 'ID' , $second_recent_post->post_author );
			$authorname= $author->display_name;
			$second_recent_data['author']   = $authorname;
		}
	}
	 else
	{	
		
			// if override field is empty
		  $firstposta= $custom_home_page_layout_options['full_width_feature_post_override'];
		   
		   if($firstposta != '')
			{
			   $offsetreca= 0;
		   	}
		 	else
		   	{
			   $offsetreca= 1;
		   	} 
	
			$args = array (
			'post_type'              => 'post',
			'post_status'			=> 'publish',	
			'orderby' 			=> 'date',
			'has_password'=>FALSE,
			'order'				=> 'DESC',
			'posts_per_page'         => 1,
			//'post__in'               => array($previous_full_width_id),
			'lang' 				=> $lang,
			'suppress_filters'		=> 0,
			'offset'               =>$offsetreca,
				'tax_query' => array( array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array('post-format-video'),
				'operator' => 'NOT IN'
			   ) )
			);
			$query = new WP_Query( $args );
			if ( $query->have_posts() ) : 
			while ( $query->have_posts() ) : $query->the_post();
			
			$previous_post = get_previous_post();
			//$next_post = get_next_post();
			
			//$second_recent_post = get_post($previous_post->ID);
		$second_recent_post = get_post($post->ID);
		
			$second_recent_data['ID'] = $second_recent_post->ID;
		 //$second_recent_data['ID'] = $post->ID;
		 	$second_recent_data['category'] = get_the_category($second_recent_data['ID']);
			$second_recent_data['title'] = $second_recent_post->post_title;
			$second_recent_data['link']   = esc_url( get_permalink( $second_recent_data['ID'] ) );
			$second_recent_data['post_date']   = $second_recent_post->post_date;
			$author = get_user_by( 'ID' , $second_recent_post->post_author );
			$authorname= $author->display_name;
			$second_recent_data['author']   = $authorname;
			
			endwhile;
			endif; 
			wp_reset_postdata();
	 
	}
	$second_recent_data['title']  = $second_recent_data['title'];
?>
                </div>
            </section>
            <!-- End Most Popular Post -->

            <?php videomodule(0,1);?>

            <!-- End Video Popular Post -->
            <section class="c-superfeature img-avd horizontal-ad mobile-tuts">
                <div class="c-superfeature-wrapper">
                    <div class="c-splash__cards mobile-tbd">
                        <div class="c-splash__cards-wrapper">
                        <?php 
		if ( wp_is_mobile() ) 
		{
			if (function_exists ('adinserter')) echo adinserter (10); 
		}
		else
		{	
			if (function_exists ('adinserter')) echo adinserter (4);
		}
		?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Start Second Recent Post -->
            <?php 
if (!empty($second_recent_data['ID'])) 
{
?>
            <section class="c-superfeature sec-2b full-inside-wrapper-sec1">
                <div class="c-superfeature-wrapper">
                    <div class="c-superfeature__images">
                        <div class="c-superfeature__images-wrapper home_img_wrapper_second">
                            <div class="c-superfeature__image">
                                <div class="c-superfeature__image-wrapper">
                                    <picture>
                                        <?php if ( wp_is_mobile() ) : ?>
                                        <div class="col-md-12 mobile-divice">
                                            <div class="row">
                                                <a
                                                    href="<?php echo get_permalink($second_recent_data['ID']) ?>"
                                                    title="<?php echo strip_tags($second_recent_data['title']); ?>">
                                                    <?php echo get_the_post_thumbnail($second_recent_data['ID'], 'home-tweak-mobile' ); ?>
                                                </a>
                                            </div>
                                        </div>
                                    	<?php else : ?>
                                        <div class="col-md-12 desk-divice">
                                            <div class="row">
                                                <a
                                                    href="<?php echo get_permalink($second_recent_data['ID']) ?>"
                                                    title="<?php echo strip_tags($second_recent_data['title']); ?>">
                                                    <?php echo get_the_post_thumbnail($second_recent_data['ID'], 'mfb-large' ); ?>
                                                </a>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                    </picture>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="c-superfeature__contents bg-gry">
                        
							<p class="c-superfeature__tag spreme_tag">
                                <span>
                                    <?php 
									$second_post_categories = get_post_primary_category($second_recent_data['ID'], 'category'); 
									$second_categories_name = $second_post_categories['primary_category']->name;
									$second_category_link = get_category_link( $second_post_categories['primary_category']->term_id );
									?>
                                    <a
                                        href="<?php echo esc_url( $second_category_link ); ?>"
                                        title="<?php echo $second_categories_name; ?>">
                                        <?php echo $second_categories_name; ?>
                                    </a>
                                </span>
                            </p>
                            <div class="c-superfeature__contents-wrapper mb-text">
                                <div class="share-icon pt-2 pr-2 text-right">
                                    <div class="a2a_kit a2a_kit_size_32 addtoany_list">
                                        <a
                                            href="https://www.facebook.com/share.php?u=<?php echo get_permalink($second_recent_data['ID']) ?>"
                                            title="<?php echo $second_recent_data['title']; ?>"
                                            class="btn_share_facebook"
                                            target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                                <path
                                                    fill="#fff"
                                                    d="M14.41 6.64l-.23 3h-3.07V20H7.24V9.64H5.18v-3h2.06v-2a5.37 5.37 0 0 1 .67-3.1A3.68 3.68 0 0 1 11.11 0a13 13 0 0 1 3.71.37l-.52 3.09a7 7 0 0 0-1.67-.25c-.8 0-1.52.29-1.52 1.09v2.34z"></path>
                                            </svg>
                                        </a>
                                        <a
                                            href="https://twitter.com/intent/tweet?text=<?php echo $second_recent_data['title']; ?>;url=<?php echo get_permalink( $second_recent_data['ID']) ?>;via=<?php echo $blog_title; ?>"
                                            title="<?php echo $second_recent_data['title']; ?>"
                                            class="btn_share_twitter"
                                            target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                                <path
                                                    fill="#fff"
                                                    d="M18 5.92v.53A11.59 11.59 0 0 1 6.5 18.13h-.21A11.62 11.62 0 0 1 0 16.28a8.24 8.24 0 0 0 1 .06 8.22 8.22 0 0 0 5.1-1.76 4.1 4.1 0 0 1-3.83-2.85 4.11 4.11 0 0 0 1.85-.07 4.1 4.1 0 0 1-3.29-4 4.11 4.11 0 0 0 1.86.51 4.11 4.11 0 0 1-1.3-5.55 11.65 11.65 0 0 0 8.46 4.29 4.11 4.11 0 0 1 7-3.74 8.2 8.2 0 0 0 2.61-1 4.11 4.11 0 0 1-1.8 2.27A8.22 8.22 0 0 0 20 3.8a8.31 8.31 0 0 1-2 2.12"></path>
                                            </svg>
                                        </a>
                                        <a
                                            href="mailto:?subject=<?php echo $second_recent_data['title']; ?>&body=<?php echo get_permalink( $second_recent_data['ID']) ?>"
                                            class="btn_share_mail">
                                            <svg
                                                id="Layer_1"
                                                data-name="Layer 1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewbox="0 0 20 20">
                                                <defs>
                                                    <style>
                                                        .cls-1 {
                                                            fill-rule: evenodd;
                                                        }
                                                    </style>
                                                </defs>
                                                <path fill="#fff" class="cls-1" d="M20 4.83V17H0V4.83L10 14z"></path>
                                                <path fill="#fff" class="cls-1" d="M10 12l10-9H0l10 9z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    <i class="fa fa-share-alt" aria-hidden="true"></i>
                                </div>
                            </div>

                            
                            <h3 class="c-superfeature__title">
                                <span>
                                    <a
                                        href="<?php echo get_permalink($second_recent_data['ID']) ?>"
                                        title="<?php echo strip_tags($second_recent_data['title']); ?>">
                                        <?php echo $second_recent_data['title']; ?>
                                    </a>
                                </span>
                            </h3>
                            <p class="c-superfeature__byline small-tag">
                                <span class="c-superfeature__byline-prefix">
                                    <?php _e('By','twentyseventeen-child'); ?>
                                </span>
                                <span class="c-superfeature__byline-name">
                                    <?php echo $second_recent_data['author']; ?>
                                </span>
                            </p>
                            <ul class="c-superfeature__meta">
                                <li class="c-superfeature__meta-item c-superfeature__meta-item--date">
                                    <span class="">
                                        <?php echo human_time_diff( strtotime( $second_recent_data['post_date'] ), current_time('timestamp') ) ?>
                                        <?php _e('ago','twentyseventeen-child'); ?></span>
                                </li>
                            </ul>
                    </div>
                </div>
            </section>

            <?php } ?>

            <!-- End Second Recent Post -->

            <!-- Start First Grid Recent Post Section -->

            <section class="c-splash sec-2b-grid">
                <div class="c-splash-wrapper">
                    <div class="c-splash__cards mobile-tbd">
                        <div class="c-splash__cards-wrapper">
                            <ul class="c-splash__cards-list c-card-list--c-splash">
                            <?php 
		   $firstpost= $custom_home_page_layout_options['full_width_feature_post_override'];
		   $secondpost = $custom_home_page_layout_options['second_full_width_feature_post_override'];
		   if(($firstpost == '') && ( $secondpost == '') )
			{
			   $offsetrec= 2;
		   	}
		   elseif(($firstpost != '') && ( $secondpost == '') )
			{
			   $offsetrec= 1;
		   	}
		   elseif(($firstpost == '') && ( $secondpost != '') )
			{
			   $offsetrec= 1;
		   	}
		   else
		   {
			   $offsetrec= 0;
		   }
		   
		
		$args = array (
			'post_type'              => 'post',
			'post_status'			=> 'publish',	
			'orderby' 			=> 'date',
			'order'				=> 'DESC',
			'has_password'=>FALSE,
			'lang' 				=> $lang,
			'suppress_filters'		=> 0,	
			'posts_per_page'         => 3,
			'offset'               =>$offsetrec,
			'tax_query' => array( array(
				'taxonomy' => 'post_format',
				'field' => 'slug',
				'terms' => array('post-format-video'),
				'operator' => 'NOT IN'
			   ) )
			);
			$posts = get_posts( $args );
			
		 	
		
				$i = 0 ; 
				foreach ( $posts as $result ) {
					setup_postdata( $result ); 
					
		
		
			  
			$first_recent_data['ID'] = $result->ID;
			$first_recent_data['category'] = get_the_category($first_recent_data['ID']);
			$first_recent_data['title'] = $result->post_title;
			$first_recent_data['link']   = esc_url( get_permalink( $first_recent_data['ID'] ) );
			$first_recent_data['post_date']   = $result->post_date;
			$author = get_user_by( 'ID' , $result->post_author );
			$authorname= $author->display_name;
			$first_recent_data['author']   = $authorname;
			  
			if($i%2==0)
			{
				$class ="c-border-box-patten-5";
			  	$bgCls="";
				$shareClass="btnd tab-share";
				$textClass="";
			}
			else
			{
				$class ="c-border-box-patten-2" ;
			  	$bgCls="";
				$shareClass="";
				$textClass="";
			}
			
     ?>

                                <li class="c-splash__cards-listitem pink-bg">
                                    <article class="c-card c-card--splash">
                                        <div class="c-card__obj">
                                            <div class="c-card__obj__header">
                                                <div class="c-card__images">
                                                    <div class="c-card__image col-md-12">
                                                        <div class="row">
                                                            <a
                                                                href="<?php echo get_permalink($first_recent_data['ID']) ?>"
                                                                title="<?php echo strip_tags($first_recent_data['title']); ?>">
                                                            <?php
							$first_second_featured_image = get_field( "second_featured_image", $result->ID );
							if(!empty($first_second_featured_image))	
							{
								echo wp_get_attachment_image($first_second_featured_image, "mfb-medium","",array( 'class' => $class ));
							}
							else
							{
								echo get_the_post_thumbnail(  $result->ID,'mfb-medium', array( 'class' => $class ));
							} 
						 ?>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="c-card__obj__body bg-rig beulah">
                                                <div class="c-card__header">
                                                    <p class="c-card__tag">
                                                        <?php 
					$first_post_categories = get_post_primary_category($first_recent_data['ID'], 'category'); 
					$first_categories_name = $first_post_categories['primary_category']->name;
					$first_category_link = get_category_link($first_post_categories['primary_category']->term_id );
					?>
                                                        <a
                                                            href="<?php echo esc_url( $first_category_link ); ?>"
                                                            title="<?php echo $first_categories_name; ?>">
                                                            <?php echo $first_categories_name; ?>
                                                        </a>
                                                    </p>
                                                    <div class="share-icon pt-2 pr-2 text-right">
                                                        <div class="a2a_kit a2a_kit_size_32 addtoany_list">
                                                            <a
                                                                href="https://www.facebook.com/share.php?u=<?php echo get_permalink($first_recent_data['ID']) ?>"
                                                                title="<?php echo $first_recent_data['title']; ?>"
                                                                class="btn_share_facebook"
                                                                target="_blank">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                                                    <path
                                                                        fill="#fff"
                                                                        d="M14.41 6.64l-.23 3h-3.07V20H7.24V9.64H5.18v-3h2.06v-2a5.37 5.37 0 0 1 .67-3.1A3.68 3.68 0 0 1 11.11 0a13 13 0 0 1 3.71.37l-.52 3.09a7 7 0 0 0-1.67-.25c-.8 0-1.52.29-1.52 1.09v2.34z"></path>
                                                                </svg>
                                                            </a>
                                                            <a
                                                                href="https://twitter.com/intent/tweet?text=<?php echo $first_recent_data['title']; ?>;url=<?php echo get_permalink( $first_recent_data['ID']) ?>;via=<?php echo $blog_title; ?>"
                                                                title="<?php echo $first_recent_data['title']; ?>"
                                                                class="btn_share_twitter"
                                                                target="_blank">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                                                    <path
                                                                        fill="#fff"
                                                                        d="M18 5.92v.53A11.59 11.59 0 0 1 6.5 18.13h-.21A11.62 11.62 0 0 1 0 16.28a8.24 8.24 0 0 0 1 .06 8.22 8.22 0 0 0 5.1-1.76 4.1 4.1 0 0 1-3.83-2.85 4.11 4.11 0 0 0 1.85-.07 4.1 4.1 0 0 1-3.29-4 4.11 4.11 0 0 0 1.86.51 4.11 4.11 0 0 1-1.3-5.55 11.65 11.65 0 0 0 8.46 4.29 4.11 4.11 0 0 1 7-3.74 8.2 8.2 0 0 0 2.61-1 4.11 4.11 0 0 1-1.8 2.27A8.22 8.22 0 0 0 20 3.8a8.31 8.31 0 0 1-2 2.12"></path>
                                                                </svg>
                                                            </a>
                                                            <a
                                                                href="mailto:?subject=<?php echo $first_recent_data['title']; ?>&body=<?php echo get_permalink( $first_recent_data['ID']) ?>"
                                                                class="btn_share_mail">
                                                                <svg
                                                                    id="Layer_1"
                                                                    data-name="Layer 1"
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    viewbox="0 0 20 20">
                                                                    <defs>
                                                                        <style>
                                                                            .cls-1 {
                                                                                fill-rule: evenodd;
                                                                            }
                                                                        </style>
                                                                    </defs>
                                                                    <path fill="#fff" class="cls-1" d="M20 4.83V17H0V4.83L10 14z"></path>
                                                                    <path fill="#fff" class="cls-1" d="M10 12l10-9H0l10 9z"></path>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <i class="fa fa-share-alt" aria-hidden="true"></i>

                                                    </div>

                                                    <h3 class="c-card__title text-wite">
                                                        <span>
                                                            <a
                                                                href="<?php echo get_permalink($first_recent_data['ID']) ?>"
                                                                title="<?php echo strip_tags($first_recent_data['title']); ?>">
                                                                <?php echo $first_recent_data['title']; ?>
                                                            </a>
                                                        </span>
                                                    </h3>
                                                    <hr class="c-card__separator">
                                                </div>
                                                <div class="c-card__footer">
                                                    <ul class="global__list-reset c-card__meta ">
                                                        <li class="c-card__meta-item  c-card__meta-item--date">
                                                            <span class="text-wite">
                                                                <?php echo human_time_diff( strtotime( $first_recent_data['post_date']  ), current_time('timestamp') ) ?>
                                                                <?php _e('ago','twentyseventeen-child'); ?>
                                                            </span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </li>
                                <?php 
		  $i++;
		  } ?>
                                <li class="c-splash__cards-listitem advertisement">
                                <?php 
		 
		 if ( wp_is_mobile() ) {
		 	if (function_exists ('adinserter')) echo adinserter (8); 
		 }
		 else{	
		    if (function_exists ('adinserter')) echo adinserter (3); 
         }
		 ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- End First Grid Recent Post Section -->

            <!-- Start Newsletter Section -->
            <?php // tweaknewsletter(1);?>
            <!-- End Newsletter Section -->

            <!-- Start Full Width Recent -->

            <?php recentpostbigbanner(5,1);?>

            <!-- End third Recent Post -->

            <!-- Start Second Recent Post Section -->

            <?php recentpostsmallfourbox(6);?>

            <!-- End Second Recent Post Section -->

            <!-- Start Tranding Post Section -->
            <section class="c-superfeature img-avd story">
                <div class="c-superfeature-wrapper mobile-tab">
                    <div class="row">
                        <?php
	    if(!empty($custom_home_page_layout_options['tranding_section']))
	    {
			$t=1;
			foreach($custom_home_page_layout_options['tranding_section'] as $trading)
			{
				
				if(!empty($trading['tranding_div']))
				{
					$trading_post = get_post($trading['tranding_div']);
					$trading_post_status = $trading_post->post_status;
					$trading_post_type = $trading_post->post_type;
					
				  if($trading_post_status == "publish" && $trading_post_type == "post"  )
				   { 
					  	$tranding_hashtag = $trading['tranding_hashtag'];
						$trading_post_ID = $trading_post->ID;
						$trading_post_title = $trading_post->post_title; 
						$trading_post_date = $trading_post->post_date;
						if($t==1)	
						{	
						?>
                        <div class="tag-img mt-tab prit1">
                            <a href="JavaScript:void(0);"><?php echo $tranding_hashtag; ?></a>
                        </div>
                        <div class="item-actor col-xs-12 col-md-4 col-lg-6 shad-imag">
                            <a
                                href="<?php echo get_permalink($trading_post_ID) ?>"
                                title="<?php echo strip_tags($trading_post_title); ?>">
                                <?php echo get_the_post_thumbnail( $trading_post_ID,'tweak-trending', array( 'class' => 'main-splash' )); ?>
                            </a>
                            <div class="bd-tods col-lg-6">
                                <div class="share-icon sharelastrow">
                                    <div class="a2a_kit a2a_kit_size_32 addtoany_list">
                                        <a
                                            href="https://www.facebook.com/share.php?u=<?php echo get_permalink($trading_post_ID) ?>"
                                            title="<?php echo $trading_post_title; ?>"
                                            class="btn_share_facebook"
                                            target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                                <path
                                                    fill="#fff"
                                                    d="M14.41 6.64l-.23 3h-3.07V20H7.24V9.64H5.18v-3h2.06v-2a5.37 5.37 0 0 1 .67-3.1A3.68 3.68 0 0 1 11.11 0a13 13 0 0 1 3.71.37l-.52 3.09a7 7 0 0 0-1.67-.25c-.8 0-1.52.29-1.52 1.09v2.34z"></path>
                                            </svg>
                                        </a>
                                        <a
                                            href="https://twitter.com/intent/tweet?text=<?php echo $trading_post_title; ?>;url=<?php echo get_permalink( $trading_post_ID) ?>;via=<?php echo $blog_title; ?>"
                                            title="<?php echo $trading_post_title; ?>"
                                            class="btn_share_twitter"
                                            target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                                <path
                                                    fill="#fff"
                                                    d="M18 5.92v.53A11.59 11.59 0 0 1 6.5 18.13h-.21A11.62 11.62 0 0 1 0 16.28a8.24 8.24 0 0 0 1 .06 8.22 8.22 0 0 0 5.1-1.76 4.1 4.1 0 0 1-3.83-2.85 4.11 4.11 0 0 0 1.85-.07 4.1 4.1 0 0 1-3.29-4 4.11 4.11 0 0 0 1.86.51 4.11 4.11 0 0 1-1.3-5.55 11.65 11.65 0 0 0 8.46 4.29 4.11 4.11 0 0 1 7-3.74 8.2 8.2 0 0 0 2.61-1 4.11 4.11 0 0 1-1.8 2.27A8.22 8.22 0 0 0 20 3.8a8.31 8.31 0 0 1-2 2.12"></path>
                                            </svg>
                                        </a>
                                        <a
                                            href="mailto:?subject=<?php echo $trading_post_title; ?>&body=<?php echo get_permalink( $trading_post_ID) ?>"
                                            class="btn_share_mail">
                                            <svg
                                                id="Layer_1"
                                                data-name="Layer 1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewbox="0 0 20 20">
                                                <defs>
                                                    <style>
                                                        .cls-1 {
                                                            fill-rule: evenodd;
                                                        }
                                                    </style>
                                                </defs>
                                                <path fill="#fff" class="cls-1" d="M20 4.83V17H0V4.83L10 14z"></path>
                                                <path fill="#fff" class="cls-1" d="M10 12l10-9H0l10 9z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                                </div>
                                <span class="c-superfeature__byline-name">

                                    <a
                                        href="<?php echo get_permalink($trading_post_ID) ?>"
                                        title="<?php echo strip_tags($trading_post_title); ?>">
                                        <?php echo $trading_post_title; ?>
                                    </a>

                                </span>
                                <ul class="c-superfeature__metas">
                                    <li class="c-superfeature__meta-item c-superfeature__meta-item--dates">
                                        <span class="">
                                            <?php echo human_time_diff( strtotime( $trading_post_date ), current_time('timestamp') ) ?>
                                            <?php _e('ago','twentyseventeen-child'); ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    <?php
						}
						else
						{
						?>
                        <div class="item-actor col-xs-12 col-md-4 col-lg-3 shad-imag">
                            <div class="tag-img mt-tab tag-splash">
                                <a href="JavaScript:void(0);"><?php echo $tranding_hashtag; ?></a>
                            </div>
                            <a
                                href="<?php echo get_permalink($trading_post_ID) ?>"
                                title="<?php echo strip_tags($trading_post_title); ?>">
                                <?php echo get_the_post_thumbnail( $trading_post_ID,'mfb-medium', array( 'class' => 'img-fluid' )); ?>
                            </a>
                            <div class="bd-tods col-lg-10">
                                <div class="share-icon sharelastrow">
                                    <div class="a2a_kit a2a_kit_size_32 addtoany_list">
                                        <a
                                            href="https://www.facebook.com/share.php?u=<?php echo get_permalink($trading_post_ID) ?>"
                                            title="<?php echo $trading_post_title; ?>"
                                            class="btn_share_facebook"
                                            target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                                <path
                                                    fill="#fff"
                                                    d="M14.41 6.64l-.23 3h-3.07V20H7.24V9.64H5.18v-3h2.06v-2a5.37 5.37 0 0 1 .67-3.1A3.68 3.68 0 0 1 11.11 0a13 13 0 0 1 3.71.37l-.52 3.09a7 7 0 0 0-1.67-.25c-.8 0-1.52.29-1.52 1.09v2.34z"></path>
                                            </svg>
                                        </a>
                                        <a
                                            href="https://twitter.com/intent/tweet?text=<?php echo $trading_post_title; ?>;url=<?php echo get_permalink( $trading_post_ID) ?>;via=<?php echo $blog_title; ?>"
                                            title="<?php echo $trading_post_title; ?>"
                                            class="btn_share_twitter"
                                            target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 20 20">
                                                <path
                                                    fill="#fff"
                                                    d="M18 5.92v.53A11.59 11.59 0 0 1 6.5 18.13h-.21A11.62 11.62 0 0 1 0 16.28a8.24 8.24 0 0 0 1 .06 8.22 8.22 0 0 0 5.1-1.76 4.1 4.1 0 0 1-3.83-2.85 4.11 4.11 0 0 0 1.85-.07 4.1 4.1 0 0 1-3.29-4 4.11 4.11 0 0 0 1.86.51 4.11 4.11 0 0 1-1.3-5.55 11.65 11.65 0 0 0 8.46 4.29 4.11 4.11 0 0 1 7-3.74 8.2 8.2 0 0 0 2.61-1 4.11 4.11 0 0 1-1.8 2.27A8.22 8.22 0 0 0 20 3.8a8.31 8.31 0 0 1-2 2.12"></path>
                                            </svg>
                                        </a>
                                        <a
                                            href="mailto:?subject=<?php echo $trading_post_title; ?>&body=<?php echo get_permalink( $trading_post_ID) ?>"
                                            class="btn_share_mail">
                                            <svg
                                                id="Layer_1"
                                                data-name="Layer 1"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewbox="0 0 20 20">
                                                <defs>
                                                    <style>
                                                        .cls-1 {
                                                            fill-rule: evenodd;
                                                        }
                                                    </style>
                                                </defs>
                                                <path fill="#fff" class="cls-1" d="M20 4.83V17H0V4.83L10 14z"></path>
                                                <path fill="#fff" class="cls-1" d="M10 12l10-9H0l10 9z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                    <i class="fa fa-share-alt" aria-hidden="true"></i>

                                </div>
                                <p class="c-superfeatures">
                                    <span class="c-superfeature__byline-prefix"></span>
                                    <span class="c-superfeature__byline-name">
                                        <a
                                            href="<?php echo get_permalink($trading_post_ID) ?>"
                                            title="<?php echo strip_tags($trading_post_title); ?>">
                                            <?php echo $trading_post_title; ?>
                                        </a>

                                    </span>
                                </p>
                                <ul class="c-superfeature__metas">
                                    <li class="c-superfeature__meta-item c-superfeature__meta-item--dates">
                                        <span class="">
                                            <?php echo human_time_diff( strtotime( $trading_post_date  ), current_time('timestamp') ) ?>
                                            <?php _e('ago','twentyseventeen-child'); ?>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php 
					    }
				  }
				$t++;
				}
			}
	    	}
	  ?>
                    </div>
                </div>
            </section>
            <!-- End Tranding Post Section -->
            <div class="clearfix"></div>

            <?php videomodule(4,2);?>

            <?php recentpostbigbanner(10,2);?>
            <?php recentpostsmallfourbox(11);?>
            <?php //tweaknewsletter(2);?>
            <?php recentpostbigbanner(15,3);?>
            <?php recentpostsmallfourbox(16);?>

        </article>
    </main>
</div>
<?php get_footer(); ?>

<script
    type="text/javascript"
    src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
<script
    type="text/javascript"
    src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.plugins.min.js"></script>
<script>

    jQuery(function () {
        jQuery('.lazy').Lazy();
    });
</script>