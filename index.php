<?php

    session_start() ;
    require_once "base.php" ;
    require_once "function.php" ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body class="bg-dark">

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 mx-auto">
                <div class="my-5">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-uppercase">Register Form</h3> 

                            <hr>

                            <?php 
                            
                                if(isset($_POST['reg'])){

                                    register() ;
 
                                }
                            
                            ?>

                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name" class="text-primary font-weight-bold">Your Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="<?php echo old('name') ; ?>" placeholder="Your name">
                                    <?php if(getError('name')){ ?>
                                        <small class="text-danger font-weight-bold"><?php echo getError('name') ; ?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="text-primary font-weight-bold">Your Email</label>
                                    <input type="text" name="email" id="email" class="form-control" value="<?php echo old('email') ; ?>" placeholder="Your Email">
                                    <?php if(getError('email')){ ?>
                                        <small class="text-danger font-weight-bold"><?php echo getError('email') ; ?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="text-primary font-weight-bold">Your Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="<?php echo old('phone') ; ?>" placeholder="Your Phone">
                                    <?php if(getError('phone')){ ?>
                                        <small class="text-danger font-weight-bold"><?php echo getError('phone') ; ?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group">
                                    <label for="address" class="text-primary font-weight-bold">Your Address</label>
                                    <textarea type="text" name="address" id="address" class="form-control" placeholder="Your Address"><?php echo old('address') ; ?></textarea>
                                    <?php if(getError('address')){ ?>
                                        <small class="text-danger font-weight-bold"><?php echo getError('address') ; ?></small>
                                    <?php } ?>
                                </div>


                                <div class="form-group">   
                                    <label for="" class="text-primary font-weight-bold">Your Gender</label>                         
                                    <div class="border rounded p-2 text-center">
                                        <?php foreach($genderArr as $g){ ?>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" id="<?php echo $g ; ?>_id" name="gender" <?php echo (old('gender') == $g ? 'checked' : '') ?> class="custom-control-input" value="<?php echo $g ; ?>">
                                                <label class="custom-control-label text-capitalize" for="<?php echo $g ; ?>_id"><?php echo $g ; ?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php if(getError('gender')){ ?>
                                        <small class="text-danger font-weight-bold"><?php echo getError('gender') ; ?></small>
                                    <?php } ?>
                                </div>

                                <div class="form-group">     
                                    <label for="" class="text-primary font-weight-bold">Your Skill</label>                       
                                    <div class="border rounded p-2 text-center">
                                        <?php foreach($skillArr as $s){ ?>                                            
                                            <div class="custom-control custom-checkbox custom-control-inline">
                                                <input type="checkbox" name="skill[]" class="custom-control-input" 
                                                value="<?php echo $s ; ?>" 
                                                id="<?php echo $s ; ?>_skill"
                                                <?php
                                                
                                                    if(old('skill')){
                                                        echo in_array($s, old('skill')) ? 'checked' : '' ; 
                                                    } 

                                                ?>
                                                >
                                                <label class="custom-control-label" for="<?php echo $s ; ?>_skill"><?php echo $s ; ?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <?php if(getError('skill')){ ?>
                                        <small class="text-danger font-weight-bold"><?php echo getError('skill') ; ?></small>
                                    <?php } ?>
                                </div>


                                <div class="form-group">
                                    <label for="upload" class="text-primary font-weight-bold">Your Photo</label>
                                    <input type="file" name="upload" id="upload" class="form-control p-1" value="<?php echo old('upload') ; ?>" >
                                    <?php if(getError('upload')){ ?>
                                        <small class="text-danger font-weight-bold"><?php echo getError('upload') ; ?></small>
                                    <?php } ?>
                                </div>

                                <hr>                                

                                <div class="form-row justify-content-between align-items-center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch" checked required>
                                    <label class="custom-control-label" for="customSwitch">All Correct</label>
                                </div>
                                    <button class="btn btn-primary" name="reg">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

    <?php clearError() ; ?>
    
</body>
</html>