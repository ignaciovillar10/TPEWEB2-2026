<?php
include_once('models/task.model.php');
include_once('views/task.view.php');
include_once('helpers/auth.helper.php');

class TaskController {

    private $model;
    private $view;

    public function __construct() {

        // barrera para usuario logueado
        $authHelper = new AuthHelper();
        $authHelper->checkLoggedIn();

        $this->model = new TaskModel();
        $this->view = new TaskView();
    }

    /**
     * Muestra la lista de tareas.
     */
    public function showTasks() {

        // obtengo tareas del model
        $tareas = $this->model->getAll();

        // se las paso a la vista
        $this->view->showTasks($tareas);
    }

    public function showTask($params = null) {
        $idTarea = $params[':ID'];
        $tarea = $this->model->get($idTarea);

        if ($tarea) // si existe la tarea
            $this->view->showTask($tarea);
        else
            $this->view->showError('La tarea no existe');
    }

    /**
     * Agrega una nueva tarea a la lista.
     */
    public function addTask() {

        $titulo = $_POST['titulo'];
        $descripcion = $_POST['descripcion'];
        $prioridad = $_POST['prioridad'];
   
        if (!empty($titulo) && !empty($prioridad)) {
            $agregar = true;
            if ($prioridad == 5) {
                //Verificar que no exista una tarea con prioridad 5 no finalizada.
                $tareas = $this->model->getTasks(5, 0);
                if (count($tareas) > 0)
                    $agregar = false;
            }

            if ($agregar){
                if($_FILES['input_name']['type'] == "image/jpg" || $_FILES['input_name']['type'] == "image/jpeg" 
                    || $_FILES['input_name']['type'] == "image/png" ) {
                    $this->model->save($titulo, $descripcion, $prioridad, $_FILES['input_name']);
                }
                else {
                    $this->model->save($titulo, $descripcion, $prioridad);
                }
                header("Location: " . VER);
            }
            else
                $this->view->showError("Ya existe una tarea con prioridad 5.");
        } else {
            $this->view->showError("Faltan datos obligatorios");
        }
    }

    public function endTask($params = null) {
        $idTarea = $params[':ID'];
        $this->model->end($idTarea);
        header("Location: " . VER);
    }

    public function deleteTask($params = null) {
        $idTarea = $params[':ID'];
        $this->model->delete($idTarea);
        header("Location: " . VER);
    }

}