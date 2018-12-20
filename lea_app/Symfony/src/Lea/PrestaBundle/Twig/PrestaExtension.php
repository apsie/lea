<?php

namespace Lea\PrestaBundle\Twig;

class PrestaExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            'setcheckbox' => new \Twig_Filter_Method($this, 'setCheckbox'),
        );
    }

	public function setCheckbox($string,$match=1)
	{

		if($string==$match)
		$newData = "checked='checked'";
		else 
		$newData = "";
		
		return $newData;
		
	}

    public function getName()
    {
        return 'presta_extension';
    }
}
