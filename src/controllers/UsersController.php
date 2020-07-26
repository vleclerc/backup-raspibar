<?php

class UsersController extends MyController {
    
    public function getAction($request) {

        $users = new Users();
        $datetime = new Datetime();
        $seconds = $datetime->format('s');
        $res = $users->insert([
            '1' => 'test'.$seconds,
        ]);

        $data = new stdClass();
        $this->response = new ResponseModel();
        $data->message = $users->get(1);
        $this->response->setData($data);
        return $this->response->toJson();
    }

}
