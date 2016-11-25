<?php



class Subject extends CI_Controller
{

    /****** Load view called by the http request ******/


    public function plan()
    {
        $data = [];

        $this->load->view('subject/plan', $data);
    }

    public function modalSubject()
    {
        $data = [];

        $this->load->view('subject/modalSubject', $data);
    }




    public function save() {

        $this->load->model("meeting_app_subjects", "subject");

        $this->load->library('session');
        $this->load->model("zeapps_users", "user");



        // constitution du tableau
        $data = [];

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }


        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->subject->update($data, $data["id"]);
        } else {
            $this->subject->insert($data);
        }

        echo json_encode("OK");
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    /********* Search all projects saved in the BDD **********/

    public function getAll() {
        $this->load->model("meeting_app_subjects", "subject");
        $subjects = $this->subject->get_all();

        if ($subjects == false) {
            echo json_encode(array());
        } else {
            echo json_encode($subjects);
        }

    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    /********* Delete a project with id argument **********/

    public function delete($id) {
        $this->load->model("meeting_app_subjects", "subject");
        $this->subject->delete($id);


        echo json_encode("OK");
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    public function getSubByProject($id_project){
        $this->load->model("meeting_app_subjects", "subject");
        $subjects = $this->subject->get_all(array("id_project" => $id_project));

        if ($subjects == false) {
            echo json_encode(array());
        } else {
            echo json_encode($subjects);
        }
    }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getSubByMeet($id_meet){
        $this->load->model("meeting_app_subjects", "subject");
        $subjects = $this->subject->get_all(array("id_meet" => $id_meet));

        if ($subjects == false) {
            echo json_encode(array());
        } else {
            echo json_encode($subjects);
        }
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getNoteByMeet($id_meet){
        $this->load->model("meeting_app_notes", "note");
        $notes = $this->note->get_all(array("id_meet" => $id_meet));

        if ($notes == false) {
            echo json_encode(array());
        } else {
            echo json_encode($notes);
        }
    }





    public function saveNote() {

        $this->load->model("meeting_app_notes", "note");

        $this->load->library('session');
        $this->load->model("zeapps_users", "user");



        // constitution du tableau
        $data = [];

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }



        if (isset($data["id"]) && is_numeric($data["id"])) {
            $this->note->update($data, $data["id"]);

        } else {
            $data['id'] = $this->note->insert($data);
        }



        echo json_encode(array("id"=>$data["id"]));
    }



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function getNote() {
        $this->load->model("meeting_app_notes", "note");
        $notes = $this->note->get_all();

        if ($notes == false) {
            echo json_encode(array());
        } else {
            echo json_encode($notes);
        }

    }



    public function get($id) {
        $this->load->model("zeapps_timesheet_notes", "note");
        echo json_encode($this->note->get($id));
    }


    public function deleteNote($id) {
        $this->load->model("meeting_app_notes", "note");

        $this->note->delete($id);


        echo json_encode("OK");
    }

}





