<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$plugin_info = array(
	'pi_name' => 'Highlight Word',
	'pi_version' => '1.0.0',
	'pi_author' => 'Bhavin Thummar',
	'pi_author_url' => '',
	'pi_description' => 'This plugin gives facility of highlighting words and also highlight by custom CSS',
	'pi_usage' => Highlight_word::usage()
);

class Highlight_word
{
	var $return_data = "";
	function Highlight_word() 
	{
		$this->EE =& get_instance();

		/* get data between tag */
		$tag_content = $this->EE->TMPL->tagdata;
		
		/* get data from particular attribute */
		$words = $this->EE->TMPL->fetch_param('words');
		$css   = $this->EE->TMPL->fetch_param('css');

		$array_words = array();

		$default_css = 'background-color: yellow;color: black;'; //default css

		if(!empty($css)){
			$default_css = $css;
		}


		$new_content = $tag_content;
		$c = 0;
		if(!empty($words)){

			$array_words = explode('|', $words);

			foreach ($array_words as $all_words) {
				$c++;

				$new_content = str_replace($all_words, '<span style="'.$default_css.'">'.$all_words.'</span>', $new_content);

			}

		}

		$this->return_data = $new_content;	 	

	}


	function usage()
	{
	  ob_start(); 
	  ?>
	  
		Sometimes you need to highlight some word in content. Using this plugin we can highlight
		single and multiple words. We can also add custom css for that highlighting.

		All Example

		{exp:highlight_word words="apple|mango"} 
		  This is apple. <br/>
		  This is mango.
		{/exp:highlight_word}

		Output
		http://prntscr.com/imz5pp
		
		{exp:highlight_word words="apple|mango" css="color:white;background-color:pink"} 
		  This is apple. <br/> 
		  This is mango.
		{/exp:highlight_word}

		Output
		http://prntscr.com/imz5pp

	  
	  <?php
	  $buffer = ob_get_contents();
	  	
	  ob_end_clean(); 
	  
	  return $buffer;
	}

	

}
