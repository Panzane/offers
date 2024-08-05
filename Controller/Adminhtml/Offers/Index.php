<?php

declare(strict_types=1);

namespace Panzane\Offers\Controller\Adminhtml\Offers;

use Magento\Backend\App\Action;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Panzane_Offers::offers_list';

    /**
     * Execute
     */
    public function execute(): void
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu('Panzane_Offers::offers_list');
        $this->_addBreadcrumb(__('Offers'), __('List'));
        $this->_view->renderLayout();
    }
}
