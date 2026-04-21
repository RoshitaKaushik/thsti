<?php

namespace App\Models;

use CodeIgniter\Model;
use Config\Database;

class ScbvModel extends Model
{
    protected $db;
     protected $table = 'state'; 
    protected $primaryKey = 'id';

    public function __construct()
    {
        parent::__construct();
        $this->db = Database::connect();
    }

    public function get_country()
    {
        $builder = $this->db->table('country');
        $builder->select('*');
        $builder->where('Active', 1);
        $builder->where('Deletestatus IS NULL', null, false); // raw condition to avoid escaping 'IS NULL'
        $builder->orderBy('CountryID', 'ASC');
        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return [];
        }
    }

    public function get_all_states()
    {
        $builder = $this->db->table('state');
        $builder->select('*');
        $builder->where('Active', 1);
        $builder->where('Deletestatus IS NULL');

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return [];
        }
    }

    public function get_states($country_id)
    {
        $builder = $this->db->table('state');
        $builder->select('*');
        $builder->where('Active', 1);
        $builder->where('Deletestatus IS NULL');
        $builder->where('CountryID', $country_id); // <-- assuming country_id is stored in 'CountryID' column

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return [];
        }
    }

    public function get_city($state_id)
    {
        $builder = $this->db->table('mst_district md');
        $builder->select('*');
        $builder->join('mst_state ms', 'ms.state_code = md.state_code');
        $builder->where('md.state_code', $state_id);

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }


    public function get_block($district_code)
    {
        $builder = $this->afterUpdatedb->table('mst_block mb');
        $builder->select('*');
        $builder->join('mst_district md', 'mb.district_id = md.district_code');
        $builder->where('mb.district_id', $district_code);

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }


    public function get_village($block_code)
    {
        $builder = $this->db->table('mst_village mv');
        $builder->select('mv.*');
        $builder->join('mst_block mb', 'mb.block_code = mv.subdistrict_code');
        $builder->where('mv.subdistrict_code', $block_code);

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }


    // Used for multiple select state,city,block in Form
    public function get_city_list($state_code)
    {
        $builder = $this->db->table('mst_district');
        $builder->select('id, district_code, district_name');
        $builder->where('state_code', $state_code);

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }


    public function get_block_list($district_id)
    {
        $builder = $this->db->table('mst_block');
        $builder->select('id, block_code, title');
        $builder->where('district_id', $district_id);

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }


    public function get_village_list($subdistrict_code)
    {
        $builder = $this->db->table('mst_village');
        $builder->select('id, village_code, village_name');
        $builder->where('subdistrict_code', $subdistrict_code);

        $query = $builder->get();

        if ($query->getNumRows() >= 1) {
            return $query->getResultArray();
        } else {
            return false;
        }
    }
}
