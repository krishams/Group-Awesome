<?php
ob_start(); // output buffer start - has to be there else we get a php warning

class Search extends CI_Controller {

  function __construct() {
        parent::__construct();
        session_start();
    }

    /*
     * This function loads the findbuddies view
     */
    function findBuddies()
    {
          $this->search_model->getRandomUsers();

          $data['main_content'] = 'findBuddies_view';
          $this->load->view('/include/template1_view', $data);
          
    }
    
}

?>

