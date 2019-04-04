<?php
namespace Ds\Base\Event;
use Bitrix\Main\EventResult;

class EventSender
{
    /**
     *
     */
    public function sendUserEvent()
    {
        $obArg = new EventArg();
        $params = ['EVENT' => $obArg];
        $event = new \Bitrix\Main\Event("ds.base", "OnCustomEvent", $params);
        $event->send();
        foreach ($event->getResults() as $eventResult)
        {
            switch($eventResult->getType())
            {
                case EventResult::ERROR:
                    // обработка ошибки

                    $newParams = $eventResult->getParameters(); // получаем то, что вернул нам обработчик события

                    echo '<pre>'.print_r([
                            'new_params' => $newParams,
                            'success' => false,
                        ], true).'</pre>';

                    break;
                case EventResult::SUCCESS:
                    // успешно
                    $newParams = $eventResult->getParameters(); // получаем то, что вернул нам обработчик события

                    echo '<pre>'.print_r([
                            'new_params' => $newParams,
                            'success' => true,
                        ], true).'</pre>';

                    break;
                case EventResult::UNDEFINED:
                    /* обработчик вернул неизвестно что вместо объекта класса \Bitrix\Main\EventResult
                    его результат по прежнему доступен через getParameters
                    */

                    $newParams = $eventResult->getParameters(); // получаем то, что вернул нам обработчик события

                    echo '<pre>'.print_r([
                            'new_params' => $newParams,
                            'success' => false,
                        ], true).'</pre>';

                    break;
            }
        }
    }
}