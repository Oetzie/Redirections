<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

class Redirections
{
    /**
     * @access public.
     * @var modX.
     */
    public $modx;

    /**
     * @access public.
     * @var Array.
     */
    public $config = [];

    /**
     * @access public.
     * @param modX $modx.
     * @param Array $config.
     */
    public function __construct(modX &$modx, array $config = [])
    {
        $this->modx =& $modx;

        $corePath   = $this->modx->getOption('redirections.core_path', $config, $this->modx->getOption('core_path') . 'components/redirections/');
        $assetsUrl  = $this->modx->getOption('redirections.assets_url', $config, $this->modx->getOption('assets_url') . 'components/redirections/');
        $assetsPath = $this->modx->getOption('redirections.assets_path', $config, $this->modx->getOption('assets_path') . 'components/redirections/');

        $this->config = array_merge([
            'namespace'             => 'redirections',
            'lexicons'              => ['redirections:default'],
            'base_path'             => $corePath,
            'core_path'             => $corePath,
            'model_path'            => $corePath . 'model/',
            'processors_path'       => $corePath . 'processors/',
            'elements_path'         => $corePath . 'elements/',
            'chunks_path'           => $corePath . 'elements/chunks/',
            'plugins_path'          => $corePath . 'elements/plugins/',
            'snippets_path'         => $corePath . 'elements/snippets/',
            'templates_path'        => $corePath . 'templates/',
            'assets_path'           => $assetsPath,
            'js_url'                => $assetsUrl . 'js/',
            'css_url'               => $assetsUrl . 'css/',
            'assets_url'            => $assetsUrl,
            'connector_url'         => $assetsUrl . 'connector.php',
            'version'               => '1.4.0',
            'branding_url'          => $this->modx->getOption('redirections.branding_url', null, ''),
            'branding_help_url'     => $this->modx->getOption('redirections.branding_url_help', null, ''),
            'context'               => $this->getContexts(),
            'exclude_contexts'      => array_merge(['mgr'], explode(',', $this->modx->getOption('redirections.exclude_contexts', null, ''))),
            'migrate'               => (bool) $this->modx->getOption('redirections.migrate', null, false),
            'clean_days'            => (int) $this->modx->getOption('redirections.clean_days', null, 30)
        ], $config);

        $this->modx->addPackage('redirections', $this->config['model_path']);

        if (is_array($this->config['lexicons'])) {
            foreach ($this->config['lexicons'] as $lexicon) {
                $this->modx->lexicon->load($lexicon);
            }
        } else {
            $this->modx->lexicon->load($this->config['lexicons']);
        }
    }

    /**
     * @access public.
     * @return String|Boolean.
     */
    public function getHelpUrl()
    {
        if (!empty($this->config['branding_help_url'])) {
            return $this->config['branding_help_url'] . '?v=' . $this->config['version'];
        }

        return false;
    }

    /**
     * @access public.
     * @return String|Boolean.
     */
    public function getBrandingUrl()
    {
        if (!empty($this->config['branding_url'])) {
            return $this->config['branding_url'];
        }

        return false;
    }

    /**
     * @access public.
     * @param String $key.
     * @param Array $options.
     * @param Mixed $default.
     * @return Mixed.
     */
    public function getOption($key, array $options = [], $default = null)
    {
        if (isset($options[$key])) {
            return $options[$key];
        }

        if (isset($this->config[$key])) {
            return $this->config[$key];
        }

        return $this->modx->getOption($this->config['namespace'] . '.' . $key, $options, $default);
    }

    /**
     * @access private.
     * @return Boolean.
     */
    private function getContexts()
    {
        return $this->modx->getCount('modContext', [
            'key:NOT IN' => array_merge(['mgr'], explode(',', $this->modx->getOption('redirections.exclude_contexts', null, '')))
        ]) === 1;
    }

    /**
     * @access public.
     * @param String|Array $context.
     * @return Array.
     */
    public function getRedirects($context = [])
    {
        if (is_string($context)) {
            $context = explode(',', $context);
        }

        return $this->modx->getCollection('RedirectionsRedirect', [
            'context:IN'    => $context + [$this->modx->context->get('key'), ''],
            'active'        => 1
        ]);
    }
}
