<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @copyright   Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Magento\Backend\Model;

class View extends \Magento\App\View
{
    /**
     * @var \Magento\Core\Model\Layout\Filter\Acl
     */
    protected $_aclFilter;

    /**
     * @param \Magento\View\LayoutInterface $layout
     * @param \Magento\App\RequestInterface $request
     * @param \Magento\App\ResponseInterface $response
     * @param \Magento\Config\ScopeInterface $configScope
     * @param \Magento\Event\ManagerInterface $eventManager
     * @param \Magento\Core\Model\Translate $translator
     * @param \Magento\App\ActionFlag $actionFlag
     * @param \Magento\Core\Model\Layout\Filter\Acl $aclFilter
     */
    public function __construct(
        \Magento\View\LayoutInterface $layout,
        \Magento\App\RequestInterface $request,
        \Magento\App\ResponseInterface $response,
        \Magento\Config\ScopeInterface $configScope,
        \Magento\Event\ManagerInterface $eventManager,
        \Magento\Core\Model\Translate $translator,
        \Magento\App\ActionFlag $actionFlag,
        \Magento\Core\Model\Layout\Filter\Acl $aclFilter
    ) {
        $this->_aclFilter = $aclFilter;
        parent::__construct($layout, $request, $response, $configScope, $eventManager, $translator, $actionFlag);
    }


    /**
     * {@inheritdoc}
     */
    public function loadLayout($handles = null, $generateBlocks = true, $generateXml = true)
    {
        parent::loadLayout($handles, false, $generateXml);
        $this->_aclFilter->filterAclNodes($this->getLayout()->getNode());
        if ($generateBlocks) {
            $this->generateLayoutBlocks();
            $this->_isLayoutLoaded = true;
        }
        $this->getLayout()->initMessages();
        return $this;
    }

} 
