<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    const ADVERT_TYPE = "advert_type_id";
    const PRICE = "price";
    const LOCATION = "local_council_id";
    const PROPERTY_TYPE = "property_type_id";
    const PROPERTY_CATEGORY = "property_category_id";
    const PROPERTY_FINISHING_STATE = "property_finishing_state_id";
	const REC_STATUS_DELETED = 0;
    const REC_STATUS_ACTIVE = 1;
    const REC_STATUS_HIDDEN = 2;

    /**
     * soft delete
     */
    public function delete($id = null, $cascade = true) {
        if (empty($id) && !empty($this->id)) {
            $id = $this->id;
        }
        if (!empty($id)) {
            $this->read(null, $id);
            if ($this->hasField("rec_status")) {
                $this->markDeleted();
                return $this->save();
            } else {
                return parent::delete();
            }
            
        }
        return false;
    }

    private function markDeleted() {
        $this->set("rec_status", self::REC_STATUS_DELETED);
    }
}
