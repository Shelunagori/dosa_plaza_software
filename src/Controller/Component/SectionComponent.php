<?php
namespace App\Controller\Component;
use App\Controller\AppController;
use Cake\Controller\Component;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;

class SectionComponent extends Component
{
	function sectionsWithPath($array)
	{
		if (count($array)) 
		{
			foreach ($array as $vals) 
			{
				if(count($vals['children'])==0)
				{
					$this->Sections = TableRegistry::get('Sections');
					$crumbs=$this->Sections->find('path', ['for' => $vals['id']]);
					$full_path='';
					foreach ($crumbs as $crumb) 
					{
						$full_path.=$crumb->name . ' - ';
					}
					echo '<option value="'.$vals['id'].'">'.$full_path.'</option>';
				}
				
				if (count($vals['children'])) 
				{
					$this->sectionsWithPath($vals['children']);
				}
			}
		}
	}
}
?>