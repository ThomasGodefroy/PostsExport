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
		add_action('load-'.$hook, array($this, 'process_action'));
	}

	//page principale de l'extension
	public function menu_html()
	{
		global $wpdb;
		
		echo '<h1>'.get_admin_page_title().'</h1>';

		$rows = $wpdb->get_results("SELECT name FROM {$wpdb->prefix}terms WHERE term_id IN (SELECT term_id FROM wp_term_taxonomy
						WHERE taxonomy = \"category\");");
?>	
		<form>
		
		Catégorie :<select name="categorie" size="1">

		<option value="Tout_categorie">Tout</option>

<?php		foreach($rows as $row)
		{
?>
			<option>
			<?php echo $row->name; ?>
			</option>'
<?php
		}
?>		
		</select>
		<br/>
<?php
		$rows = $wpdb->get_results("SELECT user_login FROM {$wpdb->prefix}users;");
?>
		Auteur :<select name="auteur" size="1">

		<option value="Tout_auteur">Tout</option>

<?php		foreach($rows as $row)
		{
?>
			<option>
			<?php echo $row->user_login; ?>
			</option>'
<?php
		}
?>
		</select>
		<br/>
<?php
		$rows = $wpdb->get_results("SELECT DISTINCT DATE_FORMAT(post_date, '%M %Y') as date FROM wp_posts ORDER BY post_date DESC;");
?>
		Date de début :<select name="date1" size="1">

		<option value="vide">Sélectionner</option>

<?php		foreach($rows as $row)
		{
?>
			<option>
			<?php echo $row->date; ?>
			</option>'
<?php
		}
?>
		</select>
<?php
		echo "\t";
		$rows = $wpdb->get_results("SELECT DISTINCT DATE_FORMAT(post_date, '%M %Y') as date FROM wp_posts ORDER BY post_date DESC;");
?>
		Date de fin :<select name="date2" size="1">

		<option value="vide">Sélectionner</option>

<?php		foreach($rows as $row)
		{
?>
			<option>
			<?php echo $row->date; ?>
			</option>'
<?php
		}
?>
		</select>
		<br/>
<?php
		$rows = $wpdb->get_results("SELECT DISTINCT post_status FROM wp_posts;");
?>
		Etat :<select name="etat" size="1">

		<option value="Tout_etat">Tout</option>

<?php		foreach($rows as $row)
		{
?>
			<option>
			<?php echo $row->post_status; ?>
			</option>'
<?php
		}
?>
		</select>
		<br/>

		<input type="hidden" name="valider" value="1"/>
    		<?php submit_button('Valider'); ?>
		</form>
<?php

	}

	//si l'utilisateur a cliqué sur le bouton 'Valider', lance les requêtes d'insertion
	public function process_action()
	{
		if (isset($_POST['valider']))
		{
			
		}
	}
}

new PostsExport_Plugin();
