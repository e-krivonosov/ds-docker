<?php
namespace Ds\Base\Cache;
use Bitrix\Main\EventManager;
use Bitrix\Main\EventResult;

class CacheD7Managed
{
    public $cacheId = 'evk';
    public $cacheTime = 3600;
    public $cachePath = 'evk';
    public $cacheTag = 'evk_tag';
    /**
     *
     */
    public function testCache()
    {
        $obCache = \Bitrix\Main\Application::getInstance()->getManagedCache();
        //$obCache->forceRewriting(true);
        if ($obCache->read($this->cacheTime, $this->cacheId)) {
            $vars = $obCache->get($this->cacheId); // достаем переменные из кеша
            if(is_array($vars) && extract($vars)) {
                /**
                 * @var array $arResult
                 */
                echo 'From cache'."<br/>";
                print_r($arResult);
                echo "<br/>";
            }
        } else {
            $arResult = [
                'time' => date('Y-m-d H:i:s'),
                'uniqId' => uniqid(),
                'data_str' => 'hello world!',
            ];
            echo 'generate cache'."<br/>";
            print_r($arResult);
            echo "<br/>";
            $obCache->set($this->cacheId, compact('arResult')); // записываем в кеш
        }
    }
}