
            <?php 
            session_start();
            if(isset($_GET['x']) && $_GET['x']=='home'){
                $page = "home.php";
                include "main.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='daftarmenu'){
                if ($_SESSION['leveluser_cafeku']==3 || $_SESSION['leveluser_cafeku']==1){
                    $page = "daftarmenu.php";
                    include "main.php";
                }else {
                    $page = "home.php";
                    include "main.php";
                }          
            }elseif (isset($_GET['x']) && $_GET['x']=='pesan'){
                if ($_SESSION['leveluser_cafeku']==3 || $_SESSION['leveluser_cafeku']==2 || $_SESSION['leveluser_cafeku']==1){
                    $page = "pesan.php";
                    include "main.php";
                }else {
                    $page = "home.php";
                    include "main.php";
                }   
            }elseif (isset($_GET['x']) && $_GET['x']=='dapur'){
                if ($_SESSION['leveluser_cafeku']==4 || $_SESSION['leveluser_cafeku']==1){
                    $page = "dapur.php";
                    include "main.php";
                }else {
                    $page = "home.php";
                    include "main.php";
                }   
            }elseif (isset($_GET['x']) && $_GET['x']=='user'){
                if ($_SESSION['leveluser_cafeku']==1){
                    $page = "user.php";
                    include "main.php";
                }else {
                    $page = "home.php";
                    include "main.php";
                }             
            }elseif (isset($_GET['x']) && $_GET['x']=='laporan'){
                if ($_SESSION['leveluser_cafeku']==1){
                    $page = "laporan.php";
                    include "main.php";
                }else {
                    $page = "home.php";
                    include "main.php";
                }  
                       
            }elseif (isset($_GET['x']) && $_GET['x']=='login'){
                include "login.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='logout'){
                include "proses/proses_logout.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='orderitem'){
                $page = "order_item.php";
                include "main.php";
            }elseif (isset($_GET['x']) && $_GET['x']=='viewitem'){
                $page = "view_item.php";
                include "main.php";
            }else {
                $page = "home.php";
                include "main.php";
            }
            ?>
            