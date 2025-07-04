<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\MustacheRenderer;
use App\Service\CommonService;
use App\Models\UserModel;
use App\Models\ProductModel;
use App\Models\CartModel;

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
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */

     
    protected $mustache;
    protected $commonService;
    protected $userModel;
    protected $productModel;

    protected $cartModel;
    protected $consultaModel;
    protected $facturaModel;
    protected $facturaCarritoModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = service('session');
        $this->mustache = new MustacheRenderer();
        $this->commonService = new CommonService();
        $this->userModel = new UserModel();
        $this->productModel = new ProductModel();
        $this->cartModel = new CartModel();
        $this->consultaModel = new \App\Models\ConsultaModel();
        $this->facturaModel = new \App\Models\FacturaModel();
        $this->facturaCarritoModel = new \App\Models\FacturaCarritoModel();
    }
}
