<?php

namespace WPez\WPezBoilerStrap\Views\Indexes;

if ( ! class_exists('Index_BS3_V1') ) {
	class Index_BS3_V1 extends \WPez\WPezBoilerStrap\Toolbox\Parents\View {

		function view( $mod, $parts, $vargs ) {

			$mac = $this->_mac;
			?>
			<!DOCTYPE html>
			<html <?php echo $vargs->lang_attrs; ?> <?php echo $mac::global_attrs($vargs->html_global_attrs) ?>>
			<head>
				<meta charset="<?php echo esc_attr( $vargs->charset ) ?>">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="<?php echo esc_attr( $vargs->viewport_content ); ?>">

				<!--[if lt IE 9]>
				<script src="<?php echo esc_url($vargs->html5shiv); ?>"></script>
				<script src="<?php echo esc_url($vargs->respondjs); ?>"></script>
				<![endif]-->

				<?php wp_head();

				echo $parts->pre_head_close;
				?>
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

			$parts = new \stdClass();

			$parts->pre_head_close = ''; // e.g. add google analytics snippet
			$parts->body = '';

			return $parts;
		}

		protected function vargs_defaults() {

			$vargs = new \stdClass();

			$vargs->lang_attrs = get_language_attributes();
			$vargs->html_global_attrs = array(
				'class' => 'no-js'
			);
			$vargs->charset = get_bloginfo( 'charset' );
			$vargs->viewport_content = 'width=device-width, initial-scale=1.0';
			$vargs->html5shiv = 'https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js';
			$vargs->respondjs = 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js';
			$vargs->body_class = '';

			return $vargs;			

		}
	}
}