<?php
class Admin_model extends CI_Model
{
    private static $db;
    private static $table = 'admin';
    private static $id = 'id_admin';

    function __construct()
    {
        parent::__construct();
        self::$db = &get_instance()->db;
    }

    public static function checkAdmin($username)
    {
        return self::$db->where('username', $username)->get(self::$table);
    }

    public static function checkPassword($username, $password)
    {
        $query = self::$db->where('username', $username);
        $query = self::$db->limit(1);
        $result = self::$db->get(self::$table)->row_array();

        if (password_verify($password, $result['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public static function getByID($id)
    {
        $query = self::$db->where(self::$id, $id);
        $result = self::$db->get(self::$table)->row_array();
        return $result;
    }

    // =======================
    // Get Data Kesehatan
    function tampil_data()
    {
        return $this->db->get('tb_fit_towork');
    }

    function view($table)
    {
        return $this->db->get($table);
    }

    function hapus_data($id_pegawai)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->delete('tb_kesehatan');
        return TRUE;
    }



    // =======================
    // Get Data Kesehatan
    function datafito_work()
    {
        return $this->db->get('tb_fit_towork');
    }

    function deldata_fit($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_fit_towork');
        return TRUE;
    }

    // public function get_ones($table, $where)
    // {
    //     $this->db->select('*');
    //     $this->db->from($table);
    //     $this->db->where($where);

    //     //die($this->db->get_compiled_select());
    //     return $this->db->get()->row();
    // }

    public function insert($data)
    {
        $this->db->insert('settings', $data);
        return TRUE;
    }

    public function nampil_data()
    {
        return $this->db->get('settings');
    }

    public function update_data($id, $data)
    {
        return $this->db->where('id', $id)->update('tb_fit_towork', $data);
    }

    function update($table, $data, $where, $id)
    {

        $this->db->trans_begin();

        $this->db->where($where, $id);
        $this->db->update($table, $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function insertss($table, $data)
    {
        $this->db->insert($table, $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
}
