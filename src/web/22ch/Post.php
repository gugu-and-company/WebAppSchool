<?php

class Post
{
  private $name;
  private $dttm;
  private $post;

  public function __construct($name, $dttm, $post)
  {
    $this->setName($name);
    $this->setDatetime($dttm);
    $this->setPost($post);
  }
  
  public function createNewPost($post)
  {
    $this->dttm = new DateTime('now');
    $this->dttm = $this->dttm->format('Y-m-d H:i');
    $this->post = $post;
  }

  public function setName($name)
  {
    $this->name = $name;
  }
  
  public function setDatetime($dttm)
  {
    $this->dttm = $dttm;
  }
  
  public function setPost($post)
  {
    $this->post = $post;
  }
  
  public function getName()
  {
    return $this->name;
  }
  
  public function getDatetime()
  {
    return $this->dttm;
  }

  public function getPost()
  {
    return $this->post;
  }

}