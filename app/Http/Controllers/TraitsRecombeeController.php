<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Recombee\RecommApi\Client;
use Recombee\RecommApi\Requests as Reqs;
use Recombee\RecommApi\Exceptions as Ex;
use DB;

class TraitsRecombeeController extends Controller
{   
    protected $client;
    public function __construct(){
        $this->client = new Client("redsocial-prod", "GPAp0BkjjAzXGrHXedLei0MlnMmhROOaklo6kBJZouOHjaCFhcnTQGgQyHy3v4DH", ["region" => "ca-east"]); 
    }

    public function addItem($id){
        try {
            $this->client->send(new Reqs\AddItem($id));
        } catch (Ex\ResponseException $th) {
            //throw $th;
            echo $th->getMessage();
        } 
    }

    public function deleteItem($id){
        try {
            $this->client->send(new Reqs\DeleteItem($id));
        } catch (Ex\ResponseException $th) {
            //throw $th;
            echo $th->getMessage();
        } 
    }

    public function addUser($id){
        try {
            $this->client->send(new Reqs\AddUser($id));
        } catch(Ex\ResponseException $e){
            //Handle errorneous request => use fallback
            echo $e->getMessage(); 
        }
    }

    public function deleteUser($id){
        try {
            $this->client->send(new Reqs\DeleteUser($id));
        } catch(Ex\ResponseException $e){
            //Handle errorneous request => use fallback
            echo $e->getMessage(); 
        }
    }

    public function postView($user_id, $item_id){
        try {
            $this->client->send(new Reqs\AddDetailView($user_id, $item_id));
        } catch(Ex\ResponseException $e){
            //Handle errorneous request => use fallback
            echo $e->getMessage(); 
        }
    }

    public function postLiked($user_id, $item_id){
        try {
            $this->client->send(new Reqs\AddPurchase($user_id, $item_id));
        } catch(Ex\ResponseException $e){
            //Handle errorneous request => use fallback
            echo $e->getMessage(); 
        }
    }

    public function delPostLiked($user_id, $item_id){
        try {
            $this->client->send(new Reqs\DeletePurchase($user_id, $item_id));
        } catch(Ex\ResponseException $e){
            //Handle errorneous request => use fallback
            echo $e->getMessage(); 
        }
    }

    public function recommendations($user_id){
        try {
            $recommended = $this->client->send(new Reqs\RecommendItemsToUser($user_id, 3));
            $ids = array();
            foreach ($recommended['recomms'] as $rcm) {
                array_push($ids, $rcm['id']);
            }
            $posts = DB::table('posts')
                        ->join('companies', 'posts.company_id', '=', 'companies.com_id') 
                        ->whereIn('post_id', $ids)
                        ->select('posts.post_id', 'posts.description', 'companies.com_name', 'companies.created_at')
                        ->get();
            return $posts;
        } catch(Ex\ResponseException $e){
            //Handle errorneous request => use fallback
            echo $e->getMessage(); 
        }
    }
}
