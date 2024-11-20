<?php

namespace Pyz\Zed\CustomerMerchantPortalGui\Communication;

use Pyz\Zed\CustomerMerchantPortalGui\Communication\ConfigurationProvider\CustomerGuiTableConfigurationProvider;
use Pyz\Zed\CustomerMerchantPortalGui\Communication\DataProvider\CustomerGuiTableDataProvider;
use Pyz\Zed\CustomerMerchantPortalGui\CustomerMerchantPortalGuiDependencyProvider;
use Spryker\Shared\GuiTable\GuiTableFactoryInterface;
use Spryker\Shared\GuiTable\Http\GuiTableDataRequestExecutorInterface;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

class CustomerMerchantPortalGuiCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return CustomerGuiTableConfigurationProvider
     */
    public function createCustomerGuiTableConfigurationProvider(): CustomerGuiTableConfigurationProvider
    {
        return new CustomerGuiTableConfigurationProvider(
            $this->getGuiTableFactory()
        );
    }

    /**
     * @return GuiTableFactoryInterface
     */
    public function getGuiTableFactory(): GuiTableFactoryInterface
    {
        return $this->getProvidedDependency(CustomerMerchantPortalGuiDependencyProvider::SERVICE_GUI_TABLE_FACTORY);
    }

    /**
     * @return CustomerGuiTableDataProvider
     */
    public function createCustomerGuiTableDataProvider(): CustomerGuiTableDataProvider
    {
        return new CustomerGuiTableDataProvider(
            $this->getCustomerFacade()
        );
    }

    /**
     * @return \Spryker\Zed\Customer\Business\CustomerFacadeInterface
     */
    public function getCustomerFacade(): CustomerFacadeInterface
    {
        return $this->getProvidedDependency(CustomerMerchantPortalGuiDependencyProvider::FACADE_CUSTOMER);
    }

    /**
     * @return \Spryker\Shared\GuiTable\Http\GuiTableDataRequestExecutorInterface
     */
    public function getGuiTableHttpDataRequestExecutor(): GuiTableDataRequestExecutorInterface
    {
        return $this->getProvidedDependency(
            CustomerMerchantPortalGuiDependencyProvider::SERVICE_GUI_TABLE_HTTP_DATA_REQUEST_EXECUTOR
        );
    }
}
