<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Spryker Marketplace License Agreement. See LICENSE file.
 */

namespace Pyz\Zed\CustomerMerchantPortalGui\Communication\ConfigurationProvider;

use Generated\Shared\Transfer\GuiTableConfigurationTransfer;
use Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface;
use Spryker\Shared\GuiTable\GuiTableFactoryInterface;

class CustomerGuiTableConfigurationProvider
{
    /**
     * @var string
     */
    public const COL_KEY_ID_CUSTOMER = 'id_customer';

    /**
     * @var string
     */
    public const COL_KEY_CREATED_AT = 'created_at';

    /**
     * @var string
     */
    public const COL_KEY_EMAIL = 'email';

    /**
     * @var string
     */
    public const COL_KEY_FIRST_NAME = 'first_name';

    /**
     * @var string
     */
    public const COL_KEY_LAST_NAME = 'last_name';

    /**
     * @var string
     */
    public const COL_KEY_STATUS = 'registered';

    /**
     * @uses \Pyz\Zed\BackUpCustomerMerchantPortalGui\Communication\Controller\IndexController::tableDataAction()
     *
     * @var string
     */
    protected const DATA_URL = '/customer-merchant-portal-gui/customer/table-data';

    /**
     * @var \Spryker\Shared\GuiTable\GuiTableFactoryInterface
     */
    protected GuiTableFactoryInterface $guiTableFactory;

    /**
     * @param \Spryker\Shared\GuiTable\GuiTableFactoryInterface $guiTableFactory
     */
    public function __construct(GuiTableFactoryInterface $guiTableFactory)
    {
        $this->guiTableFactory = $guiTableFactory;
    }

    /**
     * @return \Generated\Shared\Transfer\GuiTableConfigurationTransfer
     */
    public function getConfiguration(): GuiTableConfigurationTransfer
    {
        $guiTableConfigurationBuilder = $this->guiTableFactory->createConfigurationBuilder();

        $guiTableConfigurationBuilder = $this->addColumns($guiTableConfigurationBuilder);

        $guiTableConfigurationBuilder
            ->setDataSourceUrl(static::DATA_URL)
            ->setDefaultPageSize(25);

        return $guiTableConfigurationBuilder->createConfiguration();
    }

    /**
     * @param \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder
     *
     * @return \Spryker\Shared\GuiTable\Configuration\Builder\GuiTableConfigurationBuilderInterface
     */
    protected function addColumns(GuiTableConfigurationBuilderInterface $guiTableConfigurationBuilder
    ): GuiTableConfigurationBuilderInterface {
        $guiTableConfigurationBuilder
            ->addColumnText(static::COL_KEY_ID_CUSTOMER, 'Reference', true, false)
            ->addColumnDate(static::COL_KEY_CREATED_AT, 'Registration Date', true, true)
            ->addColumnText(static::COL_KEY_EMAIL, 'Email', true, true)
            ->addColumnText(static::COL_KEY_LAST_NAME, 'Last Name', true, true)
            ->addColumnText(static::COL_KEY_FIRST_NAME, 'First Name', true, true)
            ->addColumnText(static::COL_KEY_STATUS, 'Status', true, true);

        return $guiTableConfigurationBuilder;
    }
}
