<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

//(new CPHPCache())->CleanDir();
//\Bitrix\Main\Application::getInstance()->getManagedCache()->cleanAll();

\Bitrix\Main\Loader::includeModule('ds.base');
/**
 * PHP - HTML cache
 */
$cacheCode = new \Ds\Base\Cache\CacheCore();
$cacheCode->testCache();

/**
 * PHP - HTML cache
 */
$cacheD7 = new \Ds\Base\Cache\CacheD7();
$cacheCode->testCache();

/**
 * Только php-cache
 */
$cacheD7Managed = new \Ds\Base\Cache\CacheD7Managed();
$cacheD7Managed->testCache();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");