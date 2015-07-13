<?php
class StudentController {

    /**
     * It's a default action.
     *
     * It creates a first page.
     */
    public static function indexAction() {
        require 'View.php';
        require 'Model/Student.php';
        $student      = new Student();
        $student_desc = $student->get_student_desc();
        $students     = $student->get_students();
        $view         = new View('index',
                            array('student_desc' => $student_desc,
                                  'students'     => $students));
    }

    /**
     * addAction need to add new record into student table in the database.
     */
    public static function addAction() {
        require 'Model/Student.php';
        $student  = new Student();
        $params   = array();
        $request  = FrontController::get_request();

        $params['first_name'] = $request->get('first_name');
        $params['last_name']  = $request->get('last_name');
        $params['age']        = $request->get('age');
        $params['sex']        = $request->get('sex');
        $params['group']      = $request->get('group');
        $params['faculty']    = $request->get('faculty');

        echo $student->add($params);
    }

    /**
     * deleteAction delete a record in the student table in the database.
     */
    public static function deleteAction() {
        require 'Model/Student.php';
        $student = new Student();
        $request = FrontController::get_request();
        if ($student->delete($request->get('student_id'))) {
            echo 'done';
        };
    }

    /**
     * editAction update a record in the database.
     */
    public static function editAction() {
        require 'Model/Student.php';
        $student = new Student();
        $request = FrontController::get_request();
        $params  = array();

        $params['id']         = $request->get('id');
        $params['first_name'] = $request->get('first_name');
        $params['last_name']  = $request->get('last_name');
        $params['age']        = $request->get('age');
        $params['sex']        = $request->get('sex');
        $params['group']      = $request->get('group');
        $params['faculty']    = $request->get('faculty');

        if ($student->edit($params)) {
            echo 'done';
        };
    }
}
