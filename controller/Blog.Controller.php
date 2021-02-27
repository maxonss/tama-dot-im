<?php
/**
 * Blog's controller : mainly called by the Mezon\Router class
 * @version 0.0.1 (2021/02/22)
 * @author Maxence Puhetini
 * @see https://github.com/alexdodonov/mezon-router
 */
class Blog{
    public function actionIndex(){
        include "view/homepage.php";
        echo "ok";
    }

    public static function actionPosts($route, $variables){
        echo "getPosts() method called";
        return var_dump($route,$variables);
    }
    public static function someStaticMethod(){
        return "ok";
    }
}