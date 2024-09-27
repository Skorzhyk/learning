<?php

namespace Magecom\Learning\Controller\Index;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Psr\Log\LoggerInterface;

/**
 * Magecom Learning Items controller
 *
 * @category Magecom
 * @package Magecom\Learning\Controller\Index
 * @author  Magecom
 */
class Index extends Action
{
    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @var LoggerInterface
     */
    protected $_logger;

    /**
     * @var LoggerInterface
     */
    protected $_learningLogger;

    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param LoggerInterface $logger
     */
    public function __construct(Context $context, PageFactory $resultPageFactory, LoggerInterface $logger, LoggerInterface $learningLogger)
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
        $this->_logger = $logger;
        $this->_learningLogger = $learningLogger;
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {

        $request = $this->getRequest();
        $logger = $this->_logger;
        $message = "Module: " . $request->getModuleName() . "; Controller: " . $request->getControllerName() . "; Action: " . $request->getActionName();
        $logger->debug($message);
        $logger->info($message);
        $this->_learningLogger->notice($message);
        $logger->warning($message);
        $logger->error($message);
        $logger->critical($message);
        $logger->alert($message);
        $logger->emergency($message);

        $resultPage = $this->_resultPageFactory->create();

        $testLine = 11;

        $testLine = 12;

        return $resultPage;
    }
}
