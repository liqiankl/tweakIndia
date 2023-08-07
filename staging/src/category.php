<?php
get_header();
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
  $lang = ICL_LANGUAGE_CODE;
}
 $category = get_queried_object();
 $cat_ID =$category->term_id;
 $cat_name=  $category->name;
 $description = $category->description;
 $parentcat = $category->parent;
//print_r($category);
 if($description!="" || $parentcat == 0){
/* Get Category Image */
if (function_exists('get_wp_term_image'))
{
    $meta_image = get_wp_term_image($cat_ID);
    //It will give category/term image url
}
$category_social_link = get_field( "category_social_link" );

/* End Category Image */
 $facebook = $category_social_link['facebook'];
 $twitter = $category_social_link['twitter'];
 $instagram = $category_social_link['instagram'];
 $email = $category_social_link['email'];

 $postsPerPage = 3;
 $page = 1;

 $args = array('parent' => $cat_ID,'lang'=> $lang);
 $categories = get_categories( $args );

 foreach($categories as $category) {

	 $data_cat[]=$category->term_id;

 }

$args = array(
  'category' 		=> $cat_ID,
  'orderby'       	=>  'post_date',
  'category__in'		=> $data_cat,
  'order'         	=>  'DESC',
  'posts_per_page' 	=>  $postsPerPage, 	// no limit
  'post_type'		=> 'post',
  'post_status' 	=> 'publish',
  'has_password'=>FALSE,
  'lang' 			=> $lang,
  'suppress_filters' =>0
);

$category_posts = get_posts( $args );
$total = count($category_posts);
$post_counter = 0;
$class='';
$i = 0;
?>
<div class="wrap1">
    <section class="c-superfeature img-avd horizontal-ad space-mt">
        <div class="c-superfeature-wrapper">
            <div class="c-splash__cards mb-bottom">
                <div class="c-splash__cards-wrapper">
                    <?php
                      if (wp_is_mobile()) {
                          if (function_exists('adinserter'))
                              echo adinserter(6);
                      } else {
                          if (function_exists('adinserter'))
                              echo adinserter(1);
                      }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="row light_green">
  <section class="c-superfeature mt-40 mb-40">
    <div class="c-superfeature-wrapper">
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3 member-team-img">
		 <?php
		 if (isset($meta_image)) : ?>
				<img src="<?php echo $meta_image; ?>" width="" height="" />
		<?php endif; ?>
	 </div>
     <!--<div class="col-xs-12 col-sm-7 col-md-7 col-lg-9 member-team-biography">-->
     <div class="c-splash__cards-wrapper categorie mfb_list_ctg mfb_mt_60 mfb_mb_60">
        <h1> <?php echo  $cat_name; ?> </h1>
       <div class="">
          <div class="mfb_share">
            <ul>
			<?php if(!empty($facebook)) { ?>
			    <li> <a href="<?php echo $facebook; ?>" title="facebook" class="btn_share_facebook" target="_blank"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
				 <path d="M14.41 6.64l-.23 3h-3.07V20H7.24V9.64H5.18v-3h2.06v-2a5.37 5.37 0 0 1 .67-3.1A3.68 3.68 0 0 1 11.11 0a13 13 0 0 1 3.71.37l-.52 3.09a7 7 0 0 0-1.67-.25c-.8 0-1.52.29-1.52 1.09v2.34z"></path>
				 </svg> </a> </li>
			<?php
			}
			if(!empty($twitter)) { ?>
              <li> <a href="<?php echo $twitter; ?>" class="btn_share_twitter" target="_blank"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M18 5.92v.53A11.59 11.59 0 0 1 6.5 18.13h-.21A11.62 11.62 0 0 1 0 16.28a8.24 8.24 0 0 0 1 .06 8.22 8.22 0 0 0 5.1-1.76 4.1 4.1 0 0 1-3.83-2.85 4.11 4.11 0 0 0 1.85-.07 4.1 4.1 0 0 1-3.29-4 4.11 4.11 0 0 0 1.86.51 4.11 4.11 0 0 1-1.3-5.55 11.65 11.65 0 0 0 8.46 4.29 4.11 4.11 0 0 1 7-3.74 8.2 8.2 0 0 0 2.61-1 4.11 4.11 0 0 1-1.8 2.27A8.22 8.22 0 0 0 20 3.8a8.31 8.31 0 0 1-2 2.12"></path>
                </svg> </a> </li>
			  <?php
			}
			if(!empty($instagram)) { ?>
              <li>
			    <a href="<?php echo $instagram; ?>" title="pinterest" class="btn_share_pinterest" target="_blank">
	<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 551.034 551.034" style="enable-background:new 0 0 551.034 551.034;top: 0;" xml:space="preserve">
            <g>
              <linearGradient id="SVGID_12_" gradientUnits="userSpaceOnUse" x1="275.517" y1="4.57" x2="275.517" y2="549.72" gradientTransform="matrix(1 0 0 -1 0 554)">
                <stop offset="0" style="stop-color:#E09B3D"></stop>
                <stop offset="0.3" style="stop-color:#C74C4D"></stop>
                <stop offset="0.6" style="stop-color:#C21975"></stop>
                <stop offset="1" style="stop-color:#7024C4"></stop>
              </linearGradient>
              <path style="fill:url(#SVGID_12_);" d="M386.878,0H164.156C73.64,0,0,73.64,0,164.156v222.722 		c0,90.516,73.64,164.156,164.156,164.156h222.722c90.516,0,164.156-73.64,164.156-164.156V164.156 		C551.033,73.64,477.393,0,386.878,0z M495.6,386.878c0,60.045-48.677,108.722-108.722,108.722H164.156 		c-60.045,0-108.722-48.677-108.722-108.722V164.156c0-60.046,48.677-108.722,108.722-108.722h222.722 		c60.045,0,108.722,48.676,108.722,108.722L495.6,386.878L495.6,386.878z"></path>
              <linearGradient id="SVGID_21_" gradientUnits="userSpaceOnUse" x1="275.517" y1="4.57" x2="275.517" y2="549.72" gradientTransform="matrix(1 0 0 -1 0 554)">
                <stop offset="0" style="stop-color:#E09B3D"></stop>
                <stop offset="0.3" style="stop-color:#C74C4D"></stop>
                <stop offset="0.6" style="stop-color:#C21975"></stop>
                <stop offset="1" style="stop-color:#7024C4"></stop>
              </linearGradient>
              <path style="fill:url(#SVGID_21_);" d="M275.517,133C196.933,133,133,196.933,133,275.516s63.933,142.517,142.517,142.517 		S418.034,354.1,418.034,275.516S354.101,133,275.517,133z M275.517,362.6c-48.095,0-87.083-38.988-87.083-87.083 		s38.989-87.083,87.083-87.083c48.095,0,87.083,38.988,87.083,87.083C362.6,323.611,323.611,362.6,275.517,362.6z"></path>
              <linearGradient id="SVGID_31_" gradientUnits="userSpaceOnUse" x1="418.31" y1="4.57" x2="418.31" y2="549.72" gradientTransform="matrix(1 0 0 -1 0 554)">
                <stop offset="0" style="stop-color:#E09B3D"></stop>
                <stop offset="0.3" style="stop-color:#C74C4D"></stop>
                <stop offset="0.6" style="stop-color:#C21975"></stop>
                <stop offset="1" style="stop-color:#7024C4"></stop>
              </linearGradient>
              <circle style="fill:url(#SVGID_31_);" cx="418.31" cy="134.07" r="34.15"></circle>
            </g>
            </svg>
			    </a>
		</li>
			<?php
			}
			if(!empty($email)) { ?>
              <li> <a href="<?php echo $email; ?>" target="_blank" class="btn_share_mail"> <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <defs>
                  <style>.cls-1{fill-rule:evenodd}</style>
                </defs>
                <path class="cls-1" d="M20 4.83V17H0V4.83L10 14z"></path>
                <path class="cls-1" d="M10 12l10-9H0l10 9z"></path>
                </svg> </a> </li>
			  <?php
			}
			 ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<div class="row team biography mfb-headline">
  <section class="c-superfeature mfb-stories">
    <div class="c-superfeature-wrapper">
</div>

<?php



if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
  $lang = ICL_LANGUAGE_CODE;
}
get_header();
$blog_title = get_bloginfo();
$categeory = get_queried_object();
$cat_ID = $categeory->cat_ID;

