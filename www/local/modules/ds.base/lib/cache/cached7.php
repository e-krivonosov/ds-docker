<?php
namespace Ds\Base\Cache;
use Bitrix\Main\EventManager;
use Bitrix\Main\EventResult;

class CacheD7
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
        $obCache = \Bitrix\Main\Data\Cache::createInstance();
        //        $obCache->forceRewriting(true);

        if($obCache->initCache($this->cacheTime, $this->cacheId, $this->cachePath)) { // получаем только закэшированные переменные
            $vars = $obCache->getVars();
            if(is_array($vars) && extract($vars)) {
                /**
                 * @var array $arResult
                 */
                echo 'From cache'."<br/>";
                print_r($arResult);
                echo "<br/>";
                //                $obCache->forceRewriting(true);
            }
        }
        if($obCache->startDataCache($this->cacheTime, $this->cacheId, $this->cachePath)) { // получаем только закэшированный html-вывод
            $arResult = [
                'time' => date('Y-m-d H:i:s'),
                'uniqId' => uniqid(),
                'data_str' => 'hello world!',
            ];
            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache($this->cachePath);
            $CACHE_MANAGER->RegisterTag($this->cacheTag);
            $CACHE_MANAGER->EndTagCache();
            echo 'generate cache'."<br/>";
            print_r($arResult);
            echo "<br/>";
            $obCache->endDataCache(compact('arResult'));
        }
    }
}