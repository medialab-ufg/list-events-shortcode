<?php
/*
Plugin Name: List Events Shortcode
Plugin URI:
Description: Lista eventos da API do mapas culturais
Author: midiaLab
Version: 1.0
Text Domain:
*/

class ListEventsShortcode {
    function ListEventsShortcode() {    
		add_shortcode('event_spaces', array(&$this, 'shortcode'));
		add_action( 'wp_enqueue_scripts', array(&$this, 'addCSS') );        
    }
    
    function addCSS() {
		
		// FOR TEST ALONE:
			wp_enqueue_script('jquery', '//cdn.jsdelivr.net/jquery/1/jquery.min.js');
			wp_enqueue_script('moment', '//cdn.jsdelivr.net/momentjs/latest/moment.min.js');
			wp_enqueue_style( 'bootst', '//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css');
		// END FOR TEST ALONE:
		
        wp_enqueue_style('list-events-shortcode', plugin_dir_url( __FILE__ ) . '/list-events.css' );
        wp_enqueue_style('list-events-css-daterangepicker', '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css');
        wp_enqueue_script('list-events-js-daterangepicker', '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js');
    }
    
    function shortcode($atts, $content) {
        /*if (!is_array($atts))
			return;*/
		
        
		#$ids = $atts['ids'];
		#$tag = $atts['tag'];
        
        $params = [
            '@select' => 'id,name,occurrences.space.*',            
            'space:type' => 'BET(20,29)'
        ];
        
        if (isset($atts['@from']) && isset($atts['@to'])) {
			$params['@from']= 2014-01-01;
			$params['@to']= 2018-01-01;
		}
        
        $result = $this->getEvents($params);
        
        if (false === $result)
            return;        
        $events = json_decode($result);
        
        ob_start();        
        include('template.php');
        
        $html = ob_get_clean();
        
        return $html;		
	}
    
    function get_api_url() {
        // no futuro isso pode ser uma opção
        return 'http://museus.cultura.gov.br/api/event/findByLocation';
    }
    
    function getEvents($params) {
		// implementar cache
        $url = add_query_arg($params, $this->get_api_url());
        $response = wp_remote_get( $url, array('timeout' => 20) );        
        return wp_remote_retrieve_response_code($response) == 200 ? wp_remote_retrieve_body($response) : false;
    }
}

add_action('init', function() {
    $ListEventsShortcode = new ListEventsShortcode;
});


?>
