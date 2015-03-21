<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   * 		http://example.com/index.php/welcome
   *	- or -
   * 		http://example.com/index.php/welcome/index
   *	- or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/welcome/<method_name>
   * @see http://codeigniter.com/user_guide/general/urls.html
   */
  public function index()
  {
    // verify doctrine has been loaded correctly
    $em = $this->doctrine->em;

    $user = new Entities\User;
    $user->setName("Zhenjie Chen");
    $em->persist($user);
    $em->flush();
    echo "New user: " . $user->getId() . "<br/>";

    $user = new models\BadUser;
    $user->setName("Heisenberg");
    $em->persist($user);
    $em->flush();
    echo "New bad user: " . $user->getId() . "<br/>";

    $this->load->view('welcome_message');
  }
}
