<?php
/*
	 Plugin Name: wp-github-plugin 
	 Plugin URI: http://github.com/henningjensen/wp-github-plugin
	 Description: Integrates with Github API and fetches a user's projects
	 Author: Henning Jensen
	 Version: 0.1
	 Author URI: http://henning.fjas.no/blog
 */

function widget_github_register() {
  function widget_github_project_list($args) {
  	extract($args);

		// Pre-2.6 compatibility
		if ( ! defined( 'WP_CONTENT_URL' ) ) 
      define( 'WP_CONTENT_URL', get_option( 'siteurl' ) . '/wp-content' );
		if ( ! defined( 'WP_CONTENT_DIR' ) ) 
      define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
		if ( ! defined( 'WP_PLUGIN_URL' ) ) 
      define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
		if ( ! defined( 'WP_PLUGIN_DIR' ) ) 
      define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );

  	echo $before_widget; 
  	echo $before_title . 'Github' . $after_title; 
  ?>

  	<script type="text/javascript" src="<?php echo WP_PLUGIN_URL; ?>/wp-github-plugin/jquery-1.3.2.min.js"></script>
  	<script type="text/javascript">
  	var login = 'henningjensen';
  	var showForks = false;
  	var showPrivate = true;
  	var numberOfProjects = 10;
  
  	$.getJSON('http://github.com/api/v1/json/' + login + '?callback=?',
  		function(data) {
  			$.each(data.user.repositories, 
  				function(i){
  					if (!showForks && this.fork) return true;
  					if (!showPrivate && this.private) return true;
  					if (i == numberOfProjects) return false;
  					$('#repositories').append('<li><a href="' + this.url + '">' + this.name + '</a></li>');
  				}
  			);
  		}
  	);
  	</script>
  
  		<ul id="repositories"></ul>
  <?php 
  		echo $after_widget; 
  }
  
  register_sidebar_widget('Github project list', 'widget_github_project_list');
}
add_action('plugins_loaded', 'widget_github_register');

?>
