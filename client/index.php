<?
require_once ("../server/appConfig.php");

if (isset($_GET['action'])){
    switch ($_GET['action']){
        case 'groups':
            require_once ("../server/workDB.php");

            $db = new workDB($db_host,$user_name,$password,$db_name/*test*/,FILE);
            $arr = $db->getGroups();
            $ret = [];
            $lastCourse = null;
            $lastElement = null;
            foreach ($arr as $key => $val){
                /*  echo $key.'='.$val.'</br>';
                  echo print_r($val);
                */
                if ($lastCourse != $val['cid']){
                    if ($lastElement != null)
                        $ret[] = $lastElement;
                    $lastElement = array ('name'=> $val['cname'], 'groups'=>[]);
                    $lastCourse=$val['cid'];
                }

                //   print_r($ret);
                $lastElement['groups'][] = array('name'=> $val['name'], 'id'=> $val['id']);
                // print_r($lastElement);
            }
            $ret[] = $lastElement;
            echo json_encode($ret);
            break;
        case 'getschedule':
            break;
        case 'generateschedule':
            include_once '../server/index.php';

            break;
        default :
            echoIndex();
            break;
    }
}else{
    echoIndex();
}

function echoIndex() {
    ?>
    <!DOCTYPE html>
    <meta name="viewport" content="width=device-width, initial-scale=0.9">
    <title>Schedule</title>
    <link rel="shortcut icon" href="css/img/favicon.ico" type="image/x-icon">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/lib/bootstrap.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" title="no title" charset="utf-8">
    <script src="js/lib/react.js" charset="utf-8"></script>
    <script src="js/lib/react-dom.js" charset="utf-8"></script>
    <script src="js/lib/bootstrap.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/babel-core/5.8.23/browser.min.js"></script>
    <script src="js/lib/jquery.cookie.js" async></script>
    <main id="main"></main>
    <script type="text/javascript" src="js/cookies.js" charset="utf-8" async></script>
    <script type="text/javascript" src="js/script.js" charset="utf-8" async></script>
    <script type="text/babel" src="js/render.js" charset="utf-8" async></script>
    <?
}
