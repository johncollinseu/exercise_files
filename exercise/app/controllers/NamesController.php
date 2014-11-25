<?php

class NamesController extends \Phalcon\Mvc\Controller
{

    public function indexAction($nameId)
    {
        $this->view->name = Names::findFirstById($nameId);
    }

    public function addAction()
    {
      if ($this->request->isPost()){

        $new_name = new Names();
        $new_name->name = $this->request->getPost('name');
        $new_name->save(); 

       return $this->dispatcher->forward( array(
          'controller' => 'names', 
          'action' => 'index',
          'params' => array($new_name->id)
        ));

      } 

    }


}

