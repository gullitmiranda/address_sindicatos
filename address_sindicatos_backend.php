<?php

/**
 * Example backend class for a custom address book
 *
 * This one just holds a static list of address records
 *
 * @author Thomas Bruederli
 */
class address_sindicatos_backend extends rcube_addressbook
{
  public $primary_key = 'ID';
  public $readonly = true;
  public $groups = false;

  private $filter;
  private $result;
  private $name;

  public function __construct($name)
  {
    $this->ready = true;
    $this->name = $name;
  }

  public function get_name()
  {
    return $this->name;
  }

  public function set_search_set($filter)
  {
    $this->filter = $filter;
  }

  public function get_search_set()
  {
    return $this->filter;
  }

  public function reset()
  {
    $this->result = null;
    $this->filter = null;
  }

  function list_groups($search = null)
  {
    return array(
      // array('ID' => 'S1', 'name' => "Sindicato 1"),
      // array('ID' => 'S2', 'name' => "Sindicato 2"),
      // array('ID' => 'S3', 'name' => "Sindicato 3"),
      // array('ID' => 'S4', 'name' => "Sindicato 4"),
      // array('ID' => 'S5', 'name' => "Sindicato 5"),
    );
  }

/*
  function list_groups($search = null)
  {
    $username = $this->RCMAIL->user->data["username"];

    $groups = array(
      array('ID' => 'S1', 'name' => "Sindicato 1", "only" => array("admin@requestdev.com.br")),
      array('ID' => 'S2', 'name' => "Sindicato 2", "only" => array("contact@requestdev.com.br")),
      array('ID' => 'S3', 'name' => "Sindicato 3", "only" => array("admin@requestdev.com.br")),
      array('ID' => 'S4', 'name' => "Sindicato 4"),
      array('ID' => 'S5', 'name' => "Sindicato 5"),
    );

    $user_groups = array();
    foreach ($groups as $group) {
      $only = $group["only"];
      unset($group["only"]);

      if ($only && count($only)) {
        if (in_array($username, $only)) {
          $user_groups[] = $group;
        }
      } else {
        $user_groups[] = $group;
      }
    }

    return $user_groups;
  }
*/

  public function list_records($cols=null, $subset=0)
  {
    $this->result = $this->count();
    $this->result->add(array('ID' => '111', 'name' => "Example Contact", 'firstname' => "Example", 'surname' => "Contact", 'email' => "example@roundcube.net"));
    $this->result->add(array('ID' => '112', 'name' => "Example Contact 2", 'firstname' => "Example", 'surname' => "Contact 2", 'email' => "example2@roundcube.net"));
    $this->result->add(array('ID' => '113', 'name' => "Example Contact 3", 'firstname' => "Example", 'surname' => "Contact 3", 'email' => "example3@roundcube.net"));

    return $this->result;
  }

  public function search($fields, $value, $strict=false, $select=true, $nocount=false, $required=array())
  {
    // no search implemented, just list all records
    return $this->list_records();
  }

  public function count()
  {
    return new rcube_result_set(1, ($this->list_page-1) * $this->page_size);
  }

  public function get_result()
  {
    return $this->result;
  }

  public function get_record($id, $assoc=false)
  {
    $this->list_records();
    $first = $this->result->first();
    $sql_arr = $first['ID'] == $id ? $first : null;

    return $assoc && $sql_arr ? $sql_arr : $this->result;
  }


  function create_group($name)
  {
    $result = false;

    return $result;
  }

  function delete_group($gid)
  {
    return false;
  }

  function rename_group($gid, $newname)
  {
    return $newname;
  }

  function add_to_group($group_id, $ids)
  {
    return false;
  }

  function remove_from_group($group_id, $ids)
  {
     return false;
  }

}
