<?php
/**
* @Entity
* @Table(name="users")
*/
class Default_Model_User
{
/**
* @Id @Column(type="integer")
* @GeneratedValue(strategy="AUTO")
*/
private $id;

/** @Column(type="string") */
private $name;

public function setName($string) {
$this->name = $string;
return true;
}
}