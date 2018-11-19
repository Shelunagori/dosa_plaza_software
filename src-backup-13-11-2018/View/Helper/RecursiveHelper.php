<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\View\Helper;

use Cake\Core\App;
use Cake\Core\Exception\Exception;
use Cake\View\Helper;
use Cake\View\View;
use Cake\View\Helper\HtmlHelper;
use Cake\ORM\TableRegistry;
/**
 * Number helper library.
 *
 * Methods to make numbers more readable.
 *
 * @link http://book.cakephp.org/3.0/en/views/helpers/number.html
 * @see \Cake\I18n\Number
 */
class RecursiveHelper extends Helper
{

    function Section($array) 
	{
		if (count($array)) 
		{
			echo "\n<ul>\n";
			foreach ($array as $vals) 
			{
				echo "<li id=\"".$vals->id."\">".$vals->name;
				$html = new HtmlHelper(new \Cake\View\View());
				echo  $html->link('<i class="fa fa-pencil-square-o"></i>', ['action' => 'index', $vals->id],['escape'=>false,'class'=>'','title'=>'Edit','style'=>'float:right;']);
				if (count($vals['children'])) 
				{
					$this->Section($vals['children']);
				}
				echo "</li>\n";
			}
			echo "</ul>\n";
		}
	}
	
	function Subjects($array) 
	{
		if (count($array)) 
		{
			echo "\n<ul>\n";
			foreach ($array as $vals) 
			{
				if($vals->elective==1)
				{
				
				$elective="(Elective)";
				}
				else
				{
					$elective="";
				}
	 
				echo "<li id=\"".$vals->id."\">".$vals->name."".$elective;	
				
				$html = new HtmlHelper(new \Cake\View\View());
				echo  $html->link('<i class="fa fa-pencil-square-o"></i>', ['action' => 'index', $vals->id],['escape'=>false,'class'=>'editSubject','title'=>'Edit','style'=>'float:right;', 'role'=>'button']);
				if (count($vals['children'])) 
				{
					$this->Subjects($vals['children']);
				}
				echo "</li>\n";
			}
			echo "</ul>\n";
		}
	}
	
	function SectionforSubject($array) 
	{
		if (count($array)) 
		{
			echo "\n<ul>\n";
			foreach ($array as $vals) 
			{
				echo "<li id=\"".$vals->id."\">";//$vals->name
				if(count($vals['children'])==0)
				{
					echo '<a section_id="'.$vals->id.'" href="#" class="sectionTag">'.$vals->name.'</a>';
				}
				else
				{
					echo $vals->name;	
				}
				//$html = new HtmlHelper(new \Cake\View\View());
				if (count($vals['children'])) 
				{
					$this->SectionforSubject($vals['children']);
				}
				echo "</li>\n";
			}
			echo "</ul>\n";
		}
	}
	
	function sectionOptions($array,$section_id){
		$html = new FormHelper(new \Cake\View\View());
		//$section_id=11;
		if (count($array)) {
			foreach ($array as $vals) {
				if(count($vals['children'])==0)
				{
					$this->Sections = TableRegistry::get('Sections');
					$crumbs=$this->Sections->find('path', ['for' => $vals['id']]);
					$full_path='';
					$i=1;
					foreach ($crumbs as $crumb) 
					{
						$i++;
						$full_path.=$crumb->name . ' > ';
					}
					$full_path=substr_replace($full_path," ",-3);
					if($vals->id == $section_id){ $sel='selected="selected"'; }else{ $sel=''; }
					echo '<option value="'.$vals->id.'" '.$sel.'>'.$full_path.'</option>';
				}
				
				if (count($vals['children'])) 
				{
					$this->sectionOptions($vals['children'],$section_id);
				}
			}
			   
		}
	}
	
	function Exam($array) 
	{
		if (count($array)) 
		{
			echo "\n<ul>\n";
			foreach ($array as $vals) 
			{
				echo "<li id=\"".$vals->id."\">".$vals->name;
				$html = new HtmlHelper(new \Cake\View\View());
				echo  $html->link('<i class="fa fa-pencil-square-o"></i>', ['action' => 'index', $vals->id],['escape'=>false,'class'=>'EditBox','title'=>'Edit','role'=>'button', 'style'=>'float:right;']);
				if (count($vals['children'])) 
				{
					$this->Exam($vals['children']);
				}
				echo "</li>\n";
			}
			echo "</ul>\n";
		}
	}
	
	
	
}
