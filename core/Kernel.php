<?php


namespace Core;

class Kernel
{
    public $request;

    public $errorsPage = null;

    public $lang = 'en';

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

            $router->setRequest($this->request);

            #$router->setRequestAttributes(['name' => '111111111111111111111111111111111111111111111111111111111111111'], $this->request);

            return $router->run();

        } catch (\Throwable $th) {

            return $this->getErrorsPage($th);

        } catch (\Exception $e) {
            
            return $this->getErrorsPage($e);
        }
    }

    public function setLang(string $lang) : void
    {
        $this->lang = $lang;
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