<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerMerchantPortalGui\Communication\DataProvider;

use Generated\Shared\Transfer\CustomerCollectionTransfer;
use Generated\Shared\Transfer\CustomerTableCriteriaTransfer;
use Generated\Shared\Transfer\GuiTableDataRequestTransfer;
use Generated\Shared\Transfer\GuiTableDataResponseTransfer;
use Generated\Shared\Transfer\GuiTableRowDataResponseTransfer;
use Generated\Shared\Transfer\PaginationTransfer;
use Pyz\Zed\CustomerMerchantPortalGui\Communication\ConfigurationProvider\CustomerGuiTableConfigurationProvider;
use Spryker\Shared\GuiTable\DataProvider\AbstractGuiTableDataProvider;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Customer\Business\CustomerFacadeInterface;
use Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade\SalesMerchantPortalGuiToCurrencyFacadeInterface;
use Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade\SalesMerchantPortalGuiToMerchantUserFacadeInterface;
use Spryker\Zed\SalesMerchantPortalGui\Dependency\Facade\SalesMerchantPortalGuiToMoneyFacadeInterface;

/**
 *
 */
class CustomerGuiTableDataProvider extends AbstractGuiTableDataProvider
{

    /**
     * @var CustomerFacadeInterface
     */
    protected CustomerFacadeInterface $customerFacade;


    /**
     * @var SalesMerchantPortalGuiToMerchantUserFacadeInterface
     */
    protected SalesMerchantPortalGuiToMerchantUserFacadeInterface $merchantUserFacade;


    /**
     * @var SalesMerchantPortalGuiToCurrencyFacadeInterface
     */
    protected SalesMerchantPortalGuiToCurrencyFacadeInterface $currencyFacade;


    /**
     * @var SalesMerchantPortalGuiToMoneyFacadeInterface
     */
    protected SalesMerchantPortalGuiToMoneyFacadeInterface $moneyFacade;


    /**
     * @param CustomerFacadeInterface $customerFacade
     */
    public function __construct(CustomerFacadeInterface $customerFacade)
    {
        $this->customerFacade = $customerFacade;
    }


    /**
     * @param GuiTableDataRequestTransfer $guiTableDataRequestTransfer
     * @return AbstractTransfer
     */
    protected function createCriteria(GuiTableDataRequestTransfer $guiTableDataRequestTransfer): AbstractTransfer
    {
        return new CustomerTableCriteriaTransfer();
    }


    /**
     * @param AbstractTransfer $criteriaTransfer
     * @return GuiTableDataResponseTransfer
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\NullValueException
     */
    protected function fetchData(AbstractTransfer $criteriaTransfer): GuiTableDataResponseTransfer
    {
        $paginationTransfer = new PaginationTransfer();
        $pagination = $paginationTransfer
            ->setPage($criteriaTransfer->getPageOrFail())
            ->setMaxPerPage($criteriaTransfer->getPageSizeOrFail());
        $customerCollectionTransfer = (new CustomerCollectionTransfer())
            ->setPagination($pagination);

        $customerCollectionTransfer = $this->customerFacade
            ->getCustomerCollection($customerCollectionTransfer);
        /** @var GuiTableDataRequestTransfer $guiTableDataResponseTransfer */
        $guiTableDataResponseTransfer = new GuiTableDataResponseTransfer();

        foreach ($customerCollectionTransfer->getCustomers() as $customerTransfer) {
            $responseData = [
                CustomerGuiTableConfigurationProvider::COL_KEY_ID_CUSTOMER => $customerTransfer->getIdCustomer(),
                CustomerGuiTableConfigurationProvider::COL_KEY_CREATED_AT => $customerTransfer->getCreatedAt(),
                CustomerGuiTableConfigurationProvider::COL_KEY_EMAIL => $customerTransfer->getEmail(),
                CustomerGuiTableConfigurationProvider::COL_KEY_LAST_NAME => $customerTransfer->getLastName(),
                CustomerGuiTableConfigurationProvider::COL_KEY_FIRST_NAME => $customerTransfer->getFirstName(),
                CustomerGuiTableConfigurationProvider::COL_KEY_STATUS => $customerTransfer->getRegistered(
                ) ? 'Verified' : 'Unverified',
            ];

            $guiTableDataResponseTransfer->addRow(
                (new GuiTableRowDataResponseTransfer())->setResponseData($responseData)
            );
        }

        $paginationTransfer = $customerCollectionTransfer->getPaginationOrFail();

        return $guiTableDataResponseTransfer
            ->setPage($paginationTransfer->getPageOrFail())
            ->setPageSize($paginationTransfer->getMaxPerPageOrFail())
            ->setTotal($paginationTransfer->getNbResultsOrFail());
    }
}
