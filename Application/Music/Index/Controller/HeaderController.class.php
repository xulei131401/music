<?php
namespace Index\Controller;
use Think\Controller;
class HeaderController extends Controller {
    function index(){
    	$this->display("header");
    }
    function head(){
    	$this->display("head");
    }
}
?>