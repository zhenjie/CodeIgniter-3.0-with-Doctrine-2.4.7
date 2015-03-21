<?php
namespace Entities;

/** @Entity */
class User
{
  /** @Id @Column(type="integer") @GeneratedValue */
  private $id;

  /** @Column(type="string") */
  private $name;  

  public function setName($name) { $this->name = $name; }
  public function getId() { return $this->id; }
}