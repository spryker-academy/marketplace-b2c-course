<?php

namespace Pyz\Zed\CustomerMerchantPortalGui\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \Pyz\Zed\CustomerMerchantPortalGui\Communication\CustomerMerchantPortalGuiCommunicationFactory getFactory()
 */
class CustomerController extends AbstractController
{
    /**
     * @return array
     */
    public function indexAction(): array
    {
        $configuration = $this->getFactory()
            ->createCustomerGuiTableConfigurationProvider()
            ->getConfiguration();
       
        return $this->viewResponse([
            'customerTableConfiguration' => $configuration,
        ]);
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tableDataAction(Request $request): Response
    {
        return $this->getFactory()->getGuiTableHttpDataRequestExecutor()->execute(
            $request,
            $this->getFactory()->createCustomerGuiTableDataProvider(),
            $this->getFactory()->createCustomerGuiTableConfigurationProvider()->getConfiguration(),
        );
    }
}
