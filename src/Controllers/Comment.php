<?php

namespace Masterclass\Controllers;

class Comment extends Controller{
    
    public function create() {
        if(!isset($_SESSION['AUTHENTICATED'])) {
            header("Location: /");
            exit;
        }
        
        $sql = 'INSERT INTO comment (created_by, created_on, story_id, comment) VALUES (?, NOW(), ?, ?)';
        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            $_SESSION['username'],
            $_POST['story_id'],
            filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
        ));
        header("Location: /story/?id=" . $_POST['story_id']);
    }
    
}
