  
<?php
include "comment.php";

$method = $_SERVER['REQUEST_METHOD'];

if(isset($_SERVER['PATH_INFO']))
	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
else
	$request="";

$db=mysqli_connect("localhost","root","","vaja1");
$db->set_charset("UTF8");

$elements = null;

//restful_api/comments
if(isset($request[0])&&($request[0]=='comments')) {
    switch ($method) {
        case 'GET':
            if(isset($request[1])) // e.g. /restful_api/categories/1
                $elements = Comment::vsi($db, $request[1]);
            break;
        case 'POST':
            parse_str(file_get_contents('php://input'),$input);
            if(isset($input)){
                Comment::dodaj($db, $input["name"], $input["email"],
                " ", $input["comment"], $input["iduser"], $input["addid"] );
            }
            break;
        case 'PUT':
            
            break;
        case 'DELETE':
            break;
    }
}

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
echo json_encode($elements);
?>