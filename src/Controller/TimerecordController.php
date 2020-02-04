<?php
/**
 * TimerecordController.php - Main Controller
 *
 * Main Controller Timerecord Module
 *
 * @category Controller
 * @package Timerecord
 * @author Verein onePlace
 * @copyright (C) 2020  Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

declare(strict_types=1);

namespace OnePlace\Timerecord\Controller;

use Application\Controller\CoreEntityController;
use Application\Model\CoreEntityModel;
use OnePlace\Timerecord\Model\Timerecord;
use OnePlace\Timerecord\Model\TimerecordTable;
use Laminas\View\Model\ViewModel;
use Laminas\Db\Adapter\AdapterInterface;

class TimerecordController extends CoreEntityController {
    /**
     * Timerecord Table Object
     *
     * @since 1.0.0
     */
    protected $oTableGateway;

    /**
     * TimerecordController constructor.
     *
     * @param AdapterInterface $oDbAdapter
     * @param TimerecordTable $oTableGateway
     * @since 1.0.0
     */
    public function __construct(AdapterInterface $oDbAdapter,TimerecordTable $oTableGateway,$oServiceManager) {
        $this->oTableGateway = $oTableGateway;
        $this->sSingleForm = 'timerecord-single';
        parent::__construct($oDbAdapter,$oTableGateway,$oServiceManager);

        if($oTableGateway) {
            # Attach TableGateway to Entity Models
            if(!isset(CoreEntityModel::$aEntityTables[$this->sSingleForm])) {
                CoreEntityModel::$aEntityTables[$this->sSingleForm] = $oTableGateway;
            }
        }
    }

    /**
     * Timerecord Index
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function indexAction() {

        # You can just use the default function and customize it via hooks
        # or replace the entire function if you need more customization
        return $this->generateIndexView('timerecord');
    }

    /**
     * Timerecord Add Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function addAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * timerecord-add-before (before show add form)
         * timerecord-add-before-save (before save)
         * timerecord-add-after-save (after save)
         */
        return $this->generateAddView('timerecord');
    }

    /**
     * Timerecord Edit Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function editAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * timerecord-edit-before (before show edit form)
         * timerecord-edit-before-save (before save)
         * timerecord-edit-after-save (after save)
         */
        return $this->generateEditView('timerecord');
    }

    /**
     * Timerecord View Form
     *
     * @since 1.0.0
     * @return ViewModel - View Object with Data from Controller
     */
    public function viewAction() {
        /**
         * You can just use the default function and customize it via hooks
         * or replace the entire function if you need more customization
         *
         * Hooks available:
         *
         * timerecord-view-before
         */
        return $this->generateViewView('timerecord');
    }
}
