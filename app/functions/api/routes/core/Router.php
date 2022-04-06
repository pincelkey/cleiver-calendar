<?php

class PandaRouter {
    public static function __response($data) {
        if ($data->code >= 200 && $data->code <= 300) {
            return new WP_REST_Response($data, $data->status);
        } else {
            return new WP_Error( $data->code, __($data->message), array( 'status' => $data->status ) );
        }
    }
}
