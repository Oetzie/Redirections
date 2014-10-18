<?php

	/**
	 * Offline IP
	 *
	 * Copyright 2014 by Oene Tjeerd de Bruin <info@oetzie.nl>
	 *
	 * This file is part of Offline IP, a real estate property listings component
	 * for MODX Revolution.
	 *
	 * Offline IP is free software; you can redistribute it and/or modify it under
	 * the terms of the GNU General Public License as published by the Free Software
	 * Foundation; either version 2 of the License, or (at your option) any later
	 * version.
	 *
	 * Offline IP is distributed in the hope that it will be useful, but WITHOUT ANY
	 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
	 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
	 *
	 * You should have received a copy of the GNU General Public License along with
	 * Offline IP; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
	 * Suite 330, Boston, MA 02111-1307 USA
	 */

	$xpdo_meta_map['OfflineIpExceptions']= array(
		'package' 	=> 'offlineip',
		'version' 	=> '1.0',
		'table' 	=> 'offlineip_exceptions',
		'extends' 	=> 'xPDOSimpleObject',
		'fields' 	=> array(
			'id'			=> null,
			'context'		=> null,
			'ip'			=> null,
			'name' 			=> null,
			'description' 	=> null,
			'active'		=> null,
			'editedon' 		=> null
		),
		'fieldMeta'	=> array(
			'id' 		=> array(
				'dbtype' 	=> 'int',
				'precision' => '11',
				'phptype' 	=> 'integer',
				'null' 		=> false,
				'index' 	=> 'pk',
				'generated'	=> 'native'
			),
			'context' 	=> array(
				'dbtype' 	=> 'varchar',
				'precision' => '75',
				'phptype' 	=> 'string',
				'null' 		=> false
			),
			'ip' 		=> array(
				'dbtype' 	=> 'varchar',
				'precision' => '15',
				'phptype' 	=> 'string',
				'null' 		=> false
			),
			'name' 		=> array(
				'dbtype' 	=> 'varchar',
				'precision' => '75',
				'phptype' 	=> 'string',
				'null' 		=> false
			),
			'description' => array(
				'dbtype' 	=> 'text',
				'phptype' 	=> 'string',
				'null' 		=> false
			),
			'active'	=> array(
				'dbtype' 	=> 'int',
				'precision' => '1',
				'phptype' 	=> 'integer',
				'null' 		=> false,
				'default'	=> 1
			),
			'editedon' 	=> array(
				'dbtype' 	=> 'timestamp',
				'phptype' 	=> 'timestamp',
				'attributes' => 'ON UPDATE CURRENT_TIMESTAMP',
				'null' 		=> false
			)
		),
		'indexes'	=> array(
			'PRIMARY'	=> array(
				'alias' 	=> 'PRIMARY',
				'primary' 	=> true,
				'unique' 	=> true,
				'columns' 	=> array(
					'id' 		=> array(
						'collation' => 'A',
						'null' 		=> false,
					)
				)
			)
		)
	);

?>