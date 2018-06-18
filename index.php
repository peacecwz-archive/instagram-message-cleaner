<?php
set_time_limit(0);
date_default_timezone_set('UTC');
require __DIR__.'/vendor/autoload.php';

$username = 'Your-Username';
$password = 'Your-Password';
$debug = false;
$truncatedDebug = false;

$ig = new \InstagramAPI\Instagram($debug, $truncatedDebug);
try {
    //Login your username and password
    $ig->login($username, $password);
} catch (\Exception $e) {
    echo 'Something went wrong: '.$e->getMessage()."/n";
    exit(0);
}

try {
    //Get your inbox
    $directs = $ig->direct->getInbox();
    //Get your threads of inbox
    $threads = $directs->getInbox()->getThreads();
    for($i=0;$i < sizeof($threads); $i++){
        //Get messages from thread
        $threadItems = $threads[$i]->getItems();
        for($j=0;$j<sizeof(threadItems);$j++){
            //Delete message
            $ig->direct->deleteItem($threads[$i]->getThreadId(), $threadItems[$j]->getItemId());
        }
    }
} catch (\Exception $e) {
    echo 'Something went wrong: '.$e->getMessage()."\n";
}