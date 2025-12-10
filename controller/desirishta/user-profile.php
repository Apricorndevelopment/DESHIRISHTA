<?php
include 'header.php';
include 'config.php';

$userid = $_COOKIE['dr_userid'];

if($userid == '')
{
    header('location:login.php');
}
?>
        <!-- LOGIN -->
        <section>
            <div class="db">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-lg-3">
                            <?php
                            include 'user-sidebar.php';
                            ?>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="row">
                                <div class="col-md-12 db-sec-com db-pro-stat-pg">
                                    <?php
                                    $sqlformfill = "select * from registration where userid = '$userid'";
                                    $resultformfill = mysqli_query($con,$sqlformfill);
                                    $rowformfill = mysqli_fetch_assoc($resultformfill);
                                    ?>
                                    
                                    <div class="form-login white-box p-0">
                                        <form>
                                            <!--PROFILE BIO-->
                                            <div class="edit-pro-parti">
                                                <div class="form-tit p-3 tophead" style="position:relative">
                                                    <h1 class="text-white">Basic Information</h1>
                                                    <a href="user-profile-edit.php?tab=basic" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                </div>
                                                <div class="row p-4">
                                                <?php
                                                $sqlbasicinfo = "select * from basic_info where userid = '$userid'";
                                                $resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
                                                $rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);
                                                ?>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb ">Profile created by</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['createby'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['createby']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb">Name</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['fullname'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['fullname']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb ">Gender</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['gender'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['gender']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb ">Marital Status</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['marital'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['marital']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    if($rowbasicinfo['children'] != '')
                                                    {
                                                    ?>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb ">Have Children</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['children'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['children']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb ">Age</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['age'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['age']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb ">Height</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['height'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['height']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb ">Weight</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['weight'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['weight']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb ">Any Disability</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['physical'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['physical']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb ">Language Known</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['langauge'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowbasicinfo['langauge']); ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb ">Eating Habits</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['eating'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['eating']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb ">Smoking Habits</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['smoking'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['smoking']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 form-group row">
                                                        <div class="col-md-5">
                                                            <label class="lb ">Drinking Habits</label> 
                                                        </div>
                                                        <div class="col-md-2">:</div>
                                                        <div class="col-md-5">
                                                            <?php
                                                            if($rowbasicinfo['drinking'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['drinking']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                         
                                     <div class="form-login white-box p-0 mt-5">
                                        <form>
                                            <!--PROFILE BIO-->
                                            <div class="edit-pro-parti">
                                                <div class="form-tit p-3 tophead" style="position:relative">
                                                    <h1 class="text-white">About <?php if($rowformfill['groomlocation'] == 'Done') { echo "Groom"; } if($rowformfill['bridelocation'] == 'Done') { echo "Bride"; } ?></h1>
                                                    <a href="user-profile-edit.php?tab=aboutme" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                </div>
                                                <div class="row p-4">
                                                <?php
                                                $sqlbasicinfo = "select * from basic_info where userid = '$userid'";
                                                $resultbasicinfo = mysqli_query($con,$sqlbasicinfo);
                                                $rowbasicinfo = mysqli_fetch_assoc($resultbasicinfo);
                                                ?>
                                                    <div class="col-md-12 form-group row">
                                                        <div class="col-md-12">
                                                            <?php
                                                            if($rowbasicinfo['aboutme'] != '')
                                                            {
                                                            ?>
                                                            <label class="lb text-brown"><?php echo $rowbasicinfo['aboutme']; ?></label>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <label class="lb text-info">Enter Details</label>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>   
                                    
                                    <div class="form-login white-box p-0 mt-5">
                                        <form>
                                        <!--PROFILE BIO-->
                                                        <div class="edit-pro-parti">
                                                            <div class="form-tit p-3 tophead" style="position:relative">
                                                                <h1 class="text-white">Astro Details</h1>
                                                                <a href="user-profile-edit.php?tab=astro" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                            </div>
                                                            <div class="row p-4">
                                                                <?php
                                                                $sqlastroinfo = "select * from astro_info where userid = '$userid'";
                                                                $resultastroinfo = mysqli_query($con,$sqlastroinfo);
                                                                $rowastroinfo = mysqli_fetch_assoc($resultastroinfo);
                                                                ?>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Date of Birth</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowastroinfo['dob'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowastroinfo['dob']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Place of Birth</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowastroinfo['birthplace'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowastroinfo['birthplace']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Time of Birth</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowastroinfo['birthtime'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowastroinfo['birthtime']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Dosh/Dosham</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowastroinfo['manglik'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowastroinfo['manglik']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--END PROFILE BIO-->
                                                        
                                                    </form>
                                    </div>
                                                
                                    <div class="form-login white-box p-0 mt-5">
                                        <form>
                                                        <!--PROFILE BIO-->
                                                        <div class="edit-pro-parti">
                                                            <div class="form-tit p-3 tophead" style="position:relative">
                                                                <h1 class="text-white">Religious Background</h1>
                                                                <a href="user-profile-edit.php?tab=religious" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                            </div>
                                                            <div class="row p-4">
                                                                <?php
                                                                $sqlreligiousinfo = "select * from religious_info where userid = '$userid'";
                                                                $resultreligiousinfo = mysqli_query($con,$sqlreligiousinfo);
                                                                $rowreligiousinfo = mysqli_fetch_assoc($resultreligiousinfo);
                                                                ?>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Religion</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowreligiousinfo['religion'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowreligiousinfo['religion']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row" id="caste">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Caste</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowreligiousinfo['caste'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowreligiousinfo['caste']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Sub-caste</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowreligiousinfo['subcaste'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowreligiousinfo['subcaste']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Gothram</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowreligiousinfo['gothram'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowreligiousinfo['gothram']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--END PROFILE BIO-->
                                                        
                                                    </form>
                                    </div>
                                                
                                    <div class="form-login white-box p-0 mt-5">
                                        <form>
                                                        <!--PROFILE BIO-->
                                                        <div class="edit-pro-parti">
                                                            <div class="form-tit p-3 tophead" style="position:relative">
                                                                <h1 class="text-white">Education & Career</h1>
                                                                <a href="user-profile-edit.php?tab=educationcareer" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                            </div>
                                                            <div class="row p-4">
                                                                <?php
                                                                $sqleudcationinfo = "select * from education_info where userid = '$userid'";
                                                                $resulteudcationinfo = mysqli_query($con,$sqleudcationinfo);
                                                                $roweudcationinfo = mysqli_fetch_assoc($resulteudcationinfo);
                                                                ?>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Stream</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($roweudcationinfo['stream'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $roweudcationinfo['stream']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row"  id="education">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Highest Education</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($roweudcationinfo['education'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $roweudcationinfo['education']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">College / Institution</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($roweudcationinfo['college'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $roweudcationinfo['college']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Working With</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($roweudcationinfo['workingwith'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $roweudcationinfo['workingwith']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Profession</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($roweudcationinfo['profession'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $roweudcationinfo['profession']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-6 form-group row" id="designation">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Designation</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($roweudcationinfo['designation'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $roweudcationinfo['designation']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Profession in Detail</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($roweudcationinfo['professiondetail'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $roweudcationinfo['professiondetail']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Employer Name</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($roweudcationinfo['employername'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $roweudcationinfo['employername']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Annual Income</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($roweudcationinfo['income'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $roweudcationinfo['income']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--END PROFILE BIO-->
                                                        
                                                    </form>
                                    </div>
                                    
                                    <div class="form-login white-box p-0 mt-5">
                                        <form>    
                                                        <!--PROFILE BIO-->
                                                        <div class="edit-pro-parti">
                                                            <div class="form-tit p-3 tophead" style="position:relative">
                                                                <h1 class="text-white"><?php if($rowformfill['groomlocation'] == 'Done') { echo "Groom"; } if($rowformfill['bridelocation'] == 'Done') { echo "Bride"; } ?> Location </h1>
                                                                <a href="user-profile-edit.php?tab=groom" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                            </div>
                                                            <div class="row p-4">
                                                                <?php
                                                                $sqlgroomlocation = "select * from groom_location where userid = '$userid'";
                                                                $resultgroomlocation = mysqli_query($con,$sqlgroomlocation);
                                                                $rowgroomlocation = mysqli_fetch_assoc($resultgroomlocation);
                                                                ?>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Country</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowgroomlocation['country'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowgroomlocation['country']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                if($rowgroomlocation['country'] != 'India')
                                                                {
                                                                ?>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Citizenship</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowgroomlocation['citizenship'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowgroomlocation['citizenship']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Resident Status</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowgroomlocation['resident'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowgroomlocation['resident']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                }
                                                                ?>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">State</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowgroomlocation['state'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("_", " ",$rowgroomlocation['state']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">City</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        
                                                                        <?php
                                                                        if($rowgroomlocation['city'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown">
                                                                            <?php
                                                                            $cityarray1 = explode("//", $rowgroomlocation['city']);
                                                                            $state11 = str_replace("_", " ", $rowgroomlocation['state']);
                                                                            
                                                                            $sqlcitydata = "select * from city_state where state = '$state11'";
                                                                            $resultcitydata = mysqli_query($con,$sqlcitydata);
                                                                            while($rowcitydata = mysqli_fetch_assoc($resultcitydata))
                                                                            {
                                                                            
                                                                                if(in_array($rowcitydata['city'],$cityarray1)) 
                                                                                { 
                                                                                    echo $city11 = $rowcitydata['city']; 
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Ancestral Origin</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowgroomlocation['ancestralorigin'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowgroomlocation['ancestralorigin']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </form>
                                    </div>
                                                
                                    <div class="form-login white-box p-0 mt-5">
                                        <form>    
                                                        <!--PROFILE BIO-->
                                                        <div class="edit-pro-parti">
                                                            <div class="form-tit p-3 tophead" style="position:relative">
                                                                <h1 class="text-white">Family Details </h1>
                                                                <a href="user-profile-edit.php?tab=family" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                            </div>
                                                            <div class="row p-4">
                                                                <?php
                                                                $sqlfamilyinfo = "select * from family_info where userid = '$userid'";
                                                                $resultfamilyinfo = mysqli_query($con,$sqlfamilyinfo);
                                                                $rowfamilyinfo = mysqli_fetch_assoc($resultfamilyinfo);
                                                                ?>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Family Value</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['familyvalue'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['familyvalue']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Family Type</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['familytype'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['familytype']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Family Status</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['familystatus'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['familystatus']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Native Place</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['nativeplace'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['nativeplace']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Father's Occupation</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['fatheroccupation'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['fatheroccupation']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Mother's Occupation</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['motheroccupation'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['motheroccupation']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">No. Of Brothers</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['brothers'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['brothers']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Brothers Married</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['bromarried'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['bromarried']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">No. Of Sisters</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['sisters'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['sisters']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Sisters Married</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['sismarried'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['sismarried']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Family Location</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['familylocation'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['familylocation']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                if($rowfamilyinfo['familylocation'] == "Different Location")
                                                                {
                                                                ?>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">State</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['state'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['state']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row" id="city">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">City</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['city'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['city']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Country</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowfamilyinfo['country'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowfamilyinfo['country']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                }
                                                                ?>
                                                            </div>
                                                            
                                                        </div>
                                                        <!--END PROFILE BIO-->
                                                        
                                                    </form>
                                    </div>
                                                
                                    <div class="form-login white-box p-0 mt-5">
                                        <form>    
                                                        <!--PROFILE BIO-->
                                                        <div class="edit-pro-parti">
                                                            <div class="form-tit p-3 tophead" style="position:relative">
                                                                <h1 class="text-white">Hobbies & Interest</h1>
                                                                <a href="user-profile-edit.php?tab=hobbies" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                            </div>
                                                            <div class="row p-4">
                                                                <?php
                                                                $sqlhobbiesinfo = "select * from hobbies_info where userid = '$userid'";
                                                                $resulthobbiesinfo = mysqli_query($con,$sqlhobbiesinfo);
                                                                $rowhobbiesinfo = mysqli_fetch_assoc($resulthobbiesinfo);
                                                                ?>
                                                                <div class="col-md-12 form-group row">
                                                                    <div class="col-md-12">
                                                                        <label class="lb ">Hobbies and interest</label> 
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <?php
                                                                        if($rowhobbiesinfo['hobbies'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowhobbiesinfo['hobbies']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 form-group row">
                                                                    <div class="col-md-12">
                                                                        <label class="lb ">Favourite Music</label> 
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <?php
                                                                        if($rowhobbiesinfo['music'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowhobbiesinfo['music']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 form-group row">
                                                                    <div class="col-md-12">
                                                                        <label class="lb ">Sports you like</label> 
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <?php
                                                                        if($rowhobbiesinfo['sports'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowhobbiesinfo['sports']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 form-group row">
                                                                    <div class="col-md-12">
                                                                        <label class="lb ">Your Favourite Food</label> 
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <?php
                                                                        if($rowhobbiesinfo['food'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowhobbiesinfo['food']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--END PROFILE BIO-->
                                                        
                                                    </form>
                                    </div>
                                                
                                    <div class="form-login white-box p-0 mt-5">
                                        <form>
                                                        <!--PROFILE BIO-->
                                                        <div class="edit-pro-parti">
                                                            <div class="form-tit p-3 tophead" style="position:relative">
                                                                <h1 class="text-white">Partner Preferences</h1>
                                                                <a href="user-profile-edit.php?tab=partner" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                            </div>
                                                            <div class="row p-4">
                                                                <?php
                                                                $sqlpartnerinfo = "select * from partner_info where userid = '$userid'";
                                                                $resultpartnerinfo = mysqli_query($con,$sqlpartnerinfo);
                                                                $rowpartnerinfo = mysqli_fetch_assoc($resultpartnerinfo);
                                                                ?>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Marital Status</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnermarital'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowpartnerinfo['partnermarital']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Partner Age</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnerage'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("-", " to ", $rowpartnerinfo['partnerage']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Height</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnerheight'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("-", " to ", $rowpartnerinfo['partnerheight']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Mother Tongue</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnertongue'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowpartnerinfo['partnertongue']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Physical Status</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnerphysical'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowpartnerinfo['partnerphysical']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Eating Habits</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnereating'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowpartnerinfo['partnereating']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Drinking Habits</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnerdrinking'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowpartnerinfo['partnerdrinking']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Smoking Habits</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnersmoking'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowpartnerinfo['partnersmoking']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Religion</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnerreligion'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowpartnerinfo['partnerreligion']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Caste</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnercaste'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowpartnerinfo['partnercaste']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Manglik</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnermanglik'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowpartnerinfo['partnermanglik']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Stream</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnerstream'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowpartnerinfo['partnerstream']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Highesh Education</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnereducation'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowpartnerinfo['partnereducation']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">College / Institution</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnercollege'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowpartnerinfo['partnercollege']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Profession</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnerprofession'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowpartnerinfo['partnerprofession']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Working With</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnerdomain'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowpartnerinfo['partnerdomain']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Designation</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnerdesignation'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowpartnerinfo['partnerdesignation']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Employer Name</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partneremployername'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowpartnerinfo['partneremployername']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Annual Income</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnerincome'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowpartnerinfo['partnerincome']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">State</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnerstate'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowpartnerinfo['partnerstate']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row" id="partnercity">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">City</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnercity'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowpartnerinfo['partnercity']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Country</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowpartnerinfo['partnercountry'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo str_replace("//", ", ", $rowpartnerinfo['partnercountry']); ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--END PROFILE BIO-->
                                                        
                                                    </form>
                                    </div>
                                                
                                    <div class="form-login white-box p-0 mt-5">
                                        <form>
                                                        <!--PROFILE BIO-->
                                                        <div class="edit-pro-parti">
                                                            <div class="form-tit p-3 tophead" style="position:relative">
                                                                <h1 class="text-white">Contact Details</h1>
                                                                <a href="user-profile-edit.php?tab=contact" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                            </div>
                                                            <div class="row p-4">
                                                                <?php
                                                                $sqlcontactinfo = "select * from contact_info where userid = '$userid'";
                                                                $resultcontactinfo = mysqli_query($con,$sqlcontactinfo);
                                                                $rowcontactinfo = mysqli_fetch_assoc($resultcontactinfo);
                                                                ?>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Phone Number</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowcontactinfo['phonenumber'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowcontactinfo['phonenumber']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Email</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowcontactinfo['email'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowcontactinfo['email']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Name of Contact Person</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowcontactinfo['contactperson'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowcontactinfo['contactperson']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 form-group row">
                                                                    <div class="col-md-5">
                                                                        <label class="lb ">Relationship with the member</label> 
                                                                    </div>
                                                                    <div class="col-md-2">:</div>
                                                                    <div class="col-md-5">
                                                                        <?php
                                                                        if($rowcontactinfo['relationship'] != '')
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-brown"><?php echo $rowcontactinfo['relationship']; ?></label>
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                        ?>
                                                                        <label class="lb text-info">Enter Details</label>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--END PROFILE BIO-->
                                                        
                                                    </form>
                                    </div>
                                                
                                    <div class="form-login white-box p-0 mt-5">
                                        <form>
                                                        <!--PROFILE BIO-->
                                                        <div class="edit-pro-parti">
                                                            <div class="form-tit p-3 tophead" style="position:relative">
                                                                <h1 class="text-white">Manage Photos</h1>
                                                                <a href="user-profile-edit.php?tab=photos" class="sett-edit-btn sett-acc-edit-eve"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
                                                            </div>
                                                            <div class="row p-4">
                                                                <?php
                                                                $sqlphotosinfo = "select * from photos_info where userid = '$userid'";
                                                                $resultphotosinfo = mysqli_query($con,$sqlphotosinfo);
                                                                $rowphotosinfo = mysqli_fetch_assoc($resultphotosinfo);
                                                                ?>
                                                                <div class="col-md-4 form-group row">
                                                                    <?php
                                                                    if($rowphotosinfo['profilepic'] != '')
                                                                    {
                                                                    ?>
                                                                    <img src="userphoto/<?php echo $rowphotosinfo['profilepic']; ?>" style="width:100%">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-4 form-group row">
                                                                    <?php
                                                                    if($rowphotosinfo['photo1'] != '')
                                                                    {
                                                                    ?>
                                                                    <img src="userphoto/<?php echo $rowphotosinfo['photo1']; ?>" style="width:100%">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-4 form-group row">
                                                                    <?php
                                                                    if($rowphotosinfo['photo2'] != '')
                                                                    {
                                                                    ?>
                                                                    <img src="userphoto/<?php echo $rowphotosinfo['photo2']; ?>" style="width:100%">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-4 form-group row">
                                                                    <?php
                                                                    if($rowphotosinfo['photo3'] != '')
                                                                    {
                                                                    ?>
                                                                    <img src="userphoto/<?php echo $rowphotosinfo['photo3']; ?>" style="width:100%">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-4 form-group row">
                                                                    <?php
                                                                    if($rowphotosinfo['photo4'] != '')
                                                                    {
                                                                    ?>
                                                                    <img src="userphoto/<?php echo $rowphotosinfo['photo4']; ?>" style="width:100%">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-4 form-group row">
                                                                    <?php
                                                                    if($rowphotosinfo['photo5'] != '')
                                                                    {
                                                                    ?>
                                                                    <img src="userphoto/<?php echo $rowphotosinfo['photo5']; ?>" style="width:100%">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--END PROFILE BIO-->
                                                        
                                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END -->
<?php
include 'footer.php';
?>