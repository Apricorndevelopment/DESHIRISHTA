<?php
if($_POST['country'] == '')
{
    $country = $_COOKIE['dr_country'];
}
else
{
    $country = $_POST['country'];
}

if($_POST['city'] == '')
{
    $city = $_COOKIE['dr_city'];
}
else
{
    $city = $_POST['city'];
}
?>
<form action="filter-profiles.php" method="post">
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-icons">123</span></i>Age <span class="text-danger">*</span></h4>
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <select class="chosen-select" name="agefrom" required>
                                                <option value="">From</option>
                                                <?php
                                                for($agefrom = '18'; $agefrom <= '65'; $agefrom++)
                                                {
                                                ?>
                                                <option <?php if($_POST['agefrom'] == $agefrom) { echo "selected"; } ?> value="<?php echo $agefrom; ?>"><?php echo $agefrom; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <select class="chosen-select" name="ageto" required>
                                                <option value="">To</option>
                                                <?php
                                                for($ageto = '20'; $ageto <= '65'; $ageto++)
                                                {
                                                ?>
                                                <option <?php if($_POST['ageto'] == $ageto) { echo "selected"; } ?> value="<?php echo $ageto; ?>"><?php echo $ageto; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-icons">height</span></i>Height</h4>
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <select class="chosen-select" name="heightfrom">
                                                <option value="">From</option>
                                                <option <?php if($_POST['heightfrom'] == "4 Feet 5 Inches") { echo "selected"; } ?> value="4 Feet 5 Inches">4 Feet 5 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "4 Feet 6 Inches") { echo "selected"; } ?> value="4 Feet 6 Inches">4 Feet 6 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "4 Feet 7 Inches") { echo "selected"; } ?> value="4 Feet 7 Inches">4 Feet 7 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "4 Feet 8 Inches") { echo "selected"; } ?> value="4 Feet 8 Inches">4 Feet 8 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "4 Feet 9 Inches") { echo "selected"; } ?> value="4 Feet 9 Inches">4 Feet 9 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "4 Feet 10 Inches") { echo "selected"; } ?> value="4 Feet 10 Inches">4 Feet 10 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "4 Feet 11 Inches") { echo "selected"; } ?> value="4 Feet 11 Inches">4 Feet 11 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "5 Feet 0 Inches") { echo "selected"; } ?> value="5 Feet 0 Inches">5 Feet 0 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "5 Feet 1 Inches") { echo "selected"; } ?> value="5 Feet 1 Inches">5 Feet 1 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "5 Feet 2 Inches") { echo "selected"; } ?> value="5 Feet 2 Inches">5 Feet 2 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "5 Feet 3 Inches") { echo "selected"; } ?> value="5 Feet 3 Inches">5 Feet 3 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "5 Feet 4 Inches") { echo "selected"; } ?> value="5 Feet 4 Inches">5 Feet 4 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "5 Feet 5 Inches") { echo "selected"; } ?> value="5 Feet 5 Inches">5 Feet 5 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "5 Feet 6 Inches") { echo "selected"; } ?> value="5 Feet 6 Inches">5 Feet 6 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "5 Feet 7 Inches") { echo "selected"; } ?> value="5 Feet 7 Inches">5 Feet 7 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "5 Feet 8 Inches") { echo "selected"; } ?> value="5 Feet 8 Inches">5 Feet 8 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "5 Feet 9 Inches") { echo "selected"; } ?> value="5 Feet 9 Inches">5 Feet 9 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "5 Feet 10 Inches") { echo "selected"; } ?> value="5 Feet 10 Inches">5 Feet 10 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "5 Feet 11 Inches") { echo "selected"; } ?> value="5 Feet 11 Inches">5 Feet 11 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "6 Feet 0 Inches") { echo "selected"; } ?> value="6 Feet 0 Inches">6 Feet 0 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "6 Feet 1 Inches") { echo "selected"; } ?> value="6 Feet 1 Inches">6 Feet 1 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "6 Feet 2 Inches") { echo "selected"; } ?> value="6 Feet 2 Inches">6 Feet 2 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "6 Feet 3 Inches") { echo "selected"; } ?> value="6 Feet 3 Inches">6 Feet 3 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "6 Feet 4 Inches") { echo "selected"; } ?> value="6 Feet 4 Inches">6 Feet 4 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "6 Feet 5 Inches") { echo "selected"; } ?> value="6 Feet 5 Inches">6 Feet 5 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "6 Feet 6 Inches") { echo "selected"; } ?> value="6 Feet 6 Inches">6 Feet 6 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "6 Feet 7 Inches") { echo "selected"; } ?> value="6 Feet 7 Inches">6 Feet 7 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "6 Feet 8 Inches") { echo "selected"; } ?> value="6 Feet 8 Inches">6 Feet 8 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "6 Feet 9 Inches") { echo "selected"; } ?> value="6 Feet 9 Inches">6 Feet 9 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "6 Feet 10 Inches") { echo "selected"; } ?> value="6 Feet 10 Inches">6 Feet 10 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "6 Feet 11 Inches") { echo "selected"; } ?> value="6 Feet 11 Inches">6 Feet 11 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "7 Feet 0 Inches") { echo "selected"; } ?> value="7 Feet 0 Inches">7 Feet 0 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "7 Feet 1 Inches") { echo "selected"; } ?> value="7 Feet 1 Inches">7 Feet 1 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "7 Feet 2 Inches") { echo "selected"; } ?> value="7 Feet 2 Inches">7 Feet 2 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "7 Feet 3 Inches") { echo "selected"; } ?> value="7 Feet 3 Inches">7 Feet 3 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "7 Feet 4 Inches") { echo "selected"; } ?> value="7 Feet 4 Inches">7 Feet 4 Inches</option>
                                                <option <?php if($_POST['heightfrom'] == "7 Feet 5 Inches") { echo "selected"; } ?> value="7 Feet 5 Inches">7 Feet 5 Inches</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <select class="chosen-select" name="heightto">
                                                <option value="">To</option>
                                                <option <?php if($_POST['heightto'] == "5 Feet 0 Inches") { echo "selected"; } ?> value="5 Feet 0 Inches">5 Feet 0 Inches</option>
                                                <option <?php if($_POST['heightto'] == "5 Feet 1 Inches") { echo "selected"; } ?> value="5 Feet 1 Inches">5 Feet 1 Inches</option>
                                                <option <?php if($_POST['heightto'] == "5 Feet 2 Inches") { echo "selected"; } ?> value="5 Feet 2 Inches">5 Feet 2 Inches</option>
                                                <option <?php if($_POST['heightto'] == "5 Feet 3 Inches") { echo "selected"; } ?> value="5 Feet 3 Inches">5 Feet 3 Inches</option>
                                                <option <?php if($_POST['heightto'] == "5 Feet 4 Inches") { echo "selected"; } ?> value="5 Feet 4 Inches">5 Feet 4 Inches</option>
                                                <option <?php if($_POST['heightto'] == "5 Feet 5 Inches") { echo "selected"; } ?> value="5 Feet 5 Inches">5 Feet 5 Inches</option>
                                                <option <?php if($_POST['heightto'] == "5 Feet 6 Inches") { echo "selected"; } ?> value="5 Feet 6 Inches">5 Feet 6 Inches</option>
                                                <option <?php if($_POST['heightto'] == "5 Feet 7 Inches") { echo "selected"; } ?> value="5 Feet 7 Inches">5 Feet 7 Inches</option>
                                                <option <?php if($_POST['heightto'] == "5 Feet 8 Inches") { echo "selected"; } ?> value="5 Feet 8 Inches">5 Feet 8 Inches</option>
                                                <option <?php if($_POST['heightto'] == "5 Feet 9 Inches") { echo "selected"; } ?> value="5 Feet 9 Inches">5 Feet 9 Inches</option>
                                                <option <?php if($_POST['heightto'] == "5 Feet 10 Inches") { echo "selected"; } ?> value="5 Feet 10 Inches">5 Feet 10 Inches</option>
                                                <option <?php if($_POST['heightto'] == "5 Feet 11 Inches") { echo "selected"; } ?> value="5 Feet 11 Inches">5 Feet 11 Inches</option>
                                                <option <?php if($_POST['heightto'] == "6 Feet 0 Inches") { echo "selected"; } ?> value="6 Feet 0 Inches">6 Feet 0 Inches</option>
                                                <option <?php if($_POST['heightto'] == "6 Feet 1 Inches") { echo "selected"; } ?> value="6 Feet 1 Inches">6 Feet 1 Inches</option>
                                                <option <?php if($_POST['heightto'] == "6 Feet 2 Inches") { echo "selected"; } ?> value="6 Feet 2 Inches">6 Feet 2 Inches</option>
                                                <option <?php if($_POST['heightto'] == "6 Feet 3 Inches") { echo "selected"; } ?> value="6 Feet 3 Inches">6 Feet 3 Inches</option>
                                                <option <?php if($_POST['heightto'] == "6 Feet 4 Inches") { echo "selected"; } ?> value="6 Feet 4 Inches">6 Feet 4 Inches</option>
                                                <option <?php if($_POST['heightto'] == "6 Feet 5 Inches") { echo "selected"; } ?> value="6 Feet 5 Inches">6 Feet 5 Inches</option>
                                                <option <?php if($_POST['heightto'] == "6 Feet 6 Inches") { echo "selected"; } ?> value="6 Feet 6 Inches">6 Feet 6 Inches</option>
                                                <option <?php if($_POST['heightto'] == "6 Feet 7 Inches") { echo "selected"; } ?> value="6 Feet 7 Inches">6 Feet 7 Inches</option>
                                                <option <?php if($_POST['heightto'] == "6 Feet 8 Inches") { echo "selected"; } ?> value="6 Feet 8 Inches">6 Feet 8 Inches</option>
                                                <option <?php if($_POST['heightto'] == "6 Feet 9 Inches") { echo "selected"; } ?> value="6 Feet 9 Inches">6 Feet 9 Inches</option>
                                                <option <?php if($_POST['heightto'] == "6 Feet 10 Inches") { echo "selected"; } ?> value="6 Feet 10 Inches">6 Feet 10 Inches</option>
                                                <option <?php if($_POST['heightto'] == "6 Feet 11 Inches") { echo "selected"; } ?> value="6 Feet 11 Inches">6 Feet 11 Inches</option>
                                                <option <?php if($_POST['heightto'] == "7 Feet 0 Inches") { echo "selected"; } ?> value="7 Feet 0 Inches">7 Feet 0 Inches</option>
                                                <option <?php if($_POST['heightto'] == "7 Feet 1 Inches") { echo "selected"; } ?> value="7 Feet 1 Inches">7 Feet 1 Inches</option>
                                                <option <?php if($_POST['heightto'] == "7 Feet 2 Inches") { echo "selected"; } ?> value="7 Feet 2 Inches">7 Feet 2 Inches</option>
                                                <option <?php if($_POST['heightto'] == "7 Feet 3 Inches") { echo "selected"; } ?> value="7 Feet 3 Inches">7 Feet 3 Inches</option>
                                                <option <?php if($_POST['heightto'] == "7 Feet 4 Inches") { echo "selected"; } ?> value="7 Feet 4 Inches">7 Feet 4 Inches</option>
                                                <option <?php if($_POST['heightto'] == "7 Feet 5 Inches") { echo "selected"; } ?> value="7 Feet 5 Inches">7 Feet 5 Inches</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">diversity_4</span></i>Marital Status</h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="maritalstatus">
                                        <option value="">Select</option>
                                        <option <?php if($_POST['maritalstatus'] == "Never Married") { echo "selected"; } ?> value="Never Married">Never Married</option>
                                        <option <?php if($_POST['maritalstatus'] == "Divorced") { echo "selected"; } ?> value="Divorced">Divorced</option>
                                        <option <?php if($_POST['maritalstatus'] == "Widowed") { echo "selected"; } ?> value="Widowed">Widowed</option>
                                        <option <?php if($_POST['maritalstatus'] == "Awaiting Divorce") { echo "selected"; } ?> value="Awaiting Divorce">Awaiting Divorce</option>
                                    </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">temple_hindu</span></i>Religion</h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="religion">
                                        <option value="">Select</option>
                                        <option <?php if($_POST['religion'] == "Hindu") { echo "selected"; } ?> value="Hindu">Hindu</option>
                                        <option <?php if($_POST['religion'] == "Muslim") { echo "selected"; } ?> value="Muslim">Muslim</option>
                                        <option <?php if($_POST['religion'] == "Christain") { echo "selected"; } ?> value="Christain">Christain</option>
                                        <option <?php if($_POST['religion'] == "Christain") { echo "selected"; } ?> value="Sikh">Sikh</option>
                                        <option <?php if($_POST['religion'] == "Parsi") { echo "selected"; } ?> value="Parsi">Parsi</option>
                                        <option <?php if($_POST['religion'] == "Jain") { echo "selected"; } ?> value="Jain">Jain</option>
                                        <option <?php if($_POST['religion'] == "Buddhist") { echo "selected"; } ?> value="Buddhist">Buddhist</option>
                                        <option <?php if($_POST['religion'] == "Jewish") { echo "selected"; } ?> value="Jewish">Jewish</option>
                                        <option <?php if($_POST['religion'] == "Other") { echo "selected"; } ?> value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">reduce_capacity</span></i>Caste</h4>
                                <div class="form-group">
                                    <?php
                                    $caste_array = explode("','",$caste); 
                                    ?>
                                    <select class="form-select chosen-select" name="caste[]" multiple>
                                    <?php 
                                    $sqlgetcaste = "select * from religion_caste";
                                    $resultgetcaste = mysqli_query($con,$sqlgetcaste);
                                    while($rowgetcaste = mysqli_fetch_assoc($resultgetcaste))
                                    {
                                    ?>
                                        <option <?php if(in_array($rowgetcaste['caste'],$caste_array)) { echo "selected"; } ?> value="<?php echo $rowgetcaste['caste']; ?>"><?php echo $rowgetcaste['caste'];?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">error</span></i>Dosh/Doshm</h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="manglik">
                                        <option value="">Select</option>
                                        <option <?php if($_POST['manglik'] == "Yes") { echo "selected"; } ?> value="Yes">Yes</option>
                                        <option <?php if($_POST['manglik'] == "No") { echo "selected"; } ?> value="No">No</option>
                                        <option <?php if($_POST['manglik'] == "Dont Know") { echo "selected"; } ?> value="Dont Know">Dont Know</option>
                                    </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">school</span></i>Highest Education </h4>
                                <div class="form-group">
                                    <?php
                                    $education_array = explode("','",$education); 
                                    ?>
                                    <select class="chosen-select" name="education[]" multiple>
                                        <option value="">Select</option>
                                        <?php
                                        $sqlgeteducation = "select distinct(education) from stream_education";
                                        $resultgeteducation = mysqli_query($con,$sqlgeteducation);
                                        while($rowgeteducation = mysqli_fetch_assoc($resultgeteducation))
                                        {
                                        ?>
                                        <option <?php if(in_array($rowgeteducation['education'],$education_array)) { echo "selected"; } ?> value="<?php echo $rowgeteducation['education']; ?>"><?php echo $rowgeteducation['education']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">account_circle</span></i>Profession</h4>
                                <div class="form-group">
                                    <?php
                                    $domain_array = explode("','",$domain); 
                                    ?>
                                    <select class="chosen-select" name="domain[]" multiple>
                                        <?php
                                        $sqlgetdomain = "select distinct(domain) from domain_designation";
                                        $resultgetdomain = mysqli_query($con,$sqlgetdomain);
                                        while($rowgetdomain = mysqli_fetch_assoc($resultgetdomain))
                                        {
                                        ?>
                                        <option <?php if(in_array(str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $rowgetdomain['domain']))),$domain_array)) { echo "selected"; } ?> value="<?php echo str_replace("&", "and", str_replace(",", "", str_replace(" ", "-", $rowgetdomain['domain']))); ?>"><?php echo $rowgetdomain['domain']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">currency_rupee</span></i>Annual Income </h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="income">
                                        <option value="">Select</option>
                                        <option <?php if($_POST['income'] == "Upto 1 Lakhs") { echo "selected"; } ?> value="Upto 1 Lakhs">Upto 1 Lakhs</option>
                                        <option <?php if($_POST['income'] == "1 Lakhs - 2 Lakhs") { echo "selected"; } ?> value="1 Lakhs - 2 Lakhs">1 Lakhs - 2 Lakhs</option>
                                        <option <?php if($_POST['income'] == "2 Lakhs - 5 Lakhs") { echo "selected"; } ?> value="2 Lakhs - 5 Lakhs">2 Lakhs - 5 Lakhs</option>
                                        <option <?php if($_POST['income'] == "5 Lakhs - 7 Lakhs") { echo "selected"; } ?> value="5 Lakhs - 7 Lakhs">5 Lakhs - 7 Lakhs</option>
                                        <option <?php if($_POST['income'] == "7 Lakhs - 10 Lakhs") { echo "selected"; } ?> value="7 Lakhs - 10 Lakhs">7 Lakhs - 10 Lakhs</option>
                                        <option <?php if($_POST['income'] == "10 Lakhs - 15 Lakhs") { echo "selected"; } ?> value="10 Lakhs - 15 Lakhs">10 Lakhs - 15 Lakhs</option>
                                        <option <?php if($_POST['income'] == "15 Lakhs - 20 Lakhs") { echo "selected"; } ?> value="15 Lakhs - 20 Lakhs">15 Lakhs - 20 Lakhs</option>
                                        <option <?php if($_POST['income'] == "20 Lakhs - 25 Lakhs") { echo "selected"; } ?> value="20 Lakhs - 25 Lakhs">20 Lakhs - 25 Lakhs</option>
                                        <option <?php if($_POST['income'] == "25 Lakhs - 30 Lakhs") { echo "selected"; } ?> value="25 Lakhs - 30 Lakhs">25 Lakhs - 30 Lakhs</option>
                                        <option <?php if($_POST['income'] == "30 Lakhs - 50 Lakhs") { echo "selected"; } ?> value="30 Lakhs - 50 Lakhs">30 Lakhs - 50 Lakhs</option>
                                        <option <?php if($_POST['income'] == "50 Lakhs - 75 Lakhs") { echo "selected"; } ?> value="50 Lakhs - 75 Lakhs">50 Lakhs - 75 Lakhs</option>
                                        <option <?php if($_POST['income'] == "75 Lakhs - 1 Crore") { echo "selected"; } ?> value="75 Lakhs - 1 Crore">75 Lakhs - 1 Crore</option>
                                        <option <?php if($_POST['income'] == "1 Crore and Above") { echo "selected"; } ?> value="1 Crore and Above">1 Crore and Above</option>
                                    </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">location_on</span></i>City</h4>
                                <div class="form-group">
                                    <select class="chosen-select" name="city[]" multiple>
                                        <?php
                                        $sqlgetcity = "select distinct(city) from city_state";
                                        $resultgetcity = mysqli_query($con,$sqlgetcity);
                                        while($rowgetcity = mysqli_fetch_assoc($resultgetcity))
                                        {
                                        ?>
                                        <option value="<?php echo $rowgetcity['city']; ?>"><?php echo $rowgetcity['city']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="filt-com lhs-cate">
                                <h4><i><span class="material-symbols-outlined">flag</span></i>Country</h4>
                                <div class="form-group mb-3">
                                    <select class="chosen-select" name="country[]" multiple> 
                                        <?php
                                        $sqlgetcountries = "select * from countries";
                                        $resultgetcountries = mysqli_query($con,$sqlgetcountries);
                                        while($rowgetcountries = mysqli_fetch_assoc($resultgetcountries))
                                        {
                                        ?>
                                        <option value="<?php echo $rowgetcountries['country']; ?>"><?php echo $rowgetcountries['country']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- END -->
                            <!-- START -->
                            <div class="filt-com lhs-cate">
                                <p class="text-danger">Required field</p>
                                <button type="submit" class="cta-3 w-100 text-center">Search</button>
                            </div>
                            <!-- END -->
                        </form>