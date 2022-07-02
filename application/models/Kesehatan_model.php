<?php
class Kesehatan_model extends CI_Model {
    private static $db;
    private static $datatables;
    private static $table = 'tb_fit_towork';
    private static $id = 'id';
    private static $input;
    
    function __construct() {
        parent::__construct();
        self::$db = &get_instance()->db;
        // self::$datatables = $this->datatables;
        self::$input = $this->input;
    }

    public static function insert($data = []) {
      self::$db->insert(self::$table, $data);
      return self::$db->insert_id();
    }

    public static function getAll() {
      $filter = self::$datatables->formatArraySearch(self::$input->post()); 
      self::$datatables->select('*');
      self::$datatables->from(self::$table);
      self::$datatables->or_where($filter['alphanumeric']);
      //$this->datatables->join('tbl_user_level', 'tbl_user.id_user_level = tbl_user_level.id_user_level');
      return self::$datatables->generate('json', 'ISO-8859-1');
  }

  public static function dataForExcel(){
    self::$db->select('*');
    self::$db->order_by(self::$id);
    return self::$db->get(self::$table)->result();
  }
}