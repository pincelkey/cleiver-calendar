<?php

namespace App\Controllers;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Exception;

class EventController {
    public function __construct() { }

    public function getAuthGoogle($request) {
        $authGoogleLink = sprintf(
            'https://accounts.google.com/o/oauth2/auth?scope=%s&redirect_uri=%s&response_type=code&client_id=%s&access_type=online',
            urlencode(ENV['GOOGLE_OAUTH_SCOPE']),
            ENV['GOOGLE_CALENDAR_REDIRECT_URI'],
            ENV['GOOGLE_CLIENT_ID']
        );

        return (object)[
            'message'   => 'Google auth link generated!',
            'data'      => $authGoogleLink,
            'status'    => true,
            'code'      => 200
        ];
    }

    public function createEvent($request) {
        try {
            $calendarService = new Google_Service_Calendar(self::__getGoogleClient($request['code']));
            $calendarId = 'primary';

            $event = new Google_Service_Calendar_Event(array(
                'summary' => $request['event'],
                'location' => 'Estadio Lawn Tennis, Avenida General Salaverry, Jesús María',
                'description' => 'Cleiver Calendar, Pruebas!!',
                'start' => array(
                    'dateTime' => '2022-04-05T18:00:00',
                    'timeZone' => 'America/Bogota',
                ),
                'end' => array(
                    'dateTime' => '2022-04-05T20:00:00',
                    'timeZone' => 'America/Bogota',
                ),
                'recurrence' => array(
                    'RRULE:FREQ=DAILY;COUNT=1'
                ),
                'reminders' => array(
                    'useDefault' => FALSE,
                    'overrides' => array(
                        array('method' => 'email', 'minutes' => 24 * 60),
                        array('method' => 'popup', 'minutes' => 10),
                    ),
                ),
            ));

            $event = $calendarService->events->insert($calendarId, $event, ['sendUpdates' => 'all']);

            return (object)[
                'message'   => 'Evente created!',
                'data'      => $event,
                'status'    => true,
                'code'      => 200
            ];
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private function __getGoogleClient($googleAuthCode) {
        $client = new Google_Client();
        $client->setApplicationName('Cleiver Calendar');
        $client->setScopes(Google_Service_Calendar::CALENDAR);
        $client->setAuthConfig(__DIR__ . '/../../assets/auth/credentials.json');
        $client->setAccessType('offline');

        $accessToken = $client->fetchAccessTokenWithAuthCode($googleAuthCode);
        $client->setAccessToken($accessToken);

        if (array_key_exists('error', $accessToken)) {
            throw new Exception(join(', ', $accessToken));
        }

        return $client;
    }
}
