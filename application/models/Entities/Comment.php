<?php
namespace Entities;

/** @Entity */
class Comment
{
  /** @Id @Column(type="integer") @GeneratedValue */
  private $id;
  
  /** @Column(type="string") */
  private $text;
}