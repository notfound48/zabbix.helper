<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Curl;

class DcHetzner extends Model
{

    public $url = 'https://robot-ws.your-server.de/';
    protected $username;
    protected $password;

    public function __construct($username, $password)
    {
        parent::__construct();

        $this->username = $username;
        $this->password = $password;
    }

    public function server($parameters){
        return json_decode(Curl::to($this->url . __FUNCTION__ . '/' . $parameters['server_name'])
            ->withOption('USERPWD', decrypt($this->username) . ":" . decrypt($this->password))
            ->get(), true);
    }
}
