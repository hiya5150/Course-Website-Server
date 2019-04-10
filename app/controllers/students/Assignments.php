<?php
//This is the assignments controller, this page will recieve the input from the front end in form of post and/or parameters and if there are no errors/everything was filled out correctly then it will send the information to the assignments model, to be processed with the database, it will then return the either the data or success/failure, which will be converted to JSON and sent back to front end

class Assignments extends Controller
{
    private $currentModel;
    public function __construct()
    {
        $this->currentModel = $this->model('students', 'Assignment');
    }


    public function submitAssignment($teacherID, $studentID, $asnID){
        $data = [
            'teacher_id'=>$teacherID,
            'student_id'=>$studentID,
            'asn_id'=>$asnID,
            'submission'=>'this is my submission for my assignment',
            'success'=>true
        ];

        if($this->currentModel->submit($data)){
            echo json_encode($data);
        }
        else{
            echo json_encode(['success'=>false]);
        }
    }

    public function viewAssignments()
    {
        $assignments = $this->currentModel->getAssignments();

        if ($assignments) {
            $data = [
                'assignments' => $assignments,
                'success'=>true
            ];
            echo json_encode($data);
        }
        else{
            echo json_encode(['success'=>false]);
        }
    }

    public function viewOneAssignment($asnID){
        $data = [
            'asn_id'=>$asnID
        ];
        if($assignment = $this->currentModel->getOneAssignment($data)){
            $data = [
                'assignment'=>$assignment,
                'success'=>true
            ];
            echo json_encode($data);
        }
        else{
            echo json_encode(['success'=>false]);
        }
    }
}