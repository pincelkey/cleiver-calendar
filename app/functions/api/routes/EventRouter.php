<?php

use App\Controllers\EventController;

class EventRouter {
    public function __construct()
    {
        add_action('rest_api_init', function () {
            register_rest_route('custom/v1', '/events/auth', array(
                'methods' => 'GET',
                'callback' => array($this, 'authGoogle'),
                'permission_callback' => function ($request) {
                    return true;
                },
            ));

            register_rest_route('custom/v1', '/events', array(
                'methods' => 'POST',
                'callback' => array($this, 'store'),
                'permission_callback' => function ($request) {
                    return true;
                },
                'args'  => $this::__getArgs(['event', 'code'])
            ));
        });
    }

    public function authGoogle($request) {
        try {
            $data = (new EventController())->getAuthGoogle($request);

            return PandaRouter::__response($data);
        } catch (Exception $e) {
            return PandaRouter::__response((object)[
                'code'      => 404,
                'message'   => $e->getMessage(),
                'status'    => false           
            ]);
        }
    }

    public function store($request) {
        try {
            $data = (new EventController())->createEvent($request);

            return PandaRouter::__response($data);
        } catch (Exception $e) {
            return PandaRouter::__response((object)[
                'code'      => 404,
                'message'   => $e->getMessage(),
                'status'    => false           
            ]);
        }
    }

    private function __getArgs($selectedRules) {
        $rules = [
            'event' => [
                'required'          => true,
                'type'              => 'string',
                'validate_callback' => function($param, $request, $key) {
                    return is_string($param);
                },
            ],
            'code' => [
                'required'          => true,
                'type'              => 'string',
                'validate_callback' => function($param, $request, $key) {
                    return is_string($param);
                },
            ],
        ];

        return $selectedRules
            ? array_intersect_key($rules, array_flip($selectedRules))
            : $rules;
    }
}
