<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<style>
    /* Scoped styles to ensure it fits the sidebar */
    .filter-box {
        background: #fff;
        border: 1px solid #f3c7dd;
        border-radius: 8px;
        padding: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        font-family: sans-serif;
    }

    .filter-head {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        font-weight: 700;
        color: #7b004f;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-head i {
        font-size: 18px;
        color: #d41474; /* Matches your theme color */
    }

    /* Multi-Select Box Styling */
    .multi-select {
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        min-height: 42px;
        padding: 5px;
        cursor: pointer;
        position: relative;
        background: #fff;
        transition: border-color 0.3s;
    }
    .multi-select:hover {
        border-color: #d41474;
    }

    .multi-select:after {
        content: "▼";
        position: absolute;
        right: 10px;
        top: 12px;
        font-size: 10px;
        color: #777;
    }

    /* Selected Tags Styling */
    .tags {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .tag {
        background: #d41474; /* Theme Color */
        color: #fff;
        padding: 3px 8px;
        border-radius: 15px;
        font-size: 11px;
        display: flex;
        align-items: center;
        gap: 5px;
        font-weight: 500;
    }

    .tag span {
        cursor: pointer;
        font-weight: bold;
        font-size: 12px;
        color: white;
    }
    .tag span:hover {
        color: #ffcccc;
    }

    /* Dropdown Options Styling */
    .dropdown-box {
        display: none;
        border:none;
        /* border: 1px solid #d41474; */
        border-top: none;
        margin-top: -1px;
        max-height: 200px;
        overflow-y: auto;
        background: #fff;
        position: absolute;
        width: 100%; /* Adjust based on parent padding */
        z-index: 1000;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        border-radius: 0 0 4px 4px;
    }

    .dropdown-box div {
        padding: 8px 12px;
        font-size: 13px;
        cursor: pointer;
        border-bottom: 1px solid #eee;
        color: #333;
    }

    .dropdown-box div:hover {
        background: #ffd6ea;
        color: #7b004f;
    }

    /* Range Selects (Age/Height/Income) */
    .range-box {
        display: flex;
        gap: 5px;
    }

    .range-box select {
        border: 1px solid #ccc;
        border-radius: 4px;
        height: 38px;
        width: 100%;
        font-size: 13px;
        padding-left: 5px;
        color: #555;
    }
    .range-box select:focus {
        outline: none;
        border-color: #d41474;
    }

    /* Search Button */
    .btn-search {
        background: #d41474; /* Theme Color */
        color: #fff;
        border: none;
        border-radius: 30px;
        height: 45px;
        font-weight: 700;
        letter-spacing: 1px;
        font-size: 14px;
        width: 100%;
        transition: background 0.3s;
        margin-top: 20px;
        cursor: pointer;
    }
    .btn-search:hover {
        background: #a60c58;
        color: #fff;
    }
    
    .filter-section {
        position: relative; /* For absolute dropdown positioning */
        margin-bottom: 20px;
    }
</style>

<form method="GET" action="matches-allprofiles.php">
    <div class="filter-box">

        <!-- 1. AGE -->
        <div class="filter-section">
            <div class="filter-head"><i class="material-icons">cake</i> Age</div>
            <div class="range-box">
                <select name="agefrom">
                    <option value="">From</option>
                    <?php 
                    for($i=18; $i<=60; $i++){ 
                        $sel = (isset($_GET['agefrom']) && $_GET['agefrom'] == $i) ? 'selected' : '';
                        echo "<option value='$i' $sel>$i</option>";
                    } 
                    ?>
                </select>
                <select name="ageto">
                    <option value="">To</option>
                    <?php 
                    for($i=18; $i<=60; $i++){ 
                        $sel = (isset($_GET['ageto']) && $_GET['ageto'] == $i) ? 'selected' : '';
                        echo "<option value='$i' $sel>$i</option>";
                    } 
                    ?>
                </select>
            </div>
        </div>

        <!-- 2. HEIGHT -->
        <div class="filter-section">
            <div class="filter-head"><i class="material-icons">height</i> Height</div>
            <div class="range-box">
                <?php 
                    $heights = ["4 Feet 0 Inch","4 Feet 5 Inch","5 Feet 0 Inch","5 Feet 2 Inch","5 Feet 5 Inch","5 Feet 8 Inch","6 Feet 0 Inch","6 Feet 5 Inch"];
                ?>
                <select name="heightfrom">
                    <option value="">From</option>
                    <?php foreach($heights as $h) { 
                        $sel = (isset($_GET['heightfrom']) && $_GET['heightfrom'] == $h) ? 'selected' : '';
                        echo "<option value='$h' $sel>$h</option>";
                    } ?>
                </select>
                <select name="heightto">
                    <option value="">To</option>
                    <?php foreach($heights as $h) { 
                        $sel = (isset($_GET['heightto']) && $_GET['heightto'] == $h) ? 'selected' : '';
                        echo "<option value='$h' $sel>$h</option>";
                    } ?>
                </select>
            </div>
        </div>

        <!-- 3. MARITAL STATUS -->
        <div class="filter-section">
            <div class="filter-head"><i class="material-icons">wc</i> Marital Status</div>
            <div class="multi-select" onclick="toggleDropdown('marital-dd')">
                <div class="tags" id="marital-tags">
                    <?php if(isset($_GET['maritalstatus'])) { 
                        foreach($_GET['maritalstatus'] as $val) {
                            echo "<div class='tag'>$val <span onclick='removeTag(this)'>✕</span><input type='hidden' name='maritalstatus[]' value='$val'></div>";
                        }
                    } ?>
                </div>
            </div>
            <div class="dropdown-box" id="marital-dd">
                <?php 
                $options = ['Never Married', 'Divorced', 'Widowed', 'Separated', 'Awaiting Divorce'];
                foreach($options as $opt) {
                    echo "<div onclick=\"selectItem('$opt', 'marital-tags', 'maritalstatus[]')\">$opt</div>";
                }
                ?>
            </div>
        </div>

        <!-- 4. RELIGION -->
        <div class="filter-section">
            <div class="filter-head"><i class="material-icons">temple_hindu</i> Religion</div>
            <div class="multi-select" onclick="toggleDropdown('rel-dd')">
                <div class="tags" id="rel-tags">
                     <?php if(isset($_GET['religion'])) { 
                        foreach($_GET['religion'] as $val) {
                            echo "<div class='tag'>$val <span onclick='removeTag(this)'>✕</span><input type='hidden' name='religion[]' value='$val'></div>";
                        }
                    } ?>
                </div>
            </div>
            <div class="dropdown-box" id="rel-dd">
                <?php 
                $options = ['Hindu', 'Muslim', 'Christian', 'Sikh', 'Jain', 'Buddhist', 'Parsi', 'Jewish', 'Atheist'];
                foreach($options as $opt) {
                    echo "<div onclick=\"selectItem('$opt', 'rel-tags', 'religion[]')\">$opt</div>";
                }
                ?>
            </div>
        </div>

        <!-- 5. CASTE -->
        <div class="filter-section">
            <div class="filter-head"><i class="material-icons">reduce_capacity</i> Caste</div>
            <div class="multi-select" onclick="toggleDropdown('caste-dd')">
                <div class="tags" id="caste-tags">
                    <?php if(isset($_GET['caste'])) { 
                        foreach($_GET['caste'] as $val) {
                            echo "<div class='tag'>$val <span onclick='removeTag(this)'>✕</span><input type='hidden' name='caste[]' value='$val'></div>";
                        }
                    } ?>
                </div>
            </div>
            <div class="dropdown-box" id="caste-dd">
                <?php 
                $options = ['General', 'OBC', 'SC', 'ST', 'Brahmin', 'Rajput', 'Kayastha', 'Yadav', 'Agarwal', 'Valmiki', 'Arora', 'Khatri'];
                foreach($options as $opt) {
                    echo "<div onclick=\"selectItem('$opt', 'caste-tags', 'caste[]')\">$opt</div>";
                }
                ?>
            </div>
        </div>

        <!-- 6. CITY -->
        <div class="filter-section">
            <div class="filter-head"><i class="material-icons">location_on</i> City</div>
            <div class="multi-select" onclick="toggleDropdown('city-dd')">
                <div class="tags" id="city-tags">
                     <?php if(isset($_GET['city'])) { 
                        foreach($_GET['city'] as $val) {
                            echo "<div class='tag'>$val <span onclick='removeTag(this)'>✕</span><input type='hidden' name='city[]' value='$val'></div>";
                        }
                    } ?>
                </div>
            </div>
            <div class="dropdown-box" id="city-dd">
                <?php 
                $options = ['Delhi', 'Mumbai', 'Bangalore', 'Sonipat', 'Panipat', 'Kolkata', 'Chennai', 'Hyderabad', 'Pune', 'Jaipur', 'Lucknow'];
                foreach($options as $opt) {
                    echo "<div onclick=\"selectItem('$opt', 'city-tags', 'city[]')\">$opt</div>";
                }
                ?>
            </div>
        </div>

        <!-- 7. EDUCATION -->
        <div class="filter-section">
            <div class="filter-head"><i class="material-icons">school</i> Education</div>
            <div class="multi-select" onclick="toggleDropdown('edu-dd')">
                <div class="tags" id="edu-tags">
                     <?php if(isset($_GET['education'])) { 
                        foreach($_GET['education'] as $val) {
                            echo "<div class='tag'>$val <span onclick='removeTag(this)'>✕</span><input type='hidden' name='education[]' value='$val'></div>";
                        }
                    } ?>
                </div>
            </div>
            <div class="dropdown-box" id="edu-dd">
                <?php 
                $options = ['10th', '12th', 'Diploma', 'Graduate', 'Post Graduate', 'Doctorate', 'CA', 'CS', 'MBA'];
                foreach($options as $opt) {
                    echo "<div onclick=\"selectItem('$opt', 'edu-tags', 'education[]')\">$opt</div>";
                }
                ?>
            </div>
        </div>

        <!-- 8. DOSH / DOSHM (NEW) -->
        <div class="filter-section">
            <div class="filter-head"><i class="material-icons">stars</i> Dosh / Manglik</div>
            <div class="multi-select" onclick="toggleDropdown('dosh-dd')">
                <div class="tags" id="dosh-tags">
                     <?php if(isset($_GET['dosh'])) { 
                        foreach($_GET['dosh'] as $val) {
                            echo "<div class='tag'>$val <span onclick='removeTag(this)'>✕</span><input type='hidden' name='dosh[]' value='$val'></div>";
                        }
                    } ?>
                </div>
            </div>
            <div class="dropdown-box" id="dosh-dd">
                <?php 
                $options = ['No Dosh', 'Manglik', 'Anshik Manglik', 'Don\'t Know'];
                foreach($options as $opt) {
                    $jsOpt = addslashes($opt); // Handle quotes in "Don't Know"
                    echo "<div onclick=\"selectItem('$jsOpt', 'dosh-tags', 'dosh[]')\">$opt</div>";
                }
                ?>
            </div>
        </div>

        <!-- 9. PROFESSION (NEW) -->
        <div class="filter-section">
            <div class="filter-head"><i class="material-icons">work</i> Profession</div>
            <div class="multi-select" onclick="toggleDropdown('prof-dd')">
                <div class="tags" id="prof-tags">
                     <?php if(isset($_GET['profession'])) { 
                        foreach($_GET['profession'] as $val) {
                            echo "<div class='tag'>$val <span onclick='removeTag(this)'>✕</span><input type='hidden' name='profession[]' value='$val'></div>";
                        }
                    } ?>
                </div>
            </div>
            <div class="dropdown-box" id="prof-dd">
                <?php 
                $options = ['Private Job', 'Government Job', 'Business', 'Self Employed', 'Doctor', 'Engineer', 'Teacher', 'Defense', 'Civil Services', 'Not Working'];
                foreach($options as $opt) {
                    echo "<div onclick=\"selectItem('$opt', 'prof-tags', 'profession[]')\">$opt</div>";
                }
                ?>
            </div>
        </div>

        <!-- 10. ANNUAL INCOME (NEW) -->
        <div class="filter-section">
            <div class="filter-head"><i class="material-icons">monetization_on</i> Annual Income</div>
            <div class="range-box">
                <?php 
                    $incomes = ["0 - 2 LPA", "2 - 5 LPA", "5 - 8 LPA", "8 - 12 LPA", "12 - 20 LPA", "20 - 50 LPA", "50 LPA +"];
                ?>
                <select name="incomefrom">
                    <option value="">Min Income</option>
                    <?php foreach($incomes as $inc) { 
                        $sel = (isset($_GET['incomefrom']) && $_GET['incomefrom'] == $inc) ? 'selected' : '';
                        echo "<option value='$inc' $sel>$inc</option>";
                    } ?>
                </select>
                <select name="incometo">
                    <option value="">Max Income</option>
                    <?php foreach($incomes as $inc) { 
                        $sel = (isset($_GET['incometo']) && $_GET['incometo'] == $inc) ? 'selected' : '';
                        echo "<option value='$inc' $sel>$inc</option>";
                    } ?>
                </select>
            </div>
        </div>

        <!-- 11. COUNTRY (NEW) -->
        <div class="filter-section">
            <div class="filter-head"><i class="material-icons">public</i> Country</div>
            <div class="multi-select" onclick="toggleDropdown('country-dd')">
                <div class="tags" id="country-tags">
                     <?php if(isset($_GET['country'])) { 
                        foreach($_GET['country'] as $val) {
                            echo "<div class='tag'>$val <span onclick='removeTag(this)'>✕</span><input type='hidden' name='country[]' value='$val'></div>";
                        }
                    } ?>
                </div>
            </div>
            <div class="dropdown-box" id="country-dd">
                <?php 
                $options = ['India', 'USA', 'UK', 'Canada', 'Australia', 'UAE', 'Singapore', 'Germany', 'New Zealand'];
                foreach($options as $opt) {
                    echo "<div onclick=\"selectItem('$opt', 'country-tags', 'country[]')\">$opt</div>";
                }
                ?>
            </div>
        </div>

        <button type="submit" class="btn btn-search">SEARCH MATCHES</button>
        <div style="text-align:center; margin-top:10px;">
            <a href="matches-allprofiles.php" style="color:#777; font-size:12px; text-decoration:underline;">Reset Filters</a>
        </div>

    </div>
</form>

<script>
    // 1. Toggle the dropdown visibility
    function toggleDropdown(id) {
        // Close others first
        document.querySelectorAll('.dropdown-box').forEach(d => {
            if (d.id !== id) d.style.display = 'none';
        });
        
        const box = document.getElementById(id);
        // Toggle current
        if (box.style.display === 'block') {
            box.style.display = 'none';
        } else {
            box.style.display = 'block';
        }
    }

    // 2. Select an Item and Create a Hidden Input for PHP
    function selectItem(val, tagContainerId, inputName) {
        const box = document.getElementById(tagContainerId);

        // Prevent duplicates
        const currentInputs = box.querySelectorAll('input');
        for (let input of currentInputs) {
            if (input.value === val) return;
        }

        // Create the Visual Tag
        const tag = document.createElement('div');
        tag.className = 'tag';
        
        // Add the Hidden Input (This is what sends data to PHP!)
        const hiddenInput = `<input type="hidden" name="${inputName}" value="${val}">`;
        
        tag.innerHTML = `${val} <span onclick="removeTag(this)">✕</span> ${hiddenInput}`;
        box.appendChild(tag);
    }

    // 3. Remove Tag
    function removeTag(spanElement) {
        spanElement.parentElement.remove();
        // Stop event from bubbling up to the dropdown toggle
        event.stopPropagation();
    }

    // 4. Close dropdowns when clicking outside
    document.addEventListener('click', e => {
        if (!e.target.closest('.multi-select') && !e.target.closest('.dropdown-box')) {
            document.querySelectorAll('.dropdown-box').forEach(d => d.style.display = 'none');
        }
    });
</script>