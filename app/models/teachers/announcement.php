<?php
// This is the announcement model, it communicates with the database to view, add, delete or edit an announcement/s in the announcements table
class announcement {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function viewAnnouncements(){
        $this->db->query('SELECT *, teachers.teacher_name FROM announcements INNER JOIN teachers on teachers.teacher_id = announcements.teacher_id ORDER BY announcements.ann_date_created DESC');
        $results = $this->db->resultSet();

        return $results;
    }

    public function createAnnouncement($data){
        $this->db->query('INSERT INTO announcements (ann_title, ann_body, teacher_id) VALUES (:ann_title, :ann_body, :teacher_id)');
        $this->db->bind(':ann_title', $data['ann_title']);
        $this->db->bind(':ann_body', $data['ann_body']);
        $this->db->bind(':teacher_id', $data['teacher_id']);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function deleteAnnouncement($data){
        $this->db->query('DELETE FROM announcements WHERE ann_id = :ann_id');
        $this->db->bind(':ann_id', $data['ann_id']);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function editAnnouncement($data){
        $this->db->query('UPDATE announcements SET ann_title = :ann_title, ann_body = :ann_body, ann_date_created = current_timestamp WHERE ann_id = :ann_id');
        $this->db->bind(':ann_id', $data['ann_id']);
        $this->db->bind(':ann_title', $data['ann_title']);
        $this->db->bind(':ann_body', $data['ann_body']);

        if($this->db->execute()){
            return true;
        }
        else{
            return false;
        }

    }
}