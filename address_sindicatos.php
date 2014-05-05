<?php

require_once(dirname(__FILE__) . '/address_sindicatos_backend.php');

/**
 * Sample plugin to add a new address book
 * with just a static list of contacts
 *
 * @license GNU GPLv3+
 * @author Thomas Bruederli
 */
class address_sindicatos extends rcube_plugin
{
  private $abook_id = 'sindicatos';
  private $abook_name = 'Lista de Sindicatos';

  // Todos os usuários que estiverem nessa lista terão acesso a lista
  // Para dar permissão para todos usuários basta deixar a lista vazia:
  //    private $only = array();
  private $only = array("audi@faespsenar.com.br");

  public function init()
  {
    $user = rcmail::get_instance()->user;
    $username = $user->data["username"];

    if ($this->only && count($this->only) && !in_array($username, $this->only)) {
      return;
    }

    $this->add_hook('addressbooks_list', array($this, 'address_sources'));
    $this->add_hook('addressbook_get', array($this, 'get_address_book'));

    // use this address book for autocompletion queries
    // (maybe this should be configurable by the user?)
    $config = rcmail::get_instance()->config;
    $sources = (array) $config->get('autocomplete_addressbooks', array('sql'));
    if (!in_array($this->abook_id, $sources)) {
      $sources[] = $this->abook_id;
      $config->set('autocomplete_addressbooks', $sources);
    }
  }

  public function address_sources($p)
  {
    $abook = new address_sindicatos_backend($this->abook_name);
    $p['sources'][$this->abook_id] = array(
      'id' => $this->abook_id,
      'name' => $this->abook_name,
      'readonly' => $abook->readonly,
      'groups' => $abook->groups,
    );
    return $p;
  }

  public function get_address_book($p)
  {
    if ($p['id'] === $this->abook_id) {
      $p['instance'] = new address_sindicatos_backend($this->abook_name);
    }

    return $p;
  }

}
