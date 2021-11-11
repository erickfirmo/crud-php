<?php


namespace Core;

class Kernel
{
    public $request;

    public $errorsPage = null;

    public function __construct()
    {
        $this->request = new \Core\Request;
    }

    public function handle($router)
    {
        try {

            return $router->run($this->request);

        } catch (\Throwable $th) {

            return $this->getErrorsPage($th);

        } catch (\Exception $e) {
            
            return $this->getErrorsPage($e);
        }
    }

    // Define arquivo de visualização para erros e exceções (500)
    public function errorsPage($view)
    {
        return $this->errorsPage = $view;
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