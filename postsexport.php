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
	}

	//page principale de l'extension
	public function menu_html()
	{
		global $wpdb;
		$rows = $wpdb->get_results("SELECT name FROM wp_terms WHERE term_id IN (SELECT term_id FROM wp_term_taxonomy
						WHERE taxonomy = \"category\");");
		echo '<h1>'.get_admin_page_title().'</h1>';
?>	
		<form>
		
		<select name="categorie" size="1">

		<option>Tous</option>

<?php		foreach($rows as $row)
		{
?>
			<option><?php echo $row->name; ?></option>'
<?php
		}
?>		
		</select>
		</form>
<?php

	}
}

new PostsExport_Plugin();
