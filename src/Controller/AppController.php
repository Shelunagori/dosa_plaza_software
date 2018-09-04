<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

		//FrozenTime::setToStringFormat('dd-MM-yyyy hh:mm a');  // For any immutable DateTime
		//FrozenDate::setToStringFormat('dd-MM-yyyy');  // For any immutable Date
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
		$this->loadComponent('Auth', [
		 'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'username',
                        'password' => 'password'
                    ],
                      'userModel' => 'Users'
                ]
            ],
            'loginRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
			'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
			'unauthorizedRedirect' => $this->referer(),
        ]);
		
		
        $coreVariable = [
            'user_name' => $this->Auth->User('name'),
            'role' => $this->Auth->User('role'), 
        ];
		$this->coreVariable = $coreVariable;
		$this->set(compact('coreVariable'));
        
        $this->loadModel('Bills');
        $query=$this->Bills->find();  
        $query  ->select(['TotalSale' => $query->func()->sum('Bills.grand_total')])
                ->where(['Bills.created_on >=' => date('Y-m-d').' 00:00:00', 'Bills.created_on <=' => date('Y-m-d').' 23:59:59'])
                ->toArray();
        $TotalSale=0;
        foreach ($query as $value) {
            $TotalSale=$value->TotalSale;
        }
        $this->set(compact('TotalSale'));

        $this->loadModel('Tables');
        $occupiedTableCount=$this->Tables->find()->where(['Tables.status' => 'occupied'])->count();  
        $this->set(compact('occupiedTableCount'));

        $this->loadModel('UserRights');
        $this->loadModel('Pages');
        $userid=$this->Auth->User('id');
        if(!empty($userid)){
        $userData = $this->UserRights->find()
                    ->where(['UserRights.user_id'=>$userid])
                    ->autoFields(true);
            foreach($userData->toArray() as $data)
            {
                $userPages[]=$data->page_id;
            }
            $this->set(compact('userPages'));
        }

        $controller = $this->request->params['controller'];
        $action = $this->request->params['action']; 
        $page=$this->Pages->find()->where(['controller_name'=>$controller,'action'=>$action])->first();
        
        if(!empty($page->id) and !in_array($page->id,$userPages)){
            $pages=[];
            $this->set(compact('pages'));
            $this->viewBuilder()->layout('admin');
            $this -> render('/Error/pageNotFound'); 
        }
        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return \Cake\Network\Response|null|void
     */
	
	
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
