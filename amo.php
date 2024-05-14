<?php


//$message = '

//Заявка с сайта
//Имя: ' . $_POST['name'] . '
//Телефон: ' . $_POST['phone'];

//$to = 'info@al-baraka.ru';

//$subject = 'Заявка с сайта';

//mail($to, $subject, $message, $headers); 

include 'vendor/autoload.php';

use AmoCRM\{AmoAPI, AmoLead, AmoContact, AmoIncomingLeadForm, AmoAPIException};
use AmoCRM\TokenStorage\DatabaseStorage;

try {

    // // Параметры авторизации по протоколу oAuth 2.0
    //     $clientId     = '6bf3c013-5bea-4eb9-a620-8aa734b1ec14';
    //     $clientSecret = 'UDC5ugtsmPeAvBHrr2xxEK3ECL0NldN6reHxPiVmEJJiFG4rFOvdI6TD1j6xWzuJ';
    //     $authCode     = 'def502009db65fd71046c7e33b424d352e0fe997ee72ad7fc8f7b1cd0d38cde923e3ed551e2b906fe8f9e2a3005ef65ce728ea10cb126bcc4571ce745ac40d9058bf8f243d7eff297c1edf6583f0b432d45a9457e38e298310bada0424cbba1695ea7d2d0def00fd3039416252aa2f7353e302d500d1abea627859ba762c96bb3d181a4cecbfd6a0c9929ce0d38f26bda65a94014a783693649d4bbd92cca548b27d71cdcf06ec6535d80e1f11d675ac876058c13ff0d04cf855ac2b232552b928f8085c0ed97dbd7da7d44fc46b33aa61d04685bd9b58223512413192653b621de5ea5301c01dd54c354b6306bc04f0a2368f3c75024920763ecdaa74904d12178d5defc71f918b0b17fc3f6e219608c58fd11bd796473175c2233bfe579704e106a2b2268577419fbaa5b180c9d80cb21510a8d9c566a60811a29785ea0ae6f515443a11b4305f0e932f6d48796d570525f4b25b12c8b8b7629ac17a4144290fe86d4968d2dc6782f5b84f9ed835c4d1efd2386b7f7ec31f666453c790df39105b06c4e7f5d32cc40de929dd27c43a7b0dfdd1df47f81e96034cbccc64a29e0a9e54f3672ba1bc5d5ac56d27eb6284374620aeb7436fa0de217002829bf6048666c5998d74dd5cc24eadc8a3e72f95f2d1232084ffbe8f162b48f91bee6a0c98b15f5c73cd';
    //     $redirectUri  = 'https://al-baraka.ru/';
    //     $subdomain    = 'infoleartexru';
    

    
    //     // Авторизация
    //     AmoAPI::oAuth2($subdomain, $clientId, $clientSecret, $redirectUri, $authCode);
    


    // Последующие авторизации
    $subdomain = 'inforus453';
    AmoAPI::oAuth2($subdomain);
//
    // Получение информации об аккаунте
     //   print_r(AmoAPI::getAccount());
//
$lead1 = new AmoLead([
        'name'                => 'Заявка с сайта dzort.ru',
        'pipeline'            => [ 'id' => 7540878 ],
   ]);


    $contact1 = new AmoContact([
        'name'                => $_POST['name'],
    ]);
  
  	$contact1->setCustomFields([
      '95017' => [[
         'value' => $_POST['phone'],
         'enum'  => 'WORK'
      ]],
      '540387' => $_POST['contact']
    ]);
  $contactID = $contact1->save();
  $lead1->addContacts($contactID);
  $lead1->addTags([$_POST['formname'], ]);
  $leadId = $lead1->save();


} catch (AmoAPIException $e) {
    printf('Ошибка авторизации (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
} catch (TokenStorageException $e) {
    printf('Ошибка обработки токенов (%d): %s' . PHP_EOL, $e->getCode(), $e->getMessage());
}






