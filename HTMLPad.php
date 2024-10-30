<?php
/*
Plugin Name: HTMLPad
Plugin URI: http://www.betterhelpworld.com/wordpress/htmlPad/
Description: Easy way to add your custom HTML to your widget. Your can use for anouncements on your blog of for putting your adsense in widget.
Author: Nishanthan S.
Version: 1.1
Author URI: http://www.betterhelpworld.com/
*/

$defaultValue = "<div>\n<script type=\"text/javascript\">\n<!--\n google_ad_client = \"pub-0316982826533586\";\n/* Aug 14 - Vertical BHW */ \ngoogle_ad_slot = \"3727437708\"; \ngoogle_ad_width = 150; \ngoogle_ad_height = 600; //-->\n </script> \n<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\n </script>\n </div>\n";

function htmlPad_widget()
{
	global $defaultValue;
	$myDefaultValues = get_option('widget_htmlPad');
	if(is_array($myDefaultValues))
		echo(stripslashes($myDefaultValues['DisplayText']));
	else
	{
		echo("<b>Edit widget with your HTML.</b>");
		echo($defaultValue);
	}
}
function init_htmlPad()
{
	register_sidebar_widget("htmlPad", "htmlPad_widget");
	register_widget_control("htmlPad", 'widget_htmlPad_control','',220);
	/*delete_option("widget_htmlPad",$myNewValues);*/
}
function widget_htmlPad_control()
{
	global $defaultValue;
	$myDefaultValues = get_option('widget_htmlPad');
	if(!is_array($myDefaultValues))
	{
		$myDefaultValues = array('DisplayText'=>$defaultValue);
	}

	if(isset($_POST['myOptionForm']))
	{
		$myNewValues = array('DisplayText'=>$_POST['DisplayText']);
		update_option("widget_htmlPad",$myNewValues);
	}
	else
	{
		?>
			<textarea name="DisplayText" rows=10 cols=50><?php echo(stripslashes($myDefaultValues['DisplayText'])); ?></textarea>
			<input type="hidden" id="myOptionForm" name="myOptionForm" value="1" />
		<?php
	}
}
add_action("plugins_loaded", "init_htmlPad");
?>