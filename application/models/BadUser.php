<?php
namespace models;

/** @Entity */
class BadUser
{
  /** @Id @Column(type="integer") @GeneratedValue */
  private $id;

  /** @Column(type="string") */
  private $name;  

  public function setName($name) { $this->name = $name; }
  public function getId() { return $this->id; }
}