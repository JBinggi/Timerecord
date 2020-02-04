<?php
/**
 * ExportController.php - Timerecord Export Controller
 *
 * Main Controller for Timerecord Export
 *
 * @category Controller
 * @package Timerecord
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace OnePlace\Timerecord\Controller;

use Application\Controller\CoreController;
use Application\Controller\CoreExportController;
use OnePlace\Timerecord\Model\TimerecordTable;
use Laminas\Db\Sql\Where;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\View\Model\ViewModel;


class ExportController extends CoreExportController
{
    /**
     * ApiController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param TimerecordTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,TimerecordTable $oTableGateway,$oServiceManager) {
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);
    }


    /**
     * Dump Timerecords to excel file
     *
     * @return ViewModel
     * @since 1.0.0
     */
    public function dumpAction() {
        $this->layout('layout/json');

        # Use Default export function
        $aViewData = $this->exportData('Timerecords','timerecord');

        # return data to view (popup)
        return new ViewModel($aViewData);
    }
}