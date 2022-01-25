<?php 

function old($inputName){

    if(isset($_POST[$inputName])){
        return $_POST[$inputName];
    }else{
        return "" ;
    }

}


function setError($inputName, $message){

    $_SESSION['error'][$inputName] = $message ;

}


function getError($inputName){

    if(isset($_SESSION['error'][$inputName])){
        return $_SESSION['error'][$inputName];
    }else{
        return "" ;
    }

}


function clearError(){

    $_SESSION['error'] = [] ;

}

function textFilter($text){

    $text = trim($text) ;
    $text = htmlentities($text, ENT_QUOTES) ;
    $text = stripcslashes($text);

    return $text ;

};




function register(){

    global $genderArr, $skillArr, $data ;

    $errorStatus = 0 ;
    $name = "" ;
    $email = "" ;
    $phone = "" ;
    $address = "" ;
    $gender = "" ;
    $skill = "" ;



    if(empty($_POST['name'])){
        setError('name', "Name is Required") ;
        $errorStatus = 1 ;
    }else{
        if(strlen($_POST['name']) < 5){
            setError('name', "Name is too short") ;
            $errorStatus = 1 ;
        }else{
            if(strlen($_POST['name']) > 20){
                setError('name', "Name is too long") ;
                $errorStatus = 1 ;
            }else{
                if (!preg_match("/^[a-zA-Z-' ]*$/",$_POST['name'])) {  // A-z စစ်တာ 
                    setError('name', 'Only letters and white space allowed') ;
                    $errorStatus = 1 ;
                }else{
                    $name = textFilter($_POST['name']) ;                   
                    
                }
            }
        }
    }

    if(empty($_POST['email'])){
        setError("email","Email is required");
        $errorStatus=1;
    }else{
        if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
            setError("email","Email Format Incorrect");
            $errorStatus=1;
        }else{
            $email = textFilter($_POST['email']);
        }
    }
    

    if(empty($_POST['phone'])){
        setError("phone","Phone Number is required");
        $errorStatus=1;
    }else{
        if (!preg_match("/^[0-9-' ]*$/",$_POST['phone'])) {  
            setError('phone', 'Phone Format Incorrect') ;
            $errorStatus = 1 ;
        }else{
            $phone = textFilter($_POST['phone']) ;
        }
    }


    if(empty($_POST['address'])){
        setError("address","Address is required");
        $errorStatus=1;
    }else{
        if(strlen($_POST['address']) < 10){
            setError('address', "Address is too short") ;
            $errorStatus = 1 ;
        }else{
            if(strlen($_POST['address']) > 50){
                setError('address', "Address is too long") ;
                $errorStatus = 1 ;
            }else{
                $address = textFilter($_POST['address']) ;
            }
        }
    }


    if(empty($_POST['gender'])){
        setError("gender","Gender is required");
        $errorStatus=1;
    }else{
       if(!in_array($_POST['gender'], $genderArr)){
            setError("gender","Gender is Incorrect");
            $errorStatus=1;
       }else{
            $gender = textFilter($_POST['gender']) ;
       }
    }


    if(empty($_POST['skill'])){
        setError("skill","Skill is required");
        $errorStatus=1;
    }else{
        $skill = $_POST['skill'] ;
        $skillError = 0 ;
        foreach($skill as $s){
            if(!in_array($s, $skillArr)){
                setError("skill","Skill is Incorrect");
                $errorStatus=1;
                $skillError = 1 ;
           }
        }
        if(!$skillError){
            $skill = $_POST['skill'] ;
        }
    }


    

    if(isset($_FILES['upload']['name'])){
        $fileName = $_FILES['upload']['name'] ;
        $tempFile = $_FILES['upload']['tmp_name'] ;
        $supportFileType = ["image/png","image/jpeg"] ; 

        if(in_array($_FILES['upload']['type'], $supportFileType)){

            $saveFolder = "store/" ;
            move_uploaded_file($tempFile, $saveFolder.uniqid()."_".$fileName) ;

        }else{

            setError("upload","File is Incorrect");
            $errorStatus=1;
        }    

    }else{

        setError("upload","File is required");
        $errorStatus=1;

    }


    if(!$errorStatus){

        print_r($_POST) ;
        print_r($_FILES) ;
        
    } ;

}