$category_name = $categeory->name;
$count = $categeory->count;
$taxonomy = $categeory->taxonomy;
$post_counter = 0;
$class='';
$i = 0;
$postsPerPage=6;
$page = 1;
$paged = (get_query_var('page_val') ? get_query_var('page_val') : 1);
$args = get_posts( array(
	'posts_per_page'    => $postsPerPage,
	'category'	     => $cat_ID,
	// 'category__in'		=> $cat_ID,
	'orderby'       	=> 'post_date',
	'paged'		     => $paged,
	'order'         	=> 'DESC',
	'has_password'=>FALSE,
	'post_type'		=> 'post',
	'post_status' 		=> 'publish',
	'lang' 			=> $lang,
	'suppress_filters'  => 0,
	'hide_empty' => '0'
) );


?>

<div class="wrap1">


	<div id="primary1" class="content-area">
		<main id="main" class="site-main" role="main">
		  <section class = "c-splash mfb_mt_40" >
			<div class="c-splash-wrapper">
				<div class="c-splash__cards mobile-tbd">
					<div class="c-splash__cards-wrapper">
						<ul class="c-splash__cards-list c-card-list--c-splash mfb-mb_20">
							<?php
							foreach($args as $post)


							{


								$post_counter++;

								if ( $i % 2 ) {
									 $divClass = "c-border-box-patten-5";
									 $bgCls="bg-rig";
									 $shareClass="btnd tab-share";
									 $textClass="text-wite";
									 $mainClass="pink-bg";
								} else {
									$divClass = "c-border-box-patten-2";
									$bgCls="";
									$shareClass="";
									$textClass="";
									$mainClass="";
								}


							?>
							<li class="c-splash__cards-listitem <?php echo $mainClass; ?>">
								<article class="c-card c-card--splash">
									<div class="c-card__obj">
										<div class="c-card__obj__header">
											<div class="c-card__images">
												<div class="c-card__image col-md-12 <?php echo $divClass; ?>">
													<div class="row">
														<a href="<?php echo get_permalink($post->ID);?>" title="<?php echo $post->post_title; ?>">
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
														$format = get_post_format( $post->ID );
														if($format == 'video')
														{
														    ?>
														    <div class="cat-paly-bt">
														    <div class="play-btn-act">
														    <a target="_blank" href="<?php echo get_permalink($post->ID);?>">
															   <div class="play-button">
																  <i class="fa fa-play"></i>
															   </div>
														    </a>
														</div>
														    </div>
														<?php } ?>
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="c-card__obj__body beulahCat <?php echo $bgCls; ?>">
											<div class="c-card__header">
											<?php
												
												$post_categories = get_post_primary_category($post->ID, 'category');
												$categories_name = $post_categories['primary_category']->name;
												$category_link = get_category_link( $post_categories['primary_category']->term_id );
												if(!empty($category_link)) {
												?>
												<p class="c-card__tag">
												<a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo $categories_name; ?>"> <?php echo $categories_name; ?> </a>
												</p>
												
												
												<?php }else{
														
															$term_list = wp_get_post_terms($post->ID, 'category', ['fields' => 'all']);
															$category_linkaa = get_category_link($term_list[0]->term_id );
															?>
															<p class="c-card__tag">
															<a href="<?php echo esc_url( $category_linkaa ); ?>" title="<?php echo $term_list[0]->name; ?>"> <?php echo $term_list[0]->name; ?> </a>
															</p>
														<?php 
												} ?>
												<div class="share-icon  sharelastrow pt-2 pr-2 text-right btnd tab-share">
													<div class="a2a_kit a2a_kit_size_32 addtoany_list">
													<a href="https://www.facebook.com/share.php?u=<?php echo get_permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>" class="btn_share_facebook" target="_blank" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#fff" d="M14.41 6.64l-.23 3h-3.07V20H7.24V9.64H5.18v-3h2.06v-2a5.37 5.37 0 0 1 .67-3.1A3.68 3.68 0 0 1 11.11 0a13 13 0 0 1 3.71.37l-.52 3.09a7 7 0 0 0-1.67-.25c-.8 0-1.52.29-1.52 1.09v2.34z"></path> </svg></a><a href="https://twitter.com/intent/tweet?text=<?php echo $post->post_title; ?>;url=<?php echo get_permalink($post->ID) ?>;via=<?php echo $blog_title; ?>" title="<?php echo $post->post_title; ?>" class="btn_share_twitter" target="_blank" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#fff" d="M18 5.92v.53A11.59 11.59 0 0 1 6.5 18.13h-.21A11.62 11.62 0 0 1 0 16.28a8.24 8.24 0 0 0 1 .06 8.22 8.22 0 0 0 5.1-1.76 4.1 4.1 0 0 1-3.83-2.85 4.11 4.11 0 0 0 1.85-.07 4.1 4.1 0 0 1-3.29-4 4.11 4.11 0 0 0 1.86.51 4.11 4.11 0 0 1-1.3-5.55 11.65 11.65 0 0 0 8.46 4.29 4.11 4.11 0 0 1 7-3.74 8.2 8.2 0 0 0 2.61-1 4.11 4.11 0 0 1-1.8 2.27A8.22 8.22 0 0 0 20 3.8a8.31 8.31 0 0 1-2 2.12"></path></svg></a><a href="mailto:?subject=<?php echo $post->post_title; ?>&body=<?php echo get_permalink($post->ID) ?>"  class="btn_share_mail"> <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
													<defs><style>.cls-1{fill-rule:evenodd} </style></defs><path fill="#fff" class="cls-1" d="M20 4.83V17H0V4.83L10 14z"></path><path fill="#fff" class="cls-1" d="M10 12l10-9H0l10 9z"></path></svg></a></div>
												<i class="fa fa-share-alt" aria-hidden="true"></i>
												</div>
												<h3 class="c-card__title <?php echo $textClass ?>"> <span>
													<a href="<?php echo esc_url( get_permalink($post->ID) ); ?>"> <?php echo $post->post_title; ?> </a>  </span> </h3>
												<p class="c-card__teaser"> <?php _e("We can't wait.","twentyseventeen-child");?> </p>
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
					if ( $post_counter == 3   ) {
					?>
					<li class="c-splash__cards-listitem advertisement">
						<?php
						if ( wp_is_mobile() )
						{
							if (function_exists ('adinserter')) echo adinserter (7);
						}
						else
						{
							if (function_exists ('adinserter')) echo adinserter (2);
						}
						?>
					</li>
					<?php
					}
					if ( $post_counter == 6  ) {
						?>
						<li class="c-splash__cards-listitem advertisement">
						<?php
						if ( wp_is_mobile() )
						{
						if (function_exists ('adinserter')) echo adinserter (8);
						}
						else
						{
						if (function_exists ('adinserter')) echo adinserter (3);
						}
						?>
						</li>
						<?php
					}
				   $i++;
				  }
				?>
				</ul>
					</div>
				</div>
			</div>
	</section>
	</main>
		<!-- #main -->
	</div>
	<!-- #primary -->
	<?php get_sidebar(); ?>
