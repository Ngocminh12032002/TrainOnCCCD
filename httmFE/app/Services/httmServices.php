<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\RequestOptions;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Termwind\Components\Dd;

class httmServices
{
    protected string $url;
    public function __construct()
    {
        $this->url = 'http://127.0.0.1:8080';
    }

    private function _toObject($array)
    {
        $objectStr = json_encode($array);
        $object = json_decode($objectStr);
        return $object;
    }

    public function login($username, $password)
    {
        $url = $this->url . '/login';
        $response = Http::post($url, [
            'username' => $username,
            'password' => $password
        ]);
        $response->throw();
        // $response->throw()->json()['message'];
        $data = $response->json();
        $dataObj = $this->_toObject($data);
        return $dataObj;
    }

    public function train($file)
    {
        $fileName = $file->getClientOriginalName();
        $url = $this->url . '/train?fileInput=' . $file;
        $response = Http::attach('fileInput', file_get_contents($file->getRealPath()), $fileName)->post($url);
        // dd($response);
        // $response = Http::post($url);
        $response->throw();
        // $response->throw()->json()['message'];
        $data = $response->json();
        $dataObj = $this->_toObject($data);
        return $dataObj;
    }

    public function list()
    {
        $url = $this->url;
        $response = Http::get($url, [
            'page' => 0,
            'size' => 1000,
        ]);
        $response->throw();
        $data = $response->json();
        $dataObj = $this->_toObject($data);
        return $dataObj;
    }

    public function delete($id)
    {
        $url = $this->url . '/' . $id;
        $response = Http::delete($url);
        $response->throw();
        $data = $response->json();
        $dataObj = $this->_toObject($data);
        return $dataObj;
    }

    public function update($id, $file)
    {
        $url = $this->url . '/' . $id;
        $fileName = $file->getClientOriginalName();
        $response = Http::attach('fileInput', file_get_contents($file->getRealPath()), $fileName)->put($url);
        $response->throw();
        $data = $response->json();
        $dataObj = $this->_toObject($data);
        return $dataObj;
    }

    public function retrain($selectedIDs, $weight)
    {
        $url = $this->url . '/retrain/' . $selectedIDs . '/' . $weight;
        set_time_limit(1000);
        $response = Http::timeout(1000000)->get($url);
        // $response->throw();
        $data = $response->json();
        $dataObj = $this->_toObject($data);
        return $dataObj;
    }

    public function listWeight()
    {
        $url = $this->url . '/listweight';
        $response = Http::get($url);
        $response->throw();
        $data = $response->json();
        $dataObj = $this->_toObject($data);
        return $dataObj;
    }

    public function listModel()
    {
        $url = $this->url . '/listModel';
        $response = Http::get($url, [
            'page' => 0,
            'size' => 1000,
        ]);
        $response->throw();
        $data = $response->json();
        $dataObj = $this->_toObject($data);
        return $dataObj;
    }

    public function detailModel($id)
    {
        $url = $this->url . '/detailModel/' . $id;
        $response = Http::get($url);
        $response->throw();
        $data = $response->json();
        $dataObj = $this->_toObject($data);
        return $dataObj;
    }

    public function deleteModel($id)
    {
        $url = $this->url . '/model/' . $id;
        $response = Http::delete($url);
        $response->throw();
        $data = $response->json();
        $dataObj = $this->_toObject($data);
        return $dataObj;
    }

    public function updateModel($id, $data)
    {
        $url = $this->url . '/updateModel/' . $id . '/' . $data;
        $response = Http::put($url);
        $response->throw();
        $data = $response->json();
        $dataObj = $this->_toObject($data);
        return $dataObj;
    }
}