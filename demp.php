<?php


function test(){

    $ios = new \tencent\tpns\iOSMessage();
    $ios->custom = "{\"test\":\"123\"}";


    $tpns = new \tencent\tpns\Tpns();

    $req = $tpns->NewRequest(
        $tpns->WithAudienceType($tpns::AUDIENCE_TOKEN),
        $tpns->WithMessageType($tpns::MESSAGE_NOTIFY),
        $tpns->WithTitle('test-title'),
        $tpns->WithContent('test-content'),
        $tpns->WithIOSMessage($ios),
        $tpns->WithTokenList(['abc']),
        $tpns->WithEnvironment($tpns::ENVIRONMENT_PROD)
    );

    $stub = new \tencent\tpns\Stub(123123,'aaaaa',$tpns::SINGAPORE);

    $result = $stub->Push($req);

    var_dump($result);
}

test();