</div> <!-- .wrap -->
<?php
$thisCat = get_category(get_query_var('cat'),false);
$total_posts = $thisCat->count;
$maxPages = $total_posts / $postsPerPage;
if($total_posts <= 6){

}
else{?>
<footer class="c-card-section__footer">
<?php if($flag==0) {?>
	<a id="more_posts"  title="View More" href="javascript:void(0)" class="c-card-section__btn more_posts">
		<?php _e('More Stories','twentyseventeen-child'); ?>
	</a>
<?php }?>
    <img class="loadingimg" src="<?php echo "get_template_directory_uri"(); ?>/img/spinner.gif" width="150px" style="display: none">
    <span class="message"></span>
</footer>
<?php }?>
<?php
$link = get_category_link( $cat_ID );
get_footer();
?>
<script type="text/javascript">
    $=jQuery;
    var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
    var page = "<?php echo $page; ?>"; // What page we are on.
    var ppp = "<?php echo $postsPerPage; ?>"; // Post per page
    var catID = "<?php echo $cat_ID; ?>";
    var maxPages = "<?php echo $maxPages; ?>";
    var lang = "<?php echo $lang; ?>";
    var count = 0;
    var url = window.location.href;
    var segments = url.split('/');
    var page1 = segments[6]; // What page we are on.
    if(page1 === undefined){
    $("#more_posts").on("click",function()
     { // When btn is pressed.
         $('#more_posts').hide();
         $('.loadingimg').show();
	   count++;
        $.post(ajaxUrl, {
            action:"more_category_post_ajax",
            offset: (page * ppp) + 1,
            ppp: ppp,
		  catID:catID,
		  lang:lang,
		  maxPages:maxPages,
        }).success(function(posts)
	   {
		// googletag.pubads().refresh([gptAdSlots[1]]);
		if(posts)
		{
			page++;
			$('#more_posts').show();
			if(page >= Math.ceil(maxPages))
			{
				$("#more_posts").hide();
                                page1--;
			}
			jQuery('#more_posts').css('opacity',jQuery('#hideloadmore').attr('data-attr'));
			history.pushState(null, null, 	'<?php echo $link;?>'+'page/'+page);
			ga('send', 'pageview', window.location.pathname);
			$("ul.c-splash__cards-list").append(posts); // CHANGE THIS!
			$('.loadingimg').hide();
		}
		else
		{
			$('.loadingimg').hide();
			$(".message").html("No more stories to show!")
		}

        });
   });
   }
