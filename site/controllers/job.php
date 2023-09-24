<?php
return function($kirby, $page) {

    if ($kirby->request()->is('POST') && get('submit')) {

        // initialize variables
        $alerts      = null;
        $attachments = [];

        // check the honeypot
        if (empty(get('website')) === false) {
            go($page->url());
            exit;
        }

        // get the data and validate the other form fields
        $data = [
            'name'      => get('name'),
            'email'     => get('email'),
            'reference' => get('reference'),
            'telephone' => get('telephone')

        ];

        $rules = [
            'name'      => ['required', 'min' => 3],
            'email'     => ['required', 'email'],
            'reference' => ['required']
        ];

        $messages = [
            'name'      => 'Please enter a valid name.',
            'email'     => 'Please enter a valid email address.',
            'reference' => 'Please enter a valid reference.'
        ];

        // some of the data is invalid
        if ($invalid = invalid($data, $rules, $messages)) {
            $alerts = $invalid;
        }

        // get the uploads

        $cv = $kirby->request()->files()->get('cv');
        if ($cv['error'] === 4) {
            $alerts[] = 'Sie müssen mindestens eine Datei anhängen';
        //  stellen Sie sicher, dass keine anderen Fehler vorliegen  
        } elseif ($cv['error'] !== 0) {
            $alerts['file'] = 'Die Datei konnte nicht hochgeladen werden';
        // stellen Sie sicher, dass die Datei nicht größer als 2 MB ist  
        } elseif ($cv['size'] > 2000000)  {
            $alerts['file'] = $cv['name'] . ' ist größer als 2 MB';
        // ...und die Datei ein PDF ist
        } elseif ($cv['type'] !== 'application/pdf') {
            $alerts['file'] = $cv['name'] . ' ist kein PDF';
        // alles gültig, versuchen Sie, die temporäre Datei umzubenennen
        } else {
    
            $name     = $cv['tmp_name'];
            $tmpName  = pathinfo($name);
            // sanitize the original filename
            $filename = $tmpName['dirname']. '/'. F::safeName($cv['name']);

            if (rename($cv['tmp_name'], $filename)) {
                $name = $filename;
            }
            // add the files to the attachments array
            $attachments[] = $name;
        }


        if(!($kirby->request()->files()->get('document')['error'] === 4)){
        $upload = $kirby->request()->files()->get('document');
            // make sure the user uploads at least one file
            if ($upload['error'] === 4) {

            //  stellen Sie sicher, dass keine anderen Fehler vorliegen  
            } elseif ($upload['error'] !== 0) {
                $alerts['file'] = 'Die Datei konnte nicht hochgeladen werden: Weiteres Dokument';
            // stellen Sie sicher, dass die Datei nicht größer als 2 MB ist  
            } elseif ($upload['size'] > 2000000)  {

                $alerts['file'] = $upload['name'] . ' ist größer als 2 MB';
            // ...und die Datei ein PDF ist
            } elseif ($upload['type'] !== 'application/pdf') {

                $alerts['file'] = $upload['name'] . ' ist kein PDF';
            // alles gültig, versuchen Sie, die temporäre Datei umzubenennen
            } else {

                $name     = $upload['tmp_name'];
                $tmpName  = pathinfo($name);
                // sanitize the original filename
                $filename = $tmpName['dirname']. '/'. F::safeName($upload['name']);

                if (rename($upload['tmp_name'], $filename)) {
                    $name = $filename;
                }
                // add the files to the attachments array
                $attachments[] = $name;
        }
    }

        // the data is fine, let's send the email with attachments
        if (empty($alerts)) {
            try {
                $kirby->email([
                    'template' => 'email-job',
                    'from'     => 'no-reply@techstax.de',
                    'replyTo'  => $data['email'],
                    'to'       => 'hasaan.latif@icloud.com',
                    'subject'     => esc($data['name']) . ' hat eine Bewerbung für die Stelle ' . esc($data['reference']) .' gesendet',
                    'data'        => [
                        'name'      => esc($data['name']),
                        'email'      => esc($data['email']),
                        'tel' => esc($data['telephone']),
                        'reference' => esc($data['reference'])
                    ],
                    'attachments' => $attachments
                ]);
            } catch (Exception $error) {
                // we only display a general error message, for debugging use `$error->getMessage()`
                $alerts['general'] = "The email could not be sent";

            }



            // no exception occurred, let's send a success message
            if (empty($alerts) === true) {
                // store reference and name in the session for use on the success page
                $kirby->session()->set([
                    'reference' => esc($data['reference']),
                    'name'      => esc($data['name'])
                ]);
                // redirect to the success page
                go('success');
            }
        }
    }



    // return data to template
    return [
        'alerts' => $alerts ?? null,
        'data'   => $data   ?? false,
    ];
};