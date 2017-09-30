<?php declare(strict_types = 1);

namespace YourNamespaceApp\Controllers;

use Http\Request;
use Http\Response;
use YourNamespaceApp\Template\FrontendRenderer;
use YourNamespaceApp\Database\Connection as Connection;

class Homepage
{
    private $request;
    private $response;
    private $renderer;
    private $connectionDb;

    public function __construct(
        Request $request,
        Response $response, 
        FrontendRenderer $renderer, 
        Connection $connectionDb
    ){
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
        $this->connectionDb = $connectionDb; 
    }

    public function show()
    {
        try {
            Connection::get()->connect();
            echo 'A connection to the PostgreSQL database sever has been established successfully.';
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }

		$data = [
			'name' => $this->request->getParameter('name', 'stranger')
		];
		$html = $this->renderer->render('Homepage', $data);
		$this->response->setContent($html);
		echo $this->response->getContent();
    }
}