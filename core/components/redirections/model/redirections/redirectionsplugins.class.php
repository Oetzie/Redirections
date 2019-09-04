<?php

/**
 * Redirections
 *
 * Copyright 2019 by Oene Tjeerd de Bruin <nodx@oetzie.nl>
 */

require_once __DIR__ . '/redirections.class.php';

class RedirectionsPlugins extends Redirections
{
    /**
     * @access public.
     * @param Array $properties.
     */
    public function onDocFormSave(array $properties = [])
    {
        if (isset($properties['resource'])) {
            $this->handleResource($properties['resource']);
        }
    }

    /**
     * @access public.
     * @param Array $properties.
     */
    public function onResourceSort(array $properties = [])
    {
        if (isset($properties['nodesAffected'])) {
            foreach ((array) $properties['nodesAffected'] as $resource) {
                $this->handleResource($resource);
            }
        }
    }

    /**
     * @access public.
     */
    public function onPageNotFound()
    {
        if (!in_array($this->modx->context->get('key'), $this->getOption('exclude_contexts'), true)) {
            $request = urldecode(trim($_SERVER['REQUEST_URI'], '/'));
            $baseUrl = ltrim(trim($this->modx->getOption('base_url', null, MODX_BASE_URL)), '/');

            if ($baseUrl !== '/' && $baseUrl !== '') {
                $request = trim(str_replace($baseUrl, '', $request), '/');
            }

            if ($request !== '') {
                foreach (array_reverse($this->getRedirects()) as $redirect) {
                    $regex = preg_quote(trim($redirect->get('old_url'), '/'));
                    $regex = str_replace(['%', '\^', '\$', '/'], ['(.+?)', '^', '$', '\/'], $regex);

                    if (!preg_match('/\^/', $regex) && !preg_match('/\$/', $regex)) {
                        $regex = sprintf('/^%s$/si', $regex);
                    } else {
                        $regex = sprintf('/%s/si', $regex);
                    }

                    if (preg_match($regex, $request, $matches)) {
                        $location = $redirect->get('new_url');

                        if (is_numeric($location)) {
                            $location = $this->modx->makeUrl($location, null, null, 'full');
                        }

                        foreach ((array) $matches as $key => $value) {
                            $location = str_replace(sprintf('$%s', $key), $value, $location);
                        }

                        if (preg_match('/(\[\[\~([\d]+)\]\])/i', $location, $matches)) {
                            if (isset($matches[2])) {
                                $location = str_replace($matches[1], $this->modx->makeUrl($matches[2]), $location);
                            }
                        }

                        $location = trim($location, '/');

                        if ($location !== $this->modx->resourceIdentifier) {
                            if ($baseUrl !== '') {
                                if (0 === ($pos = strpos($location, $baseUrl))) {
                                    $location = substr($location, strlen($baseUrl), strlen($location));
                                }
                            }

                            $redirect->set('visits', (int) $redirect->get('visits') + 1);
                            $redirect->set('last_visit', date('Y-m-d H:i:s'));

                            if ($redirect->save()) {
                                $this->modx->sendRedirect($location, [
                                    'responseCode' => $redirect->get('type')
                                ]);
                            }
                        }
                    }
                }

                $notFound = $this->modx->getObject('RedirectionsRedirect', [
                    'context'   => $this->modx->context->get('key'),
                    'old_url'   => $request,
                    'active'    => 2
                ]);

                if (!$notFound) {
                    $notFound = $this->modx->newObject('RedirectionsRedirect');
                }

                $notFound->fromArray([
                    'context'      => $this->modx->context->get('key'),
                    'old_url'      => $request,
                    'active'       => 2,
                    'visits'       => (int) $notFound->get('visits') + 1,
                    'last_visit'   => date('Y-m-d H:i:s')
                ]);

                $notFound->save();
            }
        }
    }

    /**
     * @access protected.
     * @param Object $resource.
     * @return Boolean.
     */
    protected function handleResource($resource)
    {
        if ($resource instanceof modResource) {
            if (!in_array($resource->get('context_key'), $this->getOption('exclude_contexts'), true)) {
                $properties = $resource->getProperties('redirections');

                if (isset($properties['uri'])) {
                    $oldUrl = trim($properties['uri'], '/');
                    $newUrl = trim($resource->get('uri'), '/');

                    if ($oldUrl !== '' && $newUrl !== '') {
                        if ($oldUrl !== $newUrl) {
                            $redirect = $this->modx->getObject('RedirectionsRedirect', [
                                'context'   => $resource->get('context_key'),
                                'old_url'   => $newUrl,
                                'new_url'   => $oldUrl,
                                'active:!=' => 2
                            ]);

                            if (!$redirect) {
                                $redirect = $this->modx->getObject('RedirectionsRedirect', [
                                    'context'   => $resource->get('context_key'),
                                    'old_url'   => $oldUrl
                                ]);

                                if (!$redirect) {
                                    $redirect = $this->modx->newObject('RedirectionsRedirect', [
                                        'context'   => $resource->get('context_key'),
                                        'old_url'   => $oldUrl
                                    ]);
                                }

                                if ($redirect) {
                                    $redirect->fromArray([
                                        'new_url'   => $newUrl,
                                        'type'      => 'HTTP/1.1 301 Moved Permanently',
                                        'active'    => 1
                                    ]);

                                    $redirect->save();
                                }
                            } else {
                                $redirect->remove();
                            }

                            if ($this->modx->getOption('use_alias_path')) {
                                $childResources = $this->modx->getChildIds($resource->get('id'), 1, [
                                    'context' => $resource->get('context_key')
                                ]);

                                if ($childResources) {
                                    foreach ($childResources as $childResource) {
                                        $childResource = $this->modx->getObject('modResource', $childResource);

                                        if ($childResource) {
                                            $this->handleResource($childResource);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }

                $resource->setProperties(array_merge($properties, [
                    'uri' => trim($resource->get('uri'), '/')
                ]), 'redirections');

                return $resource->save();
            }
        }
    }
}
