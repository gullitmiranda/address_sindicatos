<?php

class AddressSindicatos_Plugin extends PHPUnit_Framework_TestCase
{

    function setUp()
    {
        include_once dirname(__FILE__) . '/../address_sindicatos.php';
    }

    /**
     * Plugin object construction test
     */
    function test_constructor()
    {
        $rcube  = rcube::get_instance();
        $plugin = new address_sindicatos($rcube->api);

        $this->assertInstanceOf('address_sindicatos', $plugin);
        $this->assertInstanceOf('rcube_plugin', $plugin);
    }
}

