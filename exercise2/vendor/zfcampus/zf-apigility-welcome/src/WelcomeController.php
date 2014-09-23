<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2014 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\Apigility\Welcome;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class WelcomeController extends AbstractActionController
{
    public function welcomeAction()
    {
        $viewModel = new ViewModel();
        $viewModel->setTemplate('zf-apigility-welcome/welcome');
        return $viewModel;
    }

    public function redirectAction()
    {
        return $this->redirect()->toRoute('zf-apigility/welcome');
    }
}
