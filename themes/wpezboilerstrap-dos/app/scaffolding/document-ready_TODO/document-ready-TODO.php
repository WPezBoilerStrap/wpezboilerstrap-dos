<?php

/**
 * if you want to break this down further, you might consider using the other/ folder for those pieces
 */

if ( !class_exists( 'Class_WP_ezBoilerStrap_Document_Ready' ) ) {
    class Class_WP_ezBoilerStrap_Document_Ready
    {

        public function __construct()
        {

            // add_action('TODO', array($this, 'ezbs_other_1'));
        }

        public function get( $str = 'args' )
        {
            if ( $str == 'args' ) {
                return $this->args();
            }

            return array();
        }

        protected function args()
        {

            // TODO

        }

        public function ezbs_other_1( $bool_active = true )
        {
            if ( $bool_active !== false ) {


                ob_start()
                ?>
                <script type="text/javascript">
                    $ = jQuery;
                    $(document).ready(function () {
                        <?php

                        $this->js1();

                        ?>
                    });
                </script>
                <?php
                ob_end_flush();
            }

            return;
        }

        protected function js1()
        {

            ob_start()
            ?>

            <?php
            ob_end_flush();

        }

    }
}

$obj_setup_ezbs_other = new Class_WP_ezBoilerStrap_Document_Ready;