</script>

 <script type="text/javascript">
    $ = jQuery;
    var lang1 = "<?php echo $lang; ?>";
    var url2 = window.location.href;
    var segment = url2.split('/');
//    var page1 = segments[6]; // What page we are on.
    if(lang1 === "hi"){
        var page2 = segment[8]; // What page we are on.
    }else{
        var page2 = segment[7]; // What page we are on.
    }
    if(page2 !== undefined){
    $("ul.c-splash__cards-list").hide();
    $('#more_posts').hide();
    var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
    var ppp1 = "<?php echo $postsPerPage; ?>"; // Post per page
    var catID1 = "<?php echo $cat_ID; ?>";
    var maxPages1 = "<?php echo $maxPages; ?>";
    var count1 = 0;
    $(window).on("load", function (){
         $('#more_posts').hide();
         $('.loadingimg').show();
	   count++;
        $.post(ajaxUrl, {
            action:"more_category_post_ajax",
//            offset: (page1 * ppp1) + 1,
            ppp: (page2 * ppp1),
            catID:catID1,
            lang:lang1,
            maxPages:maxPages1,
        }).success(function(posts)
	   {
		 //googletag.pubads().refresh([gptAdSlots[1]]);
		if(posts)
		{
//			page1++;
			$('#more_posts').show();
			if(page2 >= Math.ceil(maxPages1))
			{
                            $("#more_posts").hide();
                            page1--;
			}
			jQuery('#more_posts').css('opacity',jQuery('#hideloadmore').attr('data-attr'));
			history.pushState(null, null,'<?php echo $link;?>'+'page/'+page2);
			ga('send', 'pageview', window.location.pathname);
			$("ul.c-splash__cards-list").html(); // CHANGE THIS!
			$("ul.c-splash__cards-list").html(posts); // CHANGE THIS!
//			$("ul.c-splash__cards-list").append(posts); // CHANGE THIS!
			$('.loadingimg').hide();
                        $('.vertical-adv-1').hide();
                        $("ul.c-splash__cards-list").show();
		}
		else
		{
			$('.loadingimg').hide();
			$(".message").html("No more stories to show!")
		}

        });
    });
    $("#more_posts").on("click",function()
     { // When btn is pressed.
         $('#more_posts').hide();
         $('.loadingimg').show();
	   count++;
        $.post(ajaxUrl, {
            action:"more_category_post_ajax",
            offset: (page2 * ppp1) + 1,
            ppp: ppp1,
		  catID:catID1,
		  lang:lang,
		  maxPages:maxPages1,
        }).success(function(posts)
	   {
		//googletag.pubads().refresh([gptAdSlots[1]]);
		if(posts)
		{
                    page2++;
			$('#more_posts').show();
			if(page2 >= Math.ceil(maxPages1))
			{
				$("#more_posts").hide();
                                page1--;
			}
			jQuery('#more_posts').css('opacity',jQuery('#hideloadmore').attr('data-attr'));
			history.pushState(null, null,'<?php echo $link;?>'+'page/'+page2);
			ga('send', 'pageview', window.location.pathname);
			$("ul.c-splash__cards-list").append(posts); // CHANGE THIS!
			$('.loadingimg').hide();
		}
		else
		{
			$('.loadingimg').hide();
			$(".message").html("No more stories to show!")
		}

        });
   });
}
</script>


