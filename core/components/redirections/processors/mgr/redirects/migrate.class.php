<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

class RedirectionsRedirectsMigrateProcessor extends modProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = 'RedirectionsRedirect';

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['redirections:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'redirections.redirect';

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        $this->modx->getService('redirections', 'Redirections', $this->modx->getOption('redirections.core_path', null, $this->modx->getOption('core_path') . 'components/redirections/') . 'model/redirections/');

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function process()
    {
        $amount = 0;

        $contexts = $this->modx->getCollection('modContext', [
            'key:!=' => 'mgr'
        ]);

        foreach ($contexts as $context) {
            $resources = $this->modx->getCollection('modResource', [
                'context_key' => $context->get('key')
            ]);

            foreach ($resources as $resource) {
                $properties = $resource->getProperties('redirections');

                if (!isset($properties['url'])) {
                    $resource->setProperties(array_merge($properties, [
                        'uri' => trim($resource->get('uri'), '/')
                    ]), 'redirections');
                }

                if ($resource->save()) {
                    $amount++;
                }
            }
        }

        $setting = $this->modx->getObject('modSystemSetting', [
            'key' => 'redirections.migrate'
        ]);

        if ($setting) {
            $setting->fromArray([
                'value' => 1
            ]);

            if ($setting->save()) {
                $this->modx->cacheManager->refresh([
                    'system_settings' => []
                ]);
            }
        }

        return $this->success($this->modx->lexicon('redirections.migrate_redirections_success', [
            'amount' => $amount
        ]));
    }
}

return 'RedirectionsRedirectsMigrateProcessor';
