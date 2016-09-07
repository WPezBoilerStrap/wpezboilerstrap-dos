<?php

namespace WPezBoilerStrap\Views\Indexes;

if ( ! class_exists('Index_BS3_V1') ) {
	class Index_BS3_V1 extends \WPezBoilerStrap\Toolbox\Parents\View {

		function view( $lang, $mod, $parts, $vargs ) {

			?>
			<!DOCTYPE html>
			<html <?php language_attributes(); ?> class="<?php echo 'class="' . esc_attr( $vargs->html_class ) . '"'; ?>">
			<head>
				<meta charset="<?php bloginfo( 'charset' ); ?>">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="<?php echo esc_attr( $vargs->viewport_content ); ?>">

				<!--[if lt IE 9]>
				<script src="<?php echo esc_url($vargs->html5shiv); ?>"></script>
				<script src="<?php echo esc_url($vargs->respondjs); ?>"></script>
				<![endif]-->

				<?php wp_head(); ?>

			</head>
			<body <?php body_class( $vargs->body_class ); ?> >

			<?php
			/**
			 * This is where all the magic happen
			 */
			echo $parts->body;

			?>

			<?php wp_footer(); ?>
			</body>
			</html>

			<?php

			/*
			 * There is no get_wp_head() or get_wp_footer() so this view "echo" in real time.
			 * We return ''.
			 */
			return '';
		}

		protected function lang_defaults() {
			return new \stdClass();
		}

		protected function mod_defaults() {
			return new \stdClass();
		}

		protected function parts_defaults() {

			$obj = new \stdClass();
			$obj->body = 'PARTS->BODY';

			return $obj;
		}

		protected function vargs_defaults() {

			$obj = new \stdClass();
			//	$obj->language_attributes = TODO;
			$obj->html_class = 'HTML_CLASS'; // e.g., no-js
			$obj->viewport_content = 'VIEWPORT_CONTENT';
			$obj->html5shiv = 'HTML5SHIV'; // url
			$obj->respondjs = 'RESPONDjs'; // url
			$obj->body_class = 'BODY_CLASS';

			return $obj;

		}
	}
}