<?php
return [
    'auth' => [
        'methods' => ['code', 'password']
    ],
    'debug' => true,
    'panel' =>[
          'install' => true
    ],
    'email' => [
        'transport' => [
          'type' => 'smtp',
          'host' => 'smtp.IONOS.de',
          'port' => 587,
          'security' => true,
          'auth' => true,
          'username' => 'no-reply@techstax.de',
          'password' => 'LoginSven123#3212001!!',
        ]
      ]
];