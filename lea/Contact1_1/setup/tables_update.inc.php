<?php
	/**************************************************************************\
	* eGroupWare - Setup                                                       *
	* http://www.eGroupWare.org                                                *
	* Created by eTemplates DB-Tools written by ralfbecker@outdoor-training.de *
	* --------------------------------------------                             *
	* This program is free software; you can redistribute it and/or modify it  *
	* under the terms of the GNU General Public License as published by the    *
	* Free Software Foundation; either version 2 of the License, or (at your   *
	* option) any later version.                                               *
	\**************************************************************************/
	
	/* $Id: class.db_tools.inc.php 20167 2005-12-19 04:27:19Z ralfbecker $ */

	$test[] = '';
	function Epce_v1.2_upgrade()
	{
		$GLOBALS['egw_setup']->oProc->CreateTable('test2',array(
			'fd' => array(
				'test2' => array('type' => 'varchar','precision' => '255')
			),
			'pk' => array(),
			'fk' => array(),
			'ix' => array(),
			'uc' => array()
		));

		return $GLOBALS['setup_info']['Epce_v1.2']['currentver'] = '001';
	}
?>
