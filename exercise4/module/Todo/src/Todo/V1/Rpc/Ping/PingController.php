<?php
namespace Todo\V1\Rpc\Ping;

use Zend\Mvc\Controller\AbstractActionController;

class PingController extends AbstractActionController
{
    public function pingAction()
    {
        return ['ack' => date('Y-m-d H:i:s')];
    }
}
