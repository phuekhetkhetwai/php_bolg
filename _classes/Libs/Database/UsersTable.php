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

    public function insert($data,$path) {
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
                HTTP::redirect($path, "duplicated=email");
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

            $result = $statement->fetch();
            
            return $result;
            
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

    public function getBlogsByLimit($offset,$numofRecs,$searchval="") {
        try{

            if(empty($searchval)){

                $statement = $this->db->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT $offset, $numofRecs ");

            }else{

                $statement = $this->db->prepare("SELECT * FROM posts WHERE title LIKE '%$searchval%' ORDER BY id DESC LIMIT $offset, $numofRecs ");

            }
            $statement->execute();
            $results = $statement->fetchAll();

            return $results;
        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }

    }


    public function getBlogsBySearch($searchval) {
        try{
            $statement = $this->db->prepare("SELECT * FROM posts WHERE title LIKE '%$searchval%' ORDER BY id DESC");
            $statement->execute();
            $results = $statement->fetchAll();

            return $results;

        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }

    }


    public function getUsers(){
        try{
            // $statement = $this->db->prepare("SELECT * FROM users");
            $statement = $this->db->prepare("SELECT * FROM users");
            $statement->execute();

            $users = $statement->fetchAll();

            return $users;

        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public function editUser ($id) {
        try {
            $statement = $this->db->prepare("SELECT * FROM users WHERE id=:id");
            $statement->execute([
                "id" => $id
            ]);

            $user = $statement->fetch();
            
            return $user;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function updateUser($data) {
        try {

            $id = $data["id"];

            $statement = $this->db->prepare("SELECT * FROM users WHERE email=:email AND id!=:id");
            $statement->execute([
                "id" => $id,
                "email" => $data["email"]
            ]);

            $user = $statement->fetch();

            if(empty($user)){
                $statement = $this->db->prepare("UPDATE users SET name=:name, email=:email WHERE id=:id");
                $statement->execute($data);
            
                return $statement->rowCount();

            }else{

                HTTP::redirect("admin/user_edit.php", "id=$id&duplicated=email");
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function deleteUser($id) {
        try {
            $statement = $this->db->prepare("DELETE FROM users WHERE id=:id");
            $statement->execute(["id" => $id]);

            return $statement->rowCount();
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function getUsersByLimit($offset,$numofRecs,$searchval="") {
        try{
            if(empty($searchval)){

                $statement = $this->db->prepare("SELECT users.*,roles.name AS role FROM users LEFT JOIN roles ON users.role_id = roles.id ORDER BY id DESC LIMIT $offset, $numofRecs");
                
            }else{

                $statement = $this->db->prepare("SELECT users.*,roles.name AS role FROM users LEFT JOIN roles ON users.role_id = roles.id WHERE users.name LIKE '%$searchval%' ORDER BY id DESC LIMIT $offset, $numofRecs");
            }


            $statement->execute();
            $results = $statement->fetchAll();

            return $results;

        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }

    }

    public function getUsersBySearch($searchval) {
        try{
            $statement = $this->db->prepare("SELECT * FROM users WHERE name LIKE '%$searchval%' ORDER BY id DESC");
            $statement->execute();
            $users = $statement->fetchAll();

            return $users;

        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }

    }

    public function changeRole($data) {
        try {
            $statement = $this->db->prepare("UPDATE users SET role_id=:role_id WHERE id=:id");
            $statement->execute($data);

            return $statement->rowCount();
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function addComment($data) {
        try {
            $statement = $this->db->prepare("INSERT INTO comments (content, author_id, post_id) VALUE (:content, :author_id, :post_id)");
            $statement->execute($data);

            return $statement->rowCount();
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function getComment($id) {
        try {
            $statement = $this->db->prepare("SELECT comments.*,users.name FROM comments LEFT JOIN users ON comments.author_id = users.id WHERE comments.post_id=:id ORDER BY id DESC");
            $statement->execute(["id" => $id]);
            $results = $statement->fetchAll();

            return $results;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit();
        }
    }

}