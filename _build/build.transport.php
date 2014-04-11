<?php

	$mtime 	= explode(' ', microtime());
	$tstart = $mtime[1] + $mtime[0];
	
	set_time_limit(0);

	define('PKG_NAME', 			'Redirections');
	define('PKG_NAME_LOWER', 	strtolower(PKG_NAME));
	define('PKG_NAMESPACE', 	strtolower(PKG_NAME));
	define('PKG_VERSION',		'1.0.1');
	define('PKG_RELEASE',		'pl');

	$root = dirname(dirname(__FILE__)).'/';

	$sources = array(
	    'root' 			=> $root,
	    'build' 		=> $root.'_build/',
	    'data' 			=> $root.'_build/data/',
	    'resolvers' 	=> $root.'_build/resolvers/',
	    'core' 			=> $root.'core/components/'.PKG_NAME_LOWER,
	    'assets' 		=> $root.'assets/components/'.PKG_NAME_LOWER,
	    'chunks' 		=> $root.'core/components/'.PKG_NAME_LOWER.'/elements/chunks/',
	    'snippets' 		=> $root.'core/components/'.PKG_NAME_LOWER.'/elements/snippets/',
	    'plugins' 		=> $root.'core/components/'.PKG_NAME_LOWER.'/elements/plugins/',
	    'lexicon' 		=> $root.'core/components/'.PKG_NAME_LOWER.'/lexicon/',
	    'docs' 			=> $root.'core/components/'.PKG_NAME_LOWER.'/docs/'
	);

	require_once $sources['build'].'/build.config.php';
	require_once $sources['build'].'/includes/functions.php';
	require_once MODX_CORE_PATH.'model/modx/modx.class.php';
	
	$modx = new modX();
	$modx->initialize('mgr');
	$modx->setLogLevel(modX::LOG_LEVEL_INFO);
	$modx->setLogTarget('ECHO');
	
	echo XPDO_CLI_MODE ? '' : '<pre>';

	$modx->loadClass('transport.modPackageBuilder', '', false, true);
	
	$builder = new modPackageBuilder($modx);
	$builder->createPackage(PKG_NAMESPACE, PKG_VERSION, PKG_RELEASE);
	$builder->registerNamespace(PKG_NAMESPACE, false, true, '{core_path}components/'.PKG_NAMESPACE.'/');
	
	$modx->log(modX::LOG_LEVEL_INFO, 'Packaging in category...');
	
	$category = $modx->newObject('modCategory');
	$category->fromArray(array('id' => 1, 'category' => PKG_NAME), '', true, true);

	if (null === $category) {
		$modx->log(modX::LOG_LEVEL_ERROR, 'No category to pack.');
	} else {
		if (file_exists($sources['data'].'transport.plugins.php')) {	
			$modx->log(modX::LOG_LEVEL_INFO, 'Packaging in plugin(s) into category...');
		
			$plugins = include $sources['data'].'transport.plugins.php';
		
			foreach ($plugins as $plugin) {
				$category->addMany($plugin);
			}

			$modx->log(modX::LOG_LEVEL_INFO, 'Packed plugin(s) '.count($plugins).' into category.');
		} else {
			$modx->log(modX::LOG_LEVEL_INFO, 'No plugins(s) to pack...');
		}
		
		$builder->putVehicle($builder->createVehicle($category, array(
		    xPDOTransport::UNIQUE_KEY 		=> 'category',
		    xPDOTransport::PRESERVE_KEYS 	=> false,
		    xPDOTransport::UPDATE_OBJECT 	=> true,
		    xPDOTransport::RELATED_OBJECTS 	=> true,
		    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array(
		        'Plugins' => array(
		            xPDOTransport::PRESERVE_KEYS 	=> false,
		            xPDOTransport::UPDATE_OBJECT 	=> true,
		            xPDOTransport::UNIQUE_KEY 		=> 'name'
		        ),
		        'PluginEvents' => array(
		            xPDOTransport::PRESERVE_KEYS 	=> true,
		            xPDOTransport::UPDATE_OBJECT 	=> false,
		            xPDOTransport::UNIQUE_KEY 		=> array('pluginid', 'event'),
		        )
		    )
		)));

		$modx->log(modX::LOG_LEVEL_INFO, 'Packed category.');
	}
	
	$modx->log(modX::LOG_LEVEL_INFO, 'Packaging in menu...');
	
	$menu = include $sources['data'].'transport.menu.php';
	
	if (null === $menu) {
		$modx->log(modX::LOG_LEVEL_ERROR, 'No menu to pack.');
	} else {
		$vehicle = $builder->createVehicle($menu, array(
		    xPDOTransport::PRESERVE_KEYS 	=> true,
		    xPDOTransport::UPDATE_OBJECT 	=> true,
		    xPDOTransport::UNIQUE_KEY 		=> 'text',
		    xPDOTransport::RELATED_OBJECTS 	=> true,
		    xPDOTransport::RELATED_OBJECT_ATTRIBUTES => array(
		        'Action' => array(
		            xPDOTransport::PRESERVE_KEYS 	=> false,
		            xPDOTransport::UPDATE_OBJECT 	=> true,
		            xPDOTransport::UNIQUE_KEY 		=> array('namespace','controller')
		        ),
		    ),
		));
		
		$modx->log(modX::LOG_LEVEL_INFO, 'Adding in PHP resolvers...');
		
		if (is_dir($sources['assets'])) {
			$vehicle->resolve('file', array(
		    	'source' => $sources['assets'],
		    	'target' => "return MODX_ASSETS_PATH.'components/';",
		    ));
		}
		
	    if (is_dir($sources['core'])) {
			$vehicle->resolve('file', array(
			    'source' => $sources['core'],
			    'target' => "return MODX_CORE_PATH.'components/';",
			));
		}
		
		if (file_exists($sources['resolvers'].'resolve.tables.php')) {
			$vehicle->resolve('php',array(
		    	'source' => $sources['resolvers'].'resolve.tables.php',
			));
		}
		
		$builder->putVehicle($vehicle);
		
		$modx->log(modX::LOG_LEVEL_INFO, 'Packed menu.');
	}
	
	$modx->log(xPDO::LOG_LEVEL_INFO, 'Setting Package Attributes...');

	$builder->setPackageAttributes(array(
	    'license' 	=> file_get_contents($sources['docs'].'license.txt'),
	    'readme' 	=> file_get_contents($sources['docs'].'readme.txt'),
	    'changelog' => file_get_contents($sources['docs'].'changelog.txt'),
	));

	$modx->log(xPDO::LOG_LEVEL_INFO, 'Zipping up package...');

	$builder->pack();
	
	$mtime		= explode(' ', microtime());
	$tend		= $mtime[1] + $mtime[0];
	$totalTime	= ($tend - $tstart);
	$totalTime	= sprintf("%2.4f s", $totalTime);

	$modx->log(modX::LOG_LEVEL_INFO, 'Package Built: Execution time: {'.$totalTime.'}');

	echo XPDO_CLI_MODE ? '' : '</pre>';
	
	exit();
	
?>