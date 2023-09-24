<?php
return function($kirby, $page) {
    $success = false;
    if ($kirby->request()->is('POST') && get('submit')) {

        // initialize variables
        $alerts      = null;



        // check the honeypot
        if (empty(get('website')) === false) {
            go($page->url());
            exit;
        }

        // get the data and validate the other form fields
        $data = [
            'name'      => get('name'),
            'email'     => get('email'),
            'message' => get('message')
        ];

        $rules = [
            'name'      => ['required', 'min' => 3],
            'email'     => ['required', 'email'],
            'message' => ['required']
        ];

        $messages = [
            'name'      => 'Dieses Feld darf nicht leer sein',
            'email'     => 'Dieses Feld darf nicht leer sein',
            'message' => 'Dieses Feld darf nicht leer sein.'
        ];

        // some of the data is invalid
        if ($invalid = invalid($data, $rules, $messages)) {
            $alerts = $invalid;
        }


        // the data is fine, let's send the email with attachments
        if (empty($alerts)) {
            try {
                $kirby->email([
                    'template' => 'email-contact',
                    'from'     => 'no-reply@techstax.de',
                    'replyTo'  => $data['email'],
                    'to'       => 'hasaan.latif@icloud.com',
                    'subject'     => esc($data['name']) . ' hat Ihnen eine Nachricht über Ihr Kontaktformular gesendet',
                    'data'        => [
                    'name'      => esc($data['name']),
                    ]
                                ]);
            } catch (Exception $error) {
                // we only display a general error message, for debugging use `$error->getMessage()`
                $alerts[] = "Das Formular konnte nicht verarbeitet werden";
            }


            // no exception occurred, let's send a success message
            if (empty($alerts) === true) {
                // store reference and name in the session for use on the success page
                $kirby->session()->set([
                    'name'      => esc($data['name']),
                    'success_email'      => true
                ]);
                // redirect to the success page
            }
        }
    }

    // return data to template
    return [
        'alerts' => $alerts ?? null,
        'data'   => $data   ?? false
    ];
};