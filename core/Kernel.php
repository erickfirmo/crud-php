<?php


namespace Core;

class Kernel
{
    public $request;

    public $errorsPage = null;

    public $lang = 'en';

    public $webRoutes = __DIR__.'/../routes/web.php';

    public $apiRoutes = __DIR__.'/../routes/api.php';

    public function __construct()
    {
        $this->setLang(app('lang'));
        $request = new \Core\Request;
        $request->setValidatorLang(include __DIR__.'/../views/lang/'.$this->lang.'.php');
        $request->setErrorsSessionName(app('session_errors'));

        $this->request = $request;
    }

    public function handle(Object $router)
    {
        try {

            # Defining error page 404
            $router->notFoundView(__DIR__.'/../views/errors/404.php');

            # Defining namespace
            $router->setNamespace('App\Controllers\\');

            # Passing request object
            $router->setRequest('request', $this->request);

            # Load web routes file 
            require $this->webRoutes;

            # Load api routes file 
            # require $this->apiRoutes;

            # Execute de router
            return $router->run();

        } catch (\Throwable $th) {

            return $this->getErrorsPage($th);

        } catch (\Exception $e) {
            
            return $this->getErrorsPage($e);
        }
    }

    // Define arquivo de idioma
    public function setLang(string $lang) : void
    {
        $this->lang = $lang;
    }

    // Define arquivo de visualização para erros e exceções (500)
    public function errorsPage($view)
    {
        $this->errorsPage = $view;
    }

    protected function getErrorsPage(Object $exception)
    {
        if(!$this->errorsPage)
        {
            // set Exception message
            #header("HTTP/1.0 404 Not Found");
            print $exception->getMessage();
            exit();
        }

        $error = $exception->getMessage();

        // Retorna página de exibição de erros 
        include $this->errorsPage;
        exit;
    }
}