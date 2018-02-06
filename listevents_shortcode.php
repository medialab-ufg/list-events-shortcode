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
    public $url;

    function ListEventsShortcode() {
		add_shortcode('event_spaces', array(&$this, 'shortcode'));
		add_action( 'wp_enqueue_scripts', array(&$this, 'addScripts') );

        add_action('wp_ajax_nopriv_list_events_shortcode', array(&$this, 'ajaxJS'));
        add_action('wp_ajax_list_events_shortcode', array(&$this, 'ajaxJS'));
    }

    function addScripts() {

		// FOR TEST ALONE:
		wp_enqueue_script('jquery', '//cdn.jsdelivr.net/jquery/1/jquery.min.js');
		wp_enqueue_script('moment', '//cdn.jsdelivr.net/momentjs/latest/moment.min.js');
		wp_enqueue_style( 'bootst', '//cdn.jsdelivr.net/bootstrap/3/css/bootstrap.css');
		// END FOR TEST ALONE:

        #wp_enqueue_style('list-events-shortcode', plugin_dir_url( __FILE__ ) . '/list-events.css' );
        wp_enqueue_style('list-events-css-daterangepicker', '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css');
        wp_enqueue_script('list-events-js-daterangepicker', '//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js');

        wp_enqueue_script( 'listevents-ajax-script', plugin_dir_url( __FILE__ ) . 'app.js', array('jquery'));    
        
    }

    
    function shortcode($atts, $content) {
        if (!is_array($atts) || !isset($atts['url']))			
			return;	
		
        $params = [
            '@select'    => 'name,shortDescription,occurrences.rule,occurrences.space.name,occurrences.space.endereco,occurrences.space.En_Municipio,occurrences.space.En_Estado&space',
            'space:type' => 'BET(20,29)'
        ];
        $url = add_query_arg($params, $atts['url'] . '/api/event/findByLocation');            
        $result = $this->getEvents($atts, $url);
        
        if (false === $result)
            return;

        $events = json_decode($result);

        ob_start();
        include('template.php');
        $html = ob_get_clean();
        return $html;
	}

    function getEvents($atts, $url) {		
		$params['@from'] = date('Y-m-d');
        if (!isset($atts['range_date'])) {			
			$params['@to']   = date('Y-m-d', strtotime($params['@from']. ' + 30 days'));
		} else {
            $params['@to']   = date('Y-m-d', strtotime($params['@from']. ' + ' . $atts['range_date'] . ' days'));
        }
        $url = add_query_arg($params, $url);        
        $response = wp_remote_get( $url, array('timeout' => 20));
        return wp_remote_retrieve_response_code($response) == 200 ? wp_remote_retrieve_body($response) : false;
    }
}

add_action('init', function() {	
    $ListEventsShortcode = new ListEventsShortcode;
});
