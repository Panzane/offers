<?php

declare(strict_types=1);

namespace Panzane\Offers\Controller\Adminhtml\Offers;

use Magento\Backend\App\Action;

class Add extends Action
{
    const ADMIN_RESOURCE = 'Panzane_Offers::offers_add';

    /**
     * Execute
     */
    public function execute(): void
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Panzane_Offers::offers_add');
        $this->_addBreadcrumb(__('Offers'), __('Add an offer'));
        $this->_view->renderLayout();
    }
}
