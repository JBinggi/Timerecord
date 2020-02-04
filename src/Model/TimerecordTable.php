<?php
/**
 * TimerecordTable.php - Timerecord Table
 *
 * Table Model for Timerecord
 *
 * @category Model
 * @package Timerecord
 * @author Verein onePlace
 * @copyright (C) 2020 Verein onePlace <admin@1plc.ch>
 * @license https://opensource.org/licenses/BSD-3-Clause
 * @version 1.0.0
 * @since 1.0.0
 */

namespace OnePlace\Timerecord\Model;

use Application\Controller\CoreController;
use Application\Model\CoreEntityTable;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Paginator\Paginator;
use Laminas\Paginator\Adapter\DbSelect;

class TimerecordTable extends CoreEntityTable {

    /**
     * TimerecordTable constructor.
     *
     * @param TableGateway $tableGateway
     * @since 1.0.0
     */
    public function __construct(TableGateway $tableGateway) {
        parent::__construct($tableGateway);

        # Set Single Form Name
        $this->sSingleForm = 'timerecord-single';
    }

    /**
     * Get Timerecord Entity
     *
     * @param int $id
     * @return mixed
     * @since 1.0.0
     */
    public function getSingle($id) {
        # Use core function
        return $this->getSingleEntity($id,'Timerecord_ID');
    }

    /**
     * Save Timerecord Entity
     *
     * @param Timerecord $oTimerecord
     * @return int Timerecord ID
     * @since 1.0.0
     */
    public function saveSingle(Timerecord $oTimerecord) {
        $aData = [
            'label' => $oTimerecord->label,
        ];

        $aData = $this->attachDynamicFields($aData,$oTimerecord);

        $id = (int) $oTimerecord->id;

        if ($id === 0) {
            # Add Metadata
            $aData['created_by'] = CoreController::$oSession->oUser->getID();
            $aData['created_date'] = date('Y-m-d H:i:s',time());
            $aData['modified_by'] = CoreController::$oSession->oUser->getID();
            $aData['modified_date'] = date('Y-m-d H:i:s',time());

            # Insert Timerecord
            $this->oTableGateway->insert($aData);

            # Return ID
            return $this->oTableGateway->lastInsertValue;
        }

        # Check if Timerecord Entity already exists
        try {
            $this->getSingle($id);
        } catch (\RuntimeException $e) {
            throw new \RuntimeException(sprintf(
                'Cannot update timerecord with identifier %d; does not exist',
                $id
            ));
        }

        # Update Metadata
        $aData['modified_by'] = CoreController::$oSession->oUser->getID();
        $aData['modified_date'] = date('Y-m-d H:i:s',time());

        # Update Timerecord
        $this->oTableGateway->update($aData, ['Timerecord_ID' => $id]);

        return $id;
    }

    /**
     * Generate new single Entity
     *
     * @return Timerecord
     * @since 1.0.0
     */
    public function generateNew() {
        return new Timerecord($this->oTableGateway->getAdapter());
    }
}