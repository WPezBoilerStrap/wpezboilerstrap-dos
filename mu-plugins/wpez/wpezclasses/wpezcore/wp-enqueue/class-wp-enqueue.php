<?php
/**
 * Takes your arrays (of fonts, scripts and/or styles) and enqueues them.
 *
 * More info: (@link http://codex.wordpress.org/Function_Reference/get_search_form)
 *
 * PHP version 5.3
 *
 * LICENSE: TODO
 *
 * @package WP ezClasses
 * @author  Mark Simchock <mark.simchock@alchemyunited.com>
 * @since   0.5.0
 */

namespace WPez\WPezClasses\WPezCore;

if ( !class_exists( 'WP_Enqueue' ) ) {
    class WP_Enqueue {

        protected $_ins_cond_tags;
	    protected $_arr_objs_loaded;

        public function __construct() {

        	$this->conditional_tags();
	        $this->_arr_objs_loaded = array();

	        // TODO - change priority(s) into property(s)

	        // wp - frontend
	        add_action( 'wp_enqueue_scripts', array($this, 'wp_enqueue_style_loaded') );
	        add_action( 'wp_enqueue_scripts', array($this, 'wp_enqueue_script_loaded') );

	        // login
	        add_action( 'login_enqueue_scripts', array($this, 'login_enqueue_style_loaded'), 10 );
	        add_action( 'login_enqueue_scripts', array($this, 'login_enqueue_script_loaded'), 1 );

	        // admin
	        add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_style_loaded'), 10 );
	        add_action( 'admin_enqueue_scripts', array($this, 'admin_enqueue_script_loaded'), 1 );

        }

	    /**
	     * @return stdClass
	     */
	    protected function file_constants()
	    {

		    $obj = new \stdClass();

		    $obj->url = plugin_dir_url( __FILE__ );
		    $obj->path = plugin_dir_path( __FILE__ );
		    $obj->path_parent = dirname( $this->_path );
		    $obj->basename = plugin_basename( __FILE__ );
		    $obj->file = __FILE__;

		    return $obj;
	    }


	    public function set($str_prop, $mix_value){

		    if ( property_exists($this, $str_prop)){

			    $this->$str_prop = $mix_value;
			    return true;
		    }
		    return false;
	    }


        protected function conditional_tags(){

        	$ins_cond_tags = new Conditional_Tags();
	        $this->_ins_cond_tags = false;
	        if ( is_object($ins_cond_tags) &&  method_exists($ins_cond_tags, 'evaluate')){
		        $this->_ins_cond_tags = $ins_cond_tags;
	        }
        }


        protected function wp_enqueue_defaults() {
            $obj = new \stdClass();

	        $obj_action = new \stdClass();
	        $obj_action->wp = true;
	        $obj_action->admin = false;
	        $obj_action->login = false;


	        $obj->active = true;
	        $obj->registrer = false;
	        $obj->wp_enqueue_style = false;
	        $obj->wp_enqueue_script = false;
	        $obj->add_data_active = false;
	        $obj->add_data = array();
	        $obj->conditional_tags = array();
	        $obj->when = $obj_action;

            return $obj;
        }


        protected function wp_enqueue_style_defaults(){

        	$obj = new \stdClass();

	        $obj->handle = '';
	        $obj->src = false;
	        $obj->deps = array();
	        $obj->ver = false;
	        $obj->media = 'all';

	        return $obj;
        }

	    protected function wp_enqueue_script_defaults(){

		    $obj = new \stdClass();

		    $obj->handle = '';
		    $obj->src = false;
		    $obj->deps = array();
		    $obj->ver = false;
		    $obj->in_footer = false;

		    return $obj;
	    }


	    /**
	     * Takes the ez args and wp_register_style's it, with minimal prep / validation. More or less a more traditional wp_register_style() via the ez args obj
	     *
	     * @param string $obj_ez
	     */
	    public function wp_register_style( $obj_ez = '' ) {

		    if ( is_object( $obj_ez ) && isset( $obj_ez->wp_enqueue_style ) && is_object( $obj_ez->wp_enqueue_style ) && ( ! isset( $obj_ez->active ) || ( isset( $obj_ez->active ) && $obj_ez->active !== false ) ) ) {

			    wp_register_style(
				    $obj_ez->wp_enqueue_style->handle,
				    $obj_ez->wp_enqueue_style->src,
				    $obj_ez->wp_enqueue_style->deps,
				    $obj_ez->wp_enqueue_style->ver,
				    $obj_ez->wp_enqueue_style->media
			    );
		    }
	    }


	    /**
	     * Takes the ez args and wp_enqueue_style's it, with minimal prep / validation. More or less a more traditional wp_enqueue_style() via the ez args obj
	     *
	     * @param string $obj_ez
	     */
	    public function wp_enqueue_style( $obj_ez = '' ) {

		    if ( is_object( $obj_ez ) && isset( $obj_ez->wp_enqueue_style ) && is_object( $obj_ez->wp_enqueue_style ) && ( ! isset( $obj_ez->active ) || ( isset( $obj_ez->active ) && $obj_ez->active !== false ) ) ) {

			    wp_enqueue_style(
				    $obj_ez->wp_enqueue_style->handle,
				    $obj_ez->wp_enqueue_style->src,
				    $obj_ez->wp_enqueue_style->deps,
				    $obj_ez->wp_enqueue_style->ver,
				    $obj_ez->wp_enqueue_style->media
			    );
		    }
	    }


	    /**
	     * Takes the ez args obj and wp_register_script's it, with minimal prep / validation. More or less a more traditional wp_register_script() via the ez args obj
	     *
	     * @param string $obj_ez
	     */
	    public function wp_register_script( $obj_ez = '' ) {

		    if ( is_object( $obj_ez ) && isset( $obj_ez->wp_enqueue_script ) && is_object( $obj_ez->wp_enqueue_script ) && ( ! isset( $obj_ez->active ) || ( isset( $obj_ez->active ) && $obj_ez->active !== false ) ) ) {

			    wp_register_script(
				    $obj->wp_enqueue_script->handle,
				    $obj->wp_enqueue_script->src,
				    $obj->wp_enqueue_script->deps,
				    $obj->wp_enqueue_script->ver,
				    $obj->wp_enqueue_script->in_footer
			    );
		    }
	    }


	    /**
	     * Takes the ez args obj and wp_enqueue_script's it, with minimal prep / validation. More or less a more traditional wp_enqueue_script() via the ez args obj
	     *
	     * @param string $obj_ez
	     */
	    public function wp_enqueue_script( $obj_ez = '' ) {

		    if ( is_object( $obj_ez ) && isset( $obj_ez->wp_enqueue_script ) && is_object( $obj_ez->wp_enqueue_script ) && ( ! isset( $obj_ez->active ) || ( isset( $obj_ez->active ) && $obj_ez->active !== false ) ) ) {

			    wp_enqueue_script(
				    $obj_ez->wp_enqueue_script->handle,
				    $obj_ez->wp_enqueue_script->src,
				    $obj_ez->wp_enqueue_script->deps,
				    $obj_ez->wp_enqueue_script->ver,
				    $obj_ez->wp_enqueue_script->in_footer
			    );
		    }
	    }


	    /**
	     * A very basic loader for the more traditional wp_enqueue_* methods above
	     *
	     * @param string $arr_objs
	     */
	    public function wp_enqueue( $arr_objs = '' ) {

		    if ( is_array( $arr_objs ) && ! empty( $arr_objs ) ) {

			    foreach ( $arr_objs as $key => $obj ) {

				    if ( is_object( $obj->wp_enqueue_script ) ) {
					    $this->wp_enqueue_script( $obj );
				    } elseif ( is_object( $obj->wp_enqueue_style ) ) {
					    $this->wp_enqueue_style( $obj );
				    }
			    }
		    }
	    }


	    /**
	     * A very basic loader for the more traditional wp_register_* methods above
	     *
	     * @param string $arr_objs
	     */
	    public function wp_register( $arr_objs = '' ) {

		    if ( is_array( $arr_objs ) && ! empty( $arr_objs ) ) {

			    foreach ( $arr_objs as $key => $obj ) {

				    if ( isset($obj->wp_enqueue_script) && is_object( $obj->wp_enqueue_script ) ) {
					    $this->wp_register_script( $obj );
				    } elseif ( isset($obj->wp_enqueue_style) && is_object( $obj->wp_enqueue_style ) ) {
					    $this->wp_register_style( $obj );
				    }
			    }
		    }
	    }


	    // $arr_args = '', $str_type = '', $str_wp = '', $str_when = 'wp'
	    protected function ez_prep( $obj_ez = '', $bool_register = 'false' ) {

	    	if ( is_object($obj_ez) ){

	    		// NOT a deep merge
	    		$obj = (object) array_merge( (array) $this->wp_enqueue_defaults(), (array) $obj_ez );

			    $bool_conditional_tags = true;
			    if ( $this->_ins_cond_tags !== false && is_array($obj->conditional_tags) && ! empty($obj->conditional_tags)){
				    $bool_conditional_tags = $this->_ins_cond_tags->evaluate($obj->conditional_tags);
			    }
			    $obj->conditional_tags = $bool_conditional_tags;

			    if ( $obj->active === true ) {

				    if ( is_object($obj->wp_enqueue_script) ){
					    $obj->type = 'script';
					    $obj->register = $bool_register;
					    $obj->wp_enqueue_script = (object) array_merge( (array)$this->wp_enqueue_script_defaults(), (array) $obj->wp_enqueue_script );

				    } elseif ( is_object($obj->wp_enqueue_style) ){

				    	$obj->type = 'style';
					    $obj->register = $bool_register;
					    // is this REALLY necessary?
					    $obj->wp_enqueue_style->media = $this->style_media_validate($obj->wp_enqueue_style->media);
					    $obj->wp_enqueue_script = (object) array_merge( (array)$this->wp_enqueue_style_defaults(), (array) $obj->wp_enqueue_script );


				    } else {

					    $obj->active = false;
					    $obj->type   = 'unknown';

					    return $obj;
				    }
			    }
			    return $obj;
		    }
		    return false;
	    }


	    protected function style_media_validate($str_media){

		    $str_media = strtolower($str_media);
		    if ( isset($this->style_media_supported()[$str_media]) && $this->style_media_supported()[$str_media] === true ){
			    return $str_media;
		    }
		    return 'all';
	    }


	    public function style_media_supported(){

		    $arr =  array(
			    'all' 			=> true,
			    'braille'		=> true,
			    'embossed'		=> true,
			    'handheld'		=> true,
			    'print'			=> true,
			    'projection'	=> true,
			    'screen'		=> true,
			    'speech'		=> true,
			    'tty'			=> true,
			    'tv'			=> true,
		    );

		    return $arr;
	    }

	    /**
	     * A loader that only registers. it does NOT - yet? - look at ->conditional_tags()
	     *
	     * @param string $arr_objs
	     *
	     * @return array
	     */
	    public function ez_register($arr_objs = ''){

		    if ( is_array($arr_objs) && ! empty($arr_objs) ){
			    $arr_objs_new = array();
			    foreach ($arr_objs as $key => $obj){
			    	// prep it
				    $mix_temp = $this->ez_prep($obj, true);
				    // check it
				    if ( $mix_temp !== false && $mix_temp->active === true ){

				    	// register it
				    	if ( $mix_temp->wp_enqueue_script === false ){
						    $this->wp_register_style($mix_temp);
						    // push it
						    $arr_objs_new[] = $mix_temp;
					    } elseif ( $mix_temp->wp_enqueue_style === false ){
						    $this->wp_register_script($mix_temp);
						    $arr_objs_new[] = $mix_temp;
					    }
				    }
			    }
			    // return what's been registered
			    return $arr_objs_new;
		    }
	    }

	    /*
	     * TODO protected function ez_enqueue()
	     */

	    /**
	     * Preps an arr of objs and leaves them in $_arr_objs_loaded which is used based on the actions in the construct
	     *
	     * @param string $arr_objs
	     */
	    public function ez_loader($arr_objs = ''){

	    	if ( is_array($arr_objs) && ! empty($arr_objs) ){
	    		$arr_new = array();
			    foreach ($arr_objs as $key => $obj){
			    	$mix_temp = $this->ez_prep($obj, false);
				    if ( $mix_temp !== false ){
					    $arr_new[] = $mix_temp;
				    }
			    }
			    $this->_arr_objs_loaded = $arr_new;
		    }
	    }

	    public function wp_enqueue_style_loaded(){
	    	return $this->enqueue_loaded('style', 'wp');
	    }

	    public function wp_enqueue_script_loaded(){
		    return $this->enqueue_loaded('script', 'wp');
	    }

	    public function login_enqueue_style_loaded(){
		    return $this->enqueue_loaded('style', 'login');
	    }

	    public function login_enqueue_script_loaded(){
		    return $this->enqueue_loaded('script', 'login');
	    }

	    public function admin_enqueue_style_loaded(){
		    return $this->enqueue_loaded('style', 'admin');
	    }

	    public function admin_enqueue_script_loaded(){
		    return $this->enqueue_loaded('script', 'admin');
	    }

	    protected function enqueue_loaded( $str_type = '', $str_action = '') {

		    if ( is_array( $this->_arr_objs_loaded ) && ! empty( $this->_arr_objs_loaded ) ) {
			    foreach ( $this->_arr_objs_loaded as $key => $obj ) {

			    	// should we do this?
				    if ( $obj->active === true && $obj->conditional_tags === true && $obj->action_enqueue_scripts->$str_action === true ) {
					    if ( $str_type == 'style' &&  $obj->type == 'style' ) {

					    	if ( $obj->register === true ){

					    		$this->wp_register_style( $obj );

						    } elseif ( wp_style_is( $obj->wp_enqueue_style->handle, 'registered' ) ){

							    wp_enqueue_style( $obj->wp_enqueue_style->handle );
							    $this->wp_style_add_data( $obj );

						    } else {

							    $this->wp_enqueue_style( $obj );
							    $this->wp_style_add_data( $obj );
						    }
					    } elseif ( $str_type == 'script' && $obj->type == 'script') {

						    if ( $obj->register === true ){

							    $this->wp_register_script( $obj );

						    } elseif ( wp_script_is( $obj->wp_enqueue_script->handle, 'registered' ) ){

							    wp_enqueue_script( $obj->wp_enqueue_script->handle );

						    } else {

							    $this->wp_enqueue_script( $obj );
						    }
					    }
				    }
			    }
		    }
	    }


	    /**
	     * @param string $obj
	     *
	     * ref: https://developer.wordpress.org/reference/functions/wp_style_add_data/
	     */
	    protected function wp_style_add_data($obj_ez = '' ){

		    // note: the active property isn't checked, just the add_add_active.
		    if ( isset($obj_ez->add_data_active) && $obj_ez->add_data_active === true && ( isset($obj_ez->add_data) && is_array($obj_ez->add_data) && ! empty($obj_ez->add_data)) ){
			    foreach ( $obj_ez->add_data as $str_key => $str_value ) {
				    if ( isset($obj_ez->wp_enqueue_style->handle) && isset($this->wp_style_add_data_key_accepts()[$str_key]) && $this->wp_style_add_data_key_accepts()[$str_key] === true ){
					    wp_style_add_data($obj_ez->wp_enqueue_style->handle, $str_key  , $str_value);
				    }
			    }
		    }
	    }


	    protected function wp_style_add_data_key_accepts(){

		    $arr = array(
			    'conditional' => true,
			    'rtl' => true,
			    'suffix' => true,
			    'alt' => true,
			    'title' => true
		    );
		    return $arr;
	    }

    }
}