<?php
require_once 'ActiveRecord.php';

class Student {

    /**
     * Return a table (array(array)) of current table description.
     * 
     * @return array(array)
     */
    public function get_student_desc() {
        $record = new ActiveRecord('student');
        return $record->get_table_desc();
    }

    /**
     * Return a table (array(array)) of current table records.
     * 
     * @return array(array)
     */
    public function get_students() {
        $record = new ActiveRecord('student');
        return $record->get_all_rows();
    }

    /**
     * Add record with fields implements in $params array to the database.
     * 
     * @param array @params Array of table field parameters.
     * 
     * @return mixed id of nearly created record or FALSE otherwase.
     */
    public function add(array $params) {
        $record = new ActiveRecord('student');
        $record->set_fields($params);
        if ($record->add()) {
            $record->set_fields(array('id' => -2));
            $record->set_where(array('first_name' => $params['first_name'],
                                    'last_name'   => $params['last_name']));
            $row = $record->get();
            return $row['id'];
        };

        return FALSE;
    }

    /**
     * Delete a record from the database.
     * 
     * @param int|string $id id of record which need to delete.
     * 
     * @return boolean The result of the operation.
     */
    public function delete($id) {
        $record = new ActiveRecord('student');
        $record->set_where(array('id' => $id));
        return $record->delete($id);
    }

    /**
     * Update a record in the database table.
     * 
     * @param array Associative array of new table fields.
     * 
     * @return boolean Result of update operation.
     */
    public function edit($params) {
        $record = new ActiveRecord('student');
        $record->set_fields($params);
        $record->set_where(array('id' => $params['id']));
        return $record->update();
    }
}
