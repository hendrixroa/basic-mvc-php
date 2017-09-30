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
        FrontendRenderer $renderer
    ){
        $this->request = $request;
        $this->response = $response;
        $this->renderer = $renderer;
          
        try {
            $this->connectionDb = Connection::get()->connect();
            // Uncomment for debug, print_r('A connection to the PostgreSQL database sever has been established successfully.');
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getItems(){
        $query = $this->connectionDb->prepare('SELECT * FROM items;');
        $query->execute();
        Connection::get()->closeConnection();
        return $query->fetchAll();
    }

    public function show()
    {
		$data = [
            'name' => $this->request->getParameter('name', 'stranger'),
          //  'items' => $this->getItems() 
		];
		$html = $this->renderer->render('Homepage', $data);
		$this->response->setContent($html);
		echo $this->response->getContent();
    }
}