<?php
get_footer();

}else{
?>




















<?php

/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
if ( defined( 'ICL_LANGUAGE_CODE' ) ) {
  $lang = ICL_LANGUAGE_CODE;
}
get_header();
$blog_title = get_bloginfo();
$categeory = get_queried_object();
$cat_ID = $categeory->cat_ID;
$category_name = $categeory->name;
$count = $categeory->count;
$taxonomy = $categeory->taxonomy;
$post_counter = 0;
$class='';
$i = 0;
$postsPerPage=6;
$page = 1;

// $categories=get_categories(
//     array( 'parent' => $cat_ID )
// );
// $i=0;
// foreach($categories as $cat):

// $data[] = $cat->term_id;

// $i++;
// endforeach;

//  array_unshift($data,$cat_ID);



$paged = (get_query_var('page_val') ? get_query_var('page_val') : 1);


$args = array('parent' => $cat_ID,'lang'=> $lang);
$categories = get_categories( $args );
foreach($categories as $category) {

	$data_cat[]=$category->term_id;

}
// array_push($data_cat,$cat_ID);
$args = get_posts( array(
	'posts_per_page'    => $postsPerPage,
	'category'	     => $cat_ID,
	// 'category__in'		=> $data_cat,
	'orderby'       	=> 'post_date',
	'has_password'=>FALSE,
	'paged'		     => $paged,
	'order'         	=> 'DESC',
	'post_type'		=> 'post',
	'post_status' 		=> 'publish',
	'lang' 			=> $lang,
	'suppress_filters'  => 0,
	'hide_empty' => '0'
) );

?>

<div class="wrap1">
		<section class="c-superfeature img-avd horizontal-ad space-mt">
			<div class="c-superfeature-wrapper">
				<div class="c-splash__cards mb-bottom">
					<div class="c-splash__cards-wrapper">
						<?php
						if ( wp_is_mobile() )
						{
							if (function_exists ('adinserter')) echo adinserter (6);
						}
						else
						{
							if (function_exists ('adinserter')) echo adinserter (1);
						}
						?>
					</div>
				</div>
			</div>
		</section>
		<div class="row light_green">
			<section class="c-superfeature mt-0 mb-0">
				<div class="c-superfeature-wrapper">
					<div class="c-splash__cards mb-bottom">
						<div class="c-splash__cards-wrapper categorie mfb_list_ctg mfb_mt_60 mfb_mb_60">
							<h1><?php echo $category_name; ?></h1>
						</div>
					</div>
				</div>
			</section>
		</div>
	<div id="primary1" class="content-area">
		<main id="main" class="site-main" role="main">
		  <section class = "c-splash mfb_mt_40" >
			<div class="c-splash-wrapper">
				<div class="c-splash__cards mobile-tbd">
					<div class="c-splash__cards-wrapper">
						<ul class="c-splash__cards-list c-card-list--c-splash mfb-mb_20">
							<?php
							foreach($args as $post)


							{


								$post_counter++;

								if ( $i % 2 ) {
									 $divClass = "c-border-box-patten-5";
									 $bgCls="bg-rig";
									 $shareClass="btnd tab-share";
									 $textClass="text-wite";
								} else {
									$divClass = "c-border-box-patten-2";
									$bgCls="";
									$shareClass="";
									$textClass="";
								}


							?>
							<li class="c-splash__cards-listitem">
								<article class="c-card c-card--splash">
									<div class="c-card__obj">
										<div class="c-card__obj__header">
											<div class="c-card__images">
												<div class="c-card__image col-md-12 <?php echo $divClass; ?>">
													<div class="row">
														<a href="<?php echo get_permalink($post->ID);?>" title="<?php echo $post->post_title; ?>">
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
														$format = get_post_format( $post->ID );
														if($format == 'video')
														{
														    ?>
														    <div class="cat-paly-bt">
														    <div class="play-btn-act">
														    <a target="_blank" href="<?php echo get_permalink($post->ID);?>">
															   <div class="play-button">
																  <i class="fa fa-play"></i>
															   </div>
														    </a>
														</div>
														    </div>
														<?php } ?>
														</a>
													</div>
												</div>
											</div>
										</div>
										<div class="c-card__obj__body <?php echo $bgCls; ?>">
											<div class="c-card__header">
											<?php
												
												$post_categories = get_post_primary_category($post->ID, 'category');
												$categories_name = $post_categories['primary_category']->name;
												$category_link = get_category_link( $post_categories['primary_category']->term_id );
												if(!empty($category_link)) {
												?>
												<p class="c-card__tag">
												<a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo $categories_name; ?>"> <?php echo $categories_name; ?> </a>
												</p>
												
												
												<?php }else{
														
															$term_list = wp_get_post_terms($post->ID, 'category', ['fields' => 'all']);
															$category_linkaa = get_category_link($term_list[0]->term_id );
															?>
															<p class="c-card__tag">
															<a href="<?php echo esc_url( $category_linkaa ); ?>" title="<?php echo $term_list[0]->name; ?>"> <?php echo $term_list[0]->name; ?> </a>
															</p>
														<?php 
												} ?>
												<div class="share-icon  sharelastrow pt-2 pr-2 text-right btnd tab-share">
													<div class="a2a_kit a2a_kit_size_32 addtoany_list">
													<a href="https://www.facebook.com/share.php?u=<?php echo get_permalink($post->ID) ?>" title="<?php echo $post->post_title; ?>" class="btn_share_facebook" target="_blank" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#fff" d="M14.41 6.64l-.23 3h-3.07V20H7.24V9.64H5.18v-3h2.06v-2a5.37 5.37 0 0 1 .67-3.1A3.68 3.68 0 0 1 11.11 0a13 13 0 0 1 3.71.37l-.52 3.09a7 7 0 0 0-1.67-.25c-.8 0-1.52.29-1.52 1.09v2.34z"></path> </svg></a><a href="https://twitter.com/intent/tweet?text=<?php echo $post->post_title; ?>;url=<?php echo get_permalink($post->ID) ?>;via=<?php echo $blog_title; ?>" title="<?php echo $post->post_title; ?>" class="btn_share_twitter" target="_blank" ><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill="#fff" d="M18 5.92v.53A11.59 11.59 0 0 1 6.5 18.13h-.21A11.62 11.62 0 0 1 0 16.28a8.24 8.24 0 0 0 1 .06 8.22 8.22 0 0 0 5.1-1.76 4.1 4.1 0 0 1-3.83-2.85 4.11 4.11 0 0 0 1.85-.07 4.1 4.1 0 0 1-3.29-4 4.11 4.11 0 0 0 1.86.51 4.11 4.11 0 0 1-1.3-5.55 11.65 11.65 0 0 0 8.46 4.29 4.11 4.11 0 0 1 7-3.74 8.2 8.2 0 0 0 2.61-1 4.11 4.11 0 0 1-1.8 2.27A8.22 8.22 0 0 0 20 3.8a8.31 8.31 0 0 1-2 2.12"></path></svg></a><a href="mailto:?subject=<?php echo $post->post_title; ?>&body=<?php echo get_permalink($post->ID) ?>"  class="btn_share_mail"> <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
													<defs><style>.cls-1{fill-rule:evenodd} </style></defs><path fill="#fff" class="cls-1" d="M20 4.83V17H0V4.83L10 14z"></path><path fill="#fff" class="cls-1" d="M10 12l10-9H0l10 9z"></path></svg></a></div>
												<i class="fa fa-share-alt" aria-hidden="true"></i>
												</div>
												<h3 class="c-card__title <?php echo $textClass ?>"> <span>
													<a href="<?php echo esc_url( get_permalink($post->ID) ); ?>"> <?php echo $post->post_title; ?> </a>  </span> </h3>
												<p class="c-card__teaser"> <?php _e("We can't wait.","twentyseventeen-child");?> </p>
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
					if ( $post_counter == 3   ) {
					?>
					<li class="c-splash__cards-listitem advertisement">
						<?php
						if ( wp_is_mobile() )
						{
							if (function_exists ('adinserter')) echo adinserter (7);
						}
						else
						{
							if (function_exists ('adinserter')) echo adinserter (2);
						}
						?>
					</li>
					<?php
					}
					if ( $post_counter == 6  ) {
						?>
						<li class="c-splash__cards-listitem advertisement">
						<?php
						if ( wp_is_mobile() )
						{
						if (function_exists ('adinserter')) echo adinserter (8);
						}
						else
						{
						if (function_exists ('adinserter')) echo adinserter (3);
						}
						?>
						</li>
						<?php
					}
				   $i++;
				  }
				?>
				</ul>
					</div>
				</div>
			</div>
	</section>
	</main>
		<!-- #main -->
	</div>
	<!-- #primary -->
	<?php get_sidebar(); ?>
</div> <!-- .wrap -->
<?php
$thisCat = get_category(get_query_var('cat'),false);
$total_posts = $thisCat->count;
$maxPages = $total_posts / $postsPerPage;
if($total_posts <= 6){

}
else{?>
<footer class="c-card-section__footer">
<?php if($flag==0) {?>
	<a id="more_posts"  title="View More" href="javascript:void(0)" class="c-card-section__btn more_posts">
		<?php _e('More Stories','twentyseventeen-child'); ?>
	</a>
<?php }?>
    <img class="loadingimg" src="<?php echo "get_template_directory_uri"(); ?>/img/spinner.gif" width="150px" style="display: none">
    <span class="message"></span>
</footer>
<?php }?>
<?php
$link = get_category_link( $cat_ID );
get_footer();
?>
<script type="text/javascript">
    $=jQuery;
    var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
    var page = "<?php echo $page; ?>"; // What page we are on.
    var ppp = "<?php echo $postsPerPage; ?>"; // Post per page
    var catID = "<?php echo $cat_ID; ?>";
    var maxPages = "<?php echo $maxPages; ?>";
    var lang = "<?php echo $lang; ?>";
    var count = 0;
    var url = window.location.href;
    var segments = url.split('/');
    var pages = segments[8]; // What page we are on.
    if(pages === undefined){
    $("#more_posts").on("click",function()
     { // When btn is pressed.
         $('#more_posts').hide();
         $('.loadingimg').show();
	   count++;
        $.post(ajaxUrl, {
            action:"more_category_post_ajax",
            offset: (page * ppp) + 1,
            ppp: ppp,
		  catID:catID,
		  lang:lang,
		  maxPages:maxPages,
        }).success(function(posts)
	   {
		// googletag.pubads().refresh([gptAdSlots[1]]);
		if(posts)
		{
			page++;
			$('#more_posts').show();
			if(page >= Math.ceil(maxPages))
			{
                            $("#more_posts").hide();
                            page1--;
			}
			jQuery('#more_posts').css('opacity',jQuery('#hideloadmore').attr('data-attr'));
			history.pushState(null, null, 	'<?php echo $link;?>'+'page/'+page);
			ga('send', 'pageview', window.location.pathname);
			$("ul.c-splash__cards-list").append(posts); // CHANGE THIS!
			$('.loadingimg').hide();
		}
		else
		{
			$('.loadingimg').hide();
			$(".message").html("No more stories to show!")
		}

        });
   });
}
</script>
<script type="text/javascript">
    $ = jQuery;
    var lang1 = "<?php echo $lang; ?>";
    var url1 = window.location.href;
    var segment = url1.split('/');
    if(lang1 === "hi"){
        var page1 = segment[8]; // What page we are on.
    }else{
        var page1 = segment[7]; // What page we are on.
    }
    if(page1 !== undefined){
    $("ul.c-splash__cards-list").hide();
    $('#more_posts').hide();
    var ajaxUrl = "<?php echo admin_url('admin-ajax.php')?>";
    var ppp1 = "<?php echo $postsPerPage; ?>"; // Post per page
    var catID1 = "<?php echo $cat_ID; ?>";
    var maxPages1 = "<?php echo $maxPages; ?>";
    var count1 = 0;
    $(window).on("load", function (){
         $('#more_posts').hide();
         $('.loadingimg').show();
	   count++;
        $.post(ajaxUrl, {
            action:"more_category_post_ajax",
//            offset: (page1 * ppp1) + 1,
            ppp: (page1 * ppp1),
            catID:catID1,
            lang:lang1,
            maxPages:maxPages1,
        }).success(function(posts)
	   {
		// googletag.pubads().refresh([gptAdSlots[1]]);
		if(posts)
		{
			$('#more_posts').show();
			if(page1 >= Math.ceil(maxPages1))
			{
				$("#more_posts").hide();
				page1--;
			}
			jQuery('#more_posts').css('opacity',jQuery('#hideloadmore').attr('data-attr'));
			history.pushState(null, null,'<?php echo $link;?>'+'page/'+page1);
			ga('send', 'pageview', window.location.pathname);
			$("ul.c-splash__cards-list").html(); // CHANGE THIS!
			$("ul.c-splash__cards-list").html(posts); // CHANGE THIS!
//			$("ul.c-splash__cards-list").append(posts); // CHANGE THIS!
			$('.loadingimg').hide();
			$('.vertical-adv-1').hide();
                        $("ul.c-splash__cards-list").show();
		}
		else
		{
			$('.loadingimg').hide();
			$(".message").html("No more stories to show!")
		}

        });
    });
    $("#more_posts").on("click",function()
     { // When btn is pressed.
         $('#more_posts').hide();
         $('.loadingimg').show();
	   count++;
        $.post(ajaxUrl, {
            action:"more_category_post_ajax",
            offset: (page1 * ppp1) + 1,
            ppp: ppp1,
		  catID:catID1,
		  lang:lang,
		  maxPages:maxPages1,
        }).success(function(posts)
	   {
		// googletag.pubads().refresh([gptAdSlots[1]]);
		if(posts)
		{
                    page1++;
			$('#more_posts').show();
			if(page1 >= Math.ceil(maxPages1))
			{
				$("#more_posts").hide();
                                page1--;
			}
			jQuery('#more_posts').css('opacity',jQuery('#hideloadmore').attr('data-attr'));
			history.pushState(null, null,'<?php echo $link;?>'+'page/'+page1);
			ga('send', 'pageview', window.location.pathname);
			$("ul.c-splash__cards-list").append(posts); // CHANGE THIS!
			$('.loadingimg').hide();
		}
		else
		{
			$('.loadingimg').hide();
			$(".message").html("No more stories to show!")
		}

        });
   });
   }
</script>
<?php } ?>