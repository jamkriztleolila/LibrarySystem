<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Schools_data extends CI_Model{

  public function checkID($id){
    $id  = str_replace(" ","-",trim($id));
    $this->db->where("id", $id);
    $query = $this->db->get('school_data');

    return $query->num_rows() > 0;
  }

  function getSchool($id)
  {
      return $this->db->get_where('school_data',array('id'=>$id, 'status' => "active"))->row_array();
  }

  function getSchoolSetting($id)
  {
      return $this->db->get_where('school_settings',array('id'=>$id, 'status' => "active"))->row_array();
  }

  function getSchoolSettingsCount()
  {
      $this->db->from('school_settings');
      return $this->db->count_all_results();
  }

  public function getAllSchools($params = array())
  {
      $this->db->order_by('id', 'desc');
      if(isset($params) && !empty($params))
      {
          $this->db->limit($params['limit'], $params['offset']);
      }
      return $this->db->get('school_data')->result_array();
  }

  function getAllSchoolSettings($params = array())
  {
      $this->db->order_by('id', 'desc');
      if(isset($params) && !empty($params))
      {
          $this->db->limit($params['limit'], $params['offset']);
      }
      return $this->db->get('school_settings')->result_array();
  }

	public function addSchool($params)
	{
		if($this->_checkSchoolName($params["name"])){
			$data['error_message'] = "School Name has a record already";
			return $data;
		}
		else{
			$this->db->insert('school_data',$params);
			if($this->db->affected_rows() === 1) {
				$res = $this->_defaultSchoolSettings($params);
				if(!isset($res['error_message']))
					return $res;
				else
					return $res;
			}
			else{
				$data['error_message'] = "Error in creating a new school info";
				return $data;
			}
		}
	}

  function updateSetting($id, $params)
    {
        unset($params["id"]);
        $this->db->where('id',$id);
        return $this->db->update('school_settings',$params);

        if($this->db->affected_rows() === 1) {
          $data["success_message"] = $params["school"]."'s settings has been set successfully!";
        }
        else if($this->db->affected_rows() === 0) {
          $data["success_message"] = $params["school"]."'s settings has been set successfully!";
        }
        else{
          $data["error_message"] = "Database Error";
        }

        return $data;
    }

	private function _defaultSchoolSettings($school){
		$params["id"] = $this->_createNewID();
		$params["school"] = $school["id"];
		$this->db->insert('school_settings',$params);
		if($this->db->affected_rows() === 1) {
		  $data = array();
		  $data["id"] = $params["id"];
		  $data["schoolID"] = $school["id"];
		  $data["schoolName"] = $school["name"];
		  return $data;
		}
		else{
		  $data['error_message'] = "Error in create the schools initial settings";
		  return $data;
		}
	}

	private function _checkSchoolName($name){
		$this->db->where('name', $name);
		$query = $this->db->get('school_data');
		if($query->num_rows() == 1){
		  return true;
		}
		else{
		  return false;
		}
	}

	private function _checkSchoolSetting($schoolId){
		$this->db->where('school', $schoolId);
		$this->db->where('status', "active");
		$query = $this->db->get('school_settings');
		if($query->num_rows() == 1){
		  return true;
		}
		else{
		  return false;
		}
	}

	private function _createNewID(){
		$this->db->select("id");
		$this->db->order_by("id", "ASC");
		$query = $this->db->get("school_settings");
		$id = date("Y")."S";

		if($query->num_rows() == 0){
		  $id .= "00001";
		}
		else{
		  $row = $query->last_row('array');
		  $id .= substr(((substr($row['id'], 5) + 100000) + 1), 1);
		}
		return $id;
	}

}
