<?php

/**
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 * @copyright Aimeos (aimeos.org), 2014
 */

return array (
	'customer' => array (
		'customer/unitCustomer1' => array( 'label' => 'unitCustomer1', 'code' => 'unitCustomer1', 'status' => 1, 'company' => 'ABC GmbH', 'vatid' => 'DE999999999', 'salutation' => 'mr', 'title' => 'Dr', 'firstname' => 'Max', 'lastname' => 'Mustermann', 'address1' => 'Musterstraße', 'address2' => '1a', 'address3' => '', 'postal' => '20001', 'city' => 'Musterstadt', 'state' => 'Hamburg', 'countryid' => 'DE', 'langid' => 'de', 'telephone' => '01234567890', 'email' => 'unitCustomer1@aimeos.org', 'telefax' => '01234567890', 'website' => 'unittest.aimeos.org', 'birthday' => '1970-01-01', 'status' => '1', 'password' => 'unittest' ),
		'customer/unitCustomer2' => array( 'label' => 'unitCustomer2', 'code' => 'unitCustomer2', 'status' => 1, 'company' => 'ABC GmbH', 'vatid' => 'DE999999999', 'salutation' => 'mrs', 'title' => 'Prof. Dr.', 'firstname' => 'Erika', 'lastname' => 'Mustermann', 'address1' => 'Heidestraße', 'address2' => '17', 'address3' => '', 'postal' => '45632', 'city' => 'Köln', 'state' => '', 'countryid' => 'DE', 'langid' => 'de', 'telephone' => '09876543210', 'email' => 'unitCustomer2@aimeos.org', 'telefax' => '09876543210', 'website' => 'unittest.aimeos.org', 'birthday' => '1970-01-01', 'status' => '0' ),
		'customer/unitCustomer3' => array( 'label' => 'unitCustomer3', 'code' => 'unitCustomer3', 'status' => 0, 'company' => 'ABC GmbH', 'vatid' => 'DE999999999', 'salutation' => 'mr', 'title' => '', 'firstname' => 'Franz-Xaver', 'lastname' => 'Gabler', 'address1' => 'Phantasiestraße', 'address2' => '2', 'address3' => '', 'postal' => '23643', 'city' => 'Berlin', 'state' => '', 'countryid' => 'DE', 'langid' => 'de', 'telephone' => '01234509876', 'email' => 'unitCustomer3@aimeos.org', 'telefax' => '055544333212', 'website' => 'unittest.aimeos.org', 'birthday' => '1970-01-01', 'status' => '1' ),
	),

	'customer/address' => array (
		array ( 'refid' => 'customer/unitCustomer1', 'company' => 'ABC', 'vatid' => 'DE999999999', 'salutation' => 'mr', 'title' => 'Dr', 'firstname' => 'Our', 'lastname' => 'Unittest', 'address1' => 'Pickhuben', 'address2' => '2-4', 'address3' => '', 'postal' => '20457', 'city' => 'Hamburg', 'state' => 'Hamburg', 'countryid' => 'DE', 'langid' => 'de', 'telephone' => '055544332211', 'email' => 'unitCustomer1@aimeos.org', 'telefax' => '055544332212', 'website' => 'unittest.aimeos.org', 'flag' => 0, 'pos' => '0' ),
		array ( 'refid' => 'customer/unitCustomer2', 'company' => 'ABC GmbH', 'vatid' => 'DE999999999', 'salutation' => 'mr', 'title' => 'Dr.', 'firstname' => 'Good', 'lastname' => 'Unittest', 'address1' => 'Pickhuben', 'address2' => '2-4', 'address3' => '', 'postal' => '20457', 'city' => 'Hamburg', 'state' => 'Hamburg', 'countryid' => 'DE', 'langid' => 'de', 'telephone' => '055544332211', 'email' => 'unitCustomer2@aimeos.org', 'telefax' => '055544332212', 'website' => 'unittest.aimeos.org', 'flag' => 0, 'pos' => '1' ),
		array ( 'refid' => 'customer/unitCustomer2', 'company' => 'ABC GmbH', 'vatid' => 'DE999999999', 'salutation' => 'mr', 'title' => 'Dr.', 'firstname' => 'Good', 'lastname' => 'Unittest', 'address1' => 'Pickhuben', 'address2' => '2-4', 'address3' => '', 'postal' => '11099', 'city' => 'Berlin', 'state' => 'Berlin', 'countryid' => 'DE', 'langid' => 'de', 'telephone' => '055544332221', 'email' => 'unitCustomer2@aimeos.org', 'telefax' => '055544333212', 'website' => 'unittest.aimeos.org', 'flag' => 0, 'pos' => '1' ),
		array ( 'refid' => 'customer/unitCustomer3', 'company' => 'unitcompany', 'vatid' => 'DE999999999', 'salutation' => 'company', 'title' => 'unittitle', 'firstname' => 'unitfirstname', 'lastname' => 'unitlastname', 'address1' => 'unitaddress1', 'address2' => 'unitaddress2', 'address3' => 'unitaddress3', 'postal' => 'unitpostal', 'city' => 'unitcity', 'state' => 'unitstate', 'countryid' => 'DE', 'langid' => 'de', 'telephone' => '1234567890', 'email' => 'unitCustomer3@aimeos.org', 'telefax' => '1234567891', 'website' => 'unittest.aimeos.org', 'flag' => 0, 'pos' => '2' ),
	),
);
