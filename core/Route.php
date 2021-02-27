<?php

class Route{
    public static function initialization(object $router){
        $router->addRoute('/', function(){
            $articles = ArticleModel::getList();
            include('view/homepage.php');
        });
        $router->addRoute('/[date:publication_date]/[a:slug]/', function($route, $variables){
            include('view/post.php');
        });
    }

    private function checkRoute($route){
        // return ArticleModel::exists();
    }
}