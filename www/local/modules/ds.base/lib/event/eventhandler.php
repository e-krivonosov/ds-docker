<?php
namespace Ds\Base\Event;
use Bitrix\Main\EventManager;
use Bitrix\Main\EventResult;

class EventHandler
{
    /**
     *
     */
    public function handleUserEvent()
    {
        $this->handleClosure();
        $this->handleMethod();
        $this->handleClosureMethod();
    }

    /**
     * @param \Bitrix\Main\Event $event
     * @return EventResult
     */
    public static function handlerOnCustomEvent($event)
    {
        $params = $event->getParameters();

        $params['EVENT']->part3 = [
            'part_3' => 'description 3',
        ];

        return new EventResult(EventResult::SUCCESS, $params, $event->getModuleId());
    }

    /**
     * @param string $code
     * @return \Closure
     */
    public static function handlerClosureOnCustomEvent($code=null)
    {
        return function ($event) use($code) {
            /**
             * @var \Bitrix\Main\Event $event
             */
            $params = $event->getParameters();

            $params['EVENT']->part5 = [
                'part_5' => 'description 5',
                'code' => $code,
            ];

            return new EventResult(EventResult::ERROR, $params, $event->getModuleId());
        };
    }

    /**
     *
     */
    protected function handleClosure()
    {
        EventManager::getInstance()->addEventHandler('ds.base', 'OnCustomEvent', function ($event){
            /**
             * @var \Bitrix\Main\Event $event
             */
            $params = $event->getParameters();

            $params['EVENT']->part4 = [
                'part_4' => 'description 4',
            ];

            return $params;
        });
    }

    /**
     *
     */
    protected function handleMethod()
    {
        EventManager::getInstance()->addEventHandler('ds.base', 'OnCustomEvent', [
            __CLASS__, 'handlerOnCustomEvent'
        ]);
    }

    /**
     *
     */
    protected function handleClosureMethod()
    {
        EventManager::getInstance()->addEventHandler('ds.base', 'OnCustomEvent', self::handlerClosureOnCustomEvent('events'));
    }
}