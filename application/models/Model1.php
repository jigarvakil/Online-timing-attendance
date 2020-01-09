<?php

defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

class Model1 extends CI_Model {

    public function __construct() {
        parent::__construct();

    }

    public function FetchNumRecord( $tblname, $data ) {
        $this->db->where( $data );
        $query = $this->db->get( $tblname );

        return $query->num_rows();

    }

    public function FetchData( $tblname, $data ) {
        $this->db->where( $data );
        $query = $this->db->get( $tblname );
        $result = $query->result();
        return $result;
    }

    public function InsertData( $tblname, $data ) {
        $this->db->insert( $tblname, $data );

    }

    public function DeleteData( $tblname, $data ) {
        $this->db->where( $data );
        $this->db->delete( $tblname );

    }
}

/* End of file Model1.php */

?>