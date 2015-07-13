<?php
class ActiveRecord {

    const DOMAIN   = 'localhost';
    const USER     = 'root';
    const PASSWORD = 'pa$$word';
    const DATABASE = 'mindk';

    /**
     * @var string Name of the table which record is represents.
     */
    private $table = '';

    /**
     * @var array Fields of our record.
     */
    private $fields = array();

    /**
     * @var MYSQLI $connection Is a connection to the database.
     */
    private $connection = null;

    /**
     * @var string Wheare clause.
     */
    private $where = '';

    /**
     * Constructor. Creates a new connection to the database.
     *
     * @param strint $table_name The name of the table tied with.
     */
    public function __construct($table_name = '') {
        $this->table = $table_name;
        $this->connection = new MySQLI(self::DOMAIN, self::USER,
                                    self::PASSWORD, self::DATABASE);
    }

    /**
     * Close connection to the database.
     */
    public function __destruct() {
        $this->connection->close();
    }

    /**
     * Set table name with witch we will be work.
     */
    public function set_table($table_name = '') {
        $this->table = $table_name;
    }

    /**
     * Set fields of the record.
     *
     * @var array $fields - An associative array of the new fields.
     */
    public function set_fields(array $fields) {
        $this->fields = $fields;
        $this->fields = array_change_key_case($this->fields, CASE_LOWER);
    }

    /**
     * Add a new record to the database.
     *
     * @return boolean Result of sql insertion TRUE - success FALSE otherwise.
     */
    public function add() {
        $fields_definition = '';
        $fields_values     = '';
        foreach ($this->fields as $name => $value) {
            $fields_definition .= '`' . $name  . '`, ';
            $fields_values     .= '\''. $value . '\', ';
        }

        $fields_definition = chop($fields_definition, ', ');
        $fields_values     = chop($fields_values, ', ');

        $query  = 'INSERT INTO `' . $this->table . '`'
                    . ' (' . $fields_definition
                    . ' ) VALUES ( ' . $fields_values . ' )';

        return $this->connection->query($query);
    }

    /**
     * Update record.
     *
     * @return boolen Update result.
     */
    public function update() {
        $fields = '';
        foreach ($this->fields as $name => $value) {
            if ($name != 'id') {
                $fields .= '`' . $name . '` = \'' . $value . '\', ';
            }
        }

        $fields = rtrim($fields, ', ');

        $query = 'UPDATE `' . $this->table . '` SET '
                . $fields . $this->where;

        return $this->connection->query($query);
    }

    /**
     * Delete record.
     *
     * @return boolean. Result of deleting a record.
     */
    public function delete() {
        $query = 'DELETE FROM `' . $this->table . '`' . $this->where;

        return $this->connection->query($query);
    }

    /**
     * @return array An array of all records in the table.
     */
    public function get_all_rows() {
        $query  = 'SELECT * FROM ' . $this->table;
        $res    = $this->connection->query($query);
        $array = array();
        while ( $row = $res->fetch_array(MYSQLI_ASSOC) ) {
            $array[] = $row;
        }
        $res->free();
        return $array;
    }

    /**
     * @return array An array of the table description.
     */
    public function get_table_desc() {
        $query  = 'DESCRIBE ' . $this->table;
        $res    = $this->connection->query($query);
        $array = array();
        while ( $row = $res->fetch_array(MYSQLI_ASSOC) ) {
            $array[] = $row;
        }
        $res->free();
        return $array;
    }

    /**
     * Returns the row of sets fields.
     *
     * @return array Result of SELECT statement.
     */
    public function get() {
        $select_fields = '';
        foreach ($this->fields as $name => $value) {
            $select_fields .= '`' . $name . '`, ';
        }

        $select_fields = rtrim($select_fields, ', ');

        $query  = 'SELECT ' . $select_fields . ' FROM `'
                . $this->table . '` ' . $this->where;

        $res    = $this->connection->query($query);
        $result = $res->fetch_array(MYSQLI_ASSOC);
        $res->free();
        return $result;
    }

    /**
     * Set a Where clause to SQL query.
     *
     * @param array An Associative array of fields to where clause.
     */
    public function set_where(array $params) {
        $where = '';
        foreach ($params as $field_name => $field_value) {
            $where .= '`' . $field_name . '` = \'' . $field_value . '\' AND ';
        }

        $where = rtrim($where, ' AND ');
        $this->where = ' WHERE ' . $where;
    }
}
