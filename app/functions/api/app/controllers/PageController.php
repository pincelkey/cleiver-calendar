<?php

namespace App\Controllers;

use Timber\Timber;
use Exception;

class PageController {
    public function __construct() { }

    public function show($request) {
        $pageData = [];

        switch ($request['type']) {
            case 'page':
            case 'post-type':
                $post = Timber::get_post([
                    'post_type' => ($request['type'] == 'post-type')
                        ? $request['type-name']
                        : 'page',
                    'name' => $request['slug']
                ]);

                if ($post) {
                    $post->title;
                    $post->content;

                    if ($post->thumbnail) $post->thumbnail->src;

                    $pageData = [
                        'post' => $post
                    ];

                    $pageData = array_merge($pageData, $this::__getPostData($request['type'], $request['type-name'], $request['slug'], $post->ID));
                } else {
                    $pageData = false;
                }

                break;

            case 'term':
                $terms = Timber::get_terms([
                    'taxonomy'  => $request['type-name'],
                    'slug'      => $request['slug']
                ]);
                $term = count($terms) ? $terms[0] : false;

                if ($term) {
                    $term->title;

                    $pageData = [
                        'term' => $term
                    ];

                    $pageData = array_merge($pageData, $this::__getTermData($request['type-name'], $request['slug'], $term->ID, $request['parent']));
                } else {
                    $pageData = false;
                }
                break;
            case 'general':
                $pageData = $this::__getGeneralData();
                break;
        }

        if ($pageData) {
            return (object)[
                'message'   => 'Panda WP - SPA 🚀🔥🐼',
                'data'      => $pageData,
                'status'    => true,
                'code'      => 200,
            ];
        } else {
            return (object)[
                'code'      => 200,
                'message'   => 'Panda WP - SPA ⚠️🐼',
                'status'    => false
            ];
        }
    }

    private function __getPostData($objectType, $objectTypeName, $postSlug, $objectId) {
        $data = [];

        switch ($objectType) {
            case 'post-type':
                switch ($objectTypeName) {
                    case 'example':
                        $data = ['example' => 'Hi, From Panda WP'];
                        break;
                }
                break;

            case 'page':
                switch ($postSlug) {
                    case 'example':
                        $data = ['example' => 'Hi, From Panda WP'];
                        break;
                }
                break;
        }

        return $data;
    }

    private function __getTermData($objectTypeName, $postSlug, $objectId, $parent) {
        $data = [];

        switch ($objectTypeName) {
            case 'example':
                if ($parent) {
                    /* subcategory */
                } else {
                    /* category */
                }

                $data = ['example' => 'Hi, From Panda WP'];
                break;
        }

        return $data;
    }

    private function __getGeneralData() {
        $primaryMenu    = new \Timber\Menu('primary-menu');
        $footerMenu     = new \Timber\Menu('footer-menu');

        $primaryMenu->items = array_map(function($item) {
            $url = explode('/', $item->url);

            if (in_array('http:', $url) || in_array('https:', $url)) {
                $url = array_filter($url, function($element, $key){ return $element != '' && $key != 0 && $key != 2; }, ARRAY_FILTER_USE_BOTH);

                $item->slug = implode('/', $url);
                $item->url  = '/' . $item->slug;
                $item->url  = '/' . $item->slug;
            }

            return $item;
        }, $primaryMenu->items);

        $primaryMenu->items = array_filter($primaryMenu->items, function($item) {
            return $item->url;
        });

        $footerMenu->items = array_map(function($item) {
            $url = explode('/', $item->url);

            if (in_array('http:', $url) || in_array('https:', $url)) {
                $url = array_filter($url, function($element, $key){ return $element != '' && $key != 0 && $key != 2; }, ARRAY_FILTER_USE_BOTH);

                $item->slug = implode('/', $url);
                $item->url  = '/' . $item->slug;
                $item->url  = '/' . $item->slug;
            }

            return $item;
        }, $footerMenu->items);

        $footerMenu->items = array_filter($footerMenu->items, function($item) {
            return $item->url;
        });

        return [
            'information' => (object)[
                /* ACF */
                // "phone" => get_field('phone', 'options'),
                // "email" => get_field('email', 'options')
            ],
            'primary_menu'  => $primaryMenu->items,
            'footer_menu'   => $footerMenu->items
        ];
    }
}
