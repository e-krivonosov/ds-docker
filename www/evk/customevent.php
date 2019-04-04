<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

\Bitrix\Main\Loader::includeModule('ds.base');

$eventHandler = new \Ds\Base\Event\EventHandler();
$eventHandler->handleUserEvent();

$eventSender = new \Ds\Base\Event\EventSender();
$eventSender->sendUserEvent();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");