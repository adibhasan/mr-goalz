<?php include 'Generic.php'; ?>
<?php include 'controller/Settings.php'; ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
        <title><?php echo APP_NAME; ?> || SIGN IN</title>
        <?php v_includeHeader(); ?>
    </head>
    <body>
        <div id="datacontent">
            <?php
            v_sessionedTopMenu();
            ?>
            <div id="ajaxloader"><div class="ajax-loader ajxbg"></div></div>
            <div class="page-container container mpg">
                <div class="data-wrapper">
                    <div class="profile">
                        <?php profileInfoGeneral($user['using_avatar'], $user['id_name']); ?>
                    </div>
                    <div class="line"></div>
                    <div class="sponsor-link" style="padding: 5px;">
                        <?php sponsorRedirect("http://google.com"); ?>
                    </div>
                    <div class="wrapp-container">
                        <div class="main-content">
                            <div  id="editprofilecontainer" class="formcontainer">
                                <div class="profiletitle condenced">Edit Profile <button class="btn btn-danger btn-sm" id="change-password">Change Password</button></div>
                                <div class="progilebody">
                                    <div class="formwrapper">
                                        <div class="alert-custom"></div>
                                        <form autocomplete="off" name="form-settings" id="form-settings" class="dataform" >
                                            <input type="hidden" name="token" value="<?php echo v_generateToken(); ?>">
                                            <div class="input-box">
                                                <input style="color:blue;" type="text" class="profileinput center-text iconhmav-property thin minput2"  name="user_name" placeholder="Name" maxlength="50" value="<?php echo $user['user_name']; ?>">
                                            </div>
                                            <div class="input-box">
                                                <input type="email" class="profileinput center-text iconemail-property thin minput2" required="required"   name="user_email" placeholder="Email" maxlength="50" value="<?php echo $user['user_email']; ?>" readonly="readonly">
                                            </div>
                                            <div class="input-box" style="border-bottom: 2px solid #999999">
                                                <div class="dob thin">DOB:</div>
                                                <div class="selectionbox">
                                                    <select class="year thin" name="birth_year" size="4">
                                                        <?php
                                                        $currentyear = date("Y") - 4;
                                                        for ($i = $currentyear; $i > $currentyear - 100; $i--) {
                                                            if ($i == $user['birth_year'] && $user['birth_year'] != "") {
                                                                echo '<option value="' . $i . '" selected="selected">' . $i . '</option>';
                                                            } else {
                                                                echo '<option value="' . $i . '" >' . $i . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="sex thin">
                                                    <?php if ($user['gender'] == "Female"): ?>
                                                        <div class="gender gender1 btngrad2">Female</div>
                                                        <div class="gender gender2 btngrad1" >Male</div>
                                                    <?php endif; ?>
                                                    <?php if ($user['gender'] == "Male"): ?>
                                                        <div class="gender gender1 btngrad1">Female</div>
                                                        <div class="gender gender2 btngrad2" >Male</div>
                                                    <?php endif; ?>
                                                    <input type="hidden" name="gender" value="<?php echo $user['gender']; ?>" id="gender">
                                                </div>
                                                <div class="clearfix"></div>


                                            </div>

                                    </div>
                                    <div class="input-box">
                                        <input style="color:blue;" type="text" class="profileinput center-text iconrss-profile thin minput2" required="required"  name="recovery_number" placeholder="Number" maxlength="50" value="<?php echo $user['recovery_number']; ?>">
                                    </div>
                                    <div class="input-box" style="position: relative;height:70px">
                                        <select id="nationality" class="nationality text-indent dummy-select thin minput2" name="nationality" style="color:gainsboro;opacity:0;position: absolute;z-index: 111">
                                            <option value="" style="color: black">Nationality</option>
                                            <option value="Afghanistan">Afghanistan</option> 
                                            <option value="Albania">Albania</option> 
                                            <option value="Algeria">Algeria</option> 
                                            <option value="American Samoa">American Samoa</option> 
                                            <option value="Andorra">Andorra</option> 
                                            <option value="Angola">Angola</option> 
                                            <option value="Anguilla">Anguilla</option> 
                                            <option value="Antarctica">Antarctica</option> 
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option> 
                                            <option value="Argentina">Argentina</option> 
                                            <option value="Armenia">Armenia</option> 
                                            <option value="Aruba">Aruba</option> 
                                            <option value="Australia">Australia</option> 
                                            <option value="Austria">Austria</option> 
                                            <option value="Azerbaijan">Azerbaijan</option> 
                                            <option value="Bahamas">Bahamas</option> 
                                            <option value="Bahrain">Bahrain</option> 
                                            <option value="Bangladesh">Bangladesh</option> 
                                            <option value="Barbados">Barbados</option> 
                                            <option value="Belarus">Belarus</option> 
                                            <option value="Belgium">Belgium</option> 
                                            <option value="Belize">Belize</option> 
                                            <option value="Benin">Benin</option> 
                                            <option value="Bermuda">Bermuda</option> 
                                            <option value="Bhutan">Bhutan</option> 
                                            <option value="Bolivia">Bolivia</option> 
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
                                            <option value="Botswana">Botswana</option> 
                                            <option value="Bouvet Island">Bouvet Island</option> 
                                            <option value="Brazil">Brazil</option> 
                                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
                                            <option value="Brunei Darussalam">Brunei Darussalam</option> 
                                            <option value="Bulgaria">Bulgaria</option> 
                                            <option value="Burkina Faso">Burkina Faso</option> 
                                            <option value="Burundi">Burundi</option> 
                                            <option value="Cambodia">Cambodia</option> 
                                            <option value="Cameroon">Cameroon</option> 
                                            <option value="Canada">Canada</option> 
                                            <option value="Cape Verde">Cape Verde</option> 
                                            <option value="Cayman Islands">Cayman Islands</option> 
                                            <option value="Central African Republic">Central African Republic</option> 
                                            <option value="Chad">Chad</option> 
                                            <option value="Chile">Chile</option> 
                                            <option value="China">China</option> 
                                            <option value="Christmas Island">Christmas Island</option> 
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
                                            <option value="Colombia">Colombia</option> 
                                            <option value="Comoros">Comoros</option> 
                                            <option value="Congo">Congo</option> 
                                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
                                            <option value="Cook Islands">Cook Islands</option> 
                                            <option value="Costa Rica">Costa Rica</option> 
                                            <option value="Cote D'ivoire">Cote D'ivoire</option> 
                                            <option value="Croatia">Croatia</option> 
                                            <option value="Cuba">Cuba</option> 
                                            <option value="Cyprus">Cyprus</option> 
                                            <option value="Czech Republic">Czech Republic</option> 
                                            <option value="Denmark">Denmark</option> 
                                            <option value="Djibouti">Djibouti</option> 
                                            <option value="Dominica">Dominica</option> 
                                            <option value="Dominican Republic">Dominican Republic</option> 
                                            <option value="Ecuador">Ecuador</option> 
                                            <option value="Egypt">Egypt</option> 
                                            <option value="El Salvador">El Salvador</option> 
                                            <option value="Equatorial Guinea">Equatorial Guinea</option> 
                                            <option value="Eritrea">Eritrea</option> 
                                            <option value="Estonia">Estonia</option> 
                                            <option value="Ethiopia">Ethiopia</option> 
                                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
                                            <option value="Faroe Islands">Faroe Islands</option> 
                                            <option value="Fiji">Fiji</option> 
                                            <option value="Finland">Finland</option> 
                                            <option value="France">France</option> 
                                            <option value="French Guiana">French Guiana</option> 
                                            <option value="French Polynesia">French Polynesia</option> 
                                            <option value="French Southern Territories">French Southern Territories</option> 
                                            <option value="Gabon">Gabon</option> 
                                            <option value="Gambia">Gambia</option> 
                                            <option value="Georgia">Georgia</option> 
                                            <option value="Germany">Germany</option> 
                                            <option value="Ghana">Ghana</option> 
                                            <option value="Gibraltar">Gibraltar</option> 
                                            <option value="Greece">Greece</option> 
                                            <option value="Greenland">Greenland</option> 
                                            <option value="Grenada">Grenada</option> 
                                            <option value="Guadeloupe">Guadeloupe</option> 
                                            <option value="Guam">Guam</option> 
                                            <option value="Guatemala">Guatemala</option> 
                                            <option value="Guinea">Guinea</option> 
                                            <option value="Guinea-bissau">Guinea-bissau</option> 
                                            <option value="Guyana">Guyana</option> 
                                            <option value="Haiti">Haiti</option> 
                                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
                                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
                                            <option value="Honduras">Honduras</option> 
                                            <option value="Hong Kong">Hong Kong</option> 
                                            <option value="Hungary">Hungary</option> 
                                            <option value="Iceland">Iceland</option> 
                                            <option value="India">India</option> 
                                            <option value="Indonesia">Indonesia</option> 
                                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
                                            <option value="Iraq">Iraq</option> 
                                            <option value="Ireland">Ireland</option> 
                                            <option value="Israel">Israel</option> 
                                            <option value="Italy">Italy</option> 
                                            <option value="Jamaica">Jamaica</option> 
                                            <option value="Japan">Japan</option> 
                                            <option value="Jordan">Jordan</option> 
                                            <option value="Kazakhstan">Kazakhstan</option> 
                                            <option value="Kenya">Kenya</option> 
                                            <option value="Kiribati">Kiribati</option> 
                                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
                                            <option value="Korea, Republic of">Korea, Republic of</option> 
                                            <option value="Kuwait">Kuwait</option> 
                                            <option value="Kyrgyzstan">Kyrgyzstan</option> 
                                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
                                            <option value="Latvia">Latvia</option> 
                                            <option value="Lebanon">Lebanon</option> 
                                            <option value="Lesotho">Lesotho</option> 
                                            <option value="Liberia">Liberia</option> 
                                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
                                            <option value="Liechtenstein">Liechtenstein</option> 
                                            <option value="Lithuania">Lithuania</option> 
                                            <option value="Luxembourg">Luxembourg</option> 
                                            <option value="Macao">Macao</option> 
                                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
                                            <option value="Madagascar">Madagascar</option> 
                                            <option value="Malawi">Malawi</option> 
                                            <option value="Malaysia">Malaysia</option> 
                                            <option value="Maldives">Maldives</option> 
                                            <option value="Mali">Mali</option> 
                                            <option value="Malta">Malta</option> 
                                            <option value="Marshall Islands">Marshall Islands</option> 
                                            <option value="Martinique">Martinique</option> 
                                            <option value="Mauritania">Mauritania</option> 
                                            <option value="Mauritius">Mauritius</option> 
                                            <option value="Mayotte">Mayotte</option> 
                                            <option value="Mexico">Mexico</option> 
                                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
                                            <option value="Moldova, Republic of">Moldova, Republic of</option> 
                                            <option value="Monaco">Monaco</option> 
                                            <option value="Mongolia">Mongolia</option> 
                                            <option value="Montserrat">Montserrat</option> 
                                            <option value="Morocco">Morocco</option> 
                                            <option value="Mozambique">Mozambique</option> 
                                            <option value="Myanmar">Myanmar</option> 
                                            <option value="Namibia">Namibia</option> 
                                            <option value="Nauru">Nauru</option> 
                                            <option value="Nepal">Nepal</option> 
                                            <option value="Netherlands">Netherlands</option> 
                                            <option value="Netherlands Antilles">Netherlands Antilles</option> 
                                            <option value="New Caledonia">New Caledonia</option> 
                                            <option value="New Zealand">New Zealand</option> 
                                            <option value="Nicaragua">Nicaragua</option> 
                                            <option value="Niger">Niger</option> 
                                            <option value="Nigeria">Nigeria</option> 
                                            <option value="Niue">Niue</option> 
                                            <option value="Norfolk Island">Norfolk Island</option> 
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option> 
                                            <option value="Norway">Norway</option> 
                                            <option value="Oman">Oman</option> 
                                            <option value="Pakistan">Pakistan</option> 
                                            <option value="Palau">Palau</option> 
                                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
                                            <option value="Panama">Panama</option> 
                                            <option value="Papua New Guinea">Papua New Guinea</option> 
                                            <option value="Paraguay">Paraguay</option> 
                                            <option value="Peru">Peru</option> 
                                            <option value="Philippines">Philippines</option> 
                                            <option value="Pitcairn">Pitcairn</option> 
                                            <option value="Poland">Poland</option> 
                                            <option value="Portugal">Portugal</option> 
                                            <option value="Puerto Rico">Puerto Rico</option> 
                                            <option value="Qatar">Qatar</option> 
                                            <option value="Reunion">Reunion</option> 
                                            <option value="Romania">Romania</option> 
                                            <option value="Russian Federation">Russian Federation</option> 
                                            <option value="Rwanda">Rwanda</option> 
                                            <option value="Saint Helena">Saint Helena</option> 
                                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
                                            <option value="Saint Lucia">Saint Lucia</option> 
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
                                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
                                            <option value="Samoa">Samoa</option> 
                                            <option value="San Marino">San Marino</option> 
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option> 
                                            <option value="Saudi Arabia">Saudi Arabia</option> 
                                            <option value="Senegal">Senegal</option> 
                                            <option value="Serbia and Montenegro">Serbia and Montenegro</option> 
                                            <option value="Seychelles">Seychelles</option> 
                                            <option value="Sierra Leone">Sierra Leone</option> 
                                            <option value="Singapore">Singapore</option> 
                                            <option value="Slovakia">Slovakia</option> 
                                            <option value="Slovenia">Slovenia</option> 
                                            <option value="Solomon Islands">Solomon Islands</option> 
                                            <option value="Somalia">Somalia</option> 
                                            <option value="South Africa">South Africa</option> 
                                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
                                            <option value="Spain">Spain</option> 
                                            <option value="Sri Lanka">Sri Lanka</option> 
                                            <option value="Sudan">Sudan</option> 
                                            <option value="Suriname">Suriname</option> 
                                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
                                            <option value="Swaziland">Swaziland</option> 
                                            <option value="Sweden">Sweden</option> 
                                            <option value="Switzerland">Switzerland</option> 
                                            <option value="Syrian Arab Republic">Syrian Arab Republic</option> 
                                            <option value="Taiwan, Province of China">Taiwan, Province of China</option> 
                                            <option value="Tajikistan">Tajikistan</option> 
                                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
                                            <option value="Thailand">Thailand</option> 
                                            <option value="Timor-leste">Timor-leste</option> 
                                            <option value="Togo">Togo</option> 
                                            <option value="Tokelau">Tokelau</option> 
                                            <option value="Tonga">Tonga</option> 
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option> 
                                            <option value="Tunisia">Tunisia</option> 
                                            <option value="Turkey">Turkey</option> 
                                            <option value="Turkmenistan">Turkmenistan</option> 
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
                                            <option value="Tuvalu">Tuvalu</option> 
                                            <option value="Uganda">Uganda</option> 
                                            <option value="Ukraine">Ukraine</option> 
                                            <option value="United Arab Emirates">United Arab Emirates</option> 
                                            <option value="United Kingdom">United Kingdom</option> 
                                            <option value="United States">United States</option> 
                                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
                                            <option value="Uruguay">Uruguay</option> 
                                            <option value="Uzbekistan">Uzbekistan</option> 
                                            <option value="Vanuatu">Vanuatu</option> 
                                            <option value="Venezuela">Venezuela</option> 
                                            <option value="Viet Nam">Viet Nam</option> 
                                            <option value="Virgin Islands, British">Virgin Islands, British</option> 
                                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
                                            <option value="Wallis and Futuna">Wallis and Futuna</option> 
                                            <option value="Western Sahara">Western Sahara</option> 
                                            <option value="Yemen">Yemen</option> 
                                            <option value="Zambia">Zambia</option> 
                                            <option value="Zimbabwe">Zimbabwe</option>
                                        </select>
                                        <input style="color:black;position: absolute;left: 0px" type="text" class="profileinput center-text dummy-input earth-properties thin minput2" required="required"  placeholder="Nationality" maxlength="50" value="<?php echo $user['nationality']; ?>" readonly="readonly">
                                    </div>
                                    <div class="input-box" style="position: relative;height: 70px">
                                        <select class="nationality text-indent dummy-select thin minput2" name="favourite_team" style="color:gainsboro;opacity:0;position: absolute;z-index: 111">
                                            <?php
                                            echo '<option  style="color:black" value="">Favorite Team</option>';

                                            for ($i = 0; $i < count($user['team']); $i++) {
                                                if ($user['team'][$i]['teamid'] == $user['favourite_team']) {
                                                    $team = $user['team'][$i]['teamname'];
                                                }
                                                if ($user['team'][$i]['teamid'] == $user['favourite_team']) {
                                                    echo '<option value="' . $user['team'][$i]['teamid'] . '" selected="selected" style="color:black">' . $user['team'][$i]['teamname'] . '</option>';
                                                } else {
                                                    echo '<option value="' . $user['team'][$i]['teamid'] . '"  style="color:black">' . $user['team'][$i]['teamname'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input style="color:black;position: absolute;left: 0px" type="text" class="profileinput center-text dummy-input team-properties thin minput2" required="required"  placeholder="Favourite Team" maxlength="50" value="<?php echo $team; ?>" readonly="readonly">
                                    </div>
                                    <div class="input-box">
                                        <input type="checkbox" class="hidden" name="game_notification" id="notification" <?php echo $user['game_notification']==true?"checked":""; ?>>
                                        <input type="text" id="noti" class="profileinput center-text <?php echo $user['game_notification']==true?"notify2":"notify1"; ?> thin minput2"  value="Notify Me" readonly="readonly">
                                    </div>
                                    <div class="input-box">
                                        <input type="submit" class="profileinput settingssubmit icon-save black minput2"  value="Save">
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="usermenu-wrapper">
            <?php bottomSessionedMenu("shape-active", "", "", "", "", ""); ?>
        </div>
        <div class="content-wrapper">
            <img src="<?php echo BASE_URL; ?>assets/css/images/mobile.jpg" class="mob">
        </div>
        <div class="modal fade" id="reset-password">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">Change Password</h4>
                    </div>
                    <div class="modal-body">
                        <input type="password" class="hidden">
                        <div class="input-box minputbox">
                            <div class="signal"></div>
                            <input type="password" class="passwordinput black minput1" name="user_password" placeholder="Password" maxlength="20" required="required" pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,50}$" title="<?php echo $messages['pattern_username_sms']; ?>">
                            <div class="error-message"></div>
                        </div>
                        <div class="input-box minputbox">
                            <div class="signal"></div>
                            <input type="password" class="passwordinput black minput1" style="border-bottom: 2px solid #999999" name="retyped_user_password" placeholder="Confirm Password" maxlength="20" required="required" pattern="^(?=.*[A-Z])(?=.*[0-9])(?=.*[a-z]).{8,50}$" title="<?php echo $messages['pattern_username_sms']; ?>" data-match="user_password">
                            <div class="error-message"></div>
                        </div>
                        <br>
                        <button type="button" class="btn btn-default condenced" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary condenced">Change Password</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <?php v_includeFooter(); ?>
    </body>
</html>

