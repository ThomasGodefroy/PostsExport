<?php
/*
Plugin Name: Posts Export
*/

class PostsExport_Plugin
{
	public function __construct()
	{
		//hook action pour avoir un bouton pour le plug-in sur la page admin
		add_action('admin_menu', array($this, 'add_admin_menu'));
	}

	public function empty_function(){}

	//fonction créant un bouton et des sous-menus dans le menu admin 
	public function add_admin_menu()
	{
		$hook = add_menu_page('Posts Export', 'Posts Export', 'manage_options', 'posts_export', array($this, 'menu_html'));
		//add_action('load-'.$hook, array($this, 'process_action'));
	}

	//page principale de l'extension
	public function menu_html()
	{

		echo '<h1>'.get_admin_page_title().'</h1>';
	}
}

new PostsExport_Plugin();
