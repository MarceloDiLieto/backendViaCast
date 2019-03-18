<?php

namespace App\Controllers;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UserController extends Controller
{

    public function readAllUsers(RequestInterface $request, ResponseInterface $response){
        $user = $this->repo->readAllUsers();
        $this->respond(
            $response->withStatus(200)->withBody($this->getAsStream($user))
        );
    }

    public function readUserById(RequestInterface $request, ResponseInterface $response, $id){
        $user = $this->repo->readUserById($id);
        $this->respond(
            $response->withStatus(200)->withBody($this->getAsStream($user))
        );
    }

    public function deleteUser(RequestInterface $request, ResponseInterface $response){
        $user = $this->repo->deleteUser($id);
        $this->respond(
            $response->withStatus(200)->withBody($this->getAsStream($user))
        );
    }

    public function createUser(RequestInterface $request, ResponseInterface $response){
        $body = json_decode($request->getBody(), true);
        $databseRes = $this->repo->createUser($body);
        $this->respond(
            $response->withStatus(200)->withBody($this->getAsStream($databseRes))
        );
    }

    public function updateUser(RequestInterface $request, ResponseInterface $response){
        $body = json_decode($request->getBody(), true);
        $databseRes = $this->repo->updateUser($body);
        $this->respond(
            $response->withStatus(200)->withBody($this->getAsStream($databseRes))
        );
    }
}