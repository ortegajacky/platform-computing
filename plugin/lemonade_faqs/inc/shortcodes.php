<?php
/* Shortcodes */
function lemonade_faqs_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'order'						=> 'ASC',
		'orderby'					=> 'menu_order',
		'meta_key'				=> '',
		'posts_per_page'	=> '-1', 
		'display'					=> 'accordion',
		'terms_list' 			=> '',
		'by_term'					=> '0',
		'faq_type' 		=> '',
	), $atts ) );

	$terms_array = explode(",", $faq_type);

	$db_args = array(
		'post_type' 			=> 'faqs',
		'order'						=> $order,
		'orderby'					=> $orderby,
		'meta_key'				=> $meta_key,
		'posts_per_page' 	=> $posts_per_page, 
		'by_term'					=> $by_term,
		'faq_type' 		=> $faq_type,
	);


	if($faq_type != ""){
		$db_args['tax_query'][] = array(
			array(
				'taxonomy' => 'faq_type',
				'field'    => 'slug',
				'terms'    => $terms_array,
			),
		);		
	}

	$faqs_loop = new WP_Query( $db_args );

	$content = '';

	if($faqs_loop->have_posts()) {
		switch($display) {	


		case "accordion":
			$content .= '<div class="accordion" id="faq-accordion">';

			$i = 0;

			while( $faqs_loop->have_posts() ) : $faqs_loop->the_post();
			
				if($i == 0) { $first = "in"; } else { $first = ''; }
			
				$content_filtered = get_the_content();
				$content_filtered = apply_filters('the_content', $content_filtered);
				$content_filtered = str_replace(']]>', ']]&gt;', $content_filtered);
				
			    $content .= '<div class="card">';
				$content .= '<div class="card-header shadow">';
				$content .= '<h5 class="mb-0">';
				$content .= '<button class="btn btn-link collapsed text-primary" type="button" "accordion-toggle" data-toggle="collapse" data-parent="#faq-accordion" href="#collapse'.$i.'">';
				$content .= get_the_title();
				$content .= '</button>';					
				$content .= '</h5>';
				$content .= '</div>'; // end .panel-heading
				$content .= '<div id="collapse'.$i.'" class="collapse '.$first.'">';
				$content .= '<div class="card-body">'.$content_filtered.'</div>';
				$content .= '</div>'; // end .collapse
				$content .= '</div>'; // end .panel

				$i++;

			endwhile;

			$content .= "</div>"; // end .panel-group

			break;



		// case "accordion":
		// 	$content .= '<ul uk-accordion>';

		// 	$i = 0;

		// 	while( $faqs_loop->have_posts() ) : $faqs_loop->the_post();
			
		// 		if($i == 0) { $first = ' class="uk-open"'; } else { $first = ''; }
			
		// 		$content_filtered = get_the_content();
		// 		$content_filtered = apply_filters('the_content', $content_filtered);
		// 		$content_filtered = str_replace(']]>', ']]&gt;', $content_filtered);
				
		// 	    $content .= '<li'.$first.'>';
		// 		$content .= '<h3 class="uk-accordion-title">'.get_the_title().'</h3>';
		// 		$content .= '<div class="uk-accordion-content">'.$content_filtered.'</div>';
		// 		$content .= '</li'; // end .panel

		// 		$i++;

		// 	endwhile;

		// 	$content .= '</ul>'; // end .panel-group

		// 	break;


			case "standard":

				$content .= '<div class="faq-wrapper">';

				while( $faqs_loop->have_posts() ) : $faqs_loop->the_post();

					$content .= '<div class="col-md-6 col-lg-3">';
					$content .= '<div class="faq-single">';
					$content .= '<a href="'.get_permalink().'">';
					$content .= get_the_post_thumbnail($post->ID, 'doc-thumb');
					$content .= '<p>'.get_the_title().'</p>';
					$content .= '</a>';
					$content .= '</div>';
					$content .= '</div>';

				endwhile;

				$content .= '</div>';

				break;



			case "content":

				$content .= '<div class="faq-wrapper">';

				while( $faqs_loop->have_posts() ) : $faqs_loop->the_post();

					$content_filtered = get_the_content();
					$content_filtered = apply_filters('the_content', $content_filtered);
					$content_filtered = str_replace(']]>', ']]&gt;', $content_filtered);

					$content .= '<div class="faq-single">';
					$content .= '<h3 class="faq-title">'.get_the_title().'</h3>';
					$content .= '<div class="faq-content">'.$content_filtered.'</div>';
					$content .= '</div>';
				endwhile;

				$content .= '</div>';

				break;

			case "excerpt":

				$content .= '<div class="faq-wrapper">';

				while( $faqs_loop->have_posts() ) : $faqs_loop->the_post();
					$content .= '<div class="faq-single">';
					$content .= '<h3 class="faq-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
					$content .= '<div class="faq-excerpt">'.get_the_excerpt().'</div>';
					$content .= '</div>';
				endwhile;

				$content .= '</div>';

				break;

			case "list":

				$content .= '<ul class="faq-wrapper">';

				while( $faqs_loop->have_posts() ) : $faqs_loop->the_post();
					$content .= '<li class="faq-single">';
					$content .= '<a class="faq-title" href="'.get_permalink().'">'.get_the_title().'</a>';
					$content .= '</li>';
				endwhile;

				$content .= '</ul>';

				break;
		}
			
	}

	wp_reset_postdata();
	return $content;
}
add_shortcode( 'lemonade_faqs', 'lemonade_faqs_shortcode' );