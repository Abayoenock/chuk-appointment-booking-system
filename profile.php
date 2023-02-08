<?php
session_start();
include './backend/db_conn.php';

if (!($_SESSION['userSession'])) {
    header("Location: ./");
} else {

    $userID = $_SESSION['userSession'];

    $sql = "SELECT * FROM patients WHERE patientID='$userID'";
    $exe = $conn->query($sql);
    while ($row = $exe->fetch_array()) {
        $usernames = $row['firstname'] . " " . $row['lastname'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./assets/chart.js/Chart.min.css">
    <link rel="stylesheet" href="./assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="./assets/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <script src="./assets/jquery/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">





</head>

<body class="back0">
    <div class="  bg-gradient-to-b from-primary to-gray-900 backdrop-blur-sm    w-full h-screen overflow-hidden ">
        <!-- the top header -->
        <div class=" h-[50px] md:hidden w-full bg-transparent  backdrop-blur-sm flex flex-row  justify-between ">
            <div class=" text-center  justify-center items-center gap-2 h-full p-2 flex md:ml-[20px]">

                <span id="open-menu" class="block  md:hidden"><i class="fa-solid fa-bars-staggered text-white/90 text-4xl ml-2 mr-4 open-menu "></i></span>
                <img src="./img/devImgs/logo.png" class="w-8 aspect-square" alt="">
                <span class="font-bold text-white/70   ">CHUK</span>

            </div>
            <div class=" w-fit flex flex-row  items-center   mr-5 gap-4 ">

                <i class="fa-solid fa-user text-white/70 text-2xl"></i>
                <h3 class="userName  text-white/90 font-bold"> </h3>
            </div>
        </div>
        <div class="flex  justify-center md:justify-start">
            <!-- side component -->
            <div class=" md:h-screen md:w-[250px] md:flex-col  md:bottom-0 md:px-0   fixed  left-0 md:backdrop-blur-sm backdrop-blur-md flex flex-col  z-10 w-[100%] h-[100vh] gap-8   top-0  items-center   self-center bg-primary/90 md:bg-transparent transition-all duration-300  -translate-x-[100%]  md:translate-x-0 menu " id="menu">
                <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul>
                <span id="close-menu" class="block  md:hidden"><i class="fa-solid fa-xmark text-4xl absolute right-4 top-4 text-red-600 close-menu "></i></span>

                <div class="flex flex-row space-x-4 items-center justify-center w-full mt-4 z-[999999]">
                    <div class="flex flex-col gap-4">
                        <a href="./home" class="flex">
                            <img src="./img/devImgs/logo.png" class="w-8 aspect-square" alt="">
                            <span class="font-bold text-white/70   ">CHUK</span>
                        </a>
                        <div class="flex gap-4  items-center">
                            <div id="icon">
                                <span>
                                    <i class="fa-solid fa-calendar-days text-white/80 text-3xl"></i>
                                </span>
                            </div>
                            <div>
                                <h4 class="text-2xl text-white/80 digital-clocks"></h4>
                                <p class="text-xs text-white/80 date-container"></p>


                            </div>
                        </div>

                    </div>




                </div>
                <ul class="flex flex-col w-full  h-[100vh]  z-[99999]">
                    <a href="dashboard" class=" relative ">
                        <li class="w-full flex  items-center h-[50px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group pl-4 gap-2 active py-6 ">

                            <i class="fa-solid fa-hospital-user text-white  text-3xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50 "></i>
                            <span class="text-white font-semibold transition-all duration-300 group-hover:-translate-y-1">Appointments</span>


                        </li>
                    </a>





                    <a href="My-profile">
                        <li class="w-full flex  items-center h-[50px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group  pl-4 gap-2 py-6 active-link">
                            <i class="fa-solid text-white  fa-id-card-clip text-3xl transition-all duration-300 group-hover:-translate-y-1 group-hover:text-white/50"></i>
                            <span class="text-white font-semibold transition-all duration-300 group-hover:-translate-y-1">Profile</span>

                        </li>
                    </a>



                </ul>
                <ul class=" flex self-start md:w-full  md:absolute md:bottom-12 z-[99999] ">

                    <a href="logout">
                        <li class="flex w-full  items-center h-[50px] transition-all duration-300 ease-in-out bg-transparent  hover:bg-mydark/40  group  pl-4 gap-2 py-8">
                            <i class="fa-solid fa-power-off text-3xl transition-all duration-300 group-hover:-translate-y-1 text-white group-hover:text-white/50"></i>
                            <span class="text-white font-semibold transition-all duration-300 group-hover:-translate-y-1">LogOut</span>
                        </li>
                    </a>
                </ul>

            </div>
            <div class=" w-full md:ml-[250px] bg-white  h-screen overflow-y-auto flex flex-col mainContainer pb-40 p-8 ">

                <button class="bg-gradient-to-r from-gray-700/70 to-blue-500/70 bg-primary change-password  hover:bg-gradient-to-r hover:from-gray-400/40 hover:to-blue-500/40 transition eas duration-500 rounded-md px-8 py-2 text-gray-100 hover:shadow-xl w-fit  ml-4 "> <i class="fas fa-user-lock    "></i> Change Password</button>
                <div class="w-full p-4">
                    <p class=" bg-blue-100 text-sm p-4 rounded-sm text-blue-600">
                        <i class="fa fa-info-circle text-lg" aria-hidden="true"></i>
                        Keep in mind that when you update your phone number you will agin be asked to verify the phone number , make sure to but the correct phone number
                    </p>
                </div>



                <?php
                $sql = "SELECT * FROM patients WHERE patientID='$userID'";
                $exe = $conn->query($sql);
                $data = array();
                while ($row = $exe->fetch_array()) {
                    $data = $row;
                }

                ?>
                <div class="w-fit p-4">
                    <div class=" bg-blue-100 text-sm p-4 rounded-sm text-blue-600">
                        <p class="mb-4">Use this code while using USSD code</p>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-phone-volume text-4xl "></i> <?php echo $data['code']; ?>
                        </div>

                    </div>
                </div>
                <form class="mt-0 mb-0 flex flex-col gap-2 text-sm submit p-4 pt-0" action="./backend/update-profile.php?p=<?php echo $data['phoneNumber']; ?>" method="POST">
                    <div class="flex flex-col md:flex-row w-full gap-4 ">
                        <div class="flex flex-col w-full ">
                            <label for="fname" class="text-gray-700">FirstName</label>
                            <input type="text" name="firstName" id="fname" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your first  name" value="<?php echo $data['firstname']; ?>" required>
                        </div>

                        <div class="flex flex-col w-full ">
                            <label for="lname" class="text-gray-700">LastName</label>
                            <input type="text" name="lastName" id="lname" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your last name" value="<?php echo $data['lastname']; ?>" required>
                        </div>
                    </div>
                    <div class=" flex flex-col md:flex-row w-full gap-4 ">
                        <div class=" flex flex-col w-full ">
                            <label for=" bdate" class="text-gray-700">BirthDate</label>
                            <input type="date" name="DOB" id="bdate" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter choose your birth date " value="<?php echo $data['DOB']; ?>" required>
                        </div>

                        <div class="flex flex-col w-full ">
                            <label for="gender" class="text-gray-700">Gender</label>

                            <select name="gender" id="gender" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900">
                                <option value="<?php echo $data['gender']; ?>"><?php echo $data['gender']; ?></option>
                                <option value="0">Choose Gender</option>
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>


                            </select>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row w-full gap-4 ">
                        <div class="flex flex-col w-full relative">
                            <label for="email" class="text-gray-700">NID/ Passport N <sup>o</sup></label>
                            <input type="text" name="nid" id="nid" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your Identification number  " pattern="[0-9]{16}|[0-9]{9}" title="please enter number only" value="<?php echo $data['nid']; ?>" required>

                        </div>

                        <div class="flex flex-col w-full relative ">
                            <label for="phoneNumber" class="text-gray-700">Phone Number</label>
                            <input type="tel" name="phoneNumber" id="phoneNumber" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" placeholder="Enter your phone number" pattern="[0-9]{10}" title="Please Rwandan phone number Minus the country code" value="<?php echo $data['phoneNumber']; ?>" required>
                            <div class="absolute right-3 mt-8 hidden "><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col md:flex-row w-full gap-4 ">
                        <div class="flex flex-col w-full ">
                            <label for="bdate" class="text-gray-700">Nationality</label>
                            <select id="nationality" name="nationality" data-name="nationality" required="" ms-field="nationality" data-parsley-required-message="Please let us know your nationality." class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900">
                                <option value="<?php echo $data['nationality']; ?>"><?php echo $data['nationality']; ?></option>
                                <option value="">Select one...</option>
                                <option value='afghan'>Afghan</option>
                                <option value='albanian'>Albanian</option>
                                <option value='algerian'>Algerian</option>
                                <option value='american'>American</option>
                                <option value='andorran'>Andorran</option>
                                <option value='angolan'>Angolan</option>
                                <option value='anguillan'>Anguillan</option>
                                <option value='citizen-of-antigua-and-barbuda'>Citizen of Antigua and Barbuda</option>
                                <option value='argentine'>Argentine</option>
                                <option value='armenianaustralian'>ArmenianAustralian</option>
                                <option value='austrian'>Austrian</option>
                                <option value='azerbaijani'>Azerbaijani</option>
                                <option value='bahamian'>Bahamian</option>
                                <option value='bahraini'>Bahraini</option>
                                <option value='bangladeshi'>Bangladeshi</option>
                                <option value='barbadian'>Barbadian</option>
                                <option value='belarusian'>Belarusian</option>
                                <option value='belgian'>Belgian</option>
                                <option value='belizean'>Belizean</option>
                                <option value='beninese'>Beninese</option>
                                <option value='bermudian'>Bermudian</option>
                                <option value='bhutanese'>Bhutanese</option>
                                <option value='bolivian'>Bolivian</option>
                                <option value='citizen-of-bosnia-and-herzegovina'>Citizen of Bosnia and Herzegovina</option>
                                <option value='botswanan'>Botswanan</option>
                                <option value='brazilian'>Brazilian</option>
                                <option value='british'>British</option>
                                <option value='british-virgin-islander'>British Virgin Islander</option>
                                <option value='bruneian'>Bruneian</option>
                                <option value='bulgarian'>Bulgarian</option>
                                <option value='burkinan'>Burkinan</option>
                                <option value='burmese'>Burmese</option>
                                <option value='burundian'>Burundian</option>
                                <option value='cambodian'>Cambodian</option>
                                <option value='cameroonian'>Cameroonian</option>
                                <option value='canadian'>Canadian</option>
                                <option value='cape-verdean'>Cape Verdean</option>
                                <option value='cayman-islander'>Cayman Islander</option>
                                <option value='central-african'>Central African</option>
                                <option value='chadian'>Chadian</option>
                                <option value='chilean'>Chilean</option>
                                <option value='chinese'>Chinese</option>
                                <option value='colombian'>Colombian</option>
                                <option value='comoran'>Comoran</option>
                                <option value='congolese-(congo)'>Congolese (Congo)</option>
                                <option value='congolese-(drc)'>Congolese (DRC)</option>
                                <option value='cook-islander'>Cook Islander</option>
                                <option value='costa-rican'>Costa Rican</option>
                                <option value='croatian'>Croatian</option>
                                <option value='cuban'>Cuban</option>
                                <option value='cymraes'>Cymraes</option>
                                <option value='cymro'>Cymro</option>
                                <option value='cypriot'>Cypriot</option>
                                <option value='czech'>Czech</option>
                                <option value='danish'>Danish</option>
                                <option value='djiboutian'>Djiboutian</option>
                                <option value='dominican'>Dominican</option>
                                <option value='citizen-of-the-dominican-republic'>Citizen of the Dominican Republic</option>
                                <option value='dutch'>Dutch</option>
                                <option value='east-timorese'>East Timorese</option>
                                <option value='ecuadorean'>Ecuadorean</option>
                                <option value='egyptian'>Egyptian</option>
                                <option value='emirati'>Emirati</option>
                                <option value='english'>English</option>
                                <option value='equatorial-guinean'>Equatorial Guinean</option>
                                <option value='eritrean'>Eritrean</option>
                                <option value='estonian'>Estonian</option>
                                <option value='ethiopian'>Ethiopian</option>
                                <option value='faroese'>Faroese</option>
                                <option value='fijian'>Fijian</option>
                                <option value='filipino'>Filipino</option>
                                <option value='finnish'>Finnish</option>
                                <option value='french'>French</option>
                                <option value='gabonese'>Gabonese</option>
                                <option value='gambian'>Gambian</option>
                                <option value='georgian'>Georgian</option>
                                <option value='german'>German</option>
                                <option value='ghanaian'>Ghanaian</option>
                                <option value='gibraltarian'>Gibraltarian</option>
                                <option value='greek'>Greek</option>
                                <option value='greenlandic'>Greenlandic</option>
                                <option value='grenadian'>Grenadian</option>
                                <option value='guamanian'>Guamanian</option>
                                <option value='guatemalan'>Guatemalan</option>
                                <option value='citizen-of-guinea-bissau'>Citizen of Guinea-Bissau</option>
                                <option value='guinean'>Guinean</option>
                                <option value='guyanese'>Guyanese</option>
                                <option value='haitian'>Haitian</option>
                                <option value='honduran'>Honduran</option>
                                <option value='hong-konger'>Hong Konger</option>
                                <option value='hungarian'>Hungarian</option>
                                <option value='icelandic'>Icelandic</option>
                                <option value='indian'>Indian</option>
                                <option value='indonesian'>Indonesian</option>
                                <option value='iranian'>Iranian</option>
                                <option value='iraqi'>Iraqi</option>
                                <option value='irish'>Irish</option>
                                <option value='israeli'>Israeli</option>
                                <option value='italian'>Italian</option>
                                <option value='ivorian'>Ivorian</option>
                                <option value='jamaican'>Jamaican</option>
                                <option value='japanese'>Japanese</option>
                                <option value='jordanian'>Jordanian</option>
                                <option value='kazakh'>Kazakh</option>
                                <option value='kenyan'>Kenyan</option>
                                <option value='kittitian'>Kittitian</option>
                                <option value='citizen-of-kiribati'>Citizen of Kiribati</option>
                                <option value='kosovan'>Kosovan</option>
                                <option value='kuwaiti'>Kuwaiti</option>
                                <option value='kyrgyz'>Kyrgyz</option>
                                <option value='lao'>Lao</option>
                                <option value='latvian'>Latvian</option>
                                <option value='lebanese'>Lebanese</option>
                                <option value='liberian'>Liberian</option>
                                <option value='libyan'>Libyan</option>
                                <option value='liechtenstein-citizen'>Liechtenstein citizen</option>
                                <option value='lithuanian'>Lithuanian</option>
                                <option value='luxembourger'>Luxembourger</option>
                                <option value='macanese'>Macanese</option>
                                <option value='macedonian'>Macedonian</option>
                                <option value='malagasy'>Malagasy</option>
                                <option value='malawian'>Malawian</option>
                                <option value='malaysian'>Malaysian</option>
                                <option value='maldivian'>Maldivian</option>
                                <option value='malian'>Malian</option>
                                <option value='maltese'>Maltese</option>
                                <option value='marshallese'>Marshallese</option>
                                <option value='martiniquais'>Martiniquais</option>
                                <option value='mauritanian'>Mauritanian</option>
                                <option value='mauritian'>Mauritian</option>
                                <option value='mexican'>Mexican</option>
                                <option value='micronesian'>Micronesian</option>
                                <option value='moldovan'>Moldovan</option>
                                <option value='monegasque'>Monegasque</option>
                                <option value='mongolian'>Mongolian</option>
                                <option value='montenegrin'>Montenegrin</option>
                                <option value='montserratian'>Montserratian</option>
                                <option value='moroccan'>Moroccan</option>
                                <option value='mosotho'>Mosotho</option>
                                <option value='mozambican'>Mozambican</option>
                                <option value='namibian'>Namibian</option>
                                <option value='nauruan'>Nauruan</option>
                                <option value='nepalese'>Nepalese</option>
                                <option value='new-zealander'>New Zealander</option>
                                <option value='nicaraguan'>Nicaraguan</option>
                                <option value='nigerian'>Nigerian</option>
                                <option value='nigerien'>Nigerien</option>
                                <option value='niuean'>Niuean</option>
                                <option value='north-korean'>North Korean</option>
                                <option value='northern-irish'>Northern Irish</option>
                                <option value='norwegian'>Norwegian</option>
                                <option value='omani'>Omani</option>
                                <option value='pakistani'>Pakistani</option>
                                <option value='palauan'>Palauan</option>
                                <option value='palestinian'>Palestinian</option>
                                <option value='panamanian'>Panamanian</option>
                                <option value='papua-new-guinean'>Papua New Guinean</option>
                                <option value='paraguayan'>Paraguayan</option>
                                <option value='peruvian'>Peruvian</option>
                                <option value='pitcairn-islander'>Pitcairn Islander</option>
                                <option value='polish'>Polish</option>
                                <option value='portuguese'>Portuguese</option>
                                <option value='prydeinig'>Prydeinig</option>
                                <option value='puerto-rican'>Puerto Rican</option>
                                <option value='qatari'>Qatari</option>
                                <option value='romanian'>Romanian</option>
                                <option value='russian'>Russian</option>
                                <option value='rwandan'>Rwandan</option>
                                <option value='salvadorean'>Salvadorean</option>
                                <option value='sammarinese'>Sammarinese</option>
                                <option value='samoan'>Samoan</option>
                                <option value='sao-tomean'>Sao Tomean</option>
                                <option value='saudi-arabian'>Saudi Arabian</option>
                                <option value='scottish'>Scottish</option>
                                <option value='senegalese'>Senegalese</option>
                                <option value='serbian'>Serbian</option>
                                <option value='citizen-of-seychelles'>Citizen of Seychelles</option>
                                <option value='sierra-leonean'>Sierra Leonean</option>
                                <option value='singaporean'>Singaporean</option>
                                <option value='slovak'>Slovak</option>
                                <option value='slovenian'>Slovenian</option>
                                <option value='solomon-islander'>Solomon Islander</option>
                                <option value='somali'>Somali</option>
                                <option value='south-african'>South African</option>
                                <option value='south-korean'>South Korean</option>
                                <option value='south-sudanese'>South Sudanese</option>
                                <option value='spanish'>Spanish</option>
                                <option value='sri-lankan'>Sri Lankan</option>
                                <option value='st-helenian'>St Helenian</option>
                                <option value='st-lucian'>St Lucian</option>
                                <option value='stateless'>Stateless</option>
                                <option value='sudanese'>Sudanese</option>
                                <option value='surinamese'>Surinamese</option>
                                <option value='swazi'>Swazi</option>
                                <option value='swedish'>Swedish</option>
                                <option value='swiss'>Swiss</option>
                                <option value='syrian'>Syrian</option>
                                <option value='taiwanese'>Taiwanese</option>
                                <option value='tajik'>Tajik</option>
                                <option value='tanzanian'>Tanzanian</option>
                                <option value='thai'>Thai</option>
                                <option value='togolese'>Togolese</option>
                                <option value='tongan'>Tongan</option>
                                <option value='trinidadian'>Trinidadian</option>
                                <option value='tristanian'>Tristanian</option>
                                <option value='tunisian'>Tunisian</option>
                                <option value='turkish'>Turkish</option>
                                <option value='turkmen'>Turkmen</option>
                                <option value='turks-and-caicos-islander'>Turks and Caicos Islander</option>
                                <option value='tuvaluan'>Tuvaluan</option>
                                <option value='ugandan'>Ugandan</option>
                                <option value='ukrainian'>Ukrainian</option>
                                <option value='uruguayan'>Uruguayan</option>
                                <option value='uzbek'>Uzbek</option>
                                <option value='vatican-citizen'>Vatican citizen</option>
                                <option value='citizen-of-vanuatu'>Citizen of Vanuatu</option>
                                <option value='venezuelan'>Venezuelan</option>
                                <option value='vietnamese'>Vietnamese</option>
                                <option value='vincentian'>Vincentian</option>
                                <option value='wallisian'>Wallisian</option>
                                <option value='welsh'>Welsh</option>
                                <option value='yemeni'>Yemeni</option>
                                <option value='zambian'>Zambian</option>
                                <option value='zimbabwean'>Zimbabwean</option>
                            </select>
                        </div>

                        <div class="flex flex-col w-full ">
                            <label for="insurance" class="text-gray-700">Insurance</label>

                            <select name="insurance" id="insurance" class="mt-2 p-2 border border-gray-300 focus:outline-none focus:ring-0 focus:border-gray-300 rounded text-sm text-gray-900" required>
                                <option value="<?php echo $data['insurance']; ?>"><?php echo $data['insurance']; ?></option>
                                <option value="">Choose Insurance</option>

                                <option value="RSSB [RAMA]">RSSB [RAMA]</option>
                                <option value="RSSB [Mituel]">RSSB [Mituel]</option>
                                <option value="MMI">MMI</option>
                                <option value="Radiant">Radiant</option>
                                <option value="None">None</option>


                            </select>
                        </div>
                    </div>




                    <div class="my-4 mb-0 flex items-center justify-end space-x-4">
                        <button class="bg-gradient-to-r from-green-400/70 to-blue-500/70  hover:bg-primary/80   hover:bg-gradient-to-r hover:from-blue-400/70 hover:to-green-500/70 transition eas duration-500 rounded-lg px-8 py-2 text-gray-100 hover:shadow-xl  uppercase resister-btn">Update profile &nbsp <i class="fas fa-spinner animate-spin invisible" aria-hidden="true"></i> </button>
                    </div>
                </form>

            </div>



















        </div>




    </div>








    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="./assets/chart.js/Chart.min.js"></script>
    <script src="./assets/dist/js/dashboard.js"></script>
    <script src="./assets/js/sweetalert2.min.js"></script>
    <script src="./assets/js/toastr.min.js"></script>



    <script>
        clockUpdate();

        setInterval(clockUpdate, 1000);





        function clockUpdate() {
            var date = new Date();

            function addZero(x) {
                if (x < 10) {
                    return x = '0' + x;
                } else {
                    return x;
                }
            }

            var year = addZero(date.getFullYear());
            var day = date.getDay();
            switch (day) {
                case 1:
                    day = "Mon "
                    break;
                case 2:
                    day = "Tue "
                    break;

                case 3:
                    day = "Wed "
                    break;
                case 4:
                    day = "Thur "
                    break;
                case 5:
                    day = "Fri "
                    break;
                case 6:
                    day = "Sat "
                    break;
                case 0:
                    day = "Sun "
                    break;

                default:
                    break;
            }
            var month = addZero(date.getMonth() + 1);
            var dat = addZero(date.getDate());
            var h = addZero(date.getHours());
            var m = addZero(date.getMinutes());
            var s = addZero(date.getSeconds());

            $('.digital-clocks').text(h + ':' + m + ':' + s)
            $('.date-container').text(day + ' ' + dat + ' - ' + month + ' - ' + year);
        }
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        })





        $(".submit").unbind('submit').bind('submit', function() {

            var form = $(this);

            var formData = new FormData($(this)[0]);
            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: formData,
                dataType: 'json',
                cache: false,
                contentType: false,
                processData: false,
                async: false,
                success: function(response) {
                    if (response.success == true) {

                        if (response.messages == true) {
                            Toast.fire({
                                icon: 'success',
                                title: "Account information sucessfuly updated "
                            })
                            setTimeout(() => {
                                window.location = './verify';
                            }, 3000)
                        } else {
                            Toast.fire({
                                icon: 'success',
                                title: "Account information sucessfuly updated "
                            })
                        }



                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: "An error occured while updating the account information"
                        })

                    }

                }
            });
            return false;

        });
        $(".change-password").click(() => {
            async function formDataInputs() {
                const {
                    value: formValues
                } = await Swal.fire({
                    title: 'Change password',
                    confirmButtonColor: "rgba(35, 162,197,0.8)",
                    showCancelButton: true,
                    confirmButtonText: 'Change password',
                    html: '<input id="swal-input1" type="password" placeholder="Current password" class="swal2-input">' +
                        '<input id="swal-input2" type="password" placeholder="New password" class="swal2-input">' +
                        '<input id="swal-input3" type="password" placeholder="Confirm  password" class="swal2-input">',
                    focusConfirm: false,
                    preConfirm: () => {
                        return [
                            document.getElementById('swal-input1').value,
                            document.getElementById('swal-input2').value,
                            document.getElementById('swal-input3').value
                        ]
                    }
                })

                if (formValues) {
                    console.log(formValues);
                    //Swal.fire(JSON.stringify(formValues))
                    fetch("./backend/changePassword.php?o=" + formValues[0] + "&n=" + formValues[1] + "&c=" + formValues[2])
                        .then((resp) => {
                            return resp.json();
                        }).then((backData) => {
                            const gotData = backData;
                            if (gotData.success == true) {
                                Swal.fire(gotData.messages, '', 'success');

                            } else {
                                Swal.fire(gotData.messages, '', 'error');
                            }
                        })
                }
            }
            formDataInputs();
        })

        const menu = document.querySelector("#menu")
        const openMenu = document.querySelector("#open-menu")
        const closeMenu = document.querySelector("#close-menu")

        openMenu.addEventListener('click', () => {
            menu.classList.add('translate-x-0')
        })
        closeMenu.addEventListener('click', () => {
            menu.classList.remove('translate-x-0')
        })
    </script>


</body>

</html>