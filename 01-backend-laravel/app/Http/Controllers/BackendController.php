<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class BackendController extends Controller
{
    private $names = [
        1 => ["name" => "Alan", "age" => 25],
        2 => ["name" => "John", "age" => 30],
        3 => ["name" => "Paul", "age" => 35]
    ];

    public function findAll(){
        return response()->json($this->names);
    }

    public function get(int $id = 0){
        if(isset($this->names[$id])){
            return response()->json($this->names[$id]);
        }

        return response()->json(["error" => "Register not found"], Response::HTTP_NOT_FOUND);
    }

    public function create(Request $request){
        $person = [
            "id" => count($this->names) + 1,
            "name" => $request->input("name", "Default Value"),
            "age" => $request->input("age")
        ];

        $this->names[$person["id"]] = $person;

        return response()->json(["message" => "Register created successfully", "person" => $person], Response::HTTP_CREATED);
    }

    public function update(Request $request, int $id){
        if(isset($this->names[$id])){
            $this->names[$id]["name"] = $request->input("name", $this->names[$id]["name"]);
            $this->names[$id]["age"] = $request->input("age", $this->names[$id]["age"]);

            return response()->json(["message" => "Register updated successfully", "person" => $this->names[$id], "id" => $id,], Response::HTTP_CREATED);
        }

        return response()->json(["error" => "Register not found"], Response::HTTP_NOT_FOUND);
    }

    public function delete(int $id){
        if(isset($this->names[$id])){
            unset($this->names[$id]);
            return response()->json(["message" => "Register deleted successfully", "id" => $id], Response::HTTP_NO_CONTENT);
        }
        
        return response()->json(["error" => "Register not found"], Response::HTTP_NOT_FOUND);
    }
}
