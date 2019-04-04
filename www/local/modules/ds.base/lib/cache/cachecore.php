<?php
namespace Ds\Base\Cache;
use Bitrix\Main\EventManager;
use Bitrix\Main\EventResult;

class CacheCore
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
        $obCache = new \CPHPCache();
        //        $obCache->Clean($this->cacheId, $this->cachePath);

        $arResult = [];

        if($obCache->InitCache($this->cacheTime, $this->cacheId, $this->cachePath)) { // получаем только закэшированные переменные
            $vars = $obCache->GetVars();
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
        }

        if($obCache->StartDataCache($this->cacheTime, $this->cacheId, $this->cachePath)) { // получаем только закэшированный html-вывод

            global $CACHE_MANAGER;
            $CACHE_MANAGER->StartTagCache($this->cachePath);
            $CACHE_MANAGER->RegisterTag($this->cacheTag);
            $CACHE_MANAGER->EndTagCache();
            echo 'generate cache'."<br/>";
            print_r($arResult);
            echo "<br/>";
            $obCache->EndDataCache(compact('arResult'));

        }
    }
}