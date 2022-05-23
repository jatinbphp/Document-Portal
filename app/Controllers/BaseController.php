<?php

namespace App\Controllers;

use CodeIgniter\Controller; 
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\AuthModel;
/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */

class BaseController extends Controller
{
	/**
	 * Instance of the main Request object.
	 *
	 * @var IncomingRequest|CLIRequest
	 */
	protected $request;

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 *
	 * @param RequestInterface  $request
	 * @param ResponseInterface $response
	 * @param LoggerInterface   $logger
	 */
	public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.: $this->session = \Config\Services::session();
		$this->session = \Config\Services::session(@$config); 
        $this->session->start();
        
		$group_data = array();
		if(empty($this->session->get('logged_in'))) {
			$session_data = array('logged_in' => FALSE);
			$this->session->set($session_data);
		}
	}

	 

	public function render_template($page = null, $data = array())
	{	
		  $modal_auth = new AuthModel;
        $po_data = $modal_auth->get_single_record('project_options');
        
		$data['poname'] = $po_data['po_name'];
		$data['pologo'] = $po_data['po_logo'];
		$data['pologosmall'] = $po_data['po_logo_small'];
		 echo view('templates/header',$data);
		 echo view('templates/header_menu',$data);
		 echo view('templates/side_menubar',$data);
		 echo view($page, $data);
		 echo view('templates/footer',$data);
	}

public function render_user_template($page = null, $data = array())
	{	
		  $modal_auth = new AuthModel;
        $po_data = $modal_auth->get_single_record('project_options');
        
		$data['poname'] = $po_data['po_name'];
		$data['pologo'] = $po_data['po_logo'];
		$data['pologosmall'] = $po_data['po_logo_small'];
		 echo view('templates/header',$data);
		 echo view('templates/header_menu',$data);
		 echo view('templates/side_menubar_user',$data);
		 echo view($page, $data);
		 echo view('templates/footer',$data);
	}
	 
}
