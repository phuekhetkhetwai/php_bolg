<?php

namespace Libs\Database;

use Helpers\HTTP;
use PDO;
use PDOException;

class UsersTable {
    private $db;

    public function __construct(MySQL $mysql)
    {
        $this->db = $mysql->connect();
    }

    public function find($email,$password) {
        try {
            $statement = $this->db->prepare("SELECT * FROM users WHERE email=:email");
            $statement->execute([
                "email" => $email,
            ]);

            $user = $statement->fetch();

            if($user) {
                if(password_verify($password,$user->password)) {
                    return $user;
                };
            }

            return false;

        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }

    }

    public function insert($data) {
        try {

            $statement = $this->db->prepare("SELECT * FROM users WHERE email=:email");
            $statement->execute([
                "email" => $data["email"],
            ]);

            $user = $statement->fetch();
            
            if(empty($user)){
                $data["password"] = password_hash($data["password"],PASSWORD_DEFAULT);

                $statement = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");

                $statement->execute($data);

                return $this->db->lastInsertId();
            }else {
                echo "<script>alert('Email duplicated!!');window.location.href='../register.php';</script>";
            }
            

        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function getBlogs() {
        try{
            $statement = $this->db->prepare("SELECT * FROM posts");
            $statement->execute();

            $results = $statement->fetchAll();

            return $results;
        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }

    }

    public function getBlogsByLimit($offset,$numofRecs) {
        try{
            $statement = $this->db->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $offset, $numofRecs ");
            $statement->execute();
            $results = $statement->fetchAll();

            return $results;
        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }

    }

    public function blogDetail($id) {
        try {
            $statement = $this->db->prepare("SELECT * FROM posts WHERE id=:id");
            $statement->execute(['id' => $id]);
            $result = $statement->fetch();

            return $result;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    // public function userRole() {
    //     try {
    //         $statement = $this->db->prepare("SELECT users.*,roles.id AS role FROM users LEFT JOIN roles ON users.role_id = roles.id");
    //         $statement->execute();
    //         $users = $statement->fetchAll();

    //         return $users;
            
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //         exit();
    //     }
    // }

    public function add($data){
        try{

            $statement = $this->db->prepare("INSERT INTO posts (title, content, image, author_id) VALUES (:title, :content, :image, :author_id)");
            $statement->execute($data);

            return $this->db->lastInsertId();

        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }
    }

    public function edit($id) {
        try {
            $statement = $this->db->prepare("SELECT * FROM posts WHERE id=:id");
            $statement->execute([
                "id" => $id
            ]);

            $data = $statement->fetch();
            
            return $data;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function update($data) {
        try {

            if(empty($data["image"])) {

                $statement = $this->db->prepare("UPDATE posts SET title=:title, content=:content WHERE id=:id");
                $statement->execute([
                    "id" => $data["id"],
                    "title" => $data["title"],
                    "content" => $data["content"],
                ]);

            }else{

                $statement = $this->db->prepare("UPDATE posts SET title=:title, content=:content, image=:image WHERE id=:id");
                $statement->execute($data);

            }
            
            return $statement->rowCount();

        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function delete($id) {
        try {
            $statement = $this->db->prepare("DELETE FROM posts WHERE id=:id");
            $statement->execute(["id" => $id]);

            return $statement->rowCount();
